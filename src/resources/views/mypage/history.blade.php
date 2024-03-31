@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
<link rel="stylesheet" href="{{ asset('css/detail.css') }}">
@endsection

@section('content')
<div class="mypage__greeting--ttl">
    <button class="back__button" style="cursor: default">＞</button>
    <div class="greeting__name">{{ Auth::user()->username }}さんのマイページ</div>
</div>
<div class="mypage__main">
    <div class="mypage__menu">
        <div class="mypage__menu--ttl">
            <div class="mypage__menu--item"><a href="{{ route('getFavorite') }}">お気に入り店舗</a></div>
            <div class="mypage__menu--item"><a href="{{ route('getReservation') }}">予約状況</a></div>
            <div class="mypage__menu--item active"><a href="{{ route('getHistory') }}">予約履歴</a></div>
        </div>
    </div>

    <div class="mypage__content">
        <div class="mypage__content--section">
            <div class="mypage__content--item">予約履歴</div>
            @if(!$pastReservations->isEmpty())
            @foreach($pastReservations as $reservation)
            <div class="mypage__form">
                <div class="mypage__form--ttl">
                    <span class="mypage__form--icon"><i class="fa fa-clock-o fa-2x fa-flip-horizontal"></i>　履歴{{ $reservation->number }}</span>
                </div>
                <div class="mypage__history--content">
                    <div class="reservation__confirmation--content">
                        <span class="reservation__confirmation--ttl">Shop</span>
                        <span>{{ $reservation->shop->shop_name }}</span>
                    </div>
                    <div class="reservation__confirmation--content">
                        <span class="reservation__confirmation--ttl">Date</span>
                        <span>{{ $reservation->reservation_date }}</span>
                    </div>
                    <div class="reservation__confirmation--content">
                        <span class="reservation__confirmation--ttl">Time</span>
                        <span>{{ substr($reservation->reservation_time, 0, 5) }}</span>
                    </div>
                    <div class="reservation__confirmation--content">
                        <span class="reservation__confirmation--ttl">Number</span>
                        <span>{{ $reservation->reservation_number }}人</span>
                    </div>

                    <div class="mypage__form--bottom">
                        @if(!$reservation->rating) <!-- 評価未登録の場合 -->
                        <button class="mypage__form--edit-icon" onclick="toggleRatingForm({{ $reservation->id }})">
                            <i class="fa fa-commenting fa-2x"></i> コメントする
                        </button>
                        @else <!-- 評価済みの場合 -->
                            <i class="fa fa-commenting fa-2x"></i> 既にコメント済みです
                        @endif
                    </div>
                </div>

                <!-- コメントフォーム -->
                <div class="mypage__form-edit" id="ratingForm{{ $reservation->id }}" style="display: none;">
                    <form action="{{ route('postEditHistory', ['id' => $reservation->id]) }}" method="post">
                        @csrf
                        <div class="reservation__form--star">
                            <div class="reservation__confirmation--content">
                                <label for="rating" class="reservation__confirmation--ttl">Star</label>
                                <select name="rating" id="rating" class="star-rating">
                                    <option value="1">★</option>
                                    <option value="2">★★</option>
                                    <option value="3">★★★</option>
                                    <option value="4">★★★★</option>
                                    <option value="5">★★★★★</option>
                                </select>
                            </div>
                        </div>
                        <div class="reservation__form--comment">
                            <div class="reservation__confirmation--content">
                                <span class="reservation__confirmation--ttl">Comment</span>
                                <textarea id="comment" name="comment">{{ old('comment') ?? $reservation->comment }}</textarea>
                            </div>
                        </div>
                        <div class="mypage__form--bottom">
                            <button class="mypage__form--save-icon" type="submit">評価とコメントを送信する</button>
                        </div>
                    </form>
                </div>
                @if($reservation->rating) <!-- 評価済みの場合は内容を表示 -->
                <div class="mypage__form-edit">
                    <div class="reservation__confirmation--content">
                        <span class="star-rating">@for($i = 1; $i <= $reservation->rating->rating; $i++) ★ @endfor</span>
                    </div>
                    <div class="reservation__confirmation--content">
                        {{ $reservation->rating->comment }}
                    </div>
                </div>
                @endif
            </div>
            @endforeach
            @else
            <div class="mypage__form">
                <div class="mypage__form--ttl">
                    <span class="mypage__form--icon"><i class="fa fa-clock-o fa-2x"></i>　過去の予約はありません</span>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="{{ asset('js/mypage.js') }}"></script>
@endpush