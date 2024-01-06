// mypage.blade.php メニューリンクの制御（
document.getElementById('menu-favorite').addEventListener('click', function() {
    setActiveMenu('favorite');
});

document.getElementById('menu-reservation').addEventListener('click', function() {
    setActiveMenu('reservation');
});

document.getElementById('menu-history').addEventListener('click', function() {
    setActiveMenu('history');
});

function setActiveMenu(menu) {
    document.querySelectorAll('.mypage__menu--item').forEach(function(item) {
        item.classList.remove('active');
    });

    document.getElementById('menu-' + menu).classList.add('active');
}