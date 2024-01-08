@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
<link rel="stylesheet" href="{{ asset('css/detail.css') }}">
@endsection

@section('content')
<div class="mypage__greeting--ttl">
    <button class="back__button" style="cursor: default">＞</button>
    <div class="greeting__name">{{ Auth::user()->username }}さんのマイページ</div>
</div>
<div class="mypage__main">
    <div class="mypage__menu">
        <div class="mypage__menu--ttl">
            <div class="mypage__menu--item" id="menu-favorite">お気に入り店舗</div>
            <div class="mypage__menu--item" id="menu-reservation">予約状況</div>
            <div class="mypage__menu--item" id="menu-history">予約履歴</div>
        </div>
    </div>

    <div class="mypage__content">
        @include('mypage.favorite', ['favoriteShops' => $favoriteShops])
        @include('mypage.reservation', ['reservations' => $reservations])
        @include('mypage.history', ['pastReservations' => $pastReservations])
    </div>
</div>
@endsection

@push('scripts')
<script defer src="{{ asset('js/mypage.js') }}"></script>
@endpush