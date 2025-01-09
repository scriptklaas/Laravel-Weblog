@extends('layouts.app')

@section('title', 'Home')

@section('content')
<h1>Laravel Weblog</h1>
<h2><a href="{{ route('posts.login') }}">Login</a> to make posts of your own</h2>
<h2>Posts by other people:</h2>
<table>
    <thead>
        <tr>
            <th>Title</th>
            <th>Content</th>
            <th>Posted/Edited at:</th>
        </tr>
    </thead>
    <tbody>
        @foreach($posts as $post)
            <tr>
                <td><a href="{{ route('posts.show', $post->id) }}">{{ $post->title }}</a></td>
                <td>{{ $post->body }}</td>
                <td>{{ $post->updated_at }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection