@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/detail.css') }}">
@endsection

@section('content')
<div class="shop__main">
    <!-- 店舗詳細 -->
    <div class="shop__detail">
        <div class="shop__detail--ttl">
            <button class="back__button">
                <a href="#" onclick="window.history.back(); return false;">＜</a>
            </button>
            <div class="shop__detail--name">{{ $shop->shop_name }}</div>
        </div>
        <div class="shop__detail--img">
            <img src="{{ $shop->genre->image_url }}">
        </div>
        <div class="shop__detail--tag">#{{ $shop->area->area_name }}</div>
        <div class="shop__detail--tag">#{{ $shop->genre->genre_name }}</div>
        <div class="shop__detail--summary">{{ $shop->shop_summary }}</div>
        <!-- 表示の分岐 -->
        <div class="shop__detail--review">
            @auth
            @if($reviews->isEmpty())
            <!-- ログインあり＆口コミなし -->
            <a href="{{ route('review', ['id' => $shop->id]) }}">口コミを投稿する</a>
            <div class="review__button"><button>口コミはまだありません。</button></div>
            @else
            <!-- ログインあり＆口コミあり -->
            <div class="review__button"><button>全ての口コミ情報</button></div>
            <hr>
            @foreach($reviews as $review)
            @if($review->user_id == auth()->user()->id)
            <!-- ログインユーザーが口コミの投稿者である場合にのみ編集・削除のリンクを表示 -->
            <div class="review-actions">
                <button class="edit-button"><a href="{{ route('editReview', ['id' => $review->id]) }}">口コミを編集</a></button>
                <form action="{{ route('deleteReview', ['id' => $review->id]) }}" method="post" class="delete-form">
                    @csrf
                    @method('delete')
                    <button type="submit" class="delete-button">口コミを削除</button>
                </form>
            </div>
            @endif
            <div class="review">
                <div>{{ $review->user->username }}</div>
                <div class="rate-form">
                    <!-- 星の表示 -->
                    @for($i = 1; $i <= 5; $i++) @if($i <=$review->rating)
                        <span class="star-filled">★</span>
                        @else
                        <span class="star-empty">★</span>
                        @endif
                        @endfor
                </div>
                <div class="comment">
                    {!! nl2br(e($review->comment)) !!}
                </div>
            </div>
            <hr>
            @endforeach
            @endif
            @else
            @if($reviews->isEmpty())
            <!-- ログインなし＆口コミなし -->
            <div><button>口コミはまだありません。</button></div>
            @else
            <!-- ログインなし＆口コミあり -->
            <div><button>全ての口コミ情報</button></div>
            <hr>
            @foreach($reviews as $review)
            <div class="review">
                <div>{{ $review->user->username }}</div>
                <div class="rate-form">
                    <!-- 星の表示 -->
                    @for($i = 1; $i <= 5; $i++) @if($i <=$review->rating)
                        <span class="star-filled">★</span>
                        @else
                        <span class="star-empty">★</span>
                        @endif
                        @endfor
                </div>
                <div class="comment">
                    <!-- コメントの表示 -->
                    {!! nl2br(e($review->comment)) !!}
                </div>
            </div>
            @endforeach
            @endif
            @endauth
        </div>
    </div>

    <!-- 予約フォーム -->
    <div class="reservation__form">
        <form id="reservationForm" action="{{ route('postReservation', ['id' => $shop->id]) }}" method="post">
            @csrf
            <div class="reservation__form--ttl">予約</div>
            <input type="hidden" name="shop_id" value="{{ $shop->id }}">
            <div class="form__error">
                @error('reservation_date')
                {{ $message }}
                @enderror
            </div>
            <div class="form__error">
                @error('reservation_time')
                {{ $message }}
                @enderror
            </div>
            <div class="form__error">
                @error('reservation_number')
                {{ $message }}
                @enderror
            </div>
            <div class="reservation__form--date">
                <input id="selectDate" name='reservation_date' type="date">
            </div>
            <div class="reservation__form--time">
                <select id="selectTime" name="reservation_time">
                    <option value="" selected disabled>時間を選択してください</option>
                    @foreach($times as $time)
                    <option value="{{ $time }}">{{ $time }}</option>
                    @endforeach
                </select>
            </div>
            <div class="reservation__form--number">
                <select id="selectNumber" name="reservation_number">
                    <option value="" selected disabled>人数を選択してください</option>
                    @foreach($numbers as $number)
                    <option value="{{ $number }}">{{ $number  . '人' }}</option>
                    @endforeach
                </select>
            </div>

            <div class="reservation__confirmation">
                <div class="reservation__confirmation--content">
                    <span class="reservation__confirmation--ttl">Shop</span>
                    <span>{{ $shop->shop_name }}</span>
                </div>
                <div class="reservation__confirmation--content">
                    <span class="reservation__confirmation--ttl">Date</span>
                    <span id="displayDate"></span>
                </div>
                <div class="reservation__confirmation--content">
                    <span class="reservation__confirmation--ttl">Time</span>
                    <span id="displayTime"></span>
                </div>
                <div class="reservation__confirmation--content">
                    <span class="reservation__confirmation--ttl">Number</span>
                    <span id="displayNumber"></span>
                    <span id="displayNumberUnit"></span>
                </div>
            </div>

            <div class="reservation__form--btn">
                <button class="button" type="submit">予約する</button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script src="{{ asset('js/detail.js') }}"></script>
@endpush