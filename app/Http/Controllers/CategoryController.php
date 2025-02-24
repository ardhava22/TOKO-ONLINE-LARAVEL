<?php

namespace App\Http\Controllers;

use app\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    function store(Request $request)  {
        $request->validate(['name' => 'required|string|max:255']);
        $category = Category::create(['name' => $request->name]);
        return response()->json(['message' => 'Category created', 'data' => $category], 201);
    }
}
