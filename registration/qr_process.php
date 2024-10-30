<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QRコードスキャン結果</title>
    <style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #f8f9fa;
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
    }

    .container {
        background-color: #00ff00;
        /* 緑色背景 */
        border-radius: 10px;
        padding: 20px;
        max-width: 400px;
        width: 90%;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        margin: 10px;
    }

    h1 {
        text-align: center;
        font-size: 20px;
        color: black;
    }

    .info-box {
        background-color: white;
        border-radius: 10px;
        padding: 15px;
        margin-bottom: 20px;
        font-size: 16px;
    }

    .info-box p {
        margin: 5px 0;
        font-size: 14px;
        color: black;
    }

    .button-container {
        display: flex;
        justify-content: space-between;
        margin-top: 20px;
    }

    button,
    .back-button {
        padding: 12px;
        border: none;
        border-radius: 5px;
        font-size: 16px;
        cursor: pointer;
        width: 48%;
    }

    button {
        background-color: #007bff;
        color: white;
    }

    .back-button {
        background-color: #6c757d;
        color: white;
    }

    input[type="text"] {
        width: 100%;
        padding: 12px;
        margin-top: 10px;
        margin-bottom: 20px;
        border-radius: 5px;
        border: 1px solid #ccc;
        font-size: 16px;
        box-sizing: border-box;
    }

    .session-info {
        background-color: #d9e5ff;
        border-radius: 10px;
        padding: 15px;
        margin-top: 20px;
        font-size: 14px;
    }

    @media (max-width: 480px) {
        .container {
            padding: 15px;
        }

        h1 {
            font-size: 18px;
        }

        .info-box p {
            font-size: 12px;
        }

        input[type="text"] {
            font-size: 14px;
        }

        .button-container button,
        .back-button {
            font-size: 14px;
            padding: 10px;
        }

        .session-info {
            font-size: 12px;
        }
    }
    </style>
</head>

<body>
    <div class="container">
        <h1>QRコード結果</h1>
        <div class="info-box">
            <p>ログインID: <?php echo htmlspecialchars($user['loginID'], ENT_QUOTES, 'UTF-8'); ?></p>
            <p>会社名（所属）: <?php echo htmlspecialchars($company, ENT_QUOTES, 'UTF-8'); ?></p>
            <p>お名前（氏名）: <?php echo htmlspecialchars($recipientName, ENT_QUOTES, 'UTF-8'); ?></p>
            <p>読み仮名: <?php echo htmlspecialchars($recipientNameKana, ENT_QUOTES, 'UTF-8'); ?></p>
        </div>

        <form action="register.php" method="post">
            <input type="hidden" name="loginID"
                value="<?php echo htmlspecialchars($user['loginID'], ENT_QUOTES, 'UTF-8'); ?>">
            <label for="memo">メモ入力欄</label>
            <input type="text" id="memo" name="memo" placeholder="メモを入力">

            <div class="button-container">
                <button type="submit">登録</button>
                <a href="main_reception.php" class="back-button">戻る</a>
            </div>
        </form>

        <div class="session-info">
            <p>登録セッション情報: <?php echo htmlspecialchars($user['session_name'], ENT_QUOTES, 'UTF-8'); ?></p>
        </div>
    </div>
</body>

</html>