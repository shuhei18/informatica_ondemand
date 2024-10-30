<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QRコードスキャン</title>
    <style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
        background-color: #f8f9fa;
    }

    .container {
        text-align: center;
    }

    video {
        width: 100%;
        max-width: 400px;
        border-radius: 10px;
        border: 2px solid #ced4da;
    }

    canvas {
        display: none;
    }

    #qr-result {
        margin-top: 20px;
        font-size: 18px;
        font-weight: bold;
        color: #333;
    }
    </style>
</head>

<body>
    <div class="container">
        <h1>QRコードスキャン</h1>
        <video id="video" autoplay playsinline></video>
        <canvas id="canvas" hidden></canvas>
        <p id="qr-result">スキャン中...</p>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/jsqr@1.4.0/dist/jsQR.js"></script>
    <script>
    const video = document.getElementById('video');
    const canvas = document.getElementById('canvas');
    const context = canvas.getContext('2d');
    const resultDisplay = document.getElementById('qr-result');

    // カメラにアクセスしてビデオを表示する
    navigator.mediaDevices.getUserMedia({
            video: {
                facingMode: 'environment' // 背面カメラを優先的に使用
            }
        })
        .then(stream => {
            console.log("カメラにアクセス成功");
            video.srcObject = stream;
            video.setAttribute('playsinline', true); // iOS向け設定
            video.play();
            requestAnimationFrame(tick);
        })
        .catch(err => {
            console.error('カメラにアクセスできませんでした: ', err);
            if (err.name === 'NotAllowedError') {
                resultDisplay.textContent = 'カメラへのアクセスが拒否されました。';
            } else if (err.name === 'NotFoundError') {
                resultDisplay.textContent = 'カメラが見つかりませんでした。';
            } else {
                resultDisplay.textContent = 'カメラにアクセスできませんでした';
            }
        });

    function tick() {
        if (video.readyState === video.HAVE_ENOUGH_DATA) {
            console.log("ビデオデータの取得成功");
            canvas.width = video.videoWidth;
            canvas.height = video.videoHeight;
            context.drawImage(video, 0, 0, canvas.width, canvas.height);
            const imageData = context.getImageData(0, 0, canvas.width, canvas.height);
            const code = jsQR(imageData.data, imageData.width, imageData.height);

            if (code) {
                console.log("QRコードの読み取り成功: " + code.data);
                resultDisplay.textContent = `QRコードが読み取れました: ${code.data}`;
                // QRコードの内容をサーバーに送信するか、次の処理に進む
                window.location.href = `qr_process.php?data=${encodeURIComponent(code.data)}`;
            }
        }
        requestAnimationFrame(tick);
    }
    </script>
</body>

</html>