@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/form.css') }}">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
@endsection

@section('content')
<div class="login__form--reg">
    <div class="login__form--ttl">Registration</div>
    <div class="login__form--main">
        <div class="login__form--text">
            <div class="icon"><i class="fa fa-user fa-lg"></i> </div>
            <input type="text" placeholder="Username" value="{{ old('name') ?: session('name') }}">
        </div>
        <div class="login__form--text">
            <div class="icon"><i class="fa fa-envelope"></i></div>
            <input type="email" placeholder="Email" value="{{ old('email') ?: session('email') }}">
        </div>
        <div class="login__form--text">
            <div class="icon"><i class="fa fa-lock fa-lg "></i></div>
            <input type="password" placeholder="Password">
        </div>
        <div class="login__form--btn">
            <button class="button" type="submit">登録</button>
        </div>
    </div>
</div>
<div class="form__error">
    @error('name')
    {{ $message }}
    @enderror
    @error('email')
    {{ $message }}
    @enderror
    @error('password')
    {{ $message }}
    @enderror
    エラー内容の表示 <!-- 後で消す -->
</div>
@if ($errors->has('login'))
<div class="form__alert">
    {{ $errors->first('login')}}
</div>
@endif
@endsection