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
            <div class="mypage__menu--item active"><a href="{{ route('getCsvUpload') }}">店舗情報の登録（CSV）</a></div>
            <div class="mypage__menu--item"><a href="{{ route('getShoplist') }}">店舗情報一覧</a></div>
        </div>
    </div>

    <div class="mypage__content">
        <div class="mypage__content--section">
            <div class="mypage__content--item">店舗情報の登録（csv登録）</div>
            <form action="{{ route('postCsvUpload') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mypage__form">
                    <div class="login__form--text">
                        <div class="mypage__history--content">
                            <div class="reservation__confirmation--content">
                                <span class="reservation__confirmation--ttl">CSVファイル</span>
                                <span>
                                    <input id="csvFile" type="file" name="csv_file">
                                </span>
                            </div>
                            <div class="form__error">
                                @error('shop_name')
                                {{ $message }}
                                @enderror
                            </div>
                            <div class="form__error">
                                @error('csv_file')
                                {{ $message }}
                                @enderror
                            </div>
                            <div class="mypage__form--bottom">
                                <button class="mypage__form--edit-icon" type="submit">
                                    <i class="fa fa-edit fa-2x "></i> 登録する
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