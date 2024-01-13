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
            <div class="mypage__menu--item"><a href="{{ route('getFavorite') }}">お気に入り店舗</a></div>
            <div class="mypage__menu--item"><a href="{{ route('getReservation') }}">予約状況</a></div>
            <div class="mypage__menu--item active"><a href="{{ route('getHistory') }}">予約履歴</a></div>
        </div>
    </div>

    <div class="mypage__content">
        <div class="mypage__content--section">
            <div class="mypage__content--item">予約履歴</div>
            @if(!$pastReservations->isEmpty())
            @foreach($pastReservations as $reservation)
            <div class="mypage__form">
                <div class="mypage__form--ttl">
                    <span class="mypage__form--icon"><i class="fa fa-clock-o fa-2x fa-flip-horizontal"></i>　履歴{{ $reservation->number }}</span>
                </div>
                <div class="mypage__history accordion-content">
                    <div class="reservation__confirmation--content">
                        <span class="reservation__confirmation--ttl">Shop</span>
                        <span>{{ $reservation->shop->shop_name }}</span>
                    </div>
                    <div class="reservation__confirmation--content">
                        <span class="reservation__confirmation--ttl">Date</span>
                        <span>{{ $reservation->reservation_date }}</span>
                    </div>
                    <div class="reservation__confirmation--content">
                        <span class="reservation__confirmation--ttl">Time</span>
                        <span>{{ substr($reservation->reservation_time, 0, 5) }}</span>
                    </div>
                    <div class="reservation__confirmation--content">
                        <span class="reservation__confirmation--ttl">Number</span>
                        <span>{{ $reservation->reservation_number }}人</span>
                    </div>
                    <div class="mypage__form--bottom">
                        <span class="mypage__form--edit-icon"><i class="fa fa-star fa-2x"></i></span>
                        <span class="mypage__form--edit-icon"><i class="fa fa-commenting fa-2x"></i></span>
                    </div>
                </div>
            </div>
            @endforeach
            @else
            <div class="mypage__form">
                <div class="mypage__form--ttl">
                    <span class="mypage__form--icon"><i class="fa fa-clock-o fa-2x"></i>　過去の予約はありません</span>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection