<?php
session_start();

// セッションの有効時間を設定（秒単位：1時間 = 3600秒）
$session_timeout = 3600;

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


 <!doctype html>
 <html lang="ja">

 <head>
     <!-- Google tag (gtag.js) -->
     <script async src="https://www.googletagmanager.com/gtag/js?id=G-K94EJ7G2VQ"></script>
     <script>
     window.dataLayer = window.dataLayer || [];

     function gtag() {
         dataLayer.push(arguments);
     }
     gtag('js', new Date());

     gtag('config', 'G-K94EJ7G2VQ');
     </script>

     <!-- Google Tag Manager -->
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
     <!-- End Google Tag Manager -->

     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">

     <title>Informatica World Tour 2024</title>
     <meta name="twitter:title" content="Informatica World Tour 2024" />
     <meta name="twitter:card" content="summary_large_image" />
     <meta name="twitter:domain" content="https://iwt2024.jp/" />
     <meta name="description" content="Informatica World Tour 2024 2024年9月13日（金）開催" />
     <meta name="keywords"
         content="Informatica World Tour 2024,iwt2024,インフォマティカワールドツアー,大手町プレイス ホール＆カンファレンス,大井町,インフォマティカ ジャパン" />
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
     <meta property="og:image_type" content="jpg" />
     <meta name="twitter:image_width" content="1200">

     <link rel="icon" type="image/png" href="assets/images/favicon.png" />
     <link rel="shortcut icon" href="assets/images/favicon.ico">
     <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
     <script type="text/javascript" src="assets/js/iscroll.js"></script>
     <script type="text/javascript" src="assets/js/drawer.min.js"></script>
     <script type="text/javascript" src="assets/js/script.js"></script>
     <link rel="stylesheet" type="text/css" href="assets/css/style.css">
     <link rel="stylesheet" type="text/css" href="assets/css/custom.css">
     <meta name="link" content="https://iwt2024.jp/" />

     <script>
     document.addEventListener("DOMContentLoaded", function() {
         var isLoggedIn = <?php echo $is_logged_in ? 'true' : 'false'; ?>;

         // .video-thumbnailと.download-buttonを別々に取得
         var videoLinks = document.querySelectorAll('.video-thumbnail');
         var downloadButtons = document.querySelectorAll('.download-button');

         // 動画リンクに対してログインチェック
         videoLinks.forEach(function(link) {
             link.addEventListener('click', function(event) {
                 if (!isLoggedIn) {
                     event.preventDefault();
                     sessionStorage.setItem('redirectURL', link.href); // セッションストレージにリンクを保存
                     window.location.href = 'select/login.php'; // ログインページにリダイレクト
                 }
             });
         });

         // ダウンロードボタンに対してログインチェック
         downloadButtons.forEach(function(button) {
             button.addEventListener('click', function(event) {
                 if (!isLoggedIn) {
                     event.preventDefault();
                     sessionStorage.setItem('redirectURL', button.href); // セッションストレージにリンクを保存
                     window.location.href = 'select/login.php'; // ログインページにリダイレクト
                 }
             });
         });
     });
     </script>

     <style>
     .video-thumbnail {
         position: relative;
         display: inline-block;
         cursor: pointer;
     }

     .thumbnail {
         width: 100%;
         height: auto;
     }

     .play-icon {
         position: absolute;
         top: 50%;
         left: 50%;
         transform: translate(-50%, -50%);
         width: 60px;
         height: 60px;
         background-color: rgba(0, 0, 0, 0.5);
         border-radius: 50%;
         display: flex;
         align-items: center;
         justify-content: center;
         transition: background-color 0.3s ease;
     }

     .play-icon::before {
         content: '';
         display: inline-block;
         border-style: solid;
         border-width: 15px 0 15px 25px;
         border-color: transparent transparent transparent white;
     }

     .video-thumbnail:hover .play-icon {
         background-color: #FF7E01;
         /* ホバー時のアイコンの背景色を赤に */
     }

     .row {
         gap: 0px;
         justify-content: space-between;
     }

     .col-lg-9 {
         width: 45%;
     }

     .section-live .schedule-table {
         padding: 0 20px;
     }


     </style>


 </head>


 <body class="site drawer drawer--left">

     <!-- Google Tag Manager (noscript) -->
     <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NVZDXZ2Q" height="0" width="0"
             style="display:none;visibility:hidden"></iframe></noscript>
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

     <div class="site-main">


         <div class="site-section section-mainvisual">




             <section class="hero">
                 <div id="home" class="area_top_view">
                     <div class="container">
                         <div class="container-top">
                             <div class="container-top-box">
                                 <div class="text-box">
                                     <img class="iw23-logo" src="assets/images/event-logo.png" height="120">
                                     <h1>2024年9月13日(金)｜大手町プレイス ホール＆カンファレンス</h1>

                                 </div>
                             </div>

                             <div class="container-top-box">
                                 <img class="container-top-box-img" src="assets/images/iw24-main-visual.png"
                                     height="120">
                             </div>
                         </div>


                     </div>
                 </div>
             </section>


             <div class="mainvisual-detail notice" style="padding: 20px 0;">
                 <div class="container" style="text-align: center; color: #FA4616; font-weight: 600;">
                     ご来場ありがとうございました。9月30日(月)まで、<a href="#ondemand">オンデマンド</a>でセッションを視聴いただけます。
                 </div>
             </div>

             <!-- Overview start -->
             <div class="mainvisual-detail section-overveiw" id="scroll-color">
                 <div class="container">
                     <div class="section-overveiw">
                         <span class="section-title">開催概要</span>
                         <div class="row">
                             <div class="col col-13 col-md-6">
                                 <div class="detail-table">
                                     <div class="detail-cell first-cell">
                                         <strong>日程</strong>
                                     </div>
                                     <div class="detail-cell">
                                         <time>2024年9月13日(金) 13:30-18:00</time>
                                         <ul class="ul-detail">
                                             <table>
                                                 <tr>
                                                     <td>受付開始</td>
                                                     <td>13:00</td>
                                                 </tr>
                                                 <tr>
                                                     <td>展示</td>
                                                     <td>13:00-18:00</td>
                                                 </tr>
                                             </table>
                                         </ul>
                                     </div>
                                 </div>
                                 <div class="detail-table">
                                     <div class="detail-cell first-cell">
                                         <strong>会場</strong>
                                     </div>

                                     <time>大手町プレイス ホール＆カンファレンス</time>
                                     <ul class="ul-detail">
                                         <li class="li-detail">東京都千代田区大手町2-3-1</li>
                                         <li class="li-detail">大手町プレイス(イーストタワー) 1F/2F</li>
                                         <li class="li-detail">大手町駅A5出口直結</li>
                                         <a class="btn-conversion" href="https://otemachi-place-hc.jp/access.html"
                                             target="_blank">アクセスはこちら</a>
                                     </ul>

                                 </div>
                             </div>
                             <div class="col col-13 col-md-6">
                                 <div class="detail-table">
                                     <div class="detail-cell">
                                         <strong>参加費</strong>
                                     </div>
                                     <div class="detail-cell">
                                         <time>無料(事前登録制)</time>
                                     </div>
                                 </div>

                                 <div class="detail-table">
                                     <div class="detail-cell">
                                         <strong>参加対象</strong>
                                     </div>
                                     <div class="detail-cell">
                                         <p>ユーザー企業のCDO、CIO、<br>IT部門責任者・担当者<br>
                                             <small style="vertical-align: top; display: block;">
                                                 ※競合企業にお勤めの方、<span>個人の方のお申し込みは</span><span>お断りすることがございます。</span>
                                             </small>
                                         </p>

                                     </div>
                                 </div>

                                 <div class="detail-table">
                                     <div class="detail-cell">
                                         <strong>主催</strong>
                                     </div>
                                     <div class="detail-cell" style="margin-top: 0;">
                                         <p>インフォマティカ・ジャパン株式会社</p>
                                     </div>
                                 </div>

                             </div>
                         </div>
                     </div>
                 </div>
             </div>
             <!-- Overview end -->
         </div>
         <!-- highlights start -->
         <div id="highlights" class="site-section section-highlights">
             <div class="container">
                 <span class="section-title">Informatica World Tour 2024の見どころ</span>
                 <p class="highlights-description">
                     AI活用の準備はできていますか？AIを最大限に活用して、ビジネスをより早く確実に成長させるためには、企業内に蓄積されたデータを包括的に管理し、高品質なデータを整備す
                     ることが不可欠です。本イベントでは、AIを活用したクラウドデータ管理の最新テクノロジーとデモンストレーション、ユーザー導入事例、パートナーソリューションなど、多彩
                     なプログラムをご用意しています。高品質なデータに基づくAI活用の最新像をご体感ください。</p>

                 <div class="row row-height">
                     <div class="col col-12">
                         <img src="assets/images/highlights-image-01.jpg" class="highlights-image" alt="先進ユーザー事例">
                         <div class="box">
                             <h3>先進ユーザー事例</h3>
                             <p>中部電力株式会社、株式会社中電シーティーアイによる「データ連係基盤の統合／拡大、
                                 データマネジメントへ」、株式会社SUBARUからは「SUBARU流 全社データ活用で笑顔を
                                 作る「モノづくり革新」と「価値づくり」」についてご講演いただきます。
                                 各社の先進事例を是非お聞きください。
                             </p>
                         </div>
                     </div>
                     <div class="col col-12">
                         <img src="assets/images/highlights-image-02.jpg" class="highlights-image"
                             alt="基調講演・セッションプログラム">
                         <div class="box">
                             <h3>基調講演・セッションプログラム</h3>
                             <p>基調講演では「データが切り拓く生成AIの未来」をテーマに、インフォマティカの戦略・最新情報を
                                 はじめ、ユーザー事例やデモを通して、データの力により進化するビジネスの世界をご紹介します。
                                 また、インフォマティカの最新ソリューションセッションのほか、
                                 スポンサー各社によるデータマネジメントに役立つ幅広いトピックのセッションをお届けします。
                             </p>
                         </div>
                     </div>
                     <div class="col col-12">
                         <img src="assets/images/highlights-image-03.jpg" class="highlights-image" alt="多彩なソリューション展示">
                         <div class="box">
                             <h3>多彩なソリューション展示</h3>
                             <p>展示コーナーでは、インフォマティカによる生成AI対応の最新データマネジメントソリューション
                                 をデモを交えてご紹介します。さらに、スポンサー各社による、DXを推進するデータ連携・利活用
                                 の導入事例やサービス等、お客様の課題解決となる多彩なソリューションをご覧いただけます。
                                 是非、各社ブースにお立ち寄りください。
                             </p>
                         </div>
                     </div>
                 </div>

             </div>
         </div>
         <!-- highlights end -->





         <!-- present start -->
         <div id="present" class="site-section section-present" style="display: none">
             <div class="section-header">
                 <div class="container">
                     <h2 class="section-title">プレゼント</h2>
                     <div class="section-content">
                         <p class="present-text"></p>
                         <div class="row">
                             <div class="col col-12">
                                 <h3>ご来場先着200名様</h3>
                                 <P>ご来場先着200名のお客様へ<br>ボールペン/A5リングノート受付にてお渡しします！</P>
                                 <div class="box">
                                     <img src="assets/images/present1.png" width="80%">
                                 </div>

                             </div>
                             <div class="col col-12">
                                 <h3>オンラインアンケート</h3>
                                 <P>会場でオンラインアンケートへ回答いただいたお客様へ<br>オリジナルトートバッグをプレゼント！</P>
                                 <div class="box">
                                     <img src="assets/images/present2.png" width="80%">
                                 </div>
                             </div>
                             <div class="col col-12">
                                 <h3>ポイントラリー</h3>
                                 <P>展示コーナーのポイントラリーにご参加のお客様へ<br>オリジナルアクセサリーケースをプレゼント！</P>
                                 <div class="box">
                                     <img src="assets/images/present3.png" width="80%">
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>


         </div>
         <!-- present end -->


     </div>




     <!-- live start -->
     <div class="site-section section-live">

         <div class="section-content">
             <div class="container">

                 <!-- .schedule-table -->

                 <div class="hr-modoki"></div>

                 <h2 class="section-title" style="margin: 30px 0px;" id="ondemand">オンデマンド</h2>
                 <div class="schedule-table members">


                     <div class="row">
                         <div class="col col-12 col-lg-9" style="padding-bottom: 0px;">
                             <div class="modal-open">
                                 <div class="speaker-box">
                                     <h4 class="speaker-title">データが切り拓く生成 AIの未来<br>
                                         ～Everybody’s ready for AI except your data～</h4>
                                     <div class="speaker-table" style="margin-bottom: 20px;">

                                         <div class="speaker-cell">
                                             <img src="assets/images/live/i_kozawa.png" class="speaker-image"
                                                 onerror="this.src='assets/images/live/img.png'">
                                         </div>

                                         <div class="speaker-cell">
                                             <p><span class="company-name">インフォマティカ・ジャパン株式会社</span>
                                                 <span style="letter-spacing:-0.5px;">代表取締役社長</span>


                                             </p>
                                             <strong>小澤 泰斗</strong>
                                         </div>
                                     </div>



                                 </div>


                             </div>
                             <div class="modal__content js-modal" style="left: 420px; top: 0px; display: none;">
                                 <div class="modal__inner">
                                     <div class="modal__box">
                                         <div class="modal-close"></div>
                                         <span class="modal-subtitle">【基調講演】</span>
                                         <h2 class="modal-title">データが切り拓く生成 AIの未来<br>
                                             ～Everybody’s ready for AI except your data～</h2>
                                         <p class="modal-description">
                                             今、あらゆる企業がAIの準備に注力していますが、自社データの準備はできているのでしょうか。ビジネスへの生成AIの適用が加速する世界で、AIを活かすデータを全社規模で適切に管理し、データと共にAIに命を吹き込むことで、データから価値を生み出しビジネスに変革をもたらすことが可能になります。これを実現するインフォマティカの戦略と、データの力により進化する世界をご紹介します。
                                         </p>
                                         <div class="modal-member">
                                             <div class="member-table">
                                                 <div class="member-cell">
                                                     <img src="assets/images/live/i_kozawa.png" class="member-image"
                                                         onerror="this.src='assets/images/live/img.png'">
                                                 </div>
                                                 <div class="member-cell">
                                                     <h3>インフォマティカ・ジャパン株式会社</h3>
                                                     <p>代表取締役社長<span>小澤 泰斗</span></p>
                                                 </div>
                                             </div>
                                         </div>
                                     </div>
                                 </div>
                                 <!--modal__inner-->
                                 <!--modal__content-->
                             </div>




                         </div>


                         <!-- 動画 -->
                         <div class="col col-12 col-lg-9">
                             <a href="video-1.php" class="video-thumbnail">
                                 <img src="assets/images/thumbnail/1_kityoukouen.png" alt="Video Thumbnail"
                                     class="thumbnail">
                                 <div class="play-icon"></div>
                             </a>

                             <!-- ダウンロードボタン -->
                             <a href="IWT2024_Keynote.php" class="download-button">セッション講演資料</a>
                         </div>




                     </div>

                 </div><!-- .schedule-table -->



                 <div class="schedule-table members">


                     <div class="row">
                         <div class="col col-12 col-lg-9">
                             <div class="modal-open">
                                 <div class="speaker-box">
                                     <h4 class="speaker-title">データ連係基盤の統合／拡大、データマネジメントへ</h4>
                                     <div class="speaker-table" style="margin-bottom: 20px;">

                                         <div class="speaker-cell">
                                             <img src="assets/images/live/u_yamada.png" class="speaker-image"
                                                 onerror="this.src='assets/images/live/img.png'">
                                         </div>
                                         <div class="speaker-cell">
                                             <p><span class="company-name">中部電力株式会社</span>
                                                 <span style="letter-spacing:-0.5px;">ＤＸ推進室<br>ＩＴアーキテクトグループ<br>副長</span>
                                             </p>
                                             <strong>山田 祐揮 氏</strong>
                                         </div>

                                     </div>
                                     <div class="speaker-table" style="margin-bottom: 20px;">

                                         <div class="speaker-cell">
                                             <img src="assets/images/live/u_imai.png" class="speaker-image"
                                                 onerror="this.src='assets/images/live/img.png'">
                                         </div>
                                         <div class="speaker-cell">
                                             <p><span class="company-name">株式会社中電シーティーアイ</span>
                                                 <span style="letter-spacing:-0.5px;">技術本部<br>プラットフォームＲ
                                                     ハイブリッドクラウドセンター<br>共通インフラＧ<br>主査</span>

                                             </p>
                                             <strong>今井 優一 氏</strong>
                                         </div>



                                     </div>






                                 </div>


                             </div>
                             <div class="modal__content js-modal" style="left: 124.5px; top: 68px; display: none;">
                                 <div class="modal__inner">
                                     <div class="modal__box">
                                         <div class="modal-close"></div>
                                         <span class="modal-subtitle">【基調講演】</span>
                                         <h2 class="modal-title">データ連係基盤の統合／拡大、データマネジメントへ</h2>
                                         <p class="modal-description">
                                             当社では、クラウドシフトや運用効率化を目的に、データ連係基盤の最適化／インフォマティカへの『統合』を進めると共に、利用者の『拡大』を狙った多角的な取組み（教育／周知／性能改善）を行っております。本講演では、『統合』『拡大』に、中長期的なDX施策として『データマネジメント』へのチャレンジをキーワードに加え、取組み事例／苦労等を発表致します。
                                         </p>
                                         <div class="modal-member">
                                             <div class="member-table">
                                                 <div class="member-cell">
                                                     <img src="assets/images/live/u_yamada.png" class="member-image"
                                                         onerror="this.src='assets/images/live/img.png'">
                                                 </div>
                                                 <div class="member-cell">
                                                     <h3>中部電力株式会社</h3>
                                                     <p>ＤＸ推進室<br>ＩＴアーキテクトグループ<br>副長<span>山田 祐揮 氏</span></p>
                                                 </div>
                                             </div>
                                             <div class="member-table">
                                                 <div class="member-cell">
                                                     <img src="assets/images/live/u_imai.png" class="member-image"
                                                         onerror="this.src='assets/images/live/img.png'">
                                                 </div>
                                                 <div class="member-cell">
                                                     <h3>株式会社中電シーティーアイ</h3>
                                                     <p>技術本部<br>プラットフォームＲ ハイブリッドクラウドセンター<br>共通インフラＧ<br>主査<span>今井 優一
                                                             氏</span></p>
                                                 </div>
                                             </div>
                                         </div>
                                     </div>
                                 </div>
                                 <!--modal__inner-->
                                 <!--modal__content-->
                             </div>

                         </div>
                         <!-- 動画 -->
                         <div class="col col-12 col-lg-9">
                             <a href="video-2.php" class="video-thumbnail">
                                 <img src="assets/images/thumbnail/2_kityoukouen.png" alt="Video Thumbnail"
                                     class="thumbnail">
                                 <div class="play-icon"></div>
                             </a>
                         </div>
                     </div>
                 </div><!-- .schedule-table -->





                 <!-- .schedule-table -->
                 <div class="hr-modoki"></div>
                 <div class="schedule-table members">


                     <div class="row">
                         <div class="col col-12 col-lg-9">
                             <div class="modal-open">
                                 <div class="speaker-box">
                                     <h4 class="speaker-title">AI時代の勝者へ：IDMCで実現するデータマネジメント</h4>
                                     <div class="speaker-table" style="margin-bottom: 20px;">

                                         <div class="speaker-cell">
                                             <img src="assets/images/live/01_douman.png" class="speaker-image"
                                                 onerror="this.src='assets/images/live/img.png'">
                                         </div>

                                         <div class="speaker-cell">
                                             <p> <span class="company-name">アルプス システム インテグレーション株式会社</span>
                                                 <span
                                                     style="letter-spacing:-0.5px;">セールス＆マーケティング統括部<br>営業部<br>エンタープライズ営業課</span>
                                             </p>
                                             <span class="speaker-name">道満 純子 氏</span>
                                         </div>
                                     </div>

                                     <div class="speaker-table" style="margin-bottom: 20px;">

                                         <div class="speaker-cell">
                                             <img src="assets/images/live/01_takei.png" class="speaker-image"
                                                 onerror="this.src='assets/images/live/img.png'">
                                         </div>

                                         <div class="speaker-cell">
                                             <p> <span class="company-name">アルプス システム インテグレーション株式会社</span>
                                                 <span
                                                     style="letter-spacing:-0.5px;">プロダクト&ソリューション事業部<br>ソリューションビジネス統括部<br>ソリューション推進1部<br>部長</span>
                                                 <span class="speaker-name">武井 順也 氏</span>
                                         </div>
                                     </div>

                                 </div>




                             </div>
                             <div class="modal__content js-modal" style="left: 420px; top: 0px; display: none;">
                                 <div class="modal__inner">
                                     <div class="modal__box">
                                         <div class="modal-close"></div>
                                         <span class="modal-subtitle"></span>
                                         <h2 class="modal-title">AI時代の勝者へ：IDMCで実現するデータマネジメント</h2>
                                         <p class="modal-description">AI時代において、データマネジメントは重要な役割を果たし、Garbage In,
                                             Garbage
                                             Outの原則に従い正確で品質の高いデータを収集・整備することが求められます。
                                             本セミナーでは、IDMCの機能やその活用方法を事例を交えながら説明します。更にデータの収集、整備、分析の過程を解説し、データの価値を最大限に引き出すためのポイントをお伝えします。
                                             AI時代の企業競争力を高めるチャンスをお見逃しなく。ぜひご参加ください。</p>
                                         <div class="modal-member">
                                             <div class="member-table">
                                                 <div class="member-cell">
                                                     <img src="assets/images/live/01_douman.png" class="member-image"
                                                         onerror="this.src='assets/images/live/img.png'">
                                                 </div>
                                                 <div class="member-cell">
                                                     <h3>アルプス システム インテグレーション株式会社</h3>
                                                     <p>セールス＆マーケティング統括部<br>営業部<br>エンタープライズ営業課<span>道満 純子 氏</span></p>
                                                 </div>
                                             </div>
                                         </div>
                                         <div class="modal-member">
                                             <div class="member-table">
                                                 <div class="member-cell">
                                                     <img src="assets/images/live/01_takei.png" class="member-image"
                                                         onerror="this.src='assets/images/live/img.png'">
                                                 </div>
                                                 <div class="member-cell">
                                                     <h3>アルプス システム インテグレーション株式会社</h3>
                                                     <p>プロダクト&ソリューション事業部<br>ソリューションビジネス統括部<br>ソリューション推進1部<br>部長<span>武井
                                                             順也 氏</span></p>
                                                 </div>
                                             </div>
                                         </div>
                                     </div>
                                 </div>
                                 <!--modal__inner-->
                                 <!--modal__content-->
                             </div>

                         </div>
                         <!-- 動画 -->
                         <div class="col col-12 col-lg-9">
                             <a href="video-3.php" class="video-thumbnail">
                                 <img src="assets/images/thumbnail/3_ALSI.png" alt="Video Thumbnail" class="thumbnail">
                                 <div class="play-icon"></div>
                             </a>

                         </div>
                     </div>
                 </div><!-- .schedule-table -->



                 <!-- .schedule-table -->
                 <div class="hr-modoki"></div>
                 <div class="schedule-table members">
                     <div class="row">
                         <div class="col col-12 col-lg-9">
                             <div class="modal-open">
                                 <div class="speaker-box">
                                     <h4 class="speaker-title">ビジネスに革新をもたらす生成AIとモダン・データマネジメント</h4>
                                     <div class="speaker-table" style="margin-bottom: 20px;">
                                         <div class="speaker-cell">
                                             <img src="assets/images/live/i_morimoto.png" class="speaker-image"
                                                 onerror="this.src='assets/images/live/img.png'">
                                         </div>
                                         <div class="speaker-cell">
                                             <p> <span class="company-name">インフォマティカ・ジャパン株式会社</span>
                                                 <span
                                                     style="letter-spacing:-0.5px;">グローバル・パートナーテクニカルセールス<br>ソリューションアーキテクト＆エバンジェリスト</span>
                                             </p>
                                             <span class="speaker-name">森本 卓也</span>
                                         </div>
                                     </div>


                                 </div>


                             </div>
                             <div class="modal__content js-modal" style="left: 420px; top: 0px; display: none;">
                                 <div class="modal__inner">
                                     <div class="modal__box">
                                         <div class="modal-close"></div>
                                         <span class="modal-subtitle"></span>
                                         <h2 class="modal-title">ビジネスに革新をもたらす生成AIとモダン・データマネジメント</h2>
                                         <p class="modal-description">
                                             「どうすればデータから価値を生み出し、ビジネスに革新をもたらす企業になれるのか？」　生成AIとデータマネジメントこそがその答えであり、データの力をあらゆるビジネスへ解放します。本講演では、「生成AIのためのデータマネジメント」と「データマネジメントのための生成AI」、この2大テーマにフォーカスしつつ、最新のデータマネジメントの世界をご紹介します。
                                         </p>
                                         <div class="modal-member">
                                             <div class="member-table">
                                                 <div class="member-cell">
                                                     <img src="assets/images/live/i_morimoto.png" class="member-image"
                                                         onerror="this.src='assets/images/live/img.png'">
                                                 </div>
                                                 <div class="member-cell">
                                                     <h3>インフォマティカ・ジャパン株式会社</h3>
                                                     <p>グローバル・パートナーテクニカルセールス<br>ソリューションアーキテクト＆エバンジェリスト<span>森本
                                                             卓也</span></p>
                                                 </div>
                                             </div>
                                         </div>
                                     </div>
                                 </div>
                                 <!--modal__inner-->
                                 <!--modal__content-->
                             </div>

                         </div>
                         <!-- 動画 -->
                         <div class="col col-12 col-lg-9">
                             <a href="video-4.php" class="video-thumbnail">
                                 <img src="assets/images/thumbnail/4_informatica1.png" alt="Video Thumbnail"
                                     class="thumbnail">
                                 <div class="play-icon"></div>
                             </a>

                             <!-- ダウンロードボタン -->
                             <a href="IWT2024_Informatica1.php" class="download-button">セッション講演資料</a>
                         </div>
                     </div>
                 </div><!-- .schedule-table -->


                 <!-- .schedule-table -->
                 <div class="hr-modoki"></div>
                 <div class="schedule-table members">
                     <div class="row">
                         <div class="col col-12 col-lg-9">
                             <div class="modal-open">
                                 <div class="speaker-box">
                                     <h4 class="speaker-title">データ活用の課題と最新動向<br>
                                         現場で広げるデータの利活用とは</h4>
                                     <div class="speaker-table" style="margin-bottom: 20px;">
                                         <div class="speaker-cell">
                                             <img src="assets/images/live/02_suzuki.png" class="speaker-image"
                                                 onerror="this.src='assets/images/live/img.png'">
                                         </div>
                                         <div class="speaker-cell">
                                             <p><span class="company-name">NSW株式会社</span>
                                                 <span
                                                     style="letter-spacing:-0.5px;">サービスソリューション事業本部<br>クラウドプラットフォーム事業部<br>副事業部長</span>
                                             </p>
                                             <span class="speaker-name">鈴木 輝亮 氏</span>
                                         </div>
                                     </div>


                                 </div>


                             </div>
                             <div class="modal__content js-modal" style="left: 420px; top: 0px; display: none;">
                                 <div class="modal__inner">
                                     <div class="modal__box">
                                         <div class="modal-close"></div>
                                         <span class="modal-subtitle"></span>
                                         <h2 class="modal-title">データ活用の課題と最新動向<br>
                                             現場で広げるデータの利活用とは</h2>
                                         <p class="modal-description">
                                             データ活用とは、企業に蓄積されたデータや社外の情報ソースを、経営テーマや業務課題に沿って継続的に活用する営みです。日本企業においてはその重要性を認識しても活用が浸透しない、またはプロジェクトが進まないといった声を多くお聞きします。<br>
                                             本講演では、データに裏付けされたデータドリブン経営を実現するための重要なポイントや、クラウドデータファブリックで実装されるソリューション活用の未来像をお伝えします。
                                         </p>
                                         <div class="modal-member">
                                             <div class="member-table">
                                                 <div class="member-cell">
                                                     <img src="assets/images/live/02_suzuki.png" class="member-image"
                                                         onerror="this.src='assets/images/live/img.png'">
                                                 </div>
                                                 <div class="member-cell">
                                                     <h3>NSW株式会社</h3>
                                                     <p>サービスソリューション事業本部<br>クラウドプラットフォーム事業部<br>副事業部長<span>鈴木 輝亮
                                                             氏</span></p>
                                                 </div>
                                             </div>
                                         </div>
                                     </div>
                                 </div>
                                 <!--modal__inner-->
                                 <!--modal__content-->
                             </div>

                         </div>
                         <!-- 動画 -->
                         <div class="col col-12 col-lg-9">
                             <a href="video-5.php" class="video-thumbnail">
                                 <img src="assets/images/thumbnail/5_nsw.png" alt="Video Thumbnail" class="thumbnail">
                                 <div class="play-icon"></div>
                             </a>

                             <!-- ダウンロードボタン -->
                             <a href="IWT2024_NSW.php" class="download-button">セッション講演資料</a>
                         </div>
                     </div>
                 </div><!-- .schedule-table -->




                 <!-- .schedule-table -->
                 <div class="hr-modoki"></div>
                 <div class="schedule-table members">
                     <div class="row">
                         <div class="col col-12 col-lg-9">
                             <div class="modal-open">
                                 <div class="speaker-box">
                                     <h4 class="speaker-title">データ戦略を支えるインフォマティカ・プラットフォームの全体像<br>
                                         〜ETL/ELTからマスタデータ管理、データガバナンスまで〜</h4>
                                     <div class="speaker-table" style="margin-bottom: 20px;">
                                         <div class="speaker-cell">
                                             <img src="assets/images/live/i_suzuki.png" class="speaker-image"
                                                 onerror="this.src='assets/images/live/img.png'">
                                         </div>
                                         <div class="speaker-cell">
                                             <p><span class="company-name">インフォマティカ・ジャパン株式会社</span>
                                                 <span
                                                     style="letter-spacing:-0.5px;">テクニカルセールス本部<br>プリンシパルソリューションアーキテクト</span>
                                             </p>
                                             <span class="speaker-name">鈴木 直人</span>
                                         </div>
                                     </div>


                                 </div>


                             </div>
                             <div class="modal__content js-modal" style="left: 420px; top: 0px; display: none;">
                                 <div class="modal__inner">
                                     <div class="modal__box">
                                         <div class="modal-close"></div>
                                         <span class="modal-subtitle"></span>
                                         <h2 class="modal-title">データ戦略を支えるインフォマティカ・プラットフォームの全体像<br>
                                             〜ETL/ELTからマスタデータ管理、データガバナンスまで〜</h2>
                                         <p class="modal-description">
                                             インフォマティカ・プラットフォームは、データ統合、マスタデータ管理、データ/AIガバナンスを統合的に活用し、企業のデータ戦略を強化します。本講演では、AI活用、DX推進、クラウド化などお客様のビジネス、ITを取り巻く様々な活動、課題に対して、プラットフォーム全体としてどのようにデータ活用を支援できるかを探り、ビジネス価値を最大化するためのベストプラクティスおよびアプローチをご紹介します。
                                         </p>
                                         <div class="modal-member">
                                             <div class="member-table">
                                                 <div class="member-cell">
                                                     <img src="assets/images/live/i_suzuki.png" class="member-image"
                                                         onerror="this.src='assets/images/live/img.png'">
                                                 </div>
                                                 <div class="member-cell">
                                                     <h3>インフォマティカ・ジャパン株式会社</h3>
                                                     <p>テクニカルセールス本部<br>プリンシパルソリューションアーキテクト<span>鈴木 直人</span></p>
                                                 </div>
                                             </div>
                                         </div>
                                     </div>
                                 </div>
                                 <!--modal__inner-->
                                 <!--modal__content-->
                             </div>

                         </div>
                         <!-- 動画 -->
                         <div class="col col-12 col-lg-9">
                             <a href="video-6.php" class="video-thumbnail">
                                 <img src="assets/images/thumbnail/6_informatica2.png" alt="Video Thumbnail"
                                     class="thumbnail">
                                 <div class="play-icon"></div>
                             </a>

                             <!-- ダウンロードボタン -->
                             <a href="IWT2024_Informatica2.php" class="download-button">セッション講演資料</a>
                         </div>
                     </div>
                 </div><!-- .schedule-table -->

                 <!-- .schedule-table -->
                 <div class="hr-modoki"></div>
                 <div class="schedule-table members">
                     <div class="row">
                         <div class="col col-12 col-lg-9">
                             <div class="modal-open">
                                 <div class="speaker-box">
                                     <h4 class="speaker-title">Snowflake, Databricks, AWS, Microsoft, GCP...<br>
                                         マルチクラウドで創る最強データプラットフォーム</h4>
                                     <div class="speaker-table" style="margin-bottom: 20px;">
                                         <div class="speaker-cell">
                                             <img src="assets/images/live/i_arata.png" class="speaker-image"
                                                 onerror="this.src='assets/images/live/img.png'">
                                         </div>
                                         <div class="speaker-cell">
                                             <p> <span class="company-name">インフォマティカ・ジャパン株式会社</span>
                                                 <span
                                                     style="letter-spacing:-0.5px;">テクニカルセールス本部<br>執行役員<br>テクニカルセールス本部本部長</span>
                                             </p>
                                             <span class="speaker-name">荒田 圭哉</span>
                                         </div>
                                     </div>


                                 </div>


                             </div>
                             <div class="modal__content js-modal" style="left: 420px; top: 0px; display: none;">
                                 <div class="modal__inner">
                                     <div class="modal__box">
                                         <div class="modal-close"></div>
                                         <span class="modal-subtitle"></span>
                                         <h2 class="modal-title">Snowflake, Databricks, AWS, Microsoft, GCP...<br>
                                             マルチクラウドで創る最強データプラットフォーム</h2>
                                         <p class="modal-description">
                                             熱量溢れるコミュニティとユーザー体験に優れたSnowflake。AIエンジニアに評価されるDatabricks。世界で最も使われているAWS。高い期待を寄せられるMicrosoft
                                             Fabric。根強い人気を維持するGCP。自社にとって最適なデータプラットフォームを目指す場合、どれか一つを選択する必要はありません。本講演では、あらゆるデータプラットフォームを高度化しながら融合するマルチクラウド・データマネジメントとその最新ソリューションについてご紹介します。
                                         </p>
                                         <div class="modal-member">
                                             <div class="member-table">
                                                 <div class="member-cell">
                                                     <img src="assets/images/live/i_arata.png" class="member-image"
                                                         onerror="this.src='assets/images/live/img.png'">
                                                 </div>
                                                 <div class="member-cell">
                                                     <h3>インフォマティカ・ジャパン株式会社</h3>
                                                     <p>テクニカルセールス本部<br>執行役員<br>テクニカルセールス本部本部長<span>荒田 圭哉</span></p>
                                                 </div>
                                             </div>
                                         </div>
                                     </div>
                                 </div>
                                 <!--modal__inner-->
                                 <!--modal__content-->
                             </div>

                         </div>
                         <!-- 動画 -->
                         <div class="col col-12 col-lg-9">
                             <a href="video-7.php" class="video-thumbnail">
                                 <img src="assets/images/thumbnail/7_informatica3.png" alt="Video Thumbnail"
                                     class="thumbnail">
                                 <div class="play-icon"></div>
                             </a>
                             <!-- ダウンロードボタン -->
                             <a href="IWT2024_Informatica3.php" class="download-button">セッション講演資料</a>
                         </div>
                     </div>
                 </div><!-- .schedule-table -->




                 <!-- .schedule-table -->
                 <div class="hr-modoki"></div>
                 <div class="schedule-table members">
                     <div class="row">
                         <div class="col col-12 col-lg-9">
                             <div class="modal-open">
                                 <div class="speaker-box">
                                     <h4 class="speaker-title">SUBARU流 全社データ活用で笑顔を作る<br>「モノづくり革新」と「価値づくり」</h4>
                                     <div class="speaker-table" style="margin-bottom: 20px;">
                                         <div class="speaker-cell">
                                             <img src="assets/images/live/ichikawa.png" class="speaker-image"
                                                 onerror="this.src='assets/images/live/img.png'">
                                         </div>
                                         <div class="speaker-cell">
                                             <p> <span class="company-name">株式会社SUBARU</span>
                                                 <span style="letter-spacing:-0.5px;">データ統括活用推進部<br>主査</span>
                                             </p>
                                             <span class="speaker-name">市川 健太郎 氏</span>
                                         </div>
                                     </div>


                                 </div>


                             </div>
                             <div class="modal__content js-modal" style="left: 420px; top: 0px; display: none;">
                                 <div class="modal__inner">
                                     <div class="modal__box">
                                         <div class="modal-close"></div>
                                         <span class="modal-subtitle">【特別講演】</span>
                                         <h2 class="modal-title">SUBARU流 全社データ活用で笑顔を作る「モノづくり革新」と「価値づくり」</h2>
                                         <p class="modal-description">
                                             SUBARUは世界最先端の「モノづくり革新」と「価値づくり」を目指しており、モノづくりのプロセスを可視化するPLMの領域だけでなく(＝モノづくり革新)、SUBARU車両のトレーサビリティデータを利用してお客様に対して新しい価値(=価値づくり)を提供するための全社データ統合基盤をインフォマティカ製品を活用して実現しています。部門横断で活用できるデータ統合基盤(G-PLM)を構築し、データを以って組織の壁を壊し、データを以って新しい価値を生み出す、その取り組みをご紹介します。
                                         </p>
                                         <div class="modal-member">
                                             <div class="member-table">
                                                 <div class="member-cell">
                                                     <img src="assets/images/live/ichikawa.png" class="member-image"
                                                         onerror="this.src='assets/images/live/img.png'">
                                                 </div>
                                                 <div class="member-cell">
                                                     <h3>株式会社SUBARU</h3>
                                                     <p>データ統括活用推進部<br>主査<span>市川 健太郎 氏</span></p>
                                                 </div>
                                             </div>
                                         </div>
                                     </div>
                                 </div>
                                 <!--modal__inner-->
                                 <!--modal__content-->
                             </div>

                         </div>
                         <!-- 動画 -->
                         <div class="col col-12 col-lg-9">
                             <a href="video-8.php" class="video-thumbnail">
                                 <img src="assets/images/thumbnail/8_subaru.png" alt="Video Thumbnail"
                                     class="thumbnail">
                                 <div class="play-icon"></div>
                             </a>

                             <!-- ダウンロードボタン -->
                             <a href="IWT2024_SUBARU.php" class="download-button">セッション講演資料</a>
                         </div>
                     </div>
                 </div><!-- .schedule-table -->








             </div>
         </div>

     </div>
     <!-- end -->











     <!-- footer start -->
     <div class="footer-wave-image" style="background-image: url(assets/images/footer-wave.jpg);"></div>
     <footer class="site-footer">

         <div class="container">
             <img class="infa-world-footer-logo desktop-set" loading="lazy"
                 src="assets/images/logo/informatica-logo.png" alt="Informatica" width="137px">
             <h2 class="footer-title">お問い合わせ</h2>
             <h3 class="footer-subtitle">Informatica World Tour 2024 事務局</h3>
             <p>■システムやアカウントに関するお問い合わせ（株式会社シードブレイン 内）<br>
                 Email：<a
                     href="mailto:iwt2024_registration@s-bev.jp?subject=システムやアカウントに関するお問い合わせ&amp;body=ご記入ください">iwt2024_registration@s-bev.jp</a>
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