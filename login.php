<?php
// 데이터베이스 연결
$conn = mysqli_connect("localhost", "hmpark", "2023103938", "hmpark");

// 연결 오류 확인
if (mysqli_connect_errno()) {
  die('데이터베이스 연결 오류: ' . mysqli_connect_error());
}

// POST로 전달된 사용자명과 비밀번호 가져오기
$userid = $_POST['userid'];
$userpw = $_POST['userpw'];

// 사용자명과 비밀번호를 사용하여 데이터베이스에서 로그인 처리를 수행
$query = "SELECT * FROM P_Users WHERE ID = '$userid' AND PasswordHash = '$userpw'";
$result = mysqli_query($conn, $query);

// 결과 확인
if ($result && mysqli_num_rows($result) > 0) {
  session_start();
  $_SESSION['ID'] = $userid; // 로그인한 사용자의 아이디 값
  // 로그인 성공 시 메인 페이지로 리다이렉션 또는 필요한 동작 수행
  header("Location: main.php");
  exit;
} else {
  // 로그인 실패 시 에러 메시지 출력 또는 다른 처리 수행
  echo "
  <!DOCTYPE html>
  <html lang='ko'>
  <head>
    <meta charset='UTF-8'>
    <title>로그인 실패</title>
    <style>
      body {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        background-color: #f7f7f7;
        font-family: Arial, sans-serif;
      }
      .error-message {
        color: red;
        font-size: 2em;
        font-weight: bold;
        border: 2px solid red;
        padding: 20px;
        border-radius: 10px;
        background-color: #ffe6e6;
      }
    </style>
  </head>
  <body>
    <div class='error-message'>로그인 실패</div>
  </body>
  </html>";
}

// 데이터베이스 연결 닫기
mysqli_close($conn);
?>
