const dropArea = document.getElementById('dropArea');
const clickToAdd = document.getElementById('clickToAdd');
const fileInput = document.getElementById('fileInput');
const imagePreview = document.getElementById('imagePreview');

// ドロップエリアがドラッグされている間の処理
dropArea.addEventListener('dragover', function(event) {
    event.preventDefault();
});

// ドロップエリアにファイルがドロップされたときの処理
dropArea.addEventListener('drop', function(event) {
    event.preventDefault();
    const file = event.dataTransfer.files[0];
    handleFile(file);
});

// ファイルが選択されたときの処理
fileInput.addEventListener('change', function() {
    const file = fileInput.files[0];
    handleFile(file);
});

// ファイルのプレビュー表示
function displayImagePreview(file) {
    const reader = new FileReader();

    reader.onload = function(event) {
        const imageUrl = event.target.result;
        const imgElement = document.createElement('img');
        imgElement.src = imageUrl;
        imgElement.alt = 'プレビュー画像';
        imgElement.style.maxHeight = '120px'; // 画像の最大高を設定
        clickToAdd.style.display = 'none'; // "clickToAdd" 要素を非表示にする
        // 画像を表示するコンテナを取得
        const imageContainer = document.getElementById('imagePreview');
        // すでに画像が表示されている場合は削除
        const existingImage = imageContainer.querySelector('img');
        if (existingImage) {
            existingImage.remove();
        }
        // 画像を追加
        imageContainer.appendChild(imgElement);
        // 画像が表示されたので削除ボタンを表示
        const deleteButton = document.getElementById('deleteButton');
        deleteButton.style.display = 'inline-block';
    };
    reader.readAsDataURL(file); // 画像ファイルをData URL形式に変換
}

// 画像を削除する関数
function deleteImage(event) {
    event.preventDefault(); // デフォルトの動作をキャンセル
    event.stopPropagation(); // イベント伝播を停止

    // プレビュー画像を削除
    const imageContainer = document.getElementById('imagePreview');
    const image = imageContainer.querySelector('img'); // 画像要素を取得
    if (image) {
        image.remove(); // 画像を削除
    }

    // 削除ボタンを非表示にする
    const deleteButton = document.getElementById('deleteButton');
    deleteButton.style.display = 'none';

    // "clickToAdd" 要素を表示する
    clickToAdd.style.display = 'block';

    // ファイル選択ボックスの値をクリアする
    fileInput.value = null;
}

// ファイルを処理する関数
function handleFile(file) {
    const reader = new FileReader();
    reader.onload = function(event) {
        const imageUrl = event.target.result;
        displayImagePreview(file);
    };
    reader.readAsDataURL(file);
}

// クリックでファイル選択ダイアログを開く
dropArea.addEventListener('click', function() {
    fileInput.click();
});
