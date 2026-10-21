<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderItemRequest;
use App\Http\Resources\OrderItemResource;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderItemController extends Controller
{
    public function index(Request $request)
    {
        $this->authorize('viewAny', OrderItem::class);

        $orderItems = OrderItem::with(['product.category', 'order'])
            ->when($request->status, function ($query) use ($request){
                $query->where('status', $request->status);
            })
            ->get();

        return response()->json([
            "success" => true,
            "message"=> "Order items retrieved successfully.",
            "total" => $orderItems->count(),
            "data" => OrderItemResource::collection($orderItems)
        ], 200);
    }

    public function store(OrderItemRequest $request)
    {
        $this->authorize('create', OrderItem::class);

        $data = $request->validated();

        $product = Product::where('reference', $data['product_reference'])->first(['id','stock','selling_price','purchase_price']);
        $data['product_id'] = $product->id;
        $data['selling_price'] = $product->selling_price;
        $data['purchase_price'] = $product->purchase_price;
        unset($data['product_reference']);

        $order = Order::where('reference', $data['order_reference'])->first(['id']);
        $data['order_id'] = $order->id;
        unset($data['order_reference']);

        if ($order->status !== 'PREPARING') {
            return response()->json([
                "success" => false,
                "message"=> "Order items can only be added when the order is in PREPARING status.",
                "errors" => [
                    "quantity" => ["Order items can only be added when the order is in PREPARING status."]
                ],
                "data" => null
            ], 422);
        }

        if ($data['quantity'] > $product->stock) {
            return response()->json([
                "success" => false,
                "message"=> "Quantity exceeds the available stock.",
                "errors" => [
                    "quantity" => ["Quantity exceeds the available stock."]
                ],
                "data" => null
            ], 422);
        }

        $orderItem = DB::transaction(function () use ($product, $data) {
            $orderItem = OrderItem::create($data);

            $orderItem->order->increment('total_price', $orderItem->selling_price * $orderItem->quantity);

            return $orderItem->load(['product.category','order']);
        });

        return response()->json([
            "success" => true,
            "message"=> "Order item created successfully.",
            "data" => new OrderItemResource($orderItem)
        ], 201);
    }

    public function show(OrderItem $orderItem)
    {
        $this->authorize('view', $orderItem);

        $orderItem->load(['product.category','order']);

        return response()->json([
            "success" => true,
            "message"=> "Order item retrieved successfully.",
            "data" => new OrderItemResource($orderItem)
        ], 200);
    }

    public function update(Request $request, OrderItem $orderItem)
    {
        $this->authorize('update', $orderItem);

        $data = $request->validate([
            'quantity' => ['required', 'integer', 'min:1']
        ]);

        // DB Transcation rollback if a query is failed
        return DB::transaction(function () use ($orderItem,$data) {
            $product = Product::findOrFail($orderItem?->product->id);

            $q = $data['quantity'];

            if ($q > $product->stock + $orderItem->quantity) {
                return response()->json([
                    "success" => false,
                    "message"=> "Quantity exceeds the available stock.",
                    "errors" => [
                        "quantity" => ["Quantity exceeds the available stock."]
                    ],
                    "data" => null
                ], 422);
            }

            // Decrement or increment stock and total price if quantity changes
            $quantityDifference = $q - $orderItem->quantity;
            if ($quantityDifference) {
                $priceDifference = $orderItem->selling_price * $quantityDifference;
                $orderItem->order->increment('total_price', $priceDifference);

                $product->decrement('stock', $quantityDifference);

                $orderItem->update($data);
            }

            $orderItem->load(['product.category','order']);

            return response()->json([
                "success" => true,
                "message"=> "Order item quantity updated successfully.",
                "data" => new OrderItemResource($orderItem)
            ], 200);
        });
    }

    public function destroy(OrderItem $orderItem)
    {
        $this->authorize('delete', $orderItem);

        $orderItem->delete();

        return response()->json([
            "success" => true,
            "message"=> "Order item deleted successfully.",
            "data" => null
        ]);
    }
}
