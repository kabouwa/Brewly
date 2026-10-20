<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryRessource;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::when($request->search, function ($query) use ($request){
                $query->where('title', 'LIKE', '%' . $request->search . '%');
            })
            ->when($request->has('active'), function ($query) use ($request){
                $query->where('active', (boolean) $request->active);
            })
            ->get();

        return response()->json([
            "success" => true,
            "message"=> "Categories retrieved successfully",
            "total" => $categories->count(),
            "data" => CategoryRessource::collection($categories)
        ], 200);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['required','string','min:3','max:255',Rule::unique(Category::class)]
        ]);

        $category = Category::create($data);

        return response()->json([
            "success" => true,
            "message"=> "Category created successfully",
            "data" => new CategoryRessource($category)
        ], 201);
    }

    public function show(Category $category)
    {
        return response()->json([
            "success" => true,
            "message"=> "Category retrieved successfully",
            "data" => new CategoryRessource($category)
        ], 200);
    }

    public function update(Request $request, Category $category)
    {
        $data = $request->validate([
            'title' => ['required','string','min:3','max:255',Rule::unique(Category::class)->ignore($category)]
        ]);

        $category->update($data);

        return response()->json([
            "success" => true,
            "message"=> "Category updated successfully",
            "data" => new CategoryRessource($category)
        ], 200);
    }

    public function toggle(Category $category)
    {
        $category->update([
            'active' => !$category->active
        ]);

        return response()->json([
            "success" => true,
            "message"=> "Category " . ($category->active ? 'activated' : 'disabled') . " successfully",
            "data" => new CategoryRessource($category)
        ], 200);
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return response()->json([
            "success" => true,
            "message"=> "Category deleted successfully",
            "data" => null
        ]);
    }
}
