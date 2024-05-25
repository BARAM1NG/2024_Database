<?php
session_start();

// 사용자 ID 가져오기 (로그인된 사용자의 ID라고 가정)
$user_id = $_SESSION['ID'];

// 데이터베이스 연결
$conn = mysqli_connect("localhost", "hmpark", "2023103938", "hmpark");

// 연결 오류 확인
if (mysqli_connect_errno()) {
  die('데이터베이스 연결 오류: ' . mysqli_connect_error());
}

// 사용자의 주문 내역 조회
$query = "SELECT C.Name, A.OrderDate, A.TotalAmount, B.Price, A.Status 
          FROM P_Orders AS A 
          JOIN P_OrderDetails AS B ON A.OrderID = B.OrderID 
          JOIN P_Products AS C ON B.ProductID = C.ProductID 
          JOIN P_Users AS D ON A.UserID = D.ID 
          WHERE D.ID = '$user_id'";
          
$result = mysqli_query($conn, $query);

// 결과 확인
if ($result === false) {
  die('주문 내역 조회 오류: ' . mysqli_error($conn));
}

// HTML 페이지 출력
?>
<!DOCTYPE html>
<html lang="ko">
<head>
  <meta charset="UTF-8">
  <title>주문 내역</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f7f7f7;
      margin: 0;
      padding: 20px;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
    }
    th, td {
      padding: 12px;
      border: 1px solid #ddd;
      text-align: center;
    }
    th {
      background-color: #f2f2f2;
    }
    tr:nth-child(even) {
      background-color: #f9f9f9;
    }
  </style>
</head>
<body>
  <h1>주문 내역</h1>
  <table>
    <thead>
      <tr>
        <th>주문 ID</th>
        <th>주문 일자</th>
        <th>총 수량</th>
        <th>가격</th>
        <th>현재 상태</th>
      </tr>
    </thead>
    <tbody>
      <?php
      if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
          echo "<tr>";
          echo "<td>" . htmlspecialchars($row['Name']) . "</td>";
          echo "<td>" . htmlspecialchars($row['OrderDate']) . "</td>";
          echo "<td>" . htmlspecialchars($row['TotalAmount']) . "</td>";
          echo "<td>" . htmlspecialchars($row['Price']) . "</td>";
          echo "<td>" . htmlspecialchars($row['Status']) . "</td>";
          echo "</tr>";
        }
      } else {
        echo "<tr><td colspan='4'>주문 내역이 없습니다.</td></tr>";
      }
      ?>
    </tbody>
  </table>

</body>
</html>
<?php
// 데이터베이스 연결 닫기
mysqli_close($conn);
?>