<?php
session_start();
$_SESSION['timeout'] = time(); // セッションタイムアウトのリセット
echo json_encode(['session_reset' => true]);
