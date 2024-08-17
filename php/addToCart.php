<?php
include_once 'connection.php';

// Check if the form is submitted
if (isset($_POST['add_to_cart'])) {
    // Retrieve data from the form
    $item = $_POST['item'];
    $quantity = $_POST['quantity'];

    $stmt = $conn->prepare("SELECT * FROM menu_items WHERE item_id=$item");
    $stmt->execute();
    $it_price = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $pri;
    foreach($it_price as $price){
        $pri=$price['price'];
    }

    // Perform the database insertion
    $sql = "INSERT INTO order_items (item_id, quantity, subtotal) VALUES ('$item', $quantity,$quantity*$pri)";
    $result = $conn->query($sql);

    if ($result) {
        echo 'Item added to cart successfully';
        header('Location: ../html/order.php');
    } else {
        echo 'Error adding item to cart';
    }
} else if(isset($_POST['submit_order'])){
    echo "submited";
}

// Close the database connection.
// $conn->close();

?>
