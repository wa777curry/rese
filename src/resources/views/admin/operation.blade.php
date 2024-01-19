@extends('layouts.app-ad')

@section('css')
<link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
<link rel="stylesheet" href="{{ asset('css/detail.css') }}">
@endsection

@section('content')
<div class="mypage__greeting--ttl">
    <button class="back__button" style="cursor: default">＞</button>
    <div class="greeting__name">店舗代表者ページ</div>
</div>
<div class="mypage__main">
    <div class="mypage__menu">
        <div class="mypage__menu--ttl">
            <div class="mypage__menu--item active"><a href="{{ route('getOperation') }}">予約状況の確認</a></div>
            <div class="mypage__menu--item"><a href="{{ route('getUpload') }}">店舗情報の登録</a></div>
            <div class="mypage__menu--item"><a href="{{ route('getShoplist') }}">店舗情報一覧</a></div>
        </div>
    </div>

    <div class="mypage__content">
        <div class="mypage__content--section">
            <div class="mypage__content--item">予約状況の確認</div>
            <table class="data-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>予約者氏名</th>
                        <th>店舗名</th>
                        <th>予約日時</th>
                        <th>予約人数</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($reservations as $reservation)
                    <tr>
                        <td>{{ $reservation->id }}</td>
                        <td>{{ $reservation->user->username }}</td>
                        <td>{{ $reservation->shop->shop_name }}</td>
                        <td>{{ $reservation->reservation_date }}　{{ $reservation->reservation_time }}</td>
                        <td>{{ $reservation->reservation_number }}人</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection