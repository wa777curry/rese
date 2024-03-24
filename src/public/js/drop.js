const dropArea = document.getElementById('dropArea');
const fileInput = document.createElement('input');
fileInput.type = 'file';
fileInput.style.display = 'none';
fileInput.accept = 'image/*';
dropArea.appendChild(fileInput);

const imagePreview = document.getElementById('imagePreview');

// ドロップエリアがドラッグされている間の処理
dropArea.addEventListener('dragover', function(event) {
    event.preventDefault();
    dropArea.style.borderColor = '#2988bc';
});

// ドロップエリアにファイルがドロップされたときの処理
dropArea.addEventListener('drop', function(event) {
    event.preventDefault();
    dropArea.style.borderColor = '#ccc';
    const file = event.dataTransfer.files[0];
    handleFile(file);
});

// ファイルが選択されたときの処理
fileInput.addEventListener('change', function(event) {
    const file = fileInput.files[0];
    handleFile(file);
});

// ファイルのプレビュー表示
function displayPreview(imageUrl) {
    imagePreview.innerHTML = `<img src="${imageUrl}" style="max-width: 200px;">`;
}

// ファイルを処理する関数
function handleFile(file) {
    const reader = new FileReader();
    reader.onload = function(event) {
        const imageUrl = event.target.result;
        displayPreview(imageUrl);
    };
    reader.readAsDataURL(file);
}

// クリックでファイル選択ダイアログを開く
dropArea.addEventListener('click', function() {
    fileInput.click();
});