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

// 주문 취소 기능
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['cancel_order'])) {
    $order_id_to_cancel = $_POST['cancel_order'];

    // 주문 상세 정보 삭제 쿼리 실행
    $delete_order_details_query = "DELETE FROM P_OrderDetails WHERE OrderID = '$order_id_to_cancel'";
    if (mysqli_query($conn, $delete_order_details_query)) {
        // 주문 삭제 쿼리 실행
        $cancel_query = "DELETE FROM P_Orders WHERE OrderID = '$order_id_to_cancel'";
        if (mysqli_query($conn, $cancel_query)) {
            echo "<script>alert('주문이 성공적으로 취소되었습니다.');</script>";
            // 페이지 새로고침하여 최신 주문 내역을 표시
            echo "<meta http-equiv='refresh' content='0'>";
        } else {
            echo "주문 취소 오류: " . mysqli_error($conn);
        }
    } else {
        echo "주문 취소 오류: " . mysqli_error($conn);
    }
}


// 사용자의 주문 내역 조회
$query = "SELECT A.OrderID, C.Name, A.OrderDate, A.TotalAmount, B.Price, A.Status 
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
    .cancel-btn {
      background-color: #f44336;
      color: white;
      padding: 8px 16px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }
  </style>
</head>
<body>
  <h1>주문 내역</h1>
  <table>
    <thead>
      <tr>
        <th>주문 ID</th>
        <th>제품 이름</th>
        <th>주문 일자</th>
        <th>총 수량</th>
        <th>가격</th>
        <th>현재 상태</th>
        <th>취소</th>
      </tr>
    </thead>
    <tbody>
      <?php
      if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
          echo "<tr>";
          echo "<td>" . htmlspecialchars($row['OrderID']) . "</td>";
          echo "<td>" . htmlspecialchars($row['Name']) . "</td>";
          echo "<td>" . htmlspecialchars($row['OrderDate']) . "</td>";
          echo "<td>" . htmlspecialchars($row['TotalAmount']) . "</td>";
          echo "<td>" . htmlspecialchars($row['Price']) . "</td>";
          echo "<td>" . htmlspecialchars($row['Status']) . "</td>";
          echo "<td><form method='post' action='" . htmlspecialchars($_SERVER["PHP_SELF"]) . "'><input type='hidden' name='cancel_order' value='" . htmlspecialchars($row['OrderID']) . "'><button type='submit' class='cancel-btn'>취소</button></form></td>";
          echo "</tr>";
        }
      } else {
        echo "<tr><td colspan='7'>주문 내역이 없습니다.</td></tr>";
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
