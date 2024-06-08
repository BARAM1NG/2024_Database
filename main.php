<!DOCTYPE html>
<html lang="ko">
<head>
  <meta charset="UTF-8">
  <title>전자상거래 메인 페이지</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <style>
    body {
      font-family: Arial, sans-serif;
      background: url('https://images.unsplash.com/photo-1519389950473-47ba0277781c?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=MnwxMTc3M3wwfDF8c2VhcmNofDZ8fGVjb21tZXJjZXxlbnwwfHx8fDE2NTI0NDA5NzY&ixlib=rb-1.2.1&q=80&w=1080') no-repeat center center fixed; /* 세련된 전자상거래 배경 이미지 */
      background-size: cover;
      margin: 0;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }
    .container-wrapper {
      background-color: rgba(255, 255, 255, 0.9);
      border-radius: 10px;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
      padding: 40px;
      text-align: center;
      width: 80%;
      max-width: 600px;
    }
    .container-wrapper img {
      width: 150px;
      margin-bottom: 20px;
    }
    .container h1 {
      font-size: 2.5em;
      color: #333;
      margin-bottom: 20px;
    }
    .buttons {
      display: flex;
      justify-content: space-around;
      margin-top: 20px;
    }
    .button {
      display: inline-block;
      padding: 15px 30px;
      margin: 10px;
      font-size: 16px;
      font-weight: bold;
      color: #fff;
      background-color: #007bff;
      border: none;
      border-radius: 5px;
      text-decoration: none;
      transition: background-color 0.3s, transform 0.3s;
      display: flex;
      align-items: center;
      justify-content: center;
    }
    .button i {
      margin-right: 10px;
    }
    .button:hover {
      background-color: #0056b3;
      transform: translateY(-5px);
    }
    .search-bar {
      display: flex;
      flex-direction: column;
      align-items: center;
      margin-bottom: 20px;
    }
    .search-bar input[type="text"] {
      width: 70%;
      padding: 10px;
      border-radius: 5px;
      border: 1px solid #ddd;
      margin-bottom: 10px;
    }
    .search-bar button {
      padding: 10px 20px;
      border-radius: 5px;
      border: none;
      background-color: #007bff;
      color: #fff;
      font-size: 16px;
      cursor: pointer;
      transition: background-color 0.3s, transform 0.3s;
    }
    .search-bar button:hover {
      background-color: #0056b3;
      transform: translateY(-3px);
    }
  </style>
</head>
<body>
  <div class="container-wrapper">
    <img src="ecommerce-logo.png" alt="전자상거래 로고">
    <div class="container">
      <h1>전자상거래 사이트</h1>
      <div class="search-bar">
        <form action="search.php" method="get">
          <input type="text" name="query" placeholder="상품 검색">
          <button type="submit"><i class="fas fa-search"></i> 검색</button>
        </form>
      </div>
      <div class="buttons">
        <a href="orders.php" class="button"><i class="fas fa-box"></i> 주문내역</a>
        <a href="product.php" class="button"><i class="fas fa-shopping-bag"></i> 제품 살펴보기</a>
        <a href="users.php" class="button"><i class="fas fa-user"></i> 개인정보</a>
      </div>
    </div>
  </div>
</body>
</html>
