<?php
session_start();
require 'select/config.php';

// ユーザーがログインしているか確認
if (!isset($_SESSION['loginID'])) {
    // セッション情報がない場合はログインページにリダイレクト
    header("Location: select/login.php");
    exit();
}

// セッションの有効時間を設定（秒単位：1時間 = 600秒）
$session_timeout = 3600;

// 最終アクティビティ時刻を確認し、タイムアウトをチェック
if (isset($_SESSION['last_activity'])) {
    $inactive_time = time() - $_SESSION['last_activity'];

    // 10分（600秒）以上経過していればセッションを破棄
    if ($inactive_time > $session_timeout) {
        session_unset();
        session_destroy();
        header("Location: select/login.php");
        exit();
    }
}

// 最終アクティビティ時刻を更新
$_SESSION['last_activity'] = time();

// ログイン中のユーザーの loginID を取得
$loginID = $_SESSION['loginID']; 
$video_number = 7; // 動画7の場合

try {
    // PDO接続を作成
    $pdo = new PDO(DB_DSN, DB_USER, DB_PASSWORD);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // 1. user_video_flagsテーブルにloginIDがない場合、新しいレコードを作成
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM user_video_flags WHERE loginID = ?");
    $stmt->execute([$loginID]);
    $count = $stmt->fetchColumn();

    if ($count == 0) {
        // レコードがない場合、新しいレコードを作成
        $stmt = $pdo->prepare("INSERT INTO user_video_flags (loginID) VALUES (?)");
        $stmt->execute([$loginID]);
    }

    // 2. 動画のフラグが既に立っているか確認
    $stmt = $pdo->prepare("SELECT video_{$video_number}_flag FROM user_video_flags WHERE loginID = ?");
    $stmt->execute([$loginID]);
    $flag = $stmt->fetchColumn();

    // 3. フラグが立っていない場合、1に更新
    if ($flag == 0) {
        $stmt = $pdo->prepare("UPDATE user_video_flags SET video_{$video_number}_flag = 1 WHERE loginID = ?");
        $stmt->execute([$loginID]);
    }

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

<!doctype html>
<html lang="ja">



<head>

<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-K94EJ7G2VQ"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-K94EJ7G2VQ');
</script>

<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-NVZDXZ2Q');</script>
<!-- End Google Tag Manager -->

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">

    <title>Informatica World Tour 2024</title>
    <meta name="twitter:title" content="Informatica World Tour 2024"/>
    <meta name="twitter:card" content="summary_large_image"/>
    <meta name="twitter:domain" content="https://iwt2024.jp/"/>
    <meta name="description" content="Informatica World Tour 2024 2024年9月13日（金）開催" />
    <meta name="keywords" content="Informatica World Tour 2024,iwt2024,インフォマティカワールドツアー,大手町プレイス ホール＆カンファレンス,大井町,インフォマティカ ジャパン" />
    <link rel="canonical" href="https://iwt2024.jp/">
    <head prefix="og: https://iwt2024.jp/# fb: https://iwt2024.jp/ fb# website: https://iwt2024.jp/ website#"></head>
    <meta property="og:locale" content="ja_JP">
    <meta property="og:type" content="website">
    <meta property="og:title" content="Informatica World Tour 2024">
    <meta property="og:description" content="Informatica World Tour 2024 2024年9月13日（金）">
    <meta property="og:url" content="https://iwt2024.jp/">
    <meta property="og:site_name" content="Informatica World Tour 2024">
    <meta property="og:image" content="assets/images/ogp/iwt-ogp-image_2024.jpg">
    <meta property="og:image:width" content="1280">
    <meta property="og:image:height" content="630">
    <meta property="og:image_type" content="jpg"/>
    <meta name="twitter:image_width" content="1200">
    
    <link rel="icon" type="image/png" href="assets/images/favicon.png"/>
    <link rel="shortcut icon" href="assets/images/favicon.ico">
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="assets/js/iscroll.js"></script>
    <script type="text/javascript" src="assets/js/drawer.min.js"></script>
    <script type="text/javascript" src="assets/js/script.js"></script>
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="assets/css/custom.css">
    <meta name="link" content="https://iwt2024.jp/"/>
</head>


<body class="site drawer drawer--left">

<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NVZDXZ2Q"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
     
<!-- ここから -->
     <!-- Header -->
     <header class="site-header">
         <button type="button" class="drawer-toggle drawer-hamburger">
             <span class="sr-only">toggle navigation</span>
             <span class="drawer-hamburger-icon"></span>
         </button>
         <div class="container">
             <div class="site-branding">
                 <a href="https://iwt2024.jp/"><img src="assets/images/logo/informatica-logo.png" class="site-logo" alt="Infomatica"></a>
             </div>
         </div>
         <div class="header-right">
             <div class="site-navigation header-navigation">
                 <ul class="ul-menu">
                     <li class="li-menu"><a href="index.php">ホーム</a></li>
                     <li class="li-menu"><a href="agenda.php">アジェンダ</a></li>
                     <li class="li-menu"><a href="booth.php">展示</a></li>
                     <li class="li-menu"><a href="sponsored.php">スポンサー</a></li>
                       <!-- ログインしているかどうかを確認 -->
                 <?php if (isset($_SESSION['loginID'])): ?>
                 <!-- ログインしている場合 -->
                 <div class="account-dropdown">
                     <button class="account-button">
                         <!-- アイコンを左に追加 -->
                         <img src="https://assets.swoogo.com/uploads/2811891-64da62883cd1c.svg" alt="My account icon"
                             style="width: 24px;" />
                         <span>My account</span>
                     </button>
                     <div class="account-menu">
                         <p style="background-color: #FF7E01; color: white; padding: 10px;">
                             <?php echo $_SESSION['surname_kana']; ?> 様
                             <br>
                             <?php echo $_SESSION['work_email']; ?>
                         </p>
                         <a href="select/mypage.php">
                             <!-- アイコンをリンクの左に追加 -->
                             <img src="https://assets.swoogo.com/uploads/2849704-64ed272488683.svg" alt="確認アイコン"
                                 style="width: 18px; margin-right: 8px;">
                             登録確認ページ
                         </a>
                         <a href="select/logout.php">
                             <!-- ログアウトアイコンを追加 -->
                             <img src="https://assets.swoogo.com/uploads/2849701-64ed270f0caa3.svg" alt="ログアウトアイコン"
                                 style="width: 18px; margin-right: 8px;">
                             ログアウト
                         </a>
                     </div>
                 </ul>

               
                 </div>
                 <?php else: ?>
                 <!-- ログインしていない場合 -->
                 <a href="select/login.php" class="login-btn" style="margin-right: 100px;margin-left:20px">
                     <span>ログイン</span>
                 </a>
                 <?php endif; ?>
             </div>
         </div>
     </header>



     <nav class="drawer-nav" style="touch-action: none;">
         <ul class="ul-menu"
             style="transition-timing-function: cubic-bezier(0.1, 0.57, 0.1, 1); transition-duration: 0ms; transform: translate(0px, 0px) translateZ(0px);">
             <li class="li-menu"><a href="index.php">ホーム</a></li>
             <li class="li-menu"><a href="agenda.php">アジェンダ</a></li>
             <li class="li-menu"><a href="booth.php">展示</a></li>
             <li class="li-menu"><a href="sponsored.php">スポンサー</a></li>
    <!-- ログインしているかどうかを確認 -->
    <?php if (isset($_SESSION['loginID'])): ?>
                 <!-- ログインしている場合 -->
                 <div class="account-dropdown">
                     <button class="account-button">
                         <!-- アイコンを左に追加 -->
                         <img src="https://assets.swoogo.com/uploads/2811891-64da62883cd1c.svg" alt="My account icon"
                             style="width: 24px;" />
                         <span>My account</span>
                     </button>
                     <div class="account-menu">
                         <p style="background-color: #0078D7; color: white; padding: 10px;">
                             <?php echo $_SESSION['surname_kana']; ?> 様
                             <br>
                             <?php echo $_SESSION['work_email']; ?>
                         </p>
                         <a href="select/mypage.php">
                             <!-- アイコンをリンクの左に追加 -->
                             <img src="https://assets.swoogo.com/uploads/2849704-64ed272488683.svg" alt="確認アイコン"
                                 style="width: 18px; margin-right: 8px;">
                             登録確認ページ
                         </a>
                         <a href="select/logout.php">
                             <!-- ログアウトアイコンを追加 -->
                             <img src="https://assets.swoogo.com/uploads/2849701-64ed270f0caa3.svg" alt="ログアウトアイコン"
                                 style="width: 18px; margin-right: 8px;">
                             ログアウト
                         </a>
                     </div>
                 </ul>

               
                 </div>
                 <?php else: ?>
                 <!-- ログインしていない場合 -->
                 <a href="select/login.php" class="login-btn" style="margin-top:10px;">
                     <span>ログイン</span>
                 </a>
                 <?php endif; ?>
         </ul>
     </nav>
<!-- ここまで -->

<!-- End Header-->
<div class="infa-world-headline-img"></div>
<div class="container">
    <div class="site-main">

       
        
        <div style="padding:56.25% 0 0 0;position:relative; margin-top:80px;"><iframe src="https://player.vimeo.com/video/1009876350?badge=0&amp;autopause=0&amp;player_id=0&amp;app_id=58479" frameborder="0" allow="autoplay; fullscreen; picture-in-picture; clipboard-write" style="position:absolute;top:0;left:0;width:100%;height:100%;" title="Snowflake, Databricks, AWS, Microsoft, GCP...-マルチクラウドで創る最強データプラットフォーム"></iframe></div><script src="https://player.vimeo.com/api/player.js"></script>

        
 <!-- ダウンロードボタン -->
 <a href="assets/pdf/IWT2024_Informatica3.pdf" class="download-button">セッション講演資料</a>
        
        <div class="modal__inner" style="padding: 0 20px;">
            <div class="modal__box">
               
                <h2 class="modal-title" style="margin-top: 100px;">Snowflake, Databricks, AWS, Microsoft, GCP...<br>
                    マルチクラウドで創る最強データプラットフォーム</h2>
                
                <div class="modal-member">
                    <div class="member-table">
                        <div class="member-cell">
                            <img src="assets/images/live/i_arata.png" class="member-image" onerror="this.src='assets/images/live/img.png'">
                        </div>
                        <div class="member-cell">
                            <h3>インフォマティカ・ジャパン株式会社</h3>
                            <p>テクニカルセールス本部<br>執行役員<br>テクニカルセールス本部本部長<span>荒田 圭哉</span></p>
                        </div>
                    </div>
                </div>
                <p class="modal-description">熱量溢れるコミュニティとユーザー体験に優れたSnowflake。AIエンジニアに評価されるDatabricks。世界で最も使われているAWS。高い期待を寄せられるMicrosoft Fabric。根強い人気を維持するGCP。自社にとって最適なデータプラットフォームを目指す場合、どれか一つを選択する必要はありません。本講演では、あらゆるデータプラットフォームを高度化しながら融合するマルチクラウド・データマネジメントとその最新ソリューションについてご紹介します。</p>
            </div>
        </div><!--modal__inner-->

<hr>

<div class="after-session">
        <span class="section-title">他のセッションも視聴する</span>
       
           

            <div class="thumbnail-gallery">
              <div class="thumbnail-box">
                    <a href="video-1.php">
                        <img src="assets/images/thumbnail/1_kityoukouen.png" alt="Video 1 Thumbnail">
                        <div class="play-icon"></div>
                    </a>
                     <div class="video-title">データが切り拓く生成 AIの未来<br>
～Everybody’s ready for AI except your data～</div>
                </div>

                
                <div class="thumbnail-box">
                    <a href="video-2.php">
                        <img src="assets/images/thumbnail/2_kityoukouen.png" alt="Video 2 Thumbnail">
                        <div class="play-icon"></div>
                    </a>
                    <div class="video-title">データ連係基盤の統合／拡大、データマネジメントへ</div>
                </div>
                <div class="thumbnail-box">
                    <a href="video-3.php">
                        <img src="assets/images/thumbnail/3_ALSI.png" alt="Video 3 Thumbnail">
                        <div class="play-icon"></div>
                    </a>
                    <div class="video-title">AI時代の勝者へ：IDMCで実現するデータマネジメント</div>
                </div>
                <div class="thumbnail-box">
                    <a href="video-4.php">
                        <img src="assets/images/thumbnail/4_informatica1.png" alt="Video 4 Thumbnail">
                        <div class="play-icon"></div>
                    </a>
                    <div class="video-title">ビジネスに革新をもたらす生成AIとモダン・データマネジメント</div>
                </div>
                <div class="thumbnail-box">
                    <a href="video-5.php">
                        <img src="assets/images/thumbnail/5_nsw.png" alt="Video 5 Thumbnail">
                        <div class="play-icon"></div>
                    </a>
                    <div class="video-title">データ活用の課題と最新動向<br>現場で広げるデータの利活用とは</div>
                </div>
                <div class="thumbnail-box">
                    <a href="video-6.php">
                        <img src="assets/images/thumbnail/6_informatica2.png" alt="Video 6 Thumbnail">
                        <div class="play-icon"></div>
                    </a>
                    <div class="video-title">データ戦略を支えるインフォマティカ・プラットフォームの全体像
                        〜ETL/ELTからマスタデータ管理、データガバナンスまで〜</div>
                </div>
                <!--  <div class="thumbnail-box">
                    <a href="video-7.php">
                        <img src="assets/images/thumbnail/7_informatica3.png" alt="Video 7 Thumbnail">
                        <div class="play-icon"></div>
                    </a>
                    <div class="video-title">Snowflake, Databricks, AWS, Microsoft, GCP...<br>
                        マルチクラウドで創る最強データプラットフォーム
                        </div>
                </div>-->
                <div class="thumbnail-box">
                    <a href="video-8.php">
                        <img src="assets/images/thumbnail/8_subaru.png" alt="Video 8 Thumbnail">
                        <div class="play-icon"></div>
                    </a>
                    <div class="video-title">SUBARU流 全社データ活用で笑顔を作る「モノづくり革新」と「価値づくり」</div>
                </div>
            </div>
        
    </div>
<!-- mcolumn-container end -->
</div>
</div>
</div>

<!-- footer start -->
<div class="footer-wave-image" style="background-image: url(assets/images/footer-wave.jpg);"></div>
<footer class="site-footer">
   
    <div class="container">
        <img class="infa-world-footer-logo desktop-set" loading="lazy" src="assets/images/logo/informatica-logo.png" alt="Informatica" width="137px">
        <h2 class="footer-title">お問い合わせ</h2>
        <h3 class="footer-subtitle">Informatica World Tour 2024 事務局</h3>
        <p>■システムやアカウントに関するお問い合わせ（株式会社シードブレイン 内）<br> 
            Email：<a href="mailto:iwt2024_registration@s-bev.jp?subject=システムやアカウントに関するお問い合わせ&amp;body=ご記入ください">iwt2024_registration@s-bev.jp</a>
        <p>■イベント内容に関するお問い合わせ(株式会社George P. Johnson 内)<br>
Email: <a href="mailto:iwt2024@jevent.jp?subject=イベント内容に関するお問い合わせ">iwt2024@jevent.jp</a></p>
<div class="footer-info">
    
    <a href="#" class="btn-top">TOP</a>
</div>

        <div class="footer-info-2">
            <div class="col-lg-6">
                <span class="copyright">© 2024 Informatica</span>
            
        </div>
   
          
        </div>

    </div>
</footer>
<!-- footer end -->






<div class="drawer-overlay drawer-toggle"></div>
<script src="assets/js/countdown.js"></script>
<script src="assets/js/scroll_color.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        // 現在のURLからクエリパラメータを取得
        const params = new URLSearchParams(window.location.search);
    
        // すべてのリンクを取得
        document.querySelectorAll('a').forEach(link => {
            const url = new URL(link.href, window.location.href);
            // メールや電話のリンクは除外
            if (url.protocol === 'mailto:' || url.protocol === 'tel:') return;
    
            // 各クエリパラメータをリンクに追加
            params.forEach((value, key) => {
                url.searchParams.set(key, value);
            });
    
            // 変更されたURLを設定
            link.href = url.href;
        });
    });
    </script>
    

</body>
</html>