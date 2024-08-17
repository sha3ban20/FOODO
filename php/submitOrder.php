<?php
include_once "../php/connection.php";
$total_price = 0;
$stmt = $conn->prepare("SELECT order_items.*, menu_items.name, menu_items.photo, menu_items.price FROM order_items JOIN menu_items ON order_items.item_id = menu_items.item_id;");
$stmt->execute();
$my_cart = $stmt->fetchAll(PDO::FETCH_ASSOC);
$usr = $conn->prepare("SELECT * from customers;");
$stmt->execute();
$my_cart = $stmt->fetchAll(PDO::FETCH_ASSOC);
if(isset($_POST['delete_item'])){
    $item = $_POST['item'];
    $del = $conn->prepare("DELETE FROM `order_items` WHERE item_id=$item;");
    $del->execute();
    header('Location: ../html/order.php');
}
?>
