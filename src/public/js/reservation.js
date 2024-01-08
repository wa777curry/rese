// reservation.js
function openModal() {
    var modal = document.getElementById('myModal');
    modal.style.display = 'block';
}

function closeModal() {
    var modal = document.getElementById('myModal');
    modal.style.display = 'none';
}

function deleteItem() {
    // 削除処理のためのAjaxリクエストなどを追加
    // 削除が成功したら、ページをリロードするか、適切な処理を行う
    // 以下はページをリロードする例
    location.reload();
}

window.onclick = function(event) {
    var modal = document.getElementById('myModal');
    if (event.target == modal) {
        closeModal();
    }
};