<?php
session_start();

// ユーザーがログインしているか確認
if (!isset($_SESSION['loginID'])) {
    // セッション情報がない場合はログインページにリダイレクト
    header("Location: login.php");
    exit();
}

// セッションの有効時間を設定（秒単位：1時間 = 3600秒）
$session_timeout = 3600;

// 最終アクティビティ時刻を確認し、タイムアウトをチェック
if (isset($_SESSION['last_activity'])) {
    $inactive_time = time() - $_SESSION['last_activity'];

    // 1時間（3600秒）以上経過していればセッションを破棄
    if ($inactive_time > $session_timeout) {
        session_unset();
        session_destroy();
        header("Location: login.php");
        exit();
    }
}

// 最終アクティビティ時刻を更新
$_SESSION['last_activity'] = time();

?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>セッション1 - Atlassian System of Work</title>

    <link rel="stylesheet" href="session1.css">
    <style>
    /* General Styles */
    body {
        font-family: 'Arial', sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f4f4f4;
    }

    header {
        background-color: #FF7E01;
        color: white;
        padding: 20px 0;
    }

    .header-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0 20px;
    }

    .logo {
        font-size: 24px;
        text-decoration: none;
        color: white;
    }

    nav ul {
        list-style: none;
        margin: 0;
        padding: 0;
        display: flex;
        gap: 20px;
    }

    nav ul li a {
        text-decoration: none;
        color: white;
    }

    .account-link {
        text-decoration: none;
        color: white;
        font-size: 16px;
    }

    /* Video Section */
    .video-section {
        background-color: white;
        padding: 20px;
        max-width: 1200px;
        margin: 0 auto;
    }

    .session-info {
        margin-top: 20px;
    }

    h1 {
        font-size: 28px;
        margin-bottom: 10px;
    }

    .speaker-info {
        display: flex;
        align-items: center;
        margin-top: 15px;
    }

    .speaker-img {
        border-radius: 50%;
        width: 80px;
        height: 80px;
        margin-right: 15px;
    }

    .speaker-details h3 {
        margin: 0;
        font-size: 20px;
    }

    .speaker-details p {
        margin: 5px 0;
    }

    .description {
        margin: 20px 0;
        font-size: 16px;
    }

    .session-type {
        font-weight: bold;
        margin-top: 10px;
    }

    .survey-link {
        display: inline-block;
        margin-top: 20px;
        text-decoration: none;
        color: #0052cc;
        font-weight: bold;
    }

    /* Related Sessions Section */
    .related-sessions {
        background-color: #fff;
        padding: 20px;
        max-width: 1200px;
        margin: 20px auto;
        border-top: 1px solid #eee;
    }

    .related-sessions h2 {
        font-size: 24px;
        margin-bottom: 10px;
    }

    .session-list-link {
        float: right;
        text-decoration: none;
        color: #0052cc;
        font-weight: bold;
    }

    .session-cards {
        display: flex;
        justify-content: space-between;
        margin-top: 20px;
    }

    .session-card {
        width: 30%;
        text-align: center;
    }

    .session-card img {
        width: 100%;
        border-radius: 10px;
        margin-bottom: 10px;
    }

    .session-card p {
        font-size: 16px;
        color: #333;
    }
    </style>
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        // PHP側でログイン状態を判断してJavaScriptに渡す
        var isLoggedIn = <?php echo isset($_SESSION['loginID']) ? "'true'" : "'false'"; ?>;

        // 全てのセッションリンクに対してクリックイベントを設定
        var sessionLinks = document.querySelectorAll('.session-card a');
        sessionLinks.forEach(function(link) {
            link.addEventListener('click', function(event) {
                if (!isLoggedIn) {
                    // ログインしていない場合はクリックイベントをキャンセルしてログインページに遷移
                    event.preventDefault();
                    window.location.href = 'login.php';
                }
            });
        });
    });
    </script>

</head>

<body>
    <header>
        <div class="header-container">
            <a href="#" class="logo">Informatica</a>
            <nav>
                <ul>
                    <li><a href="#">セッション</a></li>
                    <li><a href="#">スポンサー</a></li>
                </ul>
            </nav>
            <div class="account">
                <a href="#" class="account-link">My account</a>
            </div>
        </div>
    </header>

    <main>
        <section class="video-section">
        <iframe src="https://player.vimeo.com/video/1009871164?badge=0&amp;autopause=0&amp;player_id=0&amp;app_id=58479" frameborder="0" allow="autoplay; fullscreen; picture-in-picture; clipboard-write"  title="基調講演"></iframe>
            <div class="session-info">
                <h1>データが切り拓く生成 AIの未来
                    ～Everybody’s ready for AI except your data～</h1>
                <div class="speaker-info">
                    <img src="speaker.jpg" alt="Speaker" class="speaker-img">
                    <div class="speaker-details">
                        <h3>インフォマティカ・ジャパン株式会社</h3>
                        <p>代表取締役社長</p>
                        <p>小澤 泰斗</p>
                    </div>
                </div>
                <p class="description">
                    今、あらゆる企業がAIの準備に注力していますが、自社データの準備はできているのでしょうか。ビジネスへの生成AIの適用が加速する世界で、AIを活かすデータを全社規模で適切に管理し、
                    データと共にAIに命を吹き込むことで、データから価値を生み出しビジネスに変革をもたらすことが可能になります。これを実現するインフォマティカの戦略と、データの力により進化する世界をご紹介します。
                </p>
            </div>
        </section>

        <section class="related-sessions">
            <h2>他のセッションも視聴する</h2>
            <a href="#" class="session-list-link">セッション一覧を見る</a>
            <div class="session-cards">
                <div class="session-card">
                    <a href="session2.php">
                        <img src="image2.jpg" alt="基調講演">
                    </a>
                    <p>AI時代の勝者へ：IDMCで実現するデータマネジメント</p>
                </div>
                <div class="session-card">
                    <a href="session3.php">
                        <img src="image3.jpg" alt="基調講演">
                    </a>
                    <p>ビジネスに革新をもたらす生成AIとモダン・データマネジメント</p>
                </div>
                <div class="session-card">
                    <a href="session4.php">
                        <img src="image4.jpg" alt="基調講演">
                    </a>
                    <p>データ活用の課題と最新動向
                        現場で広げるデータの利活用とは</p>
                </div>
                <div class="session-card">
                    <a href="session5.php">
                        <img src="image5.jpg" alt="基調講演">
                    </a>
                    <p>データ戦略を支えるインフォマティカ・プラットフォームの全体像
                        〜ETL/ELTからマスタデータ管理、データガバナンスまで〜</p>
                </div>
            </div>
        </section>
    </main>
</body>

</html>