// detail.blade.phpの画面制御
document.addEventListener('DOMContentLoaded', function () {
    const headerMenu = document.querySelector('.header__menu');
    const headerMenuHeight = headerMenu.offsetHeight;

    const shopMain = document.querySelector('.shop__main');
    shopMain.style.marginTop = headerMenuHeight + 'px';
});

function closeReservationForm() {
    // 予約状況のウインドウを非表示にする処理
    var reservationForm = document.querySelector('.mypage__form');
    reservationForm.style.display = 'none';
}
