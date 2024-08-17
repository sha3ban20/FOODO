<?php
include_once './connection.php';

header('Content-Type: application/json');

$stmt = $conn->prepare("SELECT order_items.*, menu_items.name, menu_items.photo, menu_items.price FROM order_items JOIN menu_items ON order_items.item_id = menu_items.item_id");
$stmt->execute();
$my_cart = $stmt->fetchAll(PDO::FETCH_ASSOC);

$total_price = 0;
foreach ($my_cart as $cart) {
    $total_price += $cart['subtotal'];
}

$response = [
    'cart' => $my_cart,
    'total_price' => $total_price
];

echo json_encode($response);


