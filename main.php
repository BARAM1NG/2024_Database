<!DOCTYPE html>
<html lang="ko">
<head>
  <meta charset="UTF-8">
  <title>전자상거래 메인 페이지</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      background-color: #f7f7f7;
      margin: 0;
    }
    .container {
      text-align: center;
    }
    .button {
      display: inline-block;
      padding: 15px 25px;
      margin: 10px;
      font-size: 16px;
      font-weight: bold;
      color: #fff;
      background-color: #007bff;
      border: none;
      border-radius: 5px;
      text-decoration: none;
      transition: background-color 0.3s;
    }
    .button:hover {
      background-color: #0056b3;
    }



  .container-wrapper {
    display: flex;
    flex-direction: column; /* 이미지와 div를 세로로 배치합니다. */
    align-items: center; /* 가운데 정렬합니다. */
  }

  .container {
    margin-top: 20px; /* 이미지와 div 사이의 간격 조절 */
  }

  </style>
  
</head>

  
  
  
<body>



<div class="container-wrapper">
  <img src="ecommerce-logo.png">
  <div class="container">
    <h1>전자상거래 사이트</h1>
    <a href="orders.php" class="button">주문내역</a>
    <a href="product.php" class="button">제품 살펴보기</a>
    <a href="users.php" class="button">개인정보</a>
  </div>
  </div>
</body>
</html>
