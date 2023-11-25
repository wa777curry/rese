@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/form.css') }}">
@endsection

@section('content')
<div class="message__form">
    <div class="message__form--text">
        会員登録ありがとうございます
    </div>
    <div class="message__form--text">
        <a href="{{ route('login') }}">
            <button class="button" type="submit">ログインする</button>
        </a>
    </div>
</div>
@endsection