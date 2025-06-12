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

    public function show() {
        $category_id = $_GET['category_id'];
        $category = Category::where('id', $category_id)->pluck('name')->first();
        $category_post = DB::table('category_post')->where('category_id', $category_id)->pluck('post_id');
        $post = Post::whereIn('id', $category_post)->get();
        return view('categories.show', compact('post', 'category'));
    }
}