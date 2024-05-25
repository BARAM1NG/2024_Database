<?php
// 세션 시작
session_start();

// 로그인된 사용자의 ID 가져오기
$user_id = $_SESSION['ID'];

// 데이터베이스 연결
$conn = new mysqli("localhost", "hmpark", "2023103938", "hmpark");

// 데이터베이스 연결 오류 확인
if ($conn->connect_error) {
    die("데이터베이스 연결 오류: " . $conn->connect_error);
}

// 개인정보 조회 쿼리 실행 (현재 로그인된 사용자의 정보만 조회)
$query = "SELECT Username, Email, CreateDate FROM P_Users WHERE ID = '$user_id'";
$result = $conn->query($query);

?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>User Information</title>
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
    </style>
</head>
<body>
    <h1>사용자 정보</h1>
    <table>
        <thead>
            <tr>
                <th>이름</th>
                <th>Email</th>
                <th>계정 생성일</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result && $result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["Username"] . "</td>";
                    echo "<td>" . $row["Email"] . "</td>";
                    echo "<td>" . $row["CreateDate"] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4'>No user information found</td></tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>

<?php
// 데이터베이스 연결 닫기
$conn->close();
?>
