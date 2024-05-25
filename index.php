<!DOCTYPE html>
<html lang="ko">
  <head>
    <meta charset="UTF-8">
    <title> 로그인 </title>
    <style>
      * {margin: 0; padding: 0; box-sizing: border-box;}
      body {
        font-family: Arial, sans-serif;
        background-color: #f7f7f7;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
      }
      #login_box {
        width: 400px;
        padding: 20px;
        border: solid 1px #ddd;
        border-radius: 10px;
        background-color: white;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      }
      table {
        width: 100%;
        margin-bottom: 20px;
      }
      th, td {
        padding: 10px;
      }
      th {
        text-align: right;
        font-weight: normal;
        color: #333;
      }
      input[type="text"], input[type="password"] {
        width: 100%;
        padding: 10px;
        margin-top: 5px;
        border: 1px solid #ddd;
        border-radius: 5px;
      }
      .submit {
        width: 100%;
        padding: 10px;
        font-size: 16px;
        border-radius: 5px;
        border: none;
        color: #fff;
        background-color: #007bff;
        cursor: pointer;
        transition: background-color 0.3s;
      }
      .submit:hover {
        background-color: #0056b3;
      }
      a {
        color: #007bff;
        text-decoration: none;
      }
      a:hover {
        text-decoration: underline;
      }
      p {
        text-align: center;
        margin-top: 10px;
      }
    </style>
  </head>
  <body>
    <div id="login_box">
      <form name="loginForm" action="login.php" method="post">
        <table>
          <tr>
            <th>ID:</th>
            <td><input type="text" name="userid"></td>
          </tr>
          <tr>
            <th>PASSWORD:</th>
            <td><input type="password" name="userpw"></td>
          </tr>
        </table>
        <input type="submit" class="submit" value="로그인">
      </form>

    </div>
  </body>
</html>
