<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        
        return response()->json([
            'success' => true,
            'message' => 'List Categories',
            'data' => $categories
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:categories'
        ]);

        $category =  new Category();
        $category->name = $request->name;
        $category->save();

        return response()->json([
            'success' => true,
            'message' => "Category successfully created",
            'data' => $category
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|unique:categories'
        ]);

        $category = Category::find($id);
        $category->name = $request->name;
        $category->update();

        return response()->json([
            'success' => true,
            'message' => "Category successfully updated",
            'data' => $category
        ], 200);

    }
}
