<?php
include_once "../php/connection.php";
// Assuming you have a connection established

$stmt = $conn->prepare("SELECT * FROM menu_items");
$stmt->execute();

$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>