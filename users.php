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

// 사용자 정보 수정하기
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $new_username = $_POST['new_username'];
    $new_email = $_POST['new_email'];

    // 사용자 정보 업데이트 쿼리 실행
    $update_query = "UPDATE P_Users SET Username = '$new_username', Email = '$new_email' WHERE ID = '$user_id'";
    if ($conn->query($update_query) === TRUE) {
        echo "<script>alert('사용자 정보가 성공적으로 업데이트되었습니다.');</script>";
        // 페이지 새로고침하여 최신 정보를 표시
        echo "<meta http-equiv='refresh' content='0'>";
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>사용자 정보</title>
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
            max-width: 600px;
            margin: auto;
        }
        h1, h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
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
        form {
            margin-top: 20px;
        }
        input[type=text], input[type=email] {
            width: calc(100% - 16px);
            padding: 10px;
            margin: 5px 0;
            box-sizing: border-box;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        input[type=submit] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            width: 100%;
            border-radius: 4px;
            font-size: 16px;
            transition: background-color 0.3s, transform 0.3s;
        }
        input[type=submit]:hover {
            background-color: #45a049;
            transform: translateY(-3px);
        }
    </style>
</head>
<body>
    <div class="container">
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
                        echo "<td>" . htmlspecialchars($row["Username"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["Email"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["CreateDate"]) . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='3'>No user information found</td></tr>";
                }
                ?>
            </tbody>
        </table>
        
        <!-- 사용자 정보 수정 폼 -->
        <h2>사용자 정보 수정</h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <label for="new_username">새로운 이름:</label>
            <input type="text" id="new_username" name="new_username" required>
            <label for="new_email">새로운 이메일:</label>
            <input type="email" id="new_email" name="new_email" required>
            <input type="submit" value="저장">
        </form>
    </div>
</body>
</html>

<?php
// 데이터베이스 연결 닫기
$conn->close();
?>
