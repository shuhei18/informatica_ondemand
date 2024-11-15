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
       
        <div class="mainvisual-frame">
            <div class="container">
                <div class="infa-world-headline">

                    <h1 style="display: block; height: auto; margin-top: 10%;">アジェンダ</h1>
                    <div class="header-radio">
                    <label>
                        <input type="radio" name="group1" id="radio1" onclick="selectRadio(1)">
                        <span class="custom-radio">メインセッション</span>
                    </label>
                    <label>
                        <input type="radio" name="group1" id="radio2" onclick="selectRadio(2)">
                        <span class="custom-radio">ミニセッション</span>
                    </label>
                    </div>

                </div>    
            </div>
        </div>
    </div>



<!-- live start -->
<div id="live" class="site-section section-live">

    <div class="section-content">
        <div class="container">
 <!--  <input id="TAB-02" type="radio" name="TAB" class="tab-switch" /><label class="tab-label" for="TAB-02">ミニセッション</label>-->
            <div class="tab-wrap">
                <label>
                    <input type="radio" name="tab-group" id="radio3" onclick="selectRadio(3)">
                    <span class="custom-radio">メインセッション</span>
                </label><br>
                <label>
                    <input type="radio" name="tab-group" id="radio4" onclick="selectRadio(4)">
                    <span class="custom-radio">ミニセッション</span>
                </label>
<div id="tab1" class="tab-content">
    <div class="hr-modoki"></div>
     <!-- .schedule-table -->
            <div class="list-title">基調講演</div>
                <div class="schedule-table members">
                    <div class="schedule-cell">
                        <div class="schedule-time">13:30 – 14:25</div>
                        <div class="schedule-time-2">13:30 – 14:25</div>
                    </div>

                    
                    <div class="modal-open">
                    <div class="schedule-cell-kityoukouen">
                        <span class="session-title-2">データが切り拓く生成 AIの未来<br>
～Everybody’s ready for AI except your data～</span>
                        <div class="schedule-member">
                            <img src="assets/images/live/i_kozawa.png">
                         
                        <p>
                            <span><span class="session-title">データが切り拓く生成 AIの未来<br>
～Everybody’s ready for AI except your data～</span>
                                <span class="company-name">インフォマティカ・ジャパン株式会社</span>
                                <span style="letter-spacing:-0.5px;">代表取締役社長</span>
                                
                            </span><br>
                            <strong>小澤 泰斗</strong>
                        </p>
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
                                <p class="modal-description">今、あらゆる企業がAIの準備に注力していますが、自社データの準備はできているのでしょうか。ビジネスへの生成AIの適用が加速する世界で、AIを活かすデータを全社規模で適切に管理し、データと共にAIに命を吹き込むことで、データから価値を生み出しビジネスに変革をもたらすことが可能になります。これを実現するインフォマティカの戦略と、データの力により進化する世界をご紹介します。</p>
                                <div class="modal-member">
                                    <div class="member-table">
                                        <div class="member-cell">
                                            <img src="assets/images/live/i_kozawa.png" class="member-image" onerror="this.src='assets/images/live/img.png'">
                                        </div>
                                        <div class="member-cell">
                                            <h3>インフォマティカ・ジャパン株式会社</h3>
                                            <p>代表取締役社長<span>小澤 泰斗</span></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!--modal__inner-->
                        <!--modal__content-->
                    </div>

                 

                        <div class="modal-open">
                            <div class="schedule-cell-kityoukouen">
                                <span class="session-title-2">データ連係基盤の統合／拡大、データマネジメントへ</span>
                                <div class="schedule-member">
                                    <img src="assets/images/live/u_yamada.png">
                                 
                                <p>
                                    <span><span class="session-title">データ連係基盤の統合／拡大、データマネジメントへ</span>
                                        <span class="company-name">中部電力株式会社</span>
                                        <span style="letter-spacing:-0.5px;">ＤＸ推進室<br>ＩＴアーキテクトグループ<br>副長</span>
                                        
                                    </span><br>
                                    <strong>山田 祐揮 氏</strong>
                                </p>
                                </div>

                                <div class="schedule-member">
                                    <img src="assets/images/live/u_imai.png" class="member-image" onerror="this.src='assets/images/live/img.png'">
                                 
                                    <p>
                                        <span>
                                            <span class="company-name">株式会社中電シーティーアイ</span>
                                            <span style="letter-spacing:-0.5px;">技術本部<br>プラットフォームＲ ハイブリッドクラウドセンター<br>共通インフラＧ<br>主査</span>
                                            
                                        </span><br>
                                        <strong>今井 優一 氏</strong>
                                    </p>
                                </div>
                            </div>
                            </div>
        
                            <div class="modal__content js-modal" style="left: 124.5px; top: 68px; display: none;">
                                <div class="modal__inner">
                                    <div class="modal__box">
                                        <div class="modal-close"></div>
                                        <span class="modal-subtitle">【基調講演】</span>
                                        <h2 class="modal-title">データ連係基盤の統合／拡大、データマネジメントへ</h2>
                                        <p class="modal-description">当社では、クラウドシフトや運用効率化を目的に、データ連係基盤の最適化／インフォマティカへの『統合』を進めると共に、利用者の『拡大』を狙った多角的な取組み（教育／周知／性能改善）を行っております。本講演では、『統合』『拡大』に、中長期的なDX施策として『データマネジメント』へのチャレンジをキーワードに加え、取組み事例／苦労等を発表致します。
                                            </p>
                                        <div class="modal-member">
                                            <div class="member-table">
                                                <div class="member-cell">
                                                    <img src="assets/images/live/u_yamada.png" class="member-image" onerror="this.src='assets/images/live/img.png'">
                                                </div>
                                                <div class="member-cell">
                                                    <h3>中部電力株式会社</h3>
                                                    <p>ＤＸ推進室<br>ＩＴアーキテクトグループ<br>副長<span>山田 祐揮 氏</span></p>
                                                </div>
                                            </div>
                                            <div class="member-table">
                                                <div class="member-cell">
                                                    <img src="assets/images/live/u_imai.png" class="member-image" onerror="this.src='assets/images/live/img.png'">
                                                </div>
                                                <div class="member-cell">
                                                    <h3>株式会社中電シーティーアイ</h3>
                                                    <p>技術本部<br>プラットフォームＲ ハイブリッドクラウドセンター<br>共通インフラＧ<br>主査<span>今井 優一 氏</span></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div><!--modal__inner-->
                                <!--modal__content-->
                            </div>
                </div><!-- .schedule-table -->
                <div class="hr-modoki"></div>
                <div class="schedule-table members">
                <div class="schedule-cell break2">
                    <div class="schedule-time">14:25 – 14:40</div>
                    <div class="schedule-time-2">14:25 – 14:40</div>
                </div>
                <div class="list-title break">休憩（15分間）
                </div>
            </div>
            <div class="hr-modoki"></div>
            
            <div class="schedule-table members">
                <div class="schedule-cell">
                    <div class="schedule-time">14:40 – 15:05</div>
                    <div class="schedule-time-2">14:40 – 15:05</div>
                </div>

                <div class="modal-open">
                    <div class="schedule-cell-kityoukouen">
                        <span class="session-title-2">AI時代の勝者へ：IDMCで実現するデータマネジメント</span>
                        <div class="schedule-member">
                            <img src="assets/images/live/01_douman.png">
                         
                        <p>
                            <span><span class="session-title">AI時代の勝者へ：IDMCで実現するデータマネジメント</span>
                                <span class="company-name">アルプス システム インテグレーション株式会社</span>
                                <span style="letter-spacing:-0.5px;">セールス＆マーケティング統括部<br>営業部<br>エンタープライズ営業課</span>
                                
                            </span><br>
                            <strong>道満 純子 氏</strong>
                        </p>
                        </div>
                    </div>
                    <div class="schedule-cell-kityoukouen">
                       
                        <div class="schedule-member">
                            <img src="assets/images/live/01_takei.png">
                         
                        <p>
                         
                                <span class="company-name">アルプス システム インテグレーション株式会社</span>
                                <span style="letter-spacing:-0.5px;">プロダクト&ソリューション事業部<br>ソリューションビジネス統括部<br>ソリューション推進1部<br>部長</span>
                                
                            </span><br>
                            <strong>武井 順也 氏</strong>
                        </p>
                        </div>
                    </div>
                </div>

                <div class="modal__content js-modal" style="left: 420px; top: 0px; display: none;">
                    <div class="modal__inner">
                        <div class="modal__box">
                            <div class="modal-close"></div>
                            <span class="modal-subtitle"></span>
                            <h2 class="modal-title">AI時代の勝者へ：IDMCで実現するデータマネジメント</h2>
                            <p class="modal-description">AI時代において、データマネジメントは重要な役割を果たし、Garbage In, Garbage Outの原則に従い正確で品質の高いデータを収集・整備することが求められます。
                                本セミナーでは、IDMCの機能やその活用方法を事例を交えながら説明します。更にデータの収集、整備、分析の過程を解説し、データの価値を最大限に引き出すためのポイントをお伝えします。
                                AI時代の企業競争力を高めるチャンスをお見逃しなく。ぜひご参加ください。</p>
                            <div class="modal-member">
                                <div class="member-table">
                                    <div class="member-cell">
                                        <img src="assets/images/live/01_douman.png" class="member-image" onerror="this.src='assets/images/live/img.png'">
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
                                        <img src="assets/images/live/01_takei.png" class="member-image" onerror="this.src='assets/images/live/img.png'">
                                    </div>
                                    <div class="member-cell">
                                        <h3>アルプス システム インテグレーション株式会社</h3>
                                        <p>プロダクト&ソリューション事業部<br>ソリューションビジネス統括部<br>ソリューション推進1部<br>部長<span>武井 順也 氏</span></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!--modal__inner-->
                    <!--modal__content-->
                </div>


            </div><!-- .schedule-table -->

            <div class="hr-modoki"></div>
            
            <div class="schedule-table members">
                <div class="schedule-cell">
                    <div class="schedule-time">15:05 – 15:30</div>
                    <div class="schedule-time-2">15:05 – 15:30</div>
                </div>

                <div class="modal-open">
                    <div class="schedule-cell-kityoukouen">
                        <span class="session-title-2">ビジネスに革新をもたらす生成AIとモダン・データマネジメント</span>
                        <div class="schedule-member">
                            <img src="assets/images/live/i_morimoto.png">
                         
                        <p>
                            <span><span class="session-title">ビジネスに革新をもたらす生成AIとモダン・データマネジメント</span>
                                <span class="company-name">インフォマティカ・ジャパン株式会社</span>
                                <span style="letter-spacing:-0.5px;">グローバル・パートナーテクニカルセールス<br>ソリューションアーキテクト＆エバンジェリスト</span>
                                
                            </span><br>
                            <strong>森本 卓也</strong>
                        </p>
                        </div>
                    </div>
                </div>

                <div class="modal__content js-modal" style="left: 420px; top: 0px; display: none;">
                    <div class="modal__inner">
                        <div class="modal__box">
                            <div class="modal-close"></div>
                            <span class="modal-subtitle"></span>
                            <h2 class="modal-title">ビジネスに革新をもたらす生成AIとモダン・データマネジメント</h2>
                            <p class="modal-description">「どうすればデータから価値を生み出し、ビジネスに革新をもたらす企業になれるのか？」　生成AIとデータマネジメントこそがその答えであり、データの力をあらゆるビジネスへ解放します。本講演では、「生成AIのためのデータマネジメント」と「データマネジメントのための生成AI」、この2大テーマにフォーカスしつつ、最新のデータマネジメントの世界をご紹介します。</p>
                            <div class="modal-member">
                                <div class="member-table">
                                    <div class="member-cell">
                                        <img src="assets/images/live/i_morimoto.png" class="member-image" onerror="this.src='assets/images/live/img.png'">
                                    </div>
                                    <div class="member-cell">
                                        <h3>インフォマティカ・ジャパン株式会社</h3>
                                        <p>グローバル・パートナーテクニカルセールス<br>ソリューションアーキテクト＆エバンジェリスト<span>森本 卓也</span></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!--modal__inner-->
                    <!--modal__content-->
                </div>

                    
            </div><!-- .schedule-table -->

            <div class="hr-modoki"></div>
            <div class="schedule-table members">
                <div class="schedule-cell">
                    <div class="schedule-time">15:30 – 15:55</div>
                    <div class="schedule-time-2">15:30 – 15:55</div>
                </div>

            

                <div class="modal-open">
                    <div class="schedule-cell-kityoukouen">
                        <span class="session-title-2">データ活用の課題と最新動向<br>
                            現場で広げるデータの利活用とは</span>
                        <div class="schedule-member">
                            <img src="assets/images/live/02_suzuki.png">
                         
                        <p>
                            <span><span class="session-title">データ活用の課題と最新動向　
                                現場で広げるデータの利活用とは</span>
                                <span class="company-name">NSW株式会社</span>
                                <span style="letter-spacing:-0.5px;">サービスソリューション事業本部 クラウドプラットフォーム事業部<br>副事業部長</span>
                                
                            </span><br>
                            <strong>鈴木 輝亮 氏</strong>
                        </p>
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
                                <p class="modal-description">データ活用とは、企業に蓄積されたデータや社外の情報ソースを、経営テーマや業務課題に沿って継続的に活用する営みです。日本企業においてはその重要性を認識しても活用が浸透しない、またはプロジェクトが進まないといった声を多くお聞きします。<br>
                                    本講演では、データに裏付けされたデータドリブン経営を実現するための重要なポイントや、クラウドデータファブリックで実装されるソリューション活用の未来像をお伝えします。</p>
                                <div class="modal-member">
                                    <div class="member-table">
                                        <div class="member-cell">
                                            <img src="assets/images/live/02_suzuki.png" class="member-image" onerror="this.src='assets/images/live/img.png'">
                                        </div>
                                        <div class="member-cell">
                                            <h3>NSW株式会社</h3>
                                            <p>サービスソリューション事業本部 クラウドプラットフォーム事業部<br>副事業部長<span>鈴木 輝亮 氏</span></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!--modal__inner-->
                        <!--modal__content-->
                    </div>

                    
            </div><!-- .schedule-table -->
                <div class="hr-modoki"></div>
                <div class="schedule-table members">
                <div class="schedule-cell break2">
                    <div class="schedule-time">15:55 – 16:10</div>
                    <div class="schedule-time-2">15:55 – 16:10</div>
                </div>
                <div class="list-title break">休憩（15分間）
                </div>
            </div>
                <div class="hr-modoki"></div>
            
                <div class="schedule-table members">
                    <div class="schedule-cell">
                        <div class="schedule-time">16:10 – 16:35</div>
                        <div class="schedule-time-2">16:10 – 16:35</div>
                    </div>
    
                    <div class="modal-open">
                        <div class="schedule-cell-kityoukouen">
                            <span class="session-title-2">データ戦略を支えるインフォマティカ・プラットフォームの全体像<br>
                                〜ETL/ELTからマスタデータ管理、データガバナンスまで〜</span>
                            <div class="schedule-member">
                                <img src="assets/images/live/i_suzuki.png">
                             
                            <p>
                                <span><span class="session-title">データ戦略を支えるインフォマティカ・プラットフォームの全体像<br>
                                    〜ETL/ELTからマスタデータ管理、データガバナンスまで〜</span>
                                    <span class="company-name">インフォマティカ・ジャパン株式会社</span>
                                    <span style="letter-spacing:-0.5px;">テクニカルセールス本部<br>プリンシパルソリューションアーキテクト</span>
                                    
                                </span><br>
                                <strong>鈴木 直人</strong>
                            </p>
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
                                <p class="modal-description">インフォマティカ・プラットフォームは、データ統合、マスタデータ管理、データ/AIガバナンスを統合的に活用し、企業のデータ戦略を強化します。本講演では、AI活用、DX推進、クラウド化などお客様のビジネス、ITを取り巻く様々な活動、課題に対して、プラットフォーム全体としてどのようにデータ活用を支援できるかを探り、ビジネス価値を最大化するためのベストプラクティスおよびアプローチをご紹介します。</p>
                                <div class="modal-member">
                                    <div class="member-table">
                                        <div class="member-cell">
                                            <img src="assets/images/live/i_suzuki.png" class="member-image" onerror="this.src='assets/images/live/img.png'">
                                        </div>
                                        <div class="member-cell">
                                            <h3>インフォマティカ・ジャパン株式会社</h3>
                                            <p>テクニカルセールス本部<br>プリンシパルソリューションアーキテクト<span>鈴木 直人</span></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!--modal__inner-->
                        <!--modal__content-->
                    </div>
                        
                </div><!-- .schedule-table -->

                <div class="hr-modoki"></div>
            
                <div class="schedule-table members">
                    <div class="schedule-cell">
                        <div class="schedule-time">16:35 – 17:00</div>
                        <div class="schedule-time-2">16:35 – 17:00</div>
                    </div>
    
                    <div class="modal-open">
                        <div class="schedule-cell-kityoukouen">
                            <span class="session-title-2">Snowflake, Databricks, AWS, Microsoft, GCP...<br>
                                マルチクラウドで創る最強データプラットフォーム</span>
                            <div class="schedule-member">
                                <img src="assets/images/live/i_arata.png">
                             
                            <p>
                                <span><span class="session-title">Snowflake, Databricks, AWS, Microsoft, GCP...<br>
                                    マルチクラウドで創る最強データプラットフォーム</span>
                                    <span class="company-name">インフォマティカ・ジャパン株式会社</span>
                                    <span style="letter-spacing:-0.5px;">テクニカルセールス本部<br>執行役員<br>テクニカルセールス本部本部長</span>
                                    
                                </span><br>
                                <strong>荒田 圭哉</strong>
                            </p>
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
                                <p class="modal-description">熱量溢れるコミュニティとユーザー体験に優れたSnowflake。AIエンジニアに評価されるDatabricks。世界で最も使われているAWS。高い期待を寄せられるMicrosoft Fabric。根強い人気を維持するGCP。自社にとって最適なデータプラットフォームを目指す場合、どれか一つを選択する必要はありません。本講演では、あらゆるデータプラットフォームを高度化しながら融合するマルチクラウド・データマネジメントとその最新ソリューションについてご紹介します。</p>
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
                            </div>
                        </div><!--modal__inner-->
                        <!--modal__content-->
                    </div>
    
                        
                </div><!-- .schedule-table -->
            
                <!-- .schedule-table -->
            <div class="list-title">特別講演</div>
            <div class="schedule-table members">
                <div class="schedule-cell">
                    <div class="schedule-time">17:00 – 17:20</div>
                    <div class="schedule-time-2">17:00 – 17:20</div>
                </div>

                
                <div class="modal-open">
                    <div class="schedule-cell-kityoukouen">
                        <span class="session-title-2">SUBARU流 全社データ活用で笑顔を作る「モノづくり革新」と「価値づくり」</span>
                        <div class="schedule-member">
                            <img src="assets/images/live/ichikawa.png">
                         
                        <p>
                            <span><span class="session-title">SUBARU流 全社データ活用で笑顔を作る「モノづくり革新」と「価値づくり」</span>
                                <span class="company-name">株式会社SUBARU</span>
                                <span style="letter-spacing:-0.5px;">データ統括活用推進部<br>主査</span>
                                
                            </span><br>
                            <strong>市川 健太郎 氏</strong>
                        </p>
                        </div>
                </div>
                </div>

                <div class="modal__content js-modal" style="left: 420px; top: 0px; display: none;">
                    <div class="modal__inner">
                        <div class="modal__box">
                            <div class="modal-close"></div>
                            <span class="modal-subtitle">【特別講演】</span>
                            <h2 class="modal-title">SUBARU流 全社データ活用で笑顔を作る「モノづくり革新」と「価値づくり」</h2>
                            <p class="modal-description">SUBARUは世界最先端の「モノづくり革新」と「価値づくり」を目指しており、モノづくりのプロセスを可視化するPLMの領域だけでなく(＝モノづくり革新)、SUBARU車両のトレーサビリティデータを利用してお客様に対して新しい価値(=価値づくり)を提供するための全社データ統合基盤をインフォマティカ製品を活用して実現しています。部門横断で活用できるデータ統合基盤(G-PLM)を構築し、データを以って組織の壁を壊し、データを以って新しい価値を生み出す、その取り組みをご紹介します。</p>
                            <div class="modal-member">
                                <div class="member-table">
                                    <div class="member-cell">
                                        <img src="assets/images/live/ichikawa.png" class="member-image" onerror="this.src='assets/images/live/img.png'">
                                    </div>
                                    <div class="member-cell">
                                        <h3>株式会社SUBARU</h3>
                                        <p>データ統括活用推進部<br>主査<span>市川 健太郎 氏</span></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!--modal__inner-->
                    <!--modal__content-->
                </div>

            
            </div> 
        </div>
<!-- .TAB2-->
          
            <div id="tab2" class="tab-content">
     <!-- .schedule-table -->

                 <div class="hr-modoki"></div>
                <div class="schedule-table members">
                    <div class="schedule-cell">
                        <div class="schedule-time">14:40 – 15:10</div>
                        <div class="schedule-time-2">14:40 – 15:10</div>
                    </div>
    




                   
                      <div class="row">
                            <div class="col col-12 col-lg-9">
                                <div class="modal-open">
                                <div class="speaker-box">
                                <h4 class="speaker-title">現場技術者が語る！NTTデータのインフォマティカプロジェクトでのチャレンジ！</h4>
                                <div class="speaker-table" style="margin-bottom: 20px;">
                              
                                    <div class="speaker-cell">
                                                <img src="assets/images/live/kishimoto.png" class="speaker-image" onerror="this.src='assets/images/live/img.png'">
                                            </div>

                                            <div class="speaker-cell">
                                                <p><span class="company-name">株式会社NTTデータ</span>
                                                ソリューション事業本部<br>
                                                デジタルサクセスソリューション事業部<br>
                                                データマネジメントプラットフォーム統括部<br>
                                                課長代理</p>
                                                <span class="speaker-name">岸本 康秀 氏</span>
                                            </div>
                                </div>
                                <div class="speaker-table" style="margin-bottom: 20px;">
                                
                                            <div class="speaker-cell">
                                                <img src="assets/images/live/higuchi.png" class="speaker-image" onerror="this.src='assets/images/live/img.png'">
                                            </div>

                                            <div class="speaker-cell">
                                                <p><span class="company-name">株式会社NTTデータ</span>
                                                ソリューション事業本部<br>
                                                デジタルサクセスソリューション事業部<br>
                                                データマネジメントプラットフォーム統括部
                                                <br>主任</p>
                                                <span class="speaker-name">樋口 舞子 氏</span>
                                            </div>
                                        </div>

                                        <div class="speaker-table" style="margin-bottom: 20px;">
                                
                                            <div class="speaker-cell">
                                                <img src="assets/images/live/kitamura.png" class="speaker-image" onerror="this.src='assets/images/live/img.png'">
                                            </div>

                                            <div class="speaker-cell">
                                                <p><span class="company-name">株式会社NTTデータ</span>
                                                ソリューション事業本部<br>
                                                デジタルサクセスソリューション事業部<br>
                                                データマネジメントプラットフォーム統括部<br>
                                                主任</p>
                                                <span class="speaker-name">北村 清也 氏</span>
                                            </div>
                                        </div>
                            </div>
                       

                        </div>
                                <div class="modal__content js-modal" style="left: 128.705px; top: 98px; display: none;">
                            <div class="modal__inner">
                                <div class="modal__box">
                                    <div class="modal-close"></div>
                                    <span class="modal-subtitle"></span>
                                    <h2 class="modal-title">現場技術者が語る！<br>NTTデータのインフォマティカプロジェクトでのチャレンジ！</h2>
                                    <p class="modal-description">NTTデータ内の様々なプロジェクトで活躍している技術者によるライトニングトーク。<br>
                                                                    業務改革プロジェクトにおける連携基盤構築の難しさやそれを支えるインフォマティカがどう貢献したか、またどのような点に苦労したか、などインフォマティカの導入・運用において「今まさに挑戦している事」を様々な角度から赤裸々に語ります！<br>
                                                                    現場の生の声が溢れる、時間を皆様にお届けします。</p>
                                    <div class="modal-member">
                                    <div class="member-table">
                                            <div class="member-cell">
                                                <img src="assets/images/live/kishimoto.png" class="member-image" onerror="this.src='assets/images/live/img.png'">
                                            </div>
                                            <div class="member-cell">
                                                <h3>株式会社NTTデータ</h3>
                                                <p>ソリューション事業本部<br>
                                                デジタルサクセスソリューション事業部<br>
                                                データマネジメントプラットフォーム統括部<br>
                                                課長代理
                                                <span>岸本 康秀 氏</span></p>
                                            </div>
                                        </div>
                                        <div class="member-table">
                                            <div class="member-cell">
                                                <img src="assets/images/live/higuchi.png" class="member-image" onerror="this.src='assets/images/live/img.png'">
                                            </div>
                                            <div class="member-cell">
                                                <h3>株式会社NTTデータ</h3>
                                                <p>ソリューション事業本部<br>
                                                デジタルサクセスソリューション事業部<br>
                                                データマネジメントプラットフォーム統括部
                                                <br>主任
                                                <span>樋口 舞子 氏</span></p>
                                            </div>
                                        </div>
                                        <div class="member-table">
                                            <div class="member-cell">
                                                <img src="assets/images/live/kitamura.png" class="member-image" onerror="this.src='assets/images/live/img.png'">
                                            </div>
                                            <div class="member-cell">
                                                <h3>株式会社NTTデータ</h3>
                                                <p>ソリューション事業本部<br>
                                                デジタルサクセスソリューション事業部<br>
                                                データマネジメントプラットフォーム統括部<br>
                                                主任
                                                <span>北村 清也 氏</span></p>
                                            </div>
                                        </div>


                                    </div>
                                    
                                </div>
                            </div><!--modal__inner-->
                                </div>
                            </div>
                            <hr class="mobile-line"></hr>
                            <div class="col col-12 col-lg-9 line"></div>
                            <div class="col col-12 col-lg-9">
                                <div class="modal-open">
                                    <div class="speaker-box">
                                        <h4 class="speaker-title">DX成功のカギ！<br>
                                            データをスピーディーな意思決定に活かすには</h4>
                                        <div class="speaker-table">

                                            <div class="speaker-cell">
                                                <img src="assets/images/live/04_mikami.png" class="speaker-image" onerror="this.src='assets/images/live/img.png'">
                                            </div>
                                    
                                            <div class="speaker-cell">
                                                <p><span class="company-name">SCSK株式会社</span>産業事業グループ 産業ソリューション第二事業本部<br>
                                                    エンタープライズソリューション第二部 第二課</p>
                                                <span class="speaker-name">三上 晶子 氏</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal__content js-modal" style="left: 130.205px; top: 198px; display: none;">
                                    <div class="modal__inner">
                                        <div class="modal__box">
                                            <div class="modal-close"></div>
                                            <span class="modal-subtitle"></span>
                                            <h2 class="modal-title">DX成功のカギ！<br>
                                                データをスピーディーな意思決定に活かすには</h2>
                                            <p class="modal-description">データをスピーディーな意思決定に活かせていますか？データの効果的な活用は迅速な意思決定に繋がり、そのためにはデータマネジメントが不可欠です。本セッションでは、データマネジメントの重要性とその課題、そしてそれに対する解決策をご紹介します。「データ活用を始めたけれど、いまいち成果が出ない」「データマネジメントで何をすべきか分からない」といったお悩みをお持ちの方、ぜひご参加ください。</p>
                                            <div class="modal-member">
                                                <div class="member-table">
                                                    <div class="member-cell">
                                                        <img src="assets/images/live/04_mikami.png" class="member-image" onerror="this.src='assets/images/live/img.png'">
                                                    </div>
                                                    <div class="member-cell">
                                                        <h3>SCSK株式会社</h3>
                                                        <p>産業事業グループ 産業ソリューション第二事業本部<br>
                                                            エンタープライズソリューション第二部 第二課<span>三上 晶子 氏</span></p>
                                                    </div>
                                                </div>

                                            </div>
                                            
                                        </div>
                                    </div><!--modal__inner-->
                                </div>

                            </div>

                            
                        </div>
                        
                </div><!-- .schedule-table -->
                <div class="hr-modoki"></div>
                <div class="schedule-table members">
                <div class="schedule-cell break2">
                    <div class="schedule-time">15:10 – 15:25</div>
                    <div class="schedule-time-2">15:10 – 15:25</div>
                </div>
                <div class="list-title break">休憩（15分間）
                </div>
            </div>
               
        
                <!-- .schedule-table -->
                <div class="hr-modoki"></div>
                <div class="schedule-table members">
                    <div class="schedule-cell">
                        <div class="schedule-time">15:25 – 15:55</div>
                        <div class="schedule-time-2">15:25 – 15:55</div>
                    </div>
    
                   
                        <div class="row">
                            <div class="col col-12 col-lg-9">
                                <div class="modal-open">
                                <div class="speaker-box">
                                <h4 class="speaker-title">「データの在処」と「人」をつなぐ<br>ICT基盤の現在地</h4>
                                <div class="speaker-table" style="margin-bottom: 20px;">
                              
                                    <div class="speaker-cell">
                                        <img src="assets/images/live/05_nakamura.png" class="speaker-image" onerror="this.src='assets/images/live/img.png'">
                                    </div>

                                    <div class="speaker-cell">
                                        <p><span class="company-name">NTTコミュニケーションズ株式会社</span>プラットフォームサービス本部<br>
                                            クラウド＆ネットワークサービス部<br>
                                            データプラットフォームビジネス推進部門<br>
                                            担当部長</p>
                                        <span class="speaker-name">中村 匡孝 氏</span>
                                    </div>
                                </div>
                            </div>
                       

                        </div>
                                <div class="modal__content js-modal" style="left: 128.705px; top: 98px; display: none;">
                            <div class="modal__inner">
                                <div class="modal__box">
                                    <div class="modal-close"></div>
                                    <span class="modal-subtitle"></span>
                                    <h2 class="modal-title">「データの在処」と「人」をつなぐICT基盤の現在地</h2>
                                    <p class="modal-description">ビジネスへの生成AI適用が加速する一方で、業務へのより高度な活用のためには、機密データも含めていかにデータを適切に収集し、安全に管理・活用していくかが大きな課題となっています。本講演では、AIの活用に向けて求められる最適なICT基盤について、データマネジメントの観点から、NTT Comがトータルでご支援できるソリューションや機能、ユースケースを交えてご紹介します。</p>
                                    <div class="modal-member">
                                        <div class="member-table">
                                            <div class="member-cell">
                                                <img src="assets/images/live/05_nakamura.png" class="member-image" onerror="this.src='assets/images/live/img.png'">
                                            </div>
                                            <div class="member-cell">
                                                <h3>NTTコミュニケーションズ株式会社</h3>
                                                <p>プラットフォームサービス本部<br>
                                                    クラウド＆ネットワークサービス部<br>
                                                    データプラットフォームビジネス推進部門<br>
                                                    担当部長<span>中村 匡孝 氏</span></p>
                                            </div>
                                        </div>


                                    </div>
                                    
                                </div>
                            </div><!--modal__inner-->
                                </div>
                            </div>
                            <hr class="mobile-line"></hr>
                            <div class="col col-12 col-lg-9 line"></div>
                            <div class="col col-12 col-lg-9">
                        <div class="modal-open">
                            <div class="speaker-box">
                                <h4 class="speaker-title">データ活用に悩む方必見！<br>
                                    スモールスタートで始めるデータ活用</h4>
                                <div class="speaker-table">
                                    <div class="speaker-cell">
                                        <img src="assets/images/live/03_kobayashi.png" class="speaker-image" onerror="this.src='assets/images/live/img.png'">
                                    </div>
                                    <div class="speaker-cell">
                                        <p><span class="company-name">伊藤忠テクノソリューションズ株式会社</span>データビジネス企画・推進本部<br>
                                            データビジネス営業推進部 <br>
                                            データビジネスデザイン課</p>
                                        <span class="speaker-name">小林 直人 氏</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal__content js-modal" style="left: 130.205px; top: 198px; display: none;">
                            <div class="modal__inner">
                                <div class="modal__box">
                                    <div class="modal-close"></div>
                                    <span class="modal-subtitle"></span>
                                    <h2 class="modal-title">データ活用に悩む方必見！<br>
                                        スモールスタートで始めるデータ活用</h2>
                                    <p class="modal-description">企業の価値創出においてデータ活用は不可欠ですが、具体的にどこから始めればよいか悩む企業も少なくありません。本セッションでは、データ活用の「きっかけ」を提供するため、CTCの経験・知見を基にニーズの高い分析事例をテンプレート化した「データ活用 スモールスタートパック」についてご紹介いたします。提供コンテンツや事例を通し、データ活用の確実な第一歩を踏み出すための具体的なポイントをお伝えします。</p>
                                    <div class="modal-member">
                                        <div class="member-table">
                                            <div class="member-cell">
                                                <img src="assets/images/live/03_kobayashi.png" class="member-image" onerror="this.src='assets/images/live/img.png'">
                                            </div>
                                            <div class="member-cell">
                                                <h3>伊藤忠テクノソリューションズ株式会社</h3>
                                                <p>データビジネス企画・推進本部<br>
                                                    データビジネス営業推進部 <br>
                                                    データビジネスデザイン課<span>小林 直人 氏</span></p>
                                            </div>
                                        </div>

                                    </div>
                                    
                                </div>
                            </div><!--modal__inner-->
                        </div>

                        </div>

                            
                        </div>
                        
                </div>
                <!-- .schedule-table -->

                <div class="hr-modoki"></div>
                <div class="schedule-table members">
                <div class="schedule-cell break2">
                    <div class="schedule-time">15:55 – 16:10</div>
                    <div class="schedule-time-2">15:55 – 16:10</div>
                </div>
                <div class="list-title break">休憩（15分間）
                </div>
            </div>
               
        
                <!-- .schedule-table -->
                <div class="hr-modoki"></div>
                <div class="schedule-table members">
                    <div class="schedule-cell">
                        <div class="schedule-time">16:10 – 16:55</div>
                        <div class="schedule-time-2">16:10 – 16:55</div>
                    </div>
    
                   
                        <div class="row">
                            <div class="col col-12 col-lg-9">
                                <div class="modal-open">
                                <div class="speaker-box">
                                <h4 class="speaker-title">未来を開拓するデータ流通・活用基盤「Xzilla」</h4>
                                <div class="speaker-table" style="margin-bottom: 20px;">
                                    <div class="speaker-cell">
                                        <img src="assets/images/live/01_tsumita.png" class="speaker-image" onerror="this.src='assets/images/live/img.png'">
                                    </div>
                                    <div class="speaker-cell">
                                        <p><span class="company-name">アルプス システム インテグレーション株式会社</span>プロダクト&ソリューション事業部<br>ソリューションビジネス統括部<br>ソリューション推進1部<br>課長</p>
                                        <span class="speaker-name">積田 雄人 氏</span>
                                    </div>
                                </div>
                                
                                <div class="speaker-table" style="margin-bottom: 20px;">
                                    <div class="speaker-cell">
                                        <img src="assets/images/live/01_saitou.png" class="speaker-image" onerror="this.src='assets/images/live/img.png'">
                                    </div>
                                    <div class="speaker-cell">
                                        <p><span class="company-name">北海道ガス株式会社</span>デジタルトランスフォーメーション・構造改革推進部<br>情報プラットフォーム基盤管理グループ<br>主査</p>
                                        <span class="speaker-name">齊藤 圭司 氏</span>
                                    </div>
                                </div>
                            </div>
                       

                                </div>
                                <div class="modal__content js-modal" style="left: 128.705px; top: 98px; display: none;">
                            <div class="modal__inner">
                                <div class="modal__box">
                                    <div class="modal-close"></div>
                                    <span class="modal-subtitle"></span>
                                    <h2 class="modal-title">未来を開拓するデータ流通・活用基盤「Xzilla」</h2>
                                    <p class="modal-description">「2050年カーボンニュートラル」実現のため様々な挑戦をし続ける北海道ガス。「エネルギーと環境の最適化による快適な社会の創造」をテーマにエネルギーの地産地消など地域課題と向き合いながら付加価値の高いサービス提供と業務改革を進め、脱炭素社会の実現を目指しています。これらの取り組みの中核を担うのがデータ流通・活用基盤「Xzilla（くじら）」。DXを機動的に実現する「Xzilla」とは何かを紹介致します。</p>
                                    <div class="modal-member">
                                     
                                        <div class="member-table">

                                            
                                            <div class="member-cell">
                                                <img src="assets/images/live/01_tsumita.png" class="member-image" onerror="this.src='assets/images/live/img.png'">
                                            </div>
                                            <div class="member-cell">
                                                <h3>アルプス システム インテグレーション株式会社</h3>
                                                <p>プロダクト&ソリューション事業部<br>ソリューションビジネス統括部<br>ソリューション推進1部<br>課長<span>積田 雄人 氏</span></p>
                                            </div>
                                        </div>
                                       
                                        <div class="member-table">
                                            <div class="member-cell">
                                                <img src="assets/images/live/01_saitou.png" class="member-image" onerror="this.src='assets/images/live/img.png'">
                                            </div>
                                            <div class="member-cell">
                                                <h3>北海道ガス株式会社</h3>
                                                <p>デジタルトランスフォーメーション・構造改革推進部<br>情報プラットフォーム基盤管理グループ<br>主査<span>齊藤 圭司 氏</span></p>
                                            </div>
                                        </div>

                                </div>
                                    
                                </div>
                            </div><!--modal__inner-->
                                </div>
                            </div>
                            <div class="col col-12 col-lg-9 line"></div>
                            
                        </div>

                            </div>

                            
                        </div>
                        
                </div><!-- .schedule-table -->



            </div>
          </div>
                <!-- .schedule-table -->




               


        </div>
    </div>
    
</div>
<!-- end -->


</div>


<script>
    function selectRadio(selectedRadio) {
        if (selectedRadio === 1) {
            document.getElementById('radio3').checked = true;
            document.getElementById('tab1').classList.add('active');
            document.getElementById('tab2').classList.remove('active');
        } else if (selectedRadio === 2) {
            document.getElementById('radio4').checked = true;
            document.getElementById('tab2').classList.add('active');
            document.getElementById('tab1').classList.remove('active');
        } else if (selectedRadio === 3) {
            document.getElementById('radio1').checked = true;
            document.getElementById('tab1').classList.add('active');
            document.getElementById('tab2').classList.remove('active');
        } else if (selectedRadio === 4) {
            document.getElementById('radio2').checked = true;
            document.getElementById('tab2').classList.add('active');
            document.getElementById('tab1').classList.remove('active');
        }
    }

    // 初期状態を設定
    window.onload = function() {
        document.getElementById('radio1').checked = true;
        document.getElementById('radio3').checked = true;
        document.getElementById('tab1').classList.add('active');
    };
</script>


    

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