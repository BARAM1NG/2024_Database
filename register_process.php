<?php

// 데이터베이스 연결
$conn = mysqli_connect("localhost", "hmpark", "2023103938", "hmpark");

// 연결 오류 확인
if (mysqli_connect_errno()) {
  die('데이터베이스 연결 오류: ' . mysqli_connect_error());
}

// POST로 전달된 데이터 가져오기
$userid = $_POST['userid'];
$userpw = $_POST['userpw'];
$userpw_confirm = $_POST['userpw_confirm'];
$email = $_POST['email'];
$name = $_POST['name'];

// 비밀번호 확인
if ($userpw !== $userpw_confirm) {
  die('비밀번호가 일치하지 않습니다.');
}


// 사용자 정보를 데이터베이스에 삽입
$query = "INSERT INTO P_Users (ID, PasswordHash, Email, Username, CreateDate) VALUES ('$userid', '$userpw', '$email', '$name', Now())";
if (mysqli_query($conn, $query)) {
  echo "회원가입 성공";
} else {
  echo "회원가입 실패: " . mysqli_error($conn);
}

// 데이터베이스 연결 닫기
mysqli_close($conn);
?>
