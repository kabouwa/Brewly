<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class OrderController extends Controller
{
    private function handleOrder(array $data, Order|null $order = null)
    {
        return DB::transaction(function () use ($data, $order) {
            if ( is_null($order) ) {
                $order = Order::create([
                    'status' => $data['status'] ?? 'PENDING',
                    'table' => $data['table'] ?? null,
                    'total_price' => 0,
                    'note' => $data['note'] ?? null,
                ]);
            }else {
                $order->update([
                    'note' => $data['note'] ?? null,
                    'table' => $data['table'] ?? null,
                    'status' => $data['status'] ?? $order->status,
                ]);
                foreach($order->items as $item) $item->delete();
            }

            $totalPrice = 0;

            foreach($data['items'] as $item) {
                $product = Product::where('reference', $item['product_reference'])->lockForUpdate()->firstOrFail();

                $q = $item['quantity'];

                if ($q > $product->stock) {
                    throw ValidationException::withMessages([
                        'items' => [
                            "Insufficient stock for product {$product->reference}.",
                        ]
                    ]);
                }

                OrderItem::create([
                    'product_id' => $product->id,
                    'order_id' => $order->id,
                    'purchase_price' => $product->purchase_price,
                    'selling_price' => $product->selling_price,
                    'quantity' => $q

                ]);

                $product->decrement('stock', $q);

                $totalPrice += $product->selling_price * $q;
            }

            $order->update([
                'total_price' => $totalPrice
            ]);

            return $order->load('items.product.category');
        });
    }

    public function index(Request $request)
    {
        $this->authorize('viewAny', Order::class);

        // All orders without items
        $orders = Order::when($request->status, function ($query) use ($request){
                $query->where('status', $request->status);
            })
            ->get();

        return response()->json([
            "success" => true,
            "message"=> "Orders retrieved successfully.",
            "total" => $orders->count(),
            "data" => OrderResource::collection($orders)
        ], 200);
    }

    public function store(OrderRequest $request)
    {
        $this->authorize('create', Order::class);

        $data = $request->validated();

        $order = $this->handleOrder($data);

        return response()->json([
            "success" => true,
            "message"=> "Order created successfully.",
            "data" => new OrderResource($order)
        ], 201);
    }

    public function show(Order $order)
    {
        $this->authorize('view', $order);

        // One order with items products and categories
        $order->load('items.product.category');

        return response()->json([
            "success" => true,
            "message"=> "Order retrieved successfully.",
            "data" => new OrderResource($order)
        ], 200);
    }

    public function update(OrderRequest $request, Order $order)
    {
        $this->authorize('update', $order);

        $data = $request->validated();

        $order = $this->handleOrder($data, $order);

        return response()->json([
            "success" => true,
            "message"=> "Order updated successfully.",
            "data" => new OrderResource($order)
        ], 200);
    }

    public function status(Request $request, Order $order)
    {
        $this->authorize('updateStatus', $order);

        $statues = ['PENDING','PREPARING','READY','COMPLETED','CANCELED'];

        $data = $request->validate([
            'status' => ['nullable','string', Rule::in($statues)],
        ]);

        $order->update([
            'status' => strtoupper($data['status'])
        ]);

        return response()->json([
            "success" => true,
            "message"=> "Order status updated successfully to " . strtolower($data['status']) . ".",
            "data" => null
        ], 200);
    }

    public function destroy(Order $order)
    {
        $this->authorize('delete', $order);

        $order->delete();

        return response()->json([
            "success" => true,
            "message"=> "Order deleted successfully.",
            "data" => null
        ], 200);
    }
}
