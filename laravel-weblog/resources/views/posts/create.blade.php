@extends('layouts.app')

@section('title', 'Create')

@section('content')
<h1>Make new post</h1>
<form action="{{ route('posts.store') }}" id="createform" method="POST">
    @csrf
    <label for="title">Title:</label>
    <input type="text" id="title" name="title" required>
    <br>
    <label for="body">Post:</label>
    <textarea id="body" name="body"></textarea>
    <br>
    
    <label for="category_id[]">Categories</label>
    <select multiple="multiple" name="category_id[]" id="category_id[]" size='4' form="createform">
        @foreach($categories as $category)
        <option value="{{$category->id}}">{{  $category->name  }}</option>
        @endforeach
    </select>
    <br>
    <br>
    <label for="user_id">User id:</label>
    <input type="number" id="user_id" name="user_id" value="{{$user->id}}" required>
    <br>
    <button type="submit">Save</button>
    <br>
</form>
@endsection