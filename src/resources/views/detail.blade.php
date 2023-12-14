@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/detail.css') }}">
<script src="{{ asset('js/app.js') }}"></script>
@endsection

@section('content')
<div class="shop__main">
    <!-- 店舗詳細 -->
    <div class="shop__detail">
        <div class="shop__detail--ttl">
            <div>
                <button class="back__button">
                    <a href="#" onclick="window.history.back(); return false;">＜</a>
                </button>
            </div>
            <div class="shop__detail--name">{{ $shop->shop_name }}</div>
        </div>
        <div class="shop__detail--img">
            <img src="{{ $shop->image_url }}">
        </div>
        <div class="shop__detail--tag">#{{ $shop->area }}</div>
        <div class="shop__detail--tag">#{{ $shop->genre }}</div>
        <div class="shop__detail--summary">{{ $shop->shop_summary }}</div>
    </div>

    <!-- 予約フォーム -->
    <div class="reservation__form">
        <form action="{{ route('postReservation', ['id' => $shop->id]) }}" method="post">
            @csrf
            <div class="reservation__form--ttl">予約</div>
            <input type="hidden" name="shop_id" value="{{ $shop->id }}">
            <div class="form__error">
                @error('reservation_date')
                {{ $message }}
                @enderror
            </div>
            <div class="form__error">
                @error('reservation_number')
                {{ $message }}
                @enderror
            </div>
            <div class="reservation__form--date">
                <input name='reservation_date' type="date">
            </div>
            <div class="reservation__form--time">
                <select id="reservationTime" name="reservation_time">
                    @foreach($times as $time)
                    <option value="{{ $time }}">{{ $time }}</option>
                    @endforeach
                </select>
            </div>
            <div class="reservation__form--number">
                <select id="reservationNumber" name="reservation_number">
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
                <button class="button" type="submit">予約する</button>
            </div>
        </form>
    </div>
</div>
@endsection