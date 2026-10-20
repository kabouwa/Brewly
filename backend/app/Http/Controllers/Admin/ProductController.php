<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductRessource;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    private function setCategory(array &$data) {
        // update slug to id in form data
        $category = Category::where('slug', $data['category'])->first('id');
        $data['category_id'] = $category->id;
        unset($data['category']);
    }

    public function index(Request $request)
    {
        $products = Product::with('category')
            ->when($request->search, function ($query) use ($request){
                $query->where('title', 'LIKE', '%' . $request->search . '%');
            })
            ->when($request->has('active'), function ($query) use ($request){
                $query->where('active', (boolean) $request->active);
            })
            ->get();

        return response()->json([
            "success" => true,
            "message"=> "Products retrieved successfully",
            "total" => $products->count(),
            "data" => ProductRessource::collection($products)
        ], 200);
    }

    public function store(ProductRequest $request)
    {
        $data = $request->validated();
        $this->setCategory($data);


        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products','public');
        }

        $product = Product::create($data);

        return response()->json([
            "success" => true,
            "message"=> "Product created successfully",
            "data" => new ProductRessource(Product::find($product->id))
        ], 201);
    }

    public function show(Product $product)
    {
        $product->load('category');

        return response()->json([
            "success" => true,
            "message"=> "Product retrieved successfully",
            "data" => new ProductRessource($product)
        ], 200);
    }

    public function update(ProductRequest $request, Product $product)
    {
        $data = $request->validated();
        $this->setCategory($data);

        if ($request->hasFile('image')) {
            $oldImage = $product->image;
            // Save new image
            $data['image'] = $request->file('image')->store('products','public');
        }else {
            unset($data['image']);
        }

        $product->update($data);

        // Delete old image if exists
        if (isset($oldImage) && !is_null($oldImage)) {
            Storage::disk('public')->delete($oldImage);
        }

        return response()->json([
            "success" => true,
            "message"=> "Products updated successfully",
            "data" => new ProductRessource($product)
        ], 200);
    }

    public function toggle(Product $product)
    {
        $product->update([
            'active' => !$product->active
        ]);

        return response()->json([
            "success" => true,
            "message"=> "Products " . ($product->active ? 'activated' : 'disabled') . " successfully",
            "data" => new ProductRessource($product)
        ], 200);
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return response()->json([
            "success" => true,
            "message"=> "Product deleted successfully",
            "data" => null
        ]);
    }
}
