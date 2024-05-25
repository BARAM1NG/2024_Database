<?php
session_start(); // 세션 시작

// 데이터베이스 연결
$conn = new mysqli("localhost", "hmpark", "2023103938", "hmpark");

// 데이터베이스 연결 오류 확인
if ($conn->connect_error) {
    die("데이터베이스 연결 오류: " . $conn->connect_error);
}

// 제품 목록을 가져오는 쿼리 실행
$query = "SELECT * FROM P_Products";
$result = $conn->query($query);
?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>제품 목록</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            border: 2px solid #ddd;
            background-color: #fff;
            margin-bottom: 20px; /* 테이블 아래에 간격 추가 */
        }
        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tr:hover {
            background-color: #f2f2f2;
        }
        .purchase-btn {
            display: block;
            width: 200px;
            margin: 20px auto;
            padding: 10px;
            background-color: #007bff;
            color: white;
            text-align: center;
            border: none;
            border-radius: 4px;
            text-decoration: none;
            font-size: 16px;
        }
        .purchase-btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h1>제품 목록</h1>
    <form action="purchase.php" method="post">
        <table>
            <thead>
                <tr>
                    <th>선택</th>
                    <th>제품 명</th>
                    <th>제품 설명</th>
                    <th>가격</th>
                    <th>재고 수량</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result && $result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td><input type='radio' name='product_id' value='" . $row["ProductID"] . "'></td>";
                        echo "<td>" . $row["Name"] . "</td>";
                        echo "<td>" . $row["Description"] . "</td>";
                        echo "<td>$" . number_format($row["Price"], 2) . "</td>"; // 가격을 소수점 2자리까지 표시
                        echo "<td>" . $row["StockQuantity"] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>No products found</td></tr>";
                }
                ?>
            </tbody>
        </table>
        <button type="submit" class="purchase-btn">구매하기</button>
    </form>
</body>
</html>

<?php
// 데이터베이스 연결 닫기
$conn->close();
?>
