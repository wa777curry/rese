@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/review.css') }}">
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<div class="review__main">
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
    <div class="review__form">
        <form action="{{ route('postReview', ['id' => $shop->id]) }}" method="post" enctype="multipart/form-data">
            @csrf
            <div>
                <div>
                    <h2>体験を評価してください</h2>
                </div>
                <div class="form__error">
                    @error('rating')
                    {{ $message }}
                    @enderror
                </div>
                <div class="rate-form">
                    <input id="star5" type="radio" name="rating" value="5" @if(old('rating')==5) checked @endif>
                    <label for="star5">★</label>
                    <input id="star4" type="radio" name="rating" value="4" @if(old('rating')==4) checked @endif>
                    <label for="star4">★</label>
                    <input id="star3" type="radio" name="rating" value="3" @if(old('rating')==3) checked @endif>
                    <label for="star3">★</label>
                    <input id="star2" type="radio" name="rating" value="2" @if(old('rating')==2) checked @endif>
                    <label for="star2">★</label>
                    <input id="star1" type="radio" name="rating" value="1" @if(old('rating')==1) checked @endif>
                    <label for="star1">★</label>
                </div>
                <div>
                    <h2>口コミを投稿</h2>
                </div>
                <div class="form__error">
                    @error('comment')
                    {{ $message }}
                    @enderror
                </div>
                <div class="textarea__review">
                    <textarea id="myTextarea" class="auto-bg" name="comment" oninput="countCharacters()" maxlength="400">{{ old('comment') }}</textarea>
                    <label for="myTextarea" class="placeholder">カジュアルな夜のお出かけにおすすめのスポット</label>
                </div>
                <div>
                    <h5 id="characterCount" class="character-count">0/400（最高文字数）</h5>
                </div>
                <div>
                    <h2>画像の追加</h2>
                </div>
                <div class="form__error">
                    @error('comment_url')
                    {{ $message }}
                    @enderror
                </div>
                <!-- ファイルのドラッグアンドドロップエリア -->
                <div id="dropArea" class="dropArea">
                    <div id="clickToAdd">
                        クリックして写真を追加<br>またはドラッグアンドドロップ
                    </div>
                    <!-- 画像選択後のプレビュー表示 -->
                    <div id="imagePreview" class="image-preview"></div>
                    <button type="button" id="deleteButton" onclick="deleteImage(event)" style="display: none;">×</button>
                    <!-- ファイル選択用の隠しinput -->
                    <input type="file" id="fileInput" name="comment_url" style="display: none;" accept="image/*">
                </div>
            </div>
            <div class="submit__button">
                <button type="submit">口コミを投稿</button>
            </div>
        </form>
    </div>
</div>

@endsection

@push('scripts')
<script src="{{ asset('js/drop.js') }}"></script>
<script src="{{ asset('js/review.js') }}"></script>
@endpush