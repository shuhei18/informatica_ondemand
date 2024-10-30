<?php
require 'tcpdf/tcpdf.php'; // TCPDFのパスを指定してください
require 'phpqrcode/qrlib.php'; // QRコード生成ライブラリのパスを指定してください
require 'config.php';

session_start();

// セッションIDがセットされていない場合
if (!isset($_SESSION['loginID'])) {
    echo "ログインしてください。";
    exit;
}

$loginID = $_SESSION['loginID'];

try {
    $pdo = new PDO(DB_DSN, DB_USER, DB_PASSWORD);

    // 複数の講演情報を取得
    $stmt = $pdo->prepare("SELECT lecture_time, lecture_title, hall, surname, given_name, company_name, corporate_type, corporate_prefix FROM users WHERE loginID = ?");
    $stmt->execute([$loginID]);
    $userRecords = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (empty($userRecords)) {
        echo "ユーザー情報が見つかりません。";
        exit;
    }

    // ユーザー情報は1回だけ取得（複数レコードから1つ目のレコードを使用）
    $user = $userRecords[0];

} catch (PDOException $e) {
    echo "データベースエラー: " . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8');
    exit;
}

class CustomPDF extends TCPDF {

    // Page header
    public function Header() {
        // Do not include any header content
    }

    // Page footer
    public function Footer() {
        // Do not include any footer content
    }
}
 
// SetFont( $family, $style, $size, $fontfile )
// MultiCell($w, $h, $txt, $border, $align, $fill, $ln, $x, $y, $reseth, $stretch, $ishtml, $autopadding, $maxh, $valign, $fitcell)
// Image( $file, $x, $y, $w, $h, $type, $link, $align, $resize, $dpi, $palign, $ismask, $imgmask, $border, $fitbox, $hidden, $fitonpage )
// Cell( $w, $h, $txt, $border, $ln, $align, $fill, $link, $stretch, $ignore_min_height, $calign, $valign )


// PDFの生成
$pdf = new CustomPDF();
$pdf->AddPage(); // 新しいpdfページを追加

// デフォルトのフォント設定
$pdf->SetFont("kozgopromedium", "", 10); 

// 四分割の線を引く（横線と縦線）
$pdf->Line(105, 0, 105, 297); // 縦線
$pdf->Line(0, 148.5, 210, 148.5); // 横線


// 左上のブロック（QRコード、会社名、名前、ログインID）
$pdf->SetXY(0, 0);
// QRコード
$qrCodePath = '/tmp/qrcode.png';
QRcode::png($loginID, $qrCodePath);
$pdf->Image($qrCodePath, 37.5, 30, 30);
// ログインID
$pdf->Ln();
$pdf->SetFont("", '', 8);
$pdf->MultiCell(85, null, htmlspecialchars($loginID, ENT_QUOTES, 'UTF-8'), 0, 'C', false, 0,  10, 61,);

// 会社名の表示
$companyName = htmlspecialchars($user['company_name'], ENT_QUOTES, 'UTF-8');
$corporateType = htmlspecialchars($user['corporate_type'], ENT_QUOTES, 'UTF-8');
$corporatePrefix = htmlspecialchars($user['corporate_prefix'], ENT_QUOTES, 'UTF-8');

if ($corporatePrefix === '前') {
    $displayCompanyName = $corporateType . $companyName;
} elseif ($corporatePrefix === '後') {
    $displayCompanyName = $companyName . $corporateType;
} else {
    $displayCompanyName = $companyName;
}

$pdf->SetFont("", '', 30);
$pdf->MultiCell(85, null, $displayCompanyName, 0, 'C', false, 0,  10, 90, null, null, null, null, 15, null, true);

// 名前
$pdf->Ln();
$pdf->MultiCell(85, 0, htmlspecialchars($user['surname'], ENT_QUOTES, 'UTF-8') . ' ' . htmlspecialchars($user['given_name'], ENT_QUOTES, 'UTF-8'), 0, "C", false, null, 10, 110, null, null, null, null, 10, null, true);


// 右上のブロック（小さいQRコード、セッション情報）
$pdf->SetXY(105, 0); // X軸を変更して右に寄せる
$pdf->Ln();
// 小さいQRコード
$pdf->Image($qrCodePath, 115, 5, 17, 17); 
$pdf->SetFont("", '', 8);
$pdf->MultiCell(25, null, htmlspecialchars($loginID, ENT_QUOTES, 'UTF-8'), 0, 'C', false, 0,  112.5, 22.5);
// ご登録セッション
$pdf->SetFont('', '', 12);
$pdf->MultiCell(85, null, '【ご登録セッション】', 0, 'L', false, 0,  110, 30);
$pdf->Ln(6); // 行の余白


// 各セッションの内容を表示
$pdf->SetFont('', '', 10); 
foreach ($userRecords as $record) {
    $lecture_time = htmlspecialchars($record['lecture_time'], ENT_QUOTES, 'UTF-8');
    $lecture_title = htmlspecialchars($record['lecture_title'], ENT_QUOTES, 'UTF-8');
    $hall = htmlspecialchars($record['hall'], ENT_QUOTES, 'UTF-8');
    // セッション情報 時間
    $pdf->SetFont('', '', 9);
    $pdf->SetX(110); // 同じX軸に揃える
    $pdf->SetFillColor(192);
    $pdf->MultiCell(95, null, "{$lecture_time}", 1, 'L', true, 0);
    $pdf->Ln(); // 行の余白
    // セッション情報　セッション名
    $pdf->SetFont('', '', 10);
    $pdf->SetX(110); // 同じX軸に揃える
    $pdf->MultiCell(95, null, "{$lecture_title}", 1, 'L', false, 0);
    $pdf->Ln(); // 行の余白
}


// 左下のブロック（開催日程、会場、来場に際しての注意点）
$pdf->SetXY(5, 155);
$pdf->SetFont('', '', 14);
$pdf->MultiCell(null, null, '【開催日程】', '0', 'L', false);
$pdf->Ln();
$pdf->SetX(12.5);
$pdf->SetFont('', '', 12);
$pdf->MultiCell(null, null, '受付開始 13:00', '0', 'L');
$pdf->SetX(12.5);
$pdf->MultiCell(null, null, '展示会場 13:00-18:00', '0', 'L');
$pdf->SetX(12.5);
$pdf->MultiCell(null, null, '2024年9月13日(金) 13:30-18:00', '0', 'L');
$pdf->Ln(12);

$pdf->SetX(5);
$pdf->SetFont('', '', 14);
$pdf->MultiCell(null, null, '【会場】', '0', 'L');
$pdf->Ln();
$pdf->SetFont('', '', 12);
$pdf->SetX(12.5);
$pdf->MultiCell(null, null, '大手町プレイス ホール＆カンファレンス', '0', 'L');
$pdf->SetX(12.5);
$pdf->MultiCell(null, null, '東京都千代田区大手町2-3-2 プレイス', '0', 'L');
$pdf->SetX(12.5);
$pdf->MultiCell(null, null, '大手町駅A5出口直結', '0', 'L');
$pdf->Ln(12);

$pdf->SetX(5);
$pdf->SetFont('', '', 14);
$pdf->MultiCell(null, null, '【ご来場に際して】', '0', 'L');
$pdf->Ln();
$pdf->SetFont('', '', 12);
$pdf->SetX(12.5);
$pdf->MultiCell(null, null, '受講票をA4サイズ・100%で印刷し
四つ折りにして会場へお持ちください。
受付にてホルダーをお渡しいたしますので
受講票をホルダーに入れてご入場ください。', '0', 'L');

// 右下のブロック（会場アクセス）
$pdf->SetXY(110, 155);
$pdf->SetFont('', '', 14);
$pdf->MultiCell(null, null, '【会場アクセス】', '0', 'L', false);
$pdf->Image('img-cnct/map00.png', 117.5, 168, 80);
$pdf->Ln();

// アクセス情報
$pdf->SetXY(110, 252);
$pdf->SetFont('', '', 11);
$pdf->MultiCell(90, 6, "「東京」駅丸の内北口から徒歩7分
(ＪＲ山手線・京浜東北線など)
「大手町」駅A5出口直結
(東京メトロ丸の内線・東西線・千代田線・半蔵門線・都営三田線)", 0, 'L');

// PDFを出力
$pdf->Output('登録証（受講票）.pdf', 'D');
?>
