// 予約修正フォームの表示
function toggleReservationForm(reservationId) {
    var form = document.getElementById('reservationForm' + reservationId);
    form.style.display = (form.style.display === 'none') ? 'block' : 'none';
}

// QRコードページの表示
function toggleQRCode(reservationId) {
    var qrCodeArea = document.getElementById('qrCode' + reservationId);
    qrCodeArea.style.display = (qrCodeArea.style.display === 'none') ? 'block' : 'none';
}

// コメントフォームの表示
function toggleRatingForm(reservationId) {
    var form = document.getElementById('ratingForm' + reservationId);
    form.style.display = (form.style.display === 'none') ? 'block' : 'none';
}