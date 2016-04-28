@extends('layout')
@section('content')

<form method="POST" action="/auth/login">
    {!! csrf_field() !!}

    <div>
        Email2
        <input type="text" name="email" value="{{ old('email') }}">
    </div>

    <div>
        Password
        <input type="password" name="password" id="password">
    </div>

    <div>
        <input type="checkbox" name="remember"> Remember Me
    </div>

    <div>
        <button type="submit">Login</button>
    </div>
</form>

@endsection 