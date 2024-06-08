<!DOCTYPE html>
<html lang="ko">
<head>
  <meta charset="UTF-8">
  <title>로그인</title>
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
    #login_box {
      width: 360px;
      padding: 40px;
      border-radius: 10px;
      background-color: rgba(255, 255, 255, 0.9);
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
      text-align: center;
    }
    #login_box h2 {
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
    #login_box .submit {
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
    #login_box .submit:hover {
      background-color: #0056b3;
    }
    #login_box a {
      color: #007bff;
      text-decoration: none;
      font-size: 14px;
    }
    #login_box a:hover {
      text-decoration: underline;
    }
    #login_box p {
      margin-top: 10px;
      font-size: 14px;
    }
    #login_box .register {
      margin-top: 15px;
      font-size: 14px;
    }
  </style>
</head>
<body>
  <div id="login_box">
    <h2>로그인</h2>
    <form name="loginForm" action="login.php" method="post">
      <div class="input-container">
        <i class="fas fa-user"></i>
        <input type="text" name="userid" placeholder="아이디 입력" value="jypark" required>
      </div>
      <div class="input-container">
        <i class="fas fa-lock"></i>
        <input type="password" name="userpw" placeholder="비밀번호 입력" value="jypark" required>
      </div>
      <input type="submit" class="submit" value="로그인">
    </form>
    <p class="register">계정이 없으신가요? <a href="register.php">회원가입</a></p>
  </div>
</body>
</html>
