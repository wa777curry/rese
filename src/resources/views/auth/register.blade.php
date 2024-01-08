@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/form.css') }}">
@endsection

@section('content')
<div class="login__form--reg">
    <div class="login__form--ttl">Registration</div>
    <form action="{{ route('postRegister') }}" method="post">
        @csrf
        <div class="login__form--main">
            <div class="login__form--text">
                <div class="icon"><i class="fa fa-user fa-lg"></i> </div>
                <input type="text" name="username" placeholder="Username" value="{{ old('username') }}">
            </div>
            <div class="login__form--text">
                <div class="icon"><i class="fa fa-envelope"></i></div>
                <input type="email" name="email" placeholder="Email" value="{{ old('email') }}">
            </div>
            <div class="login__form--text">
                <div class="icon"><i class="fa fa-lock fa-lg "></i></div>
                <input type="password" name="password" placeholder="Password">
            </div>
            <div class="login__form--btn">
                <button class="button" type="submit">登録</button>
            </div>
        </div>
    </form>
</div>
<div class="form__error">
    @error('username')
    {{ $message }}
    @enderror
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
@endsection