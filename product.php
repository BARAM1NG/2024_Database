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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background: url('https://images.unsplash.com/photo-1563013544-824ae1b704d3?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&q=80&w=1080') no-repeat center center fixed; /* 전자상거래 느낌의 배경 이미지 */
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
            padding: 15px;
            background-color: #007bff;
            color: white;
            text-align: center;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            font-size: 16px;
            transition: background-color 0.3s, transform 0.3s;
        }
        .purchase-btn:hover {
            background-color: #0056b3;
            transform: translateY(-5px);
        }
        .popup-img {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            z-index: 9999;
            justify-content: center;
            align-items: center;
        }
        .popup-img img {
            max-width: 100%; /* 이미지의 최대 너비를 부모 요소의 너비에 맞춤 */
            max-height: 100%; /* 이미지의 최대 높이를 부모 요소의 높이에 맞춤 */
            width: auto; /* 가로 길이를 자동으로 조정하여 원래 가로 세로 비율 유지 */
            height: auto; /* 세로 길이를 자동으로 조정하여 원래 가로 세로 비율 유지 */
            border-radius: 5px;
        }
        .close-btn-img {
            position: absolute;
            top: 50%;
            right: 20px;
            transform: translateY(-50%);
            color: #fff;
            font-size: 24px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>제품 목록</h1>
        <table>
            <thead>
                <tr>
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
                        echo "<td><a href='#' class='product-link' data-img='product_image/{$row["Name"]}.jpg'>" . $row["Name"] . "</a></td>";
                        echo "<td>" . $row["Description"] . "</td>";
                        echo "<td>$" . number_format($row["Price"], 2) . "</td>"; // 가격을 소수점 2자리까지 표시
                        echo "<td>" . $row["StockQuantity"] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>No products found</td></tr>";
                }
                ?>
            </tbody>
        </table>
        <a href="purchase.php" class="purchase-btn">구매하기</a>
    </div>

    <div class="popup-img" id="popup">
        <img src="" alt="제품 사진" id="popup-img">
        <span class="close-btn-img" onclick="closePopup()">&times;</span>
    </div>

    <script>
        // 팝업 열기
        document.querySelectorAll('.product-link').forEach(item => {
            item.addEventListener('click', event => {
                event.preventDefault();
                const imgSrc = item.getAttribute('data-img');
                document.getElementById('popup-img').src = imgSrc;
                document.getElementById('popup').style.display = 'flex';
            });
        });

        // 팝업 닫기
        function closePopup() {
            document.getElementById('popup').style.display = 'none';
        }
    </script>
</body>
</html>

<?php
// 데이터베이스 연결 닫기
$conn->close();
?>
