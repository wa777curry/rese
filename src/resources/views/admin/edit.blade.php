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
            <div class="mypage__menu--item"><a href="{{ route('getShoplist') }}">店舗情報一覧</a></div>
        </div>
    </div>

    <div class="mypage__content">
        <div class="mypage__content--section">
            <div class="mypage__content--item">店舗情報の修正</div>
            <form action="{{ route('postEdit', ['id' => $shop->id]) }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mypage__form">
                    <div class="login__form--text">
                        <div class="mypage__history--content">
                            <div class="reservation__confirmation--content">
                                <span class="reservation__confirmation--ttl">店舗名</span>
                                <span>
                                    <input id="selectText" type="text" name="shop_name" value="{{ old('shop_name', $shop->shop_name) }}">
                                </span>
                            </div>
                            <div class="reservation__confirmation--content">
                                <span class="reservation__confirmation--ttl">都道府県</span>
                                <span>
                                    <select name="area_id" id="selectText">
                                        @foreach ($areas as $area)
                                        <option value="{{ $area->id }}" {{ old('area_id', $shop->area_id) == $area->id ? 'selected' : '' }}>{{ $area->area_name }}</option>
                                        @endforeach
                                    </select>
                                </span>
                            </div>
                            <div class="reservation__confirmation--content">
                                <span class="reservation__confirmation--ttl">ジャンル</span>
                                <span>
                                    <select name="genre_id" id="selectText">
                                        @foreach ($genres as $genre)
                                        <option value="{{ $genre->id }}" {{ old('genre_id', $shop->genre_id) == $genre->id ? 'selected' : '' }}>{{ $genre->genre_name }}</option>
                                        @endforeach
                                    </select>
                                </span>
                            </div>
                            <div class="reservation__confirmation--content">
                                <span class="reservation__confirmation--ttl">店舗概要</span>
                                <span>
                                    <textarea id="selectTextarea" type="text" name="shop_summary">{{ old('shop_summary', $shop->shop_summary) }}</textarea>
                                </span>
                            </div>
                            <div class="mypage__form--bottom">
                                <button class="mypage__form--edit-icon" type="submit">
                                    <i class="fa fa-edit fa-2x "></i> 修正する
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection