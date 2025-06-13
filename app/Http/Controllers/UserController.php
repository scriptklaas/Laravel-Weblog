<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function membership(UpdateUserRequest $request)
    {
        if (Auth::check()) {
            $user = User::where('id', Auth::id())->update(['paid' => true]);
            $posts = Post::where('paid', true)->get();
            return view('premium.index', compact('posts'));
        } else {
            return redirect()->route('posts.login');
        }
    }

    public function purchase()
    {
        if (Auth::check()) {
            return view('premium.purchase');
        } else {
            return redirect()->route('posts.login');
        }
    }
}
