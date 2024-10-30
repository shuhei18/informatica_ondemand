<?php
session_start();

// ユーザーがログインしているか確認
if (!isset($_SESSION['loginID'])) {
    // セッション情報がない場合はログインページにリダイレクト
    header("Location: select/login.php");
    exit();
}

// セッションの有効時間を設定（秒単位：10分 = 600秒）
$session_timeout = 600;

// 最終アクティビティ時刻を確認し、タイムアウトをチェック
if (isset($_SESSION['last_activity'])) {
    $inactive_time = time() - $_SESSION['last_activity'];

    // 10分以上経過していればセッションを破棄
    if ($inactive_time > $session_timeout) {
        session_unset();
        session_destroy();
        header("Location: select/login.php");
        exit();
    }
}

// 最終アクティビティ時刻を更新
$_SESSION['last_activity'] = time();

// PDFファイルパス
$pdf_file = 'assets/pdf/IWT2024_Informatica2.pdf';

// ファイルが存在するかチェック
if (file_exists($pdf_file)) {
    // PDFファイルの表示用のヘッダーを設定
    header('Content-Type: application/pdf');
    header('Content-Disposition: inline; filename="' . basename($pdf_file) . '"');
    header('Content-Length: ' . filesize($pdf_file));

    // ファイルを出力してブラウザに表示
    readfile($pdf_file);
    exit();
} else {
    echo "PDFファイルが見つかりません。";
}
?>
