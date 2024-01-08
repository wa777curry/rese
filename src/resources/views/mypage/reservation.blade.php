<div id="reservation-section" class="mypage__content--section">
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
                <a href="{{ route('editReservation', ['id' => $reservation->id]) }}" class="mypage__form--edit-icon"><i class="fa fa-edit fa-2x"></i> 変更</a>

                <a href="{{ route('deleteReservation', ['id' => $reservation->id]) }}" class="mypage__form--edit-icon" onclick="return confirm('この予約を削除してよろしいですか？')">
                    <i class="fa fa-times-circle fa-2x"></i> 削除
                </a>

                <a href="{{ route('qrReservation', ['id' => $reservation->id]) }}" class="mypage__form--edit-icon"><i class="fa fa-qrcode fa-2x"></i> ＱＲ</a>
            </div>
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