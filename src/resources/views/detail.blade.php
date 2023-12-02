@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/detail.css') }}">
<script src="{{ asset('js/app.js') }}"></script>
@endsection

@section('content')
<div class="shop__main">
    <!-- あとでDBのタグに変更すること -->
    <!-- 店舗詳細 -->
    <div class="shop__detail">
        <div class="shop__detail--ttl">
            <div>
                <button class="back__button">
                    <a href="#" onclick="window.history.back(); return false;">＜</a>
                </button>
            </div>
            <div class="shop__detail--name">仙人</div>
        </div>
        <div class="shop__detail--img">
            <img src="{{ asset('storage/sushi.jpg') }}">
        </div>
        <div class="shop__detail--tag">#東京都</div>
        <div class="shop__detail--tag">#寿司</div>
        <div class="shop__detail--overview">
            料理長厳選の食材から作る寿司を用いたコースをぜひお楽しみください。食材・味・価格、お客様の満足度を徹底的に追及したお店です。特別な日のお食事、ビジネス接待まで気軽に使用することができます。
        </div>
    </div>

    <!-- 予約フォーム -->
    <div class="reservation__form">
        <form action="{{ route('reservation.submit') }}" method="post">
            @csrf
            <div class="reservation__form--ttl">予約</div>
            <div class="reservation__form--date">
                <input type="date">
            </div>
            <div class="reservation__form--time">
                <select id="reservationTime" name="reservationTime">
                    @foreach($times as $time)
                    <option value="{{ $time }}">{{ $time }}</option>
                    @endforeach
                </select>
            </div>
            <div class="reservation__form--number">
                <select id="reservationNumber" name="reservationNumber">
                    @foreach($numbers as $number)
                    <option value="{{ $number }}">
                        {{ $number === '10人以上' ? $number : $number . '人' }}
                    </option>
                    @endforeach
                </select>
            </div>

            <div class="reservation__history">
                <div class="reservation__history--name">Shop</div>
                <!-- ここにDBからの情報 -->
                <div class="reservation__history--date">Date</div>
                <!-- ここにDBからの情報 -->
                <div class="reservation__history--time">Time</div>
                <!-- ここにDBからの情報 -->
                <div class="reservation__history--number">Number</div>
                <!-- ここにDBからの情報 -->
            </div>

            <div class="reservation__form--btn">
                @guest
                <a href="{{ route('postLogin') }}"><button type="button">予約する</button></a>
                @endguest
                @auth
                <a href="{{ route('done') }}"><button type="button">予約する</button></a>
                @endauth
            </div>
        </form>
    </div>
</div>
@endsection