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
            <div class="mypage__menu--item"><a href="{{ route('getOperation') }}">予約状況の確認</a></div>
            <div class="mypage__menu--item"><a href="{{ route('getUpload') }}">店舗情報の登録</a></div>
            <div class="mypage__menu--item"><a href="{{ route('getCsvUpload') }}">店舗情報の登録（CSV）</a></div>
            <div class="mypage__menu--item active"><a href="{{ route('getShoplist') }}">店舗情報一覧</a></div>
        </div>
    </div>

    <div class="mypage__content">
        <div class="mypage__content--section">
            <div class="mypage__content--item">店舗情報一覧</div>
            <table class="data-table">
                <thead>
                    <tr>
                        <th nowrap>店舗名</th>
                        <th nowrap>都道府県</th>
                        <th nowrap>ジャンル</th>
                        <th nowrap>店舗概要</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($shops as $shop)
                    <tr>
                        <td nowrap>{{ $shop->shop_name }}</td>
                        <td nowrap>{{ $shop->area->area_name }}</td>
                        <td nowrap>{{ $shop->genre->genre_name }}</td>
                        <td>{{ $shop->shop_summary }}</td>
                        <td nowrap><a href="{{ route('getEdit', ['id' => $shop->id]) }}">修正</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection