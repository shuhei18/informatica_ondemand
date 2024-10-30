<?php
session_start();

// 管理者としてログインしているかを確認
if (!isset($_SESSION['admin_staff_in']) || $_SESSION['admin_staff_in'] !== true) {
    header('Location: adminsLogin_iwt2024.php');
    exit;
}

// セッションリストを定義
$sessions = [
    'メインセッション',
    'ミニセッションA-1',
    'ミニセッションA-2',
    'ミニセッションA-3',
    'ミニセッションB-1',
    'ミニセッションB-2'
];

?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>セッション選択</title>
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
        box-sizing: border-box;
    }

    .container {
        width: 100%;
        max-width: 400px;
        padding: 20px;
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        box-sizing: border-box;
        margin: 10px;
    }

    h1 {
        text-align: center;
        color: #333;
        margin-bottom: 20px;
        font-size: 22px;
    }

    ul {
        list-style: none;
        padding: 0;
    }

    li {
        margin-bottom: 10px;
        padding: 15px;
        background-color: #e9ecef;
        border-radius: 5px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    li span {
        font-size: 16px;
        font-weight: bold;
        color: #333;
    }

    a {
        padding: 8px 12px;
        background-color: #007bff;
        color: white;
        border-radius: 5px;
        text-decoration: none;
        font-size: 14px;
        transition: background-color 0.3s;
    }

    a:hover {
        background-color: #0056b3;
    }

    @media (max-width: 480px) {
        h1 {
            font-size: 20px;
        }

        li span {
            font-size: 14px;
        }

        a {
            font-size: 12px;
            padding: 6px 10px;
        }

        li {
            padding: 12px;
        }

        .container {
            padding: 15px;
        }
    }
    </style>
</head>

<body>
    <div class="container">
        <h1>セッション選択</h1>
        <ul>
            <?php foreach ($sessions as $session): ?>
            <li>
                <span><?php echo htmlspecialchars($session, ENT_QUOTES, 'UTF-8'); ?></span>
                <a href="qr_scan.php?session=<?php echo urlencode($session); ?>">QRコードスキャン</a>
            </li>
            <?php endforeach; ?>
        </ul>
    </div>
</body>

</html>