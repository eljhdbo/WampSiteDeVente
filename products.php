<?php include 'header.php'; ?>

<section id="products">
    <h2>Nos Armes</h2>
    <div class="products-container">
        <?php
        include 'db.php';
        $sql = "SELECT id, libelle, prix, stock, image FROM produit";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<div class="product-card">';
                echo '<div class="product-image">';
                echo '<img src="' . $row["image"] . '" alt="' . $row["libelle"] . '">';
                echo '</div>';
                echo '<div class="product-info">';
                echo '<h3>' . $row["libelle"] . '</h3>';
                echo '<p>Prix: ' . $row["prix"] . ' €</p>';
                echo '<p>Stock: ' . $row["stock"] . ' unités</p>';
                echo '<button class="add-to-cart" data-product-id="' . $row["id"] . '">Ajouter au Panier</button>';
                echo '</div>';
                echo '</div>';
            }
        } else {
            echo "Aucun produit disponible";
        }

        $conn->close();
        ?>
    </div>
</section>

<?php include 'footer.php'; ?>
