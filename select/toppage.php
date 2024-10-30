<?php
session_start();

// セッションの有効時間を設定（秒単位：1時間 = 3600秒）
$session_timeout = 600;

// 最終アクティビティ時刻を確認し、タイムアウトをチェック
if (isset($_SESSION['last_activity'])) {
    $inactive_time = time() - $_SESSION['last_activity'];

    // 1時間（3600秒）以上経過していればセッションを破棄
    if ($inactive_time > $session_timeout) {
        session_unset();
        session_destroy();
        $is_logged_in = false; // タイムアウト時は未ログインとする
    } else {
        $is_logged_in = true; // ログイン済み
    }
} else {
    $is_logged_in = false; // ログインしていない
}

// 最終アクティビティ時刻を更新
$_SESSION['last_activity'] = time();

// URLからクエリパラメータを取得
if (isset($_GET['utm_source'])) {
    $_SESSION['utm_source'] = $_GET['utm_source'];
}
if (isset($_GET['utm_medium'])) {
    $_SESSION['utm_medium'] = $_GET['utm_medium'];
}
if (isset($_GET['utm_campaign'])) {
    $_SESSION['utm_campaign'] = $_GET['utm_campaign'];
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>セッション選択ページ</title>
    <script src="top_script.js" defer></script>
    <script>
    (function(w, d, s, l, i) {
        w[l] = w[l] || [];
        w[l].push({
            'gtm.start': new Date().getTime(),
            event: 'gtm.js'
        });
        var f = d.getElementsByTagName(s)[0],
            j = d.createElement(s),
            dl = l != 'dataLayer' ? '&l=' + l : '';
        j.async = true;
        j.src =
            'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
        f.parentNode.insertBefore(j, f);
    })(window, document, 'script', 'dataLayer', 'GTM-NVZDXZ2Q');
    </script>

    <style>
    body {
        font-family: 'Arial', sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f4f4f4;
    }

    header {
        background-color: #FF7E01;
        color: #fff;
        padding: 10px 20px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .header-container {
        display: flex;
        align-items: center;
        justify-content: space-between;
        width: 100%;
    }

    .logo {
        font-size: 28px;
        font-weight: bold;
        text-decoration: none;
        color: white;
        flex: 1;
    }

    nav ul {
        list-style: none;
        padding: 0;
        display: flex;
        gap: 30px;
    }

    nav ul li {
        display: inline;
    }

    nav ul li a {
        text-decoration: none;
        color: #fff;
        font-size: 16px;
    }

    .account {
        display: flex;
        align-items: center;
    }

    .account a {
        text-decoration: none;
        color: #fff;
        font-size: 16px;
    }

    .account a::before {
        content: '\1F464';
        /* Unicode for a user icon */
        margin-right: 8px;
        font-size: 20px;
    }

    .auth a {
        margin-left: 15px;
        text-decoration: none;
        padding: 10px 20px;
        font-size: 14px;
    }

    .register-btn {
        background-color: #00aaff;
        color: white;
        border-radius: 5px;
    }

    .login-btn {
        border: 1px solid #fff;
        color: #fff;
        border-radius: 5px;
    }


    /* Session list styles */
    .session-list {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
        margin: 20px;
    }

    .session-card {
        background-color: white;
        border: 1px solid #ddd;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .session-card img {
        width: 100%;
        height: auto;
    }

    .session-info {
        padding: 15px;
    }

    .session-info .tag {
        background-color: #FF7E01;
        color: white;
        padding: 5px 10px;
        border-radius: 3px;
        font-size: 12px;
        display: inline-block;
    }

    .session-info h3 {
        margin-top: 10px;
        font-size: 18px;
        color: #333;
        cursor: pointer;
    }

    .session-info h3:hover {
        color: #FF7E01;
    }

    /* Modal styles */
    .modal {
        display: none;
        position: fixed;
        z-index: 100;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
    }

    .modal-content {
        background-color: #fff;
        margin: 10% auto;
        padding: 20px;
        border-radius: 10px;
        width: 60%;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        position: relative;
        text-align: left;
    }

    .close {
        position: absolute;
        top: 15px;
        right: 20px;
        font-size: 28px;
        color: #aaa;
        cursor: pointer;
    }

    .close:hover {
        color: black;
    }

    .modal h2 {
        font-size: 22px;
        margin-bottom: 15px;
    }

    .modal p {
        font-size: 16px;
        line-height: 1.6;
    }
    </style>
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        var isLoggedIn = <?php echo $is_logged_in ? 'true' : 'false'; ?>;

        var sessionLinks = document.querySelectorAll('.session-card a');
        sessionLinks.forEach(function(link) {
            link.addEventListener('click', function(event) {
                if (!isLoggedIn) {
                    event.preventDefault();
                    sessionStorage.setItem('redirectURL', link.href); // セッションストレージにリンクを保存
                    window.location.href = 'login.php'; // ログインページにリダイレクト
                }
            });
        });
    });
    </script>
</head>

<body>
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-WWVJM2V" height="0" width="0"
            style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NVZDXZ2Q" height="0" width="0"
            style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
    <header>
        <div class="header-container">
            <a href="#" class="logo">Informatica</a>
            <nav>
                <ul>
                    <li><a href="#">セッション</a></li>
                    <li><a href="#">スポンサー</a></li>
                </ul>
            </nav>
            <div class="auth">
                <a href="#" class="register-btn">今すぐ登録</a>
                <a href="#" class="login-btn">ログイン</a>
            </div>
        </div>
    </header>

    <main>
        <section class="session-list">
            <!-- Session 1 -->
            <div class="session-card">
                <a href="session1.php">
                    <img src="image1.jpg" alt="特別講演">
                </a>
                <div class="session-info">
                    <span class="tag">基調講演</span>
                    <h3 data-modal="modal1">データが切り拓く生成 AIの未来 ～Everybody’s ready for AI except your data～</h3>
                </div>
            </div>

            <!-- Modal for Session 1 -->
            <div id="modal1" class="modal">
                <div class="modal-content">
                    <span class="close" data-modal="modal1">&times;</span>
                    <h2>データが切り拓く生成 AIの未来 ～Everybody’s ready for AI except your data～</h2>
                    <p>今、あらゆる企業がAIの準備に注力していますが、</p>
                </div>
            </div>

            <!-- Session 2 -->
            <div class="session-card">
                <a href="session2.php">
                    <img src="image2.jpg" alt="基調講演">
                </a>
                <div class="session-info">
                    <span class="tag">基調講演</span>
                    <h3 data-modal="modal2">AI時代の勝者へ：IDMCで実現するデータマネジメント</h3>
                </div>
            </div>

            <!-- Modal for Session 2 -->
            <div id="modal2" class="modal">
                <div class="modal-content">
                    <span class="close" data-modal="modal2">&times;</span>
                    <h2>AI時代の勝者へ：IDMCで実現するデータマネジメント</h2>
                    <p>AI時代において、データマネジメントは重要な役割を果たし</p>
                </div>
            </div>

            <!-- Session 3 -->
            <div class="session-card">
                <a href="session3.php">
                    <img src="image3.jpg" alt="基調講演">
                </a>
                <div class="session-info">
                    <span class="tag">基調講演</span>
                    <h3 data-modal="modal3">ビジネスに革新をもたらす生成AIとモダン・データマネジメント</h3>
                </div>
            </div>

            <!-- Modal for Session 3 -->
            <div id="modal3" class="modal">
                <div class="modal-content">
                    <span class="close" data-modal="modal3">&times;</span>
                    <h2>ビジネスに革新をもたらす生成AIとモダン・データマネジメント</h2>
                    <p>「どうすればデータから価値を生み出し、ビジネス</p>
                </div>
            </div>

            <!-- Session 4 -->
            <div class="session-card">
                <a href="session4.php">
                    <img src="image4.jpg" alt="基調講演">
                </a>
                <div class="session-info">
                    <span class="tag">基調講演</span>
                    <h3 data-modal="modal4">データ活用の課題と最新動向
                        現場で広げるデータの利活用とは</h3>
                </div>
            </div>
            <!-- Modal for Session 4 -->
            <div id="modal4" class="modal">
                <div class="modal-content">
                    <span class="close" data-modal="modal4">&times;</span>
                    <h2>データ活用の課題と最新動向
                        現場で広げるデータの利活用とは</h2>
                    <p>データ活用とは、企業に蓄積されたデータや社外</p>
                </div>
            </div>

            <!-- Session 5 -->
            <div class="session-card">
                <a href="session.php">
                    <img src="image5.jpg" alt="基調講演">
                </a>
                <div class="session-info">
                    <span class="tag">基調講演</span>
                    <h3 data-modal="modal5">データ戦略を支えるインフォマティカ・プラットフォームの全体像
                        〜ETL/ELTからマスタデータ管理、データガバナンスまで〜</h3>
                </div>
            </div>
            <!-- Modal for Session 5 -->
            <div id="modal5" class="modal">
                <div class="modal-content">
                    <span class="close" data-modal="modal5">&times;</span>
                    <h2>データ戦略を支えるインフォマティカ・プラットフォームの全体像
                        〜ETL/ELTからマスタデータ管理、データガバナンスまで〜</h2>
                    <p>インフォマティカ・プラットフォームは、データ統合、マスタ</p>
                </div>
            </div>
        </section>
    </main>
</body>

</html>