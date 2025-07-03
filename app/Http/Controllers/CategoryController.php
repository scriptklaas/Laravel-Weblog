<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCategoryRequest;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function index() {
        $category = Category::get();
        return view('categories.index' , compact('category'));
    }

    public function store(StoreCategoryRequest $request) {
        
        $validated = $request->validated();

        Category::create($validated);

        $category = Category::get();
        return view('categories.index' , compact('category'));
    }

    public function show(Request $request) {
        
        $category = Category::where('id', $request->category_id)->with('posts')->first();

        $post = $category->posts;

        return view('categories.show', compact('post', 'category'));
    }
}