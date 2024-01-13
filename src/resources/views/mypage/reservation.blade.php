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
            <div class="mypage__menu--item active"><a href="{{ route('getReservation') }}">予約状況</a></div>
            <div class="mypage__menu--item"><a href="{{ route('getHistory') }}">予約履歴</a></div>
        </div>
    </div>

    <div class="mypage__content">
        <div class="mypage__content--section">
            <div class="mypage__content--item">予約状況</div>
            @if(!$reservations->isEmpty())
            @foreach($reservations as $reservation)
            <div class="mypage__form">
                <div class="mypage__form--ttl">
                    <span class="mypage__form--icon"><i class="fa fa-clock-o fa-2x"></i>　予約{{ $reservation->number }}</span>
                </div>
                <div class="mypage__history accordion-content">
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
                        <button class="mypage__form--edit-icon" onclick="toggleReservationForm({{ $reservation->id }})">
                            <i class="fa fa-edit fa-2x"></i> 予約の変更
                        </button>

                        <a href="{{ route('deleteReservation', ['id' => $reservation->id]) }}" class="mypage__form--edit-icon" onclick="return confirm('この予約を削除してよろしいですか？')">
                            <i class="fa fa-times-circle fa-2x"></i> 予約の削除
                        </a>

                        <a href="javascript:void(0);" class="mypage__form--edit-icon" onclick="toggleQRCode({{ $reservation->id }})">
                            <i class="fa fa-qrcode fa-2x"></i> QRコード
                        </a>
                    </div>
                </div>

                <!-- 予約変更フォーム -->
                <div class="mypage__form-edit" id="reservationForm{{ $reservation->id }}" style="display: none;">
                    <form action="{{ route('postEditReservation', ['id' => $reservation->id]) }}" method="post">
                        @csrf
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
                            <div class="reservation__confirmation--content">
                                <span class="reservation__confirmation--ttl">New Date</span>
                                <span><input id="selectDate" name='reservation_date' type="date"></span>
                            </div>
                        </div>
                        <div class="reservation__form--time">
                            <div class="reservation__confirmation--content">
                                <span class="reservation__confirmation--ttl">New Time</span>
                                <select id="selectTime" name="reservation_time">
                                    <option value="" selected disabled>時間を選択してください</option>
                                    @foreach($times as $time)
                                    <span>
                                        <option value="{{ $time }}">{{ $time }}</option>
                                    </span>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="reservation__form--number">
                            <div class="reservation__confirmation--content">
                                <span class="reservation__confirmation--ttl">New Number</span>
                                <select id="selectNumber" name="reservation_number">
                                    <option value="" selected disabled>人数を選択してください</option>
                                    @foreach($numbers as $number)
                                    <span>
                                        <option value="{{ $number }}">{{ $number  . '人' }}</option>
                                    </span>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="mypage__form--bottom">
                            <button class="mypage__form--save-icon" type="submit">変更内容を送信する</button>
                        </div>
                    </form>
                </div>

                <!-- QRコード表示エリア -->
                <div class="mypage__form--qr-code" id="qrCode{{ $reservation->id }}" style="display: none;">
                    {!! QrCode::size(150)->generate(url('reservation/' . $reservation->id)) !!}
                </div>

            </div>
            @endforeach
            @else
            <div class="mypage__form">
                <div class="mypage__form--ttl">
                    <span class="mypage__form--icon"><i class="fa fa-clock-o fa-2x"></i>　現在予約はありません</span>
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