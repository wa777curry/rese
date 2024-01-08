// contentSwitch.js
document.addEventListener('DOMContentLoaded', function() {
    function showContent(sectionId) {
        var targetSection = document.getElementById(sectionId);
        if (targetSection) {
            document.querySelectorAll('.mypage__content--section').forEach(function(section) {
                section.style.display = 'none';
            });
            targetSection.style.display = 'block';
        }
    }

    function setActiveMenu(menu) {
        document.querySelectorAll('.mypage__menu--item').forEach(function(item) {
            item.classList.remove('active');
        });
        document.getElementById('menu-' + menu).classList.add('active');
    }

    // 初期表示をお気に入り店舗（favorite-section）に設定
    showContent('favorite-section');
    setActiveMenu('favorite');

    // メニューリンクの制御
    document.getElementById('menu-favorite').addEventListener('click', function() {
        showContent('favorite-section');
        setActiveMenu('favorite');
    });

    document.getElementById('menu-reservation').addEventListener('click', function() {
        showContent('reservation-section');
        setActiveMenu('reservation');
    });

    document.getElementById('menu-history').addEventListener('click', function() {
        showContent('history-section');
        setActiveMenu('history');
    });
});