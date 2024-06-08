<?php
session_start();

// 데이터베이스 연결
$conn = new mysqli("localhost", "hmpark", "2023103938", "hmpark");

// 데이터베이스 연결 오류 확인
if ($conn->connect_error) {
    die("데이터베이스 연결 오류: " . $conn->connect_error);
}

// 검색어 가져오기
$search_query = $_GET['query'];

// 제품 검색 쿼리
$query = "SELECT * FROM P_Products WHERE Name LIKE '%$search_query%'";
$result = $conn->query($query);

// 검색 결과 처리
if ($result && $result->num_rows > 0) {
    echo "<script>alert('해당 제품이 존재합니다.');</script>";
    echo "<meta http-equiv='refresh' content='0;url=main.php'>";
} else {
    echo "<script>alert('검색 결과가 없습니다.');</script>";
    echo "<meta http-equiv='refresh' content='0;url=main.php'>";
}

// 데이터베이스 연결 닫기
$conn->close();
?>
