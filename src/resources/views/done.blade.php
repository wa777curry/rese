@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/form.css') }}">
@endsection

@section('content')
<div class="message__form">
    <div class="message__form--text">
        ご予約ありがとうございます
    </div>
    <div class="message__form--text">
        <a href="{{ route('index') }}">
            <button class="button" type="submit">戻る</button>
        </a>
    </div>
</div>
@endsection