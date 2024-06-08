<?php
session_start();

// 로그인된 사용자의 ID 가져오기
$user_id = $_SESSION['ID'];

// 데이터베이스 연결
$conn = new mysqli("localhost", "hmpark", "2023103938", "hmpark");

// 데이터베이스 연결 오류 확인
if ($conn->connect_error) {
    die("데이터베이스 연결 오류: " . $conn->connect_error);
}

// 제품 목록 조회
$query = "SELECT ProductID, Name, Price, StockQuantity FROM P_Products";
$result = $conn->query($query);
?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>Product Purchase</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background: url('https://images.unsplash.com/photo-1519389950473-47ba0277781c?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&q=80&w=1080') no-repeat center center fixed; /* 전자상거래 느낌의 배경 이미지 */
            background-size: cover;
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
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
            background-color: #007bff;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        td input[type='number'] {
            width: 60px;
            padding: 5px;
            border: 1px solid #ddd;
            border-radius: 4px;
            text-align: center;
        }
        td input[type='checkbox'] {
            transform: scale(1.2);
        }
        .center {
            text-align: center;
            margin-top: 20px;
        }
        .center button {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s, transform 0.3s;
        }
        .center button:hover {
            background-color: #0056b3;
            transform: translateY(-3px);
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>제품 구매</h1>
        <form action="purchase_process.php" method="post">
            <table>
                <thead>
                    <tr>
                        <th>제품 명</th>
                        <th>제품 가격</th>
                        <th>남은 수량</th>
                        <th>구매 수량</th>
                        <th>구매 확인</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result && $result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($row["Name"]) . "</td>";
                            echo "<td>$" . number_format($row["Price"], 2) . "</td>";
                            echo "<td>" . htmlspecialchars($row["StockQuantity"]) . "</td>";
                            echo "<td><input type='number' name='quantity[" . $row["ProductID"] . "]' min='1' max='" . $row["StockQuantity"] . "' value='1'></td>";
                            echo "<td><input type='checkbox' name='products[]' value='" . $row["ProductID"] . "'></td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5'>No products found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
            <div class="center">
                <button type="submit">구매하기</button>
            </div>
        </form>
    </div>
</body>
</html>

<?php
// 데이터베이스 연결 닫기
$conn->close();
?>
