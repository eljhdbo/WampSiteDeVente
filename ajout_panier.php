<?php
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $product_id = intval($_POST['product_id']);

    $sql = "SELECT stock FROM produit WHERE id=$product_id";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $stock = $row['stock'];

        if ($stock > 0) {
            if (!isset($_SESSION['cart'])) {
                $_SESSION['cart'] = array();
            }

            if (isset($_SESSION['cart'][$product_id])) {
                $_SESSION['cart'][$product_id]++;
            } else {
                $_SESSION['cart'][$product_id] = 1;
            }

            $new_stock = $stock - 1;
            $update_sql = "UPDATE produit SET stock=$new_stock WHERE id=$product_id";
            $conn->query($update_sql);

            $response = array(
                'status' => 'success',
                'cart' => $_SESSION['cart'],
                'stock' => array($product_id => $new_stock)
            );
        } else {
            $response = array(
                'status' => 'error',
                'message' => 'Stock insuffisant.'
            );
        }
    } else {
        $response = array(
            'status' => 'error',
            'message' => 'Produit non trouvé.'
        );
    }

    echo json_encode($response);
} else {
    echo json_encode(array('status' => 'error', 'message' => 'Invalid request method.'));
}

$conn->close();
?>
