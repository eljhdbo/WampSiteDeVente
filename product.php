<?php include 'header.php'; ?>

<section id="product-details">
    <?php
    include 'db.php';

    $id = $_GET['id'];
    $sql = "SELECT libelle, prix, stock, image FROM produit WHERE id=$id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo '<h2>' . $row["libelle"] . '</h2>';
        echo '<img src="' . $row["image"] . '" alt="' . $row["libelle"] . '">';
        echo '<p>Prix: ' . $row["prix"] . ' €</p>';
        echo '<p>Stock: ' . $row["stock"] . ' unités</p>';
        echo '<button class="add-to-cart" data-product-id="' . $row["id"] . '">Ajouter au Panier</button>';
    } else {
        echo "Produit non trouvé";
    }

    $conn->close();
    ?>
</section>

<?php include 'footer.php'; ?>
