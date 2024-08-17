<?php
// Assuming $my_cart is defined somewhere.
$total_price = 0;
$cart_html = '';

foreach ($my_cart as $cart) {
    $cart_html .= '<tr>';
    $cart_html .= '<td>' . $cart['name'] . '</td>';
    $cart_html .= '<td>' . $cart['quantity'] . '</td>';
    $cart_html .= '<td>' . $cart['price'] . '<span> $</span></td>';
    $cart_html .= '</tr>';
    $total_price += ($cart['quantity'] * $cart['price']);
}

// Return data as JSON
echo json_encode([
    'cart_html' => $cart_html,
    'total_price' => $total_price
]);
