@extends('layouts.app')

@section('title', 'Your Post')

@section('content')
        <h1>{{ $post->title }}</h1>
        <p>{{ $post->body }}</p>
        <h2>Categories:</h2>
        @foreach ($category as $category)
        <p>{{ $category  }}</p>
        @endforeach
        <h2>Comments:</h2>
                @foreach ($comment as $comment)
                <p>{{ $comment }}</p>
                @endforeach
        <form action="{{ route('comments.store', $post->id) }}" method="POST">
                @csrf
                <label for="body">New Comment:</label>
                <br>
                <textarea id="body" name="body"></textarea>
                <br>
                <button type="submit">Comment</button>
                <br>
                <br>
                <label for="user_id">User id:</label>
                <input type="number" id="user_id" name="user_id" value="{{$post->user_id}}" required>
                <br>
                <label for="post_id">Post id:</label>
                <input type="number" id="post_id" name="post_id" value="{{$post->id}}" required>
        </form>
@endsection