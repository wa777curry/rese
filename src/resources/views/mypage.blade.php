@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
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
            <div class="mypage__form">
                <div class="mypage__form--ttl">
                    <div class="mypage__form--icon"><i class="fa fa-clock-o fa-2x"></i></div>予約
                    <div class="mypage__form--close"><span class="round_btn" onclick="closeReservationForm()"></span></div>
                </div>
                <!-- あとでDBのタグに変更すること -->
                <div class="mypage__history">
                    <div class="mypage__history--text">Shop</div>
                    <!-- ここにDBからの情報 -->
                    <div class="mypage__history--text">Date</div>
                    <!-- ここにDBからの情報 -->
                    <div class="mypage__history--text">Time</div>
                    <!-- ここにDBからの情報 -->
                    <div class="mypage__history--text">Number</div>
                    <!-- ここにDBからの情報 -->
                </div>
            </div>
        </div>

        <!-- お気に入り店舗 -->
        <div class="mypage__favorite">
            <div class="greeting__name">{{ Auth::user()->username }}さん</div>

            <!-- あとでDBのタグに変更すること -->
            <div class="mypage__main--ttl">お気に入り店舗</div>
            <div class="mypage__shop">
                <div class="shop__list--card">
                    <div class="shop__list--img">
                        <img src="{{ asset('storage/sushi.jpg') }}">
                    </div>
                    <div class="shop__content">
                        <div class="shop__content--name">仙人</div>
                        <div class="shop__content--tag">#東京都</div>
                        <div class="shop__content--tag">#寿司</div>
                        <div class="shop__content--detail">
                            <a href=""><button class="button" type="submit">詳しく見る</button></a>
                            <i class="fa fa-heart-o fa-lg"></i>
                        </div>
                    </div>
                </div>
                <div class="shop__list--card">
                    <div class="shop__list--img">
                        <img src="{{ asset('storage/sushi.jpg') }}">
                    </div>
                    <div class="shop__content">
                        <div class="shop__content--name">仙人</div>
                        <div class="shop__content--tag">#東京都</div>
                        <div class="shop__content--tag">#寿司</div>
                        <div class="shop__content--detail">
                            <a href=""><button class="button" type="submit">詳しく見る</button></a>
                            <i class="fa fa-heart-o fa-lg"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection