<div id="history-section" class="mypage__content--section">
    <div class="mypage__content--item">予約履歴</div>
    @if(!$pastReservations->isEmpty())
    @foreach($pastReservations as $reservation)
    <div class="mypage__form">
        <div class="mypage__form--ttl">
            <span class="mypage__form--icon"><i class="fa fa-clock-o fa-2x fa-flip-horizontal"></i>　履歴{{ $reservation->number }}</span>
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
                <span class="mypage__form--edit-icon"><i class="fa fa-star fa-2x"></i></span>
                <span class="mypage__form--edit-icon"><i class="fa fa-commenting fa-2x"></i></span>
            </div>
        </div>
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