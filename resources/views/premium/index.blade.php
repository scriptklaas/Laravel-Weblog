@extends('layouts.app')

@section('title', 'Premium content')

@section('content')
<h2>All premium posts</h2>
@auth
<h1>Posts</h1>
<table>
    <thead>
        <tr>
            <th>Title</th>
            <th>Content</th>
        </tr>
    </thead>
    <tbody>
        @foreach($posts as $post)
            <tr>
                <td><a href="{{ route('posts.show', $post->id) }}">{{ $post->title }}</a></td>
                <td>{{ $post->body }}</td>
        @endforeach
@endauth
@endsection