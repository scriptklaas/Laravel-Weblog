@extends('layouts.app')

@section('title', 'Posts by Category')

@section('content')
        <h1>{{ $category }}</h1>
        <h2>Posts:</h2>
        @foreach ($post as $post)
        <p><a href="{{ route('posts.show', $post->id) }}">{{  $post->title  }}</p>
        @endforeach
        
@endsection