<?php
session_start();

// 사용자 ID 가져오기 (로그인된 사용자의 ID라고 가정)
$user_id = $_SESSION['ID'];

// 데이터베이스 연결
$conn = new mysqli("localhost", "hmpark", "2023103938", "hmpark");

// 데이터베이스 연결 오류 확인
if ($conn->connect_error) {
    die("데이터베이스 연결 오류: " . $conn->connect_error);
}

// 한글 인코딩 설정
header('Content-Type: text/html; charset=UTF-8');

// POST 데이터 검증
if (isset($_POST['products']) && isset($_POST['quantity'])) {
    $products = $_POST['products'];
    $quantities = $_POST['quantity'];
    
    // 새로운 주문 추가
    $total_amount = 0;
    
    // 각 제품의 가격을 가져와서 총 금액 계산
    foreach ($products as $product_id) {
        $query = "SELECT Price FROM P_Products WHERE ProductID = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $product_id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            $product = $result->fetch_assoc();
            $price = $product['Price'];
            $quantity = $quantities[$product_id];
            $total_amount += $price * $quantity;
        }
    }
    
    // P_Orders 테이블에 새로운 주문 추가
    $order_query = "INSERT INTO P_Orders (UserID, OrderDate, TotalAmount, Status) VALUES (?, NOW(), ?, 'Pending')";
    $order_stmt = $conn->prepare($order_query);
    $order_stmt->bind_param("id", $user_id, $total_amount);
    $order_stmt->execute();
    
    // 새로 추가된 주문 ID 가져오기
    $order_id = $order_stmt->insert_id;
    
    // P_OrderDetails 테이블에 주문 세부사항 추가
    foreach ($products as $product_id) {
        $query = "SELECT Price FROM P_Products WHERE ProductID = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $product_id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            $product = $result->fetch_assoc();
            $price = $product['Price'];
            $quantity = $quantities[$product_id];
            
            $order_details_query = "INSERT INTO P_OrderDetails (OrderID, ProductID, Price, Quantity) VALUES (?, ?, ?, ?)";
            $order_details_stmt = $conn->prepare($order_details_query);
            $order_details_stmt->bind_param("iidi", $order_id, $product_id, $price, $quantity);
            $order_details_stmt->execute();
        }
    }

    echo "주문이 완료되었습니다!";
} else {
    echo "선택된 제품이 없거나 수량이 잘못되었습니다.";
}

// 데이터베이스 연결 닫기
$conn->close();
?>
