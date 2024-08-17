<?php
include_once './connection.php';

header('Content-Type: application/json');

$stmt = $conn->prepare("SELECT * FROM menu_items");
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($result);
