function toggleReservationForm(reservationId) {
    var form = document.getElementById('reservationForm' + reservationId);
    form.style.display = (form.style.display === 'none') ? 'block' : 'none';
}

function toggleQRCode(reservationId) {
    var qrCodeArea = document.getElementById('qrCode' + reservationId);
    qrCodeArea.style.display = (qrCodeArea.style.display === 'none') ? 'block' : 'none';
}