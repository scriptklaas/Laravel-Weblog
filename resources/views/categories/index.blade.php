@extends('layouts.app')

@section('title', 'Categories')

@section('content')
<h1>Existing categories:</h1>
<table>
    @foreach($category as $category)
        <tr>
            <td>{{ $category->name }}</td>
    @endforeach
</table>
<h1>Make a new category</h1>
<form action="{{ route('categories.store') }}" method="POST">
    @csrf
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" required>
    <button type="submit">Save</button>
</form>
@endsection