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
    
<div class="site-main">
    
    
    <div class="site-section section-mainvisual">
       
        <div class="mainvisual-frame img-3">
            <div class="container">
                <div class="infa-world-headline">

                    <h1>スポンサー</h1>

                  
                </div>    
            </div>
        </div>
    </div>










        



        





<!-- sponsored start -->
<div id="sponsored" class="site-section section-sponsored">

    <div class="section-content">
        <div class="container">
            <div class="sponsored platinum">
                <h3 class="section-subtitle">プラチナスポンサー</h3>
                <div class="row">
                     <div class="col col-6 col-lg-3">
                        
                        <a href="https://www.alsi.co.jp/" rel="noopener" target="_blank"><img src="assets/images/sponsor/ALSI.png" class="sponsored-image" alt="アルプス システム インテグレーション株式会社"></a>
                    </div>
                    <div class="col col-6 col-lg-3">
                        <a href="https://dx.nsw.co.jp/" rel="noopener" target="_blank"><img src="assets/images/sponsor/NSW.png" class="sponsored-image" alt="NSW株式会社"></a>

                    </div>
                </div>
            </div>
            <div class="sponsored gold">
                <h3 class="section-subtitle">ゴールドスポンサー</h3>
                <div class="row">
                    <div class="col col-6 col-lg-3">
                        <a href="https://www.ctc-g.co.jp/" rel="noopener" target="_blank"><img src="assets/images/sponsor/CTC.png" class="sponsored-image" alt="伊藤忠テクノソリューションズ株式会社"></a>
                    </div>
                    <div class="col col-6 col-lg-3">
                        <a href="https://www.scsk.jp/sp/informatica/index.html" rel="noopener" target="_blank"><img src="assets/images/sponsor/SCSK.png" class="sponsored-image" alt="SCSK株式会社"></a>
                    </div>
                    <div class="col col-6 col-lg-3">
                        <a href="https://www.ntt.com/business/sdpf.html" rel="noopener" target="_blank"><img src="assets/images/sponsor/NTTcom.png" class="sponsored-image" alt="NTTコミュニケーションズ株式会社"></a>
                    </div>
                    <div class="col col-6 col-lg-3">
                        <a href="https://enterprise-aiiot.nttdata.com/service/informatica" rel="noopener" target="_blank"><img src="assets/images/sponsor/NTTDATA.png" class="sponsored-image" alt="株式会社NTTデータ"></a>
                    </div>
                </div>
            </div>
            <div class="sponsored silver">
                <h3 class="section-subtitle">シルバースポンサー</h3>
                <div class="row">
                    
                    <div class="col col-6 col-lg-3">
                        <a href="https://www.tdc.co.jp/product/informatica/" rel="noopener" target="_blank"><img src="assets/images/sponsor/TDCSOFT.png" class="sponsored-image" alt="TDCソフト株式会社"></a>
                    </div>
                    <div class="col col-6 col-lg-3">
                        <a href="https://www.b-en-g.co.jp/jp/solution" rel="noopener" target="_blank"><img src="assets/images/sponsor/b-en-g.png" class="sponsored-image" alt="ビジネスエンジニアリング株式会社"></a>
                    </div>
                    <div class="col col-6 col-lg-3">
                        <a href="https://www.fujitsu.com/jp/innovation/data-driven/capabilities/data-utilization/informatica/" rel="noopener" target="_blank"><img src="assets/images/sponsor/FUJITSU.png" class="sponsored-image" alt="富士通株式会社"></a>
                    </div>
                    <div class="col col-6 col-lg-3">
                        <a href="https://www.mind.co.jp/digital_transformation/" rel="noopener" target="_blank"><img src="assets/images/sponsor/MITSUBISHI.png" class="sponsored-image" alt="三菱電機インフォメーションネットワーク株式会社"></a>
                    </div>

                </div>

                    <div class="sponsored silver">
                        <h3 class="section-subtitle">展示スポンサー</h3>
                        <div class="row">
                            <div class="col col-6 col-lg-3">
                                <a href="https://www.hitachi-systems.com/solution/s0306/Informatica/" rel="noopener" target="_blank"><img src="assets/images/sponsor/HITACHI.png" class="sponsored-image" alt="株式会社日立システムズ"></a>
                            </div>
                        </div>
                   
                  
                </div>
            
        </div>
    </div>
</div>
<!-- sponsored end -->



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