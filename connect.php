<?php
header('Content-Type: text/html; charset=UTF-8');

$server = 'localhost';
$user = 'hmpark';
$password = '2023103938';
$dbname = 'hmpark';

$conn = new mysqli($server, $user, $password, $dbname);

// ���� ���� ����
$conn->set_charset('utf8');

if ($conn->connect_error) {
    echo "<h2>���ӿ� �����Ͽ����ϴ�.</h2>";
} else {
    echo "<h2>���ӿ� �����Ͽ����ϴ�.</h2>";
}
?>
