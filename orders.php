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
$query = "SELECT A.OrderID, C.Name, A.OrderDate, B.Quantity, B.Price, A.Status 
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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <style>
    body {
      font-family: Arial, sans-serif;
      background: url('https://images.unsplash.com/photo-1498050108023-c5249f4df085?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=MnwxMTc3M3wwfDF8c2VhcmNofDJ8fHRlY2h8ZW58MHx8fHwxNjUyNDQwOTc2&ixlib=rb-1.2.1&q=80&w=1080') no-repeat center center fixed; /* 테크 느낌의 배경 이미지 */
      background-size: cover;
      margin: 0;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      padding: 20px;
    }
    .container {
      background-color: rgba(255, 255, 255, 0.9);
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
      width: 80%;
      max-width: 1200px;
      margin: auto;
    }
    h1 {
      text-align: center;
      color: #333;
      margin-bottom: 20px;
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
      transition: background-color 0.3s;
    }
    .cancel-btn:hover {
      background-color: #d32f2f;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>주문 내역</h1>
    <table>
      <thead>
        <tr>
          <th>주문 ID</th>
          <th>제품 이름</th>
          <th>주문 일자</th>
          <th>주문 수량</th>
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
            echo "<td>" . htmlspecialchars($row['Quantity']) . "</td>";
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
  </div>
</body>
</html>
<?php
// 데이터베이스 연결 닫기
mysqli_close($conn);
?>
