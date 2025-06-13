@extends('layouts.app')

@section('title', 'Home')

@section('content')
<h1>Laravel Weblog</h1>
<h2>Filter by category:</h2>
<label for="category_id">Categories:</label>
<br>
<form action="{{ route('categories.show') }}" method="GET">
    <select name="category_id" id="category_id" size='4'>
        @foreach($categories as $category)
        <option value="{{$category->id}}">{{  $category->name  }}</option>
        @endforeach
    </select>
    <br>
    <button type="submit">Filter</button>
</form>
<h2>All posts:</h2>
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

