@extends('layouts.app')

@section('title', 'Purchase Premium Access')

@section('content')
@auth
<h2>Click here to become a paid member</h2>
<form action="{{ route('users.membership') }}" method="POST">
@csrf
<button>Subscribe</button>
</form>
@endauth
<p>If there's nothing here please login</p>
@endsection