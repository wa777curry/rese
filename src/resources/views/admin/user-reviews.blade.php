@extends('layouts.app-ad')

@section('css')
<link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
<link rel="stylesheet" href="{{ asset('css/detail.css') }}">
@endsection

@section('content')
<div class="mypage__greeting--ttl">
    <button class="back__button" style="cursor: default">＞</button>
    <div class="greeting__name">管理者ページ</div>
</div>
<div class="mypage__main">
    <div class="mypage__menu">
        <div class="mypage__menu--ttl">
            <div class="mypage__menu--item"><a href="{{ route('getManagement') }}">店舗代表者登録</a></div>
            <div class="mypage__menu--item"><a href="{{ route('listManagement') }}">店舗代表者一覧</a></div>
            <div class="mypage__menu--item active"><a href="{{ route('userReviews') }}">ユーザー口コミ一覧</a></div>
        </div>
    </div>

    <div class="mypage__content">
        <div class="mypage__content--section">
            <div class="mypage__content--item">ユーザー口コミ一覧</div>
            <table class="data-table">
                <thead>
                    <tr>
                        <th nowrap>ID</th>
                        <th nowrap>ユーザー名</th>
                        <th nowrap>店舗名</th>
                        <th>口コミ内容</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($reviews as $review)
                    <tr>
                        <td nowrap>{{ $review->id }}</td>
                        <td nowrap>{{ $review->user->username }}</td>
                        <td nowrap>{{ $review->shop->shop_name }}</td>
                        <td>{{ $review->comment }}</td>
                        <td nowrap>
                            <form action="{{ route('deleteReview', $review->id) }}" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit" onclick="return confirm('口コミを削除しますか？')">削除する</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection