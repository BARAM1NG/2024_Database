<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>회원가입</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: Arial, sans-serif;
            background: url('https://images.unsplash.com/photo-1519389950473-47ba0277781c?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=MnwxMTc3M3wwfDF8c2VhcmNofDZ8fGVjb21tZXJjZXxlbnwwfHx8fDE2NTI0NDA5NzY&ixlib=rb-1.2.1&q=80&w=1080') no-repeat center center fixed;
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        #register_box {
            width: 400px;
            padding: 40px;
            border-radius: 10px;
            background-color: rgba(255, 255, 255, 0.9);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        #register_box h2 {
            margin-bottom: 20px;
            color: #333;
        }
        .input-container {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }
        .input-container i {
            margin-right: 10px;
            color: #555;
        }
        .input-container input {
            flex: 1;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            transition: border-color 0.3s;
        }
        .input-container input:focus {
            border-color: #007bff;
        }
        #register_box .submit {
            width: 100%;
            padding: 12px;
            font-size: 16px;
            border-radius: 5px;
            border: none;
            color: #fff;
            background-color: #007bff;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        #register_box .submit:hover {
            background-color: #0056b3;
        }
        #register_box a {
            color: #007bff;
            text-decoration: none;
            font-size: 14px;
        }
        #register_box a:hover {
            text-decoration: underline;
        }
        #register_box p {
            margin-top: 10px;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div id="register_box">
        <h2>회원가입</h2>
        <form name="registerForm" action="register_process.php" method="post">
            <div class="input-container">
                <i class="fas fa-user"></i>
                <input type="text" name="userid" placeholder="아이디 입력" required>
            </div>
            <div class="input-container">
                <i class="fas fa-lock"></i>
                <input type="password" name="userpw" placeholder="비밀번호 입력" required>
            </div>
            <div class="input-container">
                <i class="fas fa-lock"></i>
                <input type="password" name="userpw_confirm" placeholder="비밀번호 확인" required>
            </div>
            <div class="input-container">
                <i class="fas fa-envelope"></i>
                <input type="email" name="email" placeholder="이메일 입력" required>
            </div>
            <div class="input-container">
                <i class="fas fa-user"></i>
                <input type="text" name="name" placeholder="이름 입력" required>
            </div>
            <input type="submit" class="submit" value="회원가입">
        </form>
        <p>이미 계정이 있으신가요? <a href="index.php">로그인</a></p>
    </div>
</body>
</html>
