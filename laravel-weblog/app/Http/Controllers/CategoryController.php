<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCategoryRequest;

class CategoryController extends Controller
{
    public function store(StoreCategoryRequest $request) {
        
        $validated = $request->validated();

        Category::create($validated);

        $category = Category::get();
        return view('categories' , compact('category'));
    }

    public function show() {
        $category = Category::get();
        return view('categories' , compact('category'));
    }
}
