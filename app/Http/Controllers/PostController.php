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
use Illuminate\Support\Facades\Storage;
use Laravel\Pail\Files;
use Symfony\Component\HttpFoundation\File\File;

class PostController extends Controller
{
    
    // Display homepage
    public function welcome()
    {
        $categories = Category::get();
        $posts = Post::where('paid', false)->orderBy('updated_at', 'desc')->get();
        return view('welcome', compact('posts', 'categories'));
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::check()) {
            $user = Auth::user();
            
            $comments = Comment::where('user_id', $user->id)->get();
            
            $posts = Post::where('user_id', $user->id)->orderBy('updated_at', 'desc')->get();
            
            $categories = Category::get();

            return view('posts.index', compact('posts', 'comments', 'user', 'categories'));
        } 
        
        $categories = Category::get();
        
        $posts = Post::where('paid', false)->orderBy('updated_at', 'desc')->get();
        
        return view('welcome', compact('posts', 'categories'));        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Auth::check()) {
            $categories = Category::get();
            return view('posts.create', compact('categories'));
        } else {
            return redirect()->route('posts.login');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        // dd($request);
        $validated = $request->validated();
        
        $validated['user_id'] = Auth::user()->id;

        if ($request->has('image')) {
            $imageName = time().'.'.$request->image->extension();
            
            $request->image->move(public_path('storage/images'), $imageName);
            
            $validated['image'] = 'storage/images/'.$imageName;
        }

        if ($request->has('paid')) {
            $validated['paid'] = true;
        } else {
            $validated['paid'] = false;
        }

        $post = Post::create($validated);
        
        $post->categories()->sync($validated['category_id']);
        
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
        if (Auth::user()->id !== $post['user_id']) {
            return redirect()->route('posts.index');
        } else {
            $categories = Category::get();
            return view('posts.edit', compact('post', 'categories'));
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $validated = $request->validated();

        if ($request->has('image')) {
            $imageName = time().'.'.$request->image->extension();
            
            $request->image->move(public_path('storage/images'), $imageName);
            
            $validated['image'] = 'storage/images/'.$imageName;
        }

        if ($request->has('paid')) {
            $validated['paid'] = true;
        } else {
            $validated['paid'] = false;
        }
        $post->update($validated);
        
        $post->categories()->sync($validated['category_id']);
        
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

    // Display premium posts
    public function premium() 
    {
        if (Auth::check()) {
            if (Auth::user()['paid']) {
                $posts = Post::where('paid', true)->orderBy('updated_at', 'desc')->get();
                return view('premium.index', compact('posts'));
            } else {
                return redirect()->route('users.purchase');
            }
        } else {
            return redirect()->route('posts.login');
        }
    }
}
