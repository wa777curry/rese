// mypage.blade.php 画面制御
document.addEventListener('DOMContentLoaded', function() {
    function showContent(sectionId) {
        document.querySelectorAll('.mypage__content--section').forEach(function(section) {
            section.style.display = 'none';
        });
        document.getElementById(sectionId).style.display = 'block';
    }

    document.getElementById('menu-favorite').addEventListener('click', function() {
        showContent('favorite-section');
    });

    document.getElementById('menu-reservation').addEventListener('click', function() {
        showContent('reservation-section');
    });

    document.getElementById('menu-history').addEventListener('click', function() {
        showContent('history-section');
    });

    // 最初にお気に入り店舗のセクションを表示しておく
    showContent('favorite-section');
});

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

// 仮のルーティング
const routes = {
    favorite: '{{ route('getFavorite') }}',
    reservation: '{{ route('getReservation') }}',
    history: '{{ route('getHistory') }}',
};


// メニュークリック時の処理
function handleMenuClick(path) {
    // 対応するルートからコンテンツを読み込む
    fetch(routes[path])
    .then(response => response.text())
    .then(html => {
        // 取得したHTMLを表示エリアに設定
        document.getElementById('content-area').innerHTML = html;
    });

    // 履歴を追加
    history.pushState(null, null, path);
}

// 初回読み込み時にURLに応じて初期コンテンツを表示
const initialPath = window.location.pathname;
handleMenuClick(initialPath);

// メニュークリック時の例
document.getElementById('menu-favorite').addEventListener('click', () => handleMenuClick('/favorite'));
document.getElementById('menu-reservation').addEventListener('click', () => handleMenuClick('/reservation'));
document.getElementById('menu-history').addEventListener('click', () => handleMenuClick('/history'));
