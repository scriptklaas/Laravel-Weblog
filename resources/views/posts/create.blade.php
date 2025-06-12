@extends('layouts.app')

@section('title', 'Create')

@section('content')
<h1>Make new post</h1>
<form action="{{ route('posts.store') }}" id="createform" method="POST" enctype="multipart/form-data">
    @csrf
    <label for="title">Title:</label>
    <input type="text" id="title" name="title" required>
    <br>
    <label for="body">Post:</label>
    <textarea id="body" name="body"></textarea>
    <br>
    <input type="checkbox" id="paid" name="paid">Premium Content
    <br>
    <label for="category_id[]">Categories</label>
    <select multiple="multiple" name="category_id[]" id="category_id[]" size='4' form="createform">
        @foreach($categories as $category)
        <option value="{{$category->id}}">{{  $category->name  }}</option>
        @endforeach
    </select>
    <br>
    <button type="submit">Save</button>
    <br>
    <br>
    <h2>Add an image:</h2>
    <div>
    <label for="image">Choose file to upload</label>
    <input type="file" id="image" name="image">
    </div>
</form>

@endsection