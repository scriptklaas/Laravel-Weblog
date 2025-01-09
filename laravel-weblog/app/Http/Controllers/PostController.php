<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use Illuminate\Auth\Events\Validated;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::check()) {
            $user = Auth::user();
            $comments = Comment::where('user_id', $user->id)->get();
            $posts = Post::where('user_id', $user->id)->orderBy('updated_at', 'desc')->get();
            
            return view('posts.index', compact('posts', 'comments', 'user'));
        } else {
            $posts = Post::orderBy('updated_at', 'desc')->get();
            return view('welcome', compact('posts'));
        }
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::user();
        $categories = Category::get();
        return view('posts.create', compact('user', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        $validated = $request->validated();

        $post = Post::create($validated);
        
        $post->categories()->sync($validated->category_id);

        return redirect()->route('posts.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        $category_post = DB::table('category_post')->where('post_id', $post->id)->pluck('category_id');
        $category = Category::whereIn('id', $category_post)->pluck('name');
        $comment = Comment::where('post_id', $post->id)->pluck('body');
        return view('posts.show', compact('post', 'comment', 'category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $user = Auth::user();
        $categories = Category::get();
        return view('posts.edit', compact('post', 'categories', 'user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $validated = $request->validated();

        $post->update($validated);
        dd($validated);
        $post->categories()->sync($validated);

        return redirect()->route('posts.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('posts.index');
    }
}
