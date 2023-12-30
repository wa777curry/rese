@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
<link rel="stylesheet" href="{{ asset('css/detail.css') }}">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
<script src="{{ asset('js/app.js') }}"></script>
@endsection

@section('content')
<div class="mypage__main">
    <div class="mypage__content">
        <!-- 予約状況の表示 -->
        <div class="mypage__status">
            <div class="greeting__name">　</div>
            <div class="mypage__main--ttl">予約状況</div>
            @if(!$reservations->isEmpty())
            @foreach($reservations as $reservation)
            <div class="mypage__form">
                <div class="mypage__form--ttl">
                    <div class="mypage__form--icon"><i class="fa fa-clock-o fa-2x"></i></div>
                    <span>予約{{ $reservation->number }}</span>
                    <div class="mypage__form--close"><i class="fa fa-times-circle-o fa-2x"></i></div>
                </div>
                <div class="mypage__history">
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
                </div>
            </div>
            @endforeach
            @else
            <div class="mypage__form">
                <div class="mypage__form--ttl">
                    <div class="mypage__form--icon"><i class="fa fa-clock-o fa-2x"></i></div>予約
                    <div class="mypage__form--close"><i class="fa fa-times-circle-o fa-2x"></i></div>
                </div>
                <div class="reservation__confirmation--content">
                    <div class="mypage__history--text">
                        予約はありません
                    </div>
                </div>
            </div>
            @endif
        </div>

        <!-- お気に入り店舗 -->
        <div class="mypage__favorite">
            <div class="greeting__name">{{ Auth::user()->username }}さん</div>

            <div class="mypage__main--ttl">お気に入り店舗</div>
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
    </div>
</div>
@endsection