<?php
session_start();

// 로그인된 사용자의 ID 가져오기
$user_id = $_SESSION['Email'];

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
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f2f5;
            margin: 0;
            padding: 20px;
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }
        .container {
            max-width: 900px;
            margin: auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
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
        }
        .center button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Purchase Product</h1>
        <form action="purchase_process.php" method="post">
            <table>
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Stock Quantity</th>
                        <th>Quantity</th>
                        <th>Purchase</th>
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
                <button type="submit">Purchase</button>
            </div>
        </form>
    </div>
</body>
</html>

<?php
// 데이터베이스 연결 닫기
$conn->close();
?>
