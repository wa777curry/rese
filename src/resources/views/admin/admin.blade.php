@extends('layouts.app-ad')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
<link rel="stylesheet" href="{{ asset('css/detail.css') }}">
<link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
@endsection

@section('content')
<div class="mypage__greeting--ttl">
    <button class="back__button" style="cursor: default">＞</button>
    <div class="greeting__name">管理者ページ</div>
</div>
<div class="mypage__main">
    <div class="mypage__menu">
        <div class="mypage__menu--ttl">
            <div class="mypage__menu--item active"><a href="{{ route('getManagement') }}">店舗代表者登録</a></div>
            <div class="mypage__menu--item"><a href="{{ route('listManagement') }}">店舗代表者一覧</a></div>
            <div class="mypage__menu--item"><a href="{{ route('userReviews') }}">ユーザー口コミ一覧</a></div>
        </div>
    </div>

    <div class="mypage__content">
        <div class="mypage__content--section">
            <div class="mypage__content--item">店舗代表者登録</div>
            <form action="{{ route('postManagement') }}" method="post">
                @csrf
                <div class="mypage__form">
                    <div class="login__form--text">
                        <div class="mypage__history--content">
                            <div class="reservation__confirmation--content">
                                <span class="reservation__confirmation--ttl">店舗代表者名</span>
                                <span>
                                    <input id="selectText" type="text" name="representativename" value="{{ old('representativename') }}">
                                </span>
                            </div>
                            <div class="form__error">
                                @error('representativename')
                                {{ $message }}
                                @enderror
                            </div>
                            <div class="reservation__confirmation--content">
                                <span class="reservation__confirmation--ttl">メールアドレス</span>
                                <span>
                                    <input id="selectText" type="email" name="email" value="{{ old('email') }}">
                                </span>
                            </div>
                            <div class="form__error">
                                @error('email')
                                {{ $message }}
                                @enderror
                            </div>
                            <div class="reservation__confirmation--content">
                                <span class="reservation__confirmation--ttl">パスワード</span>
                                <span>
                                    <input id="selectText" type="password" name="password">
                                </span>
                            </div>
                            <div class="form__error">
                                @error('password')
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