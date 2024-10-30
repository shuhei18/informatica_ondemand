<?php
// config.phpでデータベース接続情報を設定
require 'config.php';

try {
    // PDOを使用してデータベースに接続
    $pdo = new PDO(DB_DSN, DB_USER, DB_PASSWORD);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // usersテーブルからloginIDを取得
    $stmt = $pdo->query("SELECT loginID FROM users");
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($rows) {
        // ヘッダーを設定して、ブラウザにCSVファイルをダウンロードさせる
        header('Content-Type: text/csv; charset=UTF-8');
        header('Content-Disposition: attachment; filename="login_ids.csv"');
        header('Pragma: no-cache');
        header('Expires: 0');

        // 出力を開始
        $output = fopen('php://output', 'w');

        // ヘッダー行を書き込む（loginID）
        fputcsv($output, array('loginID'));

        // 取得したデータをCSV形式で出力
        foreach ($rows as $row) {
            fputcsv($output, $row);
        }

        // 出力を閉じる
        fclose($output);
        exit(); // スクリプトを終了し、ブラウザにファイルを送信

    } else {
        echo "データが見つかりませんでした。";
    }

} catch (PDOException $e) {
    echo "データベース接続エラー: " . $e->getMessage();
}
?>
