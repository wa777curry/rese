@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/review.css') }}">
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<div class="review__main">
    <!-- 店舗詳細 -->
    <div class="shop__data">
        <h1>投稿内容を編集しますか？</h1>
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
        <form action="{{ route('updateReview', ['id' => $review->id]) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('put')
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
                    <input id="star5" type="radio" name="rating" value="5" @if($review->rating == 5) checked @endif>
                    <label for="star5">★</label>
                    <input id="star4" type="radio" name="rating" value="4" @if($review->rating == 4) checked @endif>
                    <label for="star4">★</label>
                    <input id="star3" type="radio" name="rating" value="3" @if($review->rating == 3) checked @endif>
                    <label for="star3">★</label>
                    <input id="star2" type="radio" name="rating" value="2" @if($review->rating == 2) checked @endif>
                    <label for="star2">★</label>
                    <input id="star1" type="radio" name="rating" value="1" @if($review->rating == 1) checked @endif>
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
                    <textarea id="myTextarea" class="auto-bg" name="comment" oninput="countCharacters()" maxlength="400">{{ $review->comment }}</textarea>
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
                    @if($review->comment_url)
                    <!-- 画像がある場合 -->
                    <div id="imagePreview" class="image-preview">
                        <img src="{{ asset('storage/' . $review->comment_url) }}" alt="Comment Image">
                        <button type="button" id="deleteButton" onclick="deleteImage(event)">×</button>
                        <input type="hidden" name="deleteFlag" id="deleteFlagInput" value="0">
                    </div>
                    @else
                    <!-- 画像がない場合 -->
                    <div id="imagePreview" class="image-preview">
                        <button type="button" id="deleteButton" onclick="deleteImage(event)" style="display: none;">×</button>
                    </div>
                    @endif
                    <div id="clickToAdd" class="{{ $review->comment_url ? 'hidden' : '' }}">
                        クリックして写真を追加<br>またはドラッグアンドドロップ
                    </div>
                    <!-- ファイル選択用の隠しinput -->
                    <input type="file" id="fileInput" name="comment_url" style="display: none;" accept="image/*">
                </div>
            </div>
            <div class="submit__button">
                <button type="submit">口コミを編集して投稿</button>
            </div>
            <div class="form__error2">
                @error('shop_id')
                {{ $message }}
                @enderror
            </div>
        </form>
    </div>
</div>

@endsection

@push('scripts')
<script src="{{ asset('js/drop.js') }}"></script>
<script src="{{ asset('js/review.js') }}"></script>
@endpush