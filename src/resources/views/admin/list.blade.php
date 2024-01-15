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
            <div class="mypage__menu--item active"><a href="{{ route('listManagement') }}">店舗代表者一覧</a></div>
        </div>
    </div>

    <div class="mypage__content">
        <div class="mypage__content--section">
            <div class="mypage__content--item">店舗代表者一覧</div>
            <table class="data-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>代表者名</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($representatives as $representative)
                    <tr>
                        <td>{{ $representative->id }}</td>
                        <td>{{ $representative->representativename }}</td>
                        <td>{{ $representative->email }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection