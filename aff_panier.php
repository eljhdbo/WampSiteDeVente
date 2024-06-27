<div id="cart">
    <h2>Mon Panier</h2>
    <div class="cart-items">
        <?php
        include 'db.php';
        session_start();
        
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = array();
        }

        foreach ($_SESSION['cart'] as $product_id => $quantity) {
            $sql = "SELECT libelle, prix FROM produit WHERE id=$product_id";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                echo '<div class="cart-item">';
                echo '<p>' . $row["libelle"] . ' x ' . $quantity . '</p>';
                echo '<p>' . ($row["prix"] * $quantity) . ' €</p>';
                echo '</div>';
            }
        }

        $conn->close();
        ?>
    </div>
    <button class="clear-cart">Vider le panier</button>
</div>
