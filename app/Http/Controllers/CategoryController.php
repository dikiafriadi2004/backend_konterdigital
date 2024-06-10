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
        ], 200);
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

    public function show($id) 
    {
        $category = Category::find($id);

        if(!$category){
            return response()->json([
                'success' => false,
                'message' => "Category for id: " .$id. " not found",
                'data' => null
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => "Detail Category",
            'data' => $category
        ], 200);
    }

    public function destroy($id)
    {
        $category = Category::find($id);
        $category->delete();

        return response()->json([
            'success' => true,
            'message' => "Category id: ". $id . " has been successfully deleted",
            'data' => null
        ], 200);
    }
}
