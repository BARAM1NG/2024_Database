<?php
header('Content-Type: text/html; charset=UTF-8');

$server = 'localhost';
$user = 'hmpark';
$password = '2023103938';
$dbname = 'hmpark';

$conn = new mysqli($server, $user, $password, $dbname);

// 문자 집합 설정
$conn->set_charset('utf8');

if ($conn->connect_error) {
    echo "<h2>접속에 실패하였습니다.</h2>";
} else {
    echo "<h2>접속에 성공하였습니다.</h2>";
}
?>
