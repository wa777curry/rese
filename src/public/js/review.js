// 文字数カウント
function countCharacters() {
    var textarea = document.getElementById("myTextarea");
    var characterCount = textarea.value.length;
    var displayElement = document.getElementById("characterCount");
    displayElement.textContent = characterCount + "/400（最高文字数）";
}

// 例文表示制御
document.addEventListener('DOMContentLoaded', function() {
    const textarea = document.getElementById('myTextarea');
    const placeholder = document.querySelector('.placeholder');

    // テキストエリアがフォーカスされたときの処理
    textarea.addEventListener('focus', function() {
        this.classList.add('focused');
    });

    // テキストエリアがフォーカスされたまま入力されたときの処理
    textarea.addEventListener('input', function() {
        if (this.value.trim() !== '') {
            this.classList.add('has-content');
            placeholder.style.display = 'none'; // 入力されたらプレースホルダーを非表示
        } else {
            this.classList.remove('has-content');
            placeholder.style.display = 'block'; // 入力されていない場合はプレースホルダーを表示
        }
    });

    // テキストエリアからフォーカスが外れたときの処理
    textarea.addEventListener('blur', function() {
        if (this.value.trim() === '') {
            this.classList.remove('focused', 'has-content');
            placeholder.style.display = 'block'; // フォーカスが外れたとき、入力がない場合はプレースホルダーを表示
        } else {
            this.classList.remove('focused');
        }
    });
});
