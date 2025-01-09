@extends('layouts.app')

@section('title', 'Posts')
    
@section('content')
<h1>Posts</h1>
<table>
    <thead>
        <tr>
            <th>Naam</th>
            <th>Beschrijving</th>
            <th>Acties</th>
        </tr>
    </thead>
    <tbody>
        @foreach($posts as $post)
            <tr>
                <td>{{ $post->title }}</td>
                <td>{{ $post->body }}</td>
                <td>{{ $post->category->name }}</td>
                <td>Bewerken/Verwijderen</td>
                <td>
                    <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Verwijderen</button>
                    </form>
                </td>
                <td>
                    <a href="{{ route('posts.edit', $post->id) }}">Bewerken</a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection