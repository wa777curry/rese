@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/form.css') }}">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
@endsection

@section('content')
<div class="login__form">
    <div class="login__form--ttl">Login</div>
    <form action="{{ route('postLogin') }}" method="post">
        @csrf
        <div class="login__form--main">
            <div class="login__form--text">
                <div class="icon"><i class="fa fa-envelope"></i></div>
                <input type="email" name="email" placeholder="Email" value="{{ old('email') }}">
            </div>
            <div class="login__form--text">
                <div class="icon"><i class="fa fa-lock fa-lg"></i></div>
                <input type="password" name="password" placeholder="Password">
            </div>
            <div class="login__form--btn">
                <button class="button" type="submit">ログイン</button>
            </div>
        </div>
    </form>
</div>
<div class="form__error">
    @error('email')
    {{ $message }}
    @enderror
</div>
<div class="form__error">
    @error('password')
    {{ $message }}
    @enderror
</div>
<div class="form__error">
    @if ($errors->has('postLogin'))
    <div class="form__alert">
        {{ $errors->first('postLogin')}}
    </div>
    @endif
</div>
    @endsection