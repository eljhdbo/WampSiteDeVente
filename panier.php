<?php
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $action = $_POST['action'];

    if ($action == 'clear') {
        foreach ($_SESSION['cart'] as $product_id => $quantity) {
            $sql = "SELECT stock FROM produit WHERE id=$product_id";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $stock = $row['stock'];
                $new_stock = $stock + $quantity;
                $update_sql = "UPDATE produit SET stock=$new_stock WHERE id=$product_id";
                $conn->query($update_sql);
            }
        }
        $_SESSION['cart'] = array();
    }

    echo json_encode(array('status' => 'success', 'cart' => $_SESSION['cart']));
} else {
    echo json_encode(array('status' => 'error', 'message' => 'Invalid request method.'));
}

$conn->close();
?>
