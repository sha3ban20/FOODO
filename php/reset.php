<?php
include_once "../php/connection.php";
if (isset($_POST['confirm'])) {
    $del = $conn->prepare("DELETE FROM `order_items`;");
    $del->execute();
    header('Location: ../html/order.php');
}else if(isset($_POST['discard'])){
    $del = $conn->prepare("DELETE FROM `order_items`;");
    $del->execute();
    header('Location: ../html/order.php');
}
