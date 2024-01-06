// detail.blade.php 画面制御
document.addEventListener('DOMContentLoaded', function () {
    const headerMenu = document.querySelector('.header__menu');
    const headerMenuHeight = headerMenu.offsetHeight;

    const shopMain = document.querySelector('.shop__main');
    shopMain.style.marginTop = headerMenuHeight + 'px';
});

// detail.blade.php 予約内容を反映させる
window.onload = function () {
    updateDisplay();
    var $formObject = document.getElementById( "reservationForm" );
    for( var $i = 0; $i < $formObject.length; $i++ ) {
        $formObject.elements[$i].onkeyup = function(){
            updateDisplay();
        };
        $formObject.elements[$i].onchange = function(){
            updateDisplay();
        };
    }
}
function updateDisplay() {
    var $formObject = document.getElementById("reservationForm");
    var selectedNumber = $formObject['reservation_number'].value;

    document.getElementById("displayDate").innerHTML = $formObject['reservation_date'].value;
    document.getElementById("displayTime").innerHTML = $formObject['reservation_time'].value;

    var displayNumber = document.getElementById("displayNumber");
    var displayNumberUnit = document.getElementById("displayNumberUnit");

    if (selectedNumber > 0) {
        displayNumber.innerHTML = selectedNumber;
        displayNumberUnit.innerHTML = selectedNumber > 1 ? '人' : '人';
    } else {
        displayNumber.innerHTML = '';
        displayNumberUnit.innerHTML = '';
    }
}

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
})