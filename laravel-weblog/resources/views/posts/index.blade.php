@extends('layouts.app')

@section('title', 'Posts')

@section('content')
<h1>Posts</h1>
<table>
    <thead>
        <tr>
            <th>Title</th>
            <th>Content</th>
            <th>Posted/Edited at:</th>
            <th>Edit/Delete</th>
        </tr>
    </thead>
    <tbody>
        @foreach($posts as $post)
            <tr>
                <td><a href="{{ route('posts.show', $post->id) }}">{{ $post->title }}</a></td>
                <td>{{ $post->body }}</td>
                <td>{{ $post->updated_at }}</td>
                @auth
                <td>
                    <form action="{{ route('posts.edit', $post) }}">
                        <button type="submit" value="{{ $post->id }}" name="{{ $post->id }}">Edit</button>
                    </form>
                </td>
                <td>
                    <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
                        
                        @csrf
                        @method('DELETE')
                        <button type="submit">Delete</button>
                    </form>
                </td>
                @endauth
            </tr>
        @endforeach
    </tbody>
</table>
@auth
    <h1>Comments</h1>
    <table>
        <thead>
            <tr>
                <th>Naam</th>
                <th>Beschrijving</th>
                <th>Acties</th>
            </tr>
        </thead>
        <tbody>
                @foreach($comments as $comment)
                    <tr>
                        <td><a href="{{ route('posts.show', $comment->post_id) }}">{{ $comment->body }}</td>
                        <td>Bewerken/Verwijderen</td>
                    </tr>
                @endforeach
        </tbody>
    </table>
@endauth
@endsection