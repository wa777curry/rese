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
            <div class="mypage__menu--item"><a href="{{ route('getHistory') }}">予約履歴</a></div>
        </div>
    </div>

    <div class="mypage__content">
        <div class="mypage__content--section">
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
    </div>
</div>
@endsection