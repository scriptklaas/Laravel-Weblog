@extends('layouts.app')

@section('title', 'Your Post')

@section('content')
        <h1>{{ $post->title }}</h1>
        <p>{{ $post->body }}</p>
                @if ($post->image != NULL)
                        <img src="{{ asset($post->image) }}">
                @endif
        <h2>Categories:</h2>
                @foreach ($category as $category)
                <p>{{ $category  }}</p>
                @endforeach
        <h2>Comments:</h2>
                @foreach ($comment as $comment)
                <p>{{ $comment }}</p>
                @endforeach
        <h2>Premium:</h2>
                @if ($post->paid != NULL)
                        <p>True</p>
                @else
                        <p>False</p>
                @endif
        <form action="{{ route('comments.store', $post->id) }}" method="POST">
                @csrf
                <label for="body">New Comment:</label>
                <br>
                <textarea id="body" name="body"></textarea>
                <br>
                <button type="submit">Comment</button>
                <br>
        </form>
@endsection