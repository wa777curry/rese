@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/detail.css') }}">
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<div class="reviews__main">
    <!-- 店舗詳細 -->
    <div class="shop__data">
        <h1>今回のご利用はいかがでしたか？</h1>
        <div class="shop__list">
            <div class="shop__list--card">
                <div class="shop__list--img">
                    <img src="{{ $shop->genre->image_url }}">
                </div>
                <div class="shop__content">
                    <div class="shop__content--name">{{ $shop->shop_name }}</div>
                    <div class="shop__content--tag">#{{ $shop->area->area_name }}</div>
                    <div class="shop__content--tag">#{{ $shop->genre->genre_name }}</div>
                    <div class="shop__content--detail">
                        <a href="{{ route('detail', ['id' => $shop->id]) }}"><button class="button" type="submit">詳しく見る</button></a>
                        @auth
                        @if(auth()->user()->favorites->contains($shop->id))
                        <!-- お気に入り登録済みの場合 -->
                        <form action="{{ route('nofavorite', ['shop' => $shop->id]) }}" method="get">
                            @csrf
                            <button class="f-button" type="submit"><i class="fa fa-heart fa-lg fa-2x on-color"></i></button>
                        </form>
                        @else
                        <!-- お気に入り未登録の場合 -->
                        <form action="{{ route('favorite', ['shop' => $shop->id]) }}" method="get">
                            @csrf
                            <button class="f-button" type="submit"><i class="fa fa-heart fa-lg fa-2x off-color"></i></button>
                        </form>
                        @endif
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- 予約フォーム -->
    <div class="reviews__form">
        <div>
            <h2>体験を評価してください</h2>
        </div>
        <div></div>
        <div>
            <h2>口コミを投稿</h2>
        </div>
        <textarea></textarea>
        <div>
            <h2>画像の追加</h2>
        </div>
        <textarea>クリックして写真を追加</textarea>
    </div>
</div>
<div><button>口コミを投稿</button></div>
@endsection

@push('scripts')
<script src="{{ asset('js/detail.js') }}"></script>
@endpush