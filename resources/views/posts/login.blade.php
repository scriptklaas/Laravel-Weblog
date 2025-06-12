@extends('layouts.app')

@section('title', 'Log In')
    
@section('content')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <h1>Log In:</h1>
    <br>
    <form action="{{ route('posts.login') }}" method="POST">
        @csrf
        <label for="email">E-Mail:</label>
        <input type="email" id="email" name="email" value="test@test.nl">
        <br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" value="password">
        <br>
        <input type="submit" value="Log in">
    </form>
@endsection