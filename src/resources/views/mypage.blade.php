@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
<link rel="stylesheet" href="{{ asset('css/detail.css') }}">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

@endsection

@section('content')
<div class="mypage__greeting--ttl">
    <button class="back__button" style="cursor: default">＞</button>
    <div class="greeting__name">{{ Auth::user()->username }}さんのマイページ</div>
</div>
<div class="mypage__main">
    <div class="mypage__menu">
        <div class="mypage__menu--ttl">
            <div class="mypage__menu--item">
                <a href="{{ route('getFavorite') }}" id="menu-favorite">お気に入り店舗</a>
            </div>
            <div class="mypage__menu--item">
                <a href="{{ route('mypage') }}" id="menu-reservation">予約状況</a>
            </div>
            <div class="mypage__menu--item">
                <a href="{{ route('mypage') }}" id="menu-history">予約履歴</a>
            </div>
        </div>

        <div class="mypage__content">
            @include('mypage.favorite')
        </div>
    </div>
</div>
@endsection