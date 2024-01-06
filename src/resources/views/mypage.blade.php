@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
<link rel="stylesheet" href="{{ asset('css/detail.css') }}">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
<script src="{{ asset('js/app.js') }}"></script>
<script defer src="{{ asset('js/app-defer.js') }}"></script>
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
        <!-- お気に入り店舗の中身 -->
        <div id="favorite-section" class="mypage__content--section">
            <div class="mypage__content--item">お気に入り店舗</div>
            <div class="mypage__shop">
                @foreach($favoriteShops as $shop)
                <div class="shop__list--card">
                    <div class="shop__list--img">
                        <img src="{{ $shop->shop->image_url }}">
                    </div>
                    <div class="shop__content">
                        <div class="shop__content--name">{{ $shop->shop->shop_name }}</div>
                        <div class="shop__content--tag">#{{ $shop->shop->area->area_name }}</div>
                        <div class="shop__content--tag">#{{ $shop->shop->genre->genre_name }}</div>
                        <div class="shop__content--detail">
                            <a href="{{ route('detail', ['id' => $shop->shop->id]) }}"><button class="button" type="submit">詳しく見る</button></a>
                            @auth
                            @if(auth()->user()->favorites->contains($shop->shop->id))
                            <!-- お気に入り登録済みの場合 -->
                            <form action="{{ route('nofavorite', ['shop' => $shop->shop->id]) }}" method="get">
                                @csrf
                                <button class="f-button" type="submit"><i class="fa fa-heart fa-lg fa-2x on-color"></i></button>
                            </form>
                            @else
                            <!-- お気に入り未登録の場合 -->
                            <form action="{{ route('favorite', ['shop' => $shop->shop->id]) }}" method="get">
                                @csrf
                                <button class="f-button" type="submit"><i class="fa fa-heart fa-lg fa-2x off-color"></i></button>
                            </form>
                            @endif
                            @endauth
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- 予約状況の中身 -->
        <div id="reservation-section" class="mypage__content--section">
            <div class="mypage__content--item">予約状況</div>
            @if(!$reservations->isEmpty())
            @foreach($reservations as $reservation)
            <div class="mypage__form">
                <div class="mypage__form--ttl">
                    <span class="mypage__form--icon"><i class="fa fa-clock-o fa-2x"></i>　予約{{ $reservation->number }}</span>
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
                        <span class="mypage__form--edit-icon"><i class="fa fa-edit fa-2x"></i> 変更</span>
                        <span class="mypage__form--edit-icon"><i class="fa fa-times-circle fa-2x"></i> 削除</span>
                        <span class="mypage__form--edit-icon"><i class="fa fa-qrcode fa-2x"></i> ＱＲ</span>
                    </div>
                </div>
            </div>
            @endforeach
            @else
            <div class="mypage__form">
                <div class="mypage__form--ttl">
                    <span class="mypage__form--icon"><i class="fa fa-clock-o fa-2x"></i>　現在予約はありません</span>
                </div>
            </div>
            @endif
        </div>

        <!-- 予約履歴の中身 -->
        <div id="history-section" class="mypage__content--section">
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