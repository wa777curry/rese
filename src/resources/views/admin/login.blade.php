@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/form.css') }}">
@endsection

@section('content')
<div class="login__form-ad">
    <div class="login__form--ttl">Administrator Login</div>
    <form action="{{ route('postAdmin') }}" method="post">
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
            <div class="login__form--text-ad">
                <input type="radio" name="role" value="admin" checked>　管理者
                <input type="radio" name="role" value="representative">　店舗代表者
            </div>
            <div class="login__form--btn">
                <button class="button" type="submit">ログイン</button>
            </div>
        </div>
    </form>
</div>
<div class="form__error">
    @if ($errors->has('postAdmin'))
    <div class="form__alert">
        {{ $errors->first('postAdmin')}}
    </div>
    @endif
</div>
@endsection