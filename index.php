<?php include 'header.php'; ?>
<?php include 'aff_panier.php'; ?>

<section id="home" class="section">
    <h2>BIENVENUE CHEZ TITANE DEFENSE</h2>
    <p>Bienvenue chez Titane Défense, votre destination ultime pour les armes de poing d'exception. Que vous soyez passionné par les répliques de films cultes ou à la recherche d'armes de poing d'une qualité inégalée, notre collection saura combler vos attentes. Découvrez des pièces uniques, alliant précision et élégance, pour les collectionneurs et les amateurs éclairés. Plongez dans l'univers fascinant des armes de poing, où chaque modèle raconte une histoire.</p>
</section>

<section id="products" class="section">
    <h2>Nos Armes</h2>
    <div class="products-container">
        <?php
        include 'db.php';
        $sql = "SELECT id, libelle, prix, stock, image FROM produit WHERE event_end_date IS NULL LIMIT 6";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<div class="product-card" id="product-' . $row["id"] . '">';
                echo '<div class="product-image">';
                echo '<img src="' . $row["image"] . '" alt="' . $row["libelle"] . '">';
                echo '</div>';
                echo '<div class="product-info">';
                echo '<h3>' . $row["libelle"] . '</h3>';
                echo '<p>Prix: ' . $row["prix"] . ' €</p>';
                echo '<p>Stock: ' . $row["stock"] . ' unités</p>';
                echo '<button class="add-to-cart" data-product-id="' . $row["id"] . '" ' . ($row["stock"] <= 0 ? 'disabled' : '') . '>Ajouter au Panier</button>';
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

<section id="event-weapons" class="section">
    <h2>Armes d'événements spéciaux</h2>
    <div class="event-weapons-container">
        <?php
        include 'db.php';
        $sql = "SELECT id, libelle, prix, stock, image, event_end_date FROM produit WHERE event_end_date IS NOT NULL";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $event_end_date = new DateTime($row['event_end_date']);
                $current_date = new DateTime();
                $interval = $current_date->diff($event_end_date);
                $days_left = 30 - $interval->days;

                if ($days_left <= 0) {
                    // Réinitialisation du timer de l'évènement
                    $new_event_end_date = $current_date->add(new DateInterval('P30D'));
                    $reset_sql = "UPDATE produit SET event_end_date = '" . $new_event_end_date->format('Y-m-d H:i:s') . "' WHERE id = " . $row['id'];
                    $conn->query($reset_sql);
                    $days_left = 30;
                }

                $event_end_timestamp = $event_end_date->getTimestamp();
                $current_timestamp = $current_date->getTimestamp();
                $seconds_left = ($event_end_timestamp + (30 * 24 * 60 * 60)) - $current_timestamp;

                echo '<div class="event-weapon-card">';
                echo '<div class="event-weapon-image">';
                echo '<img src="' . $row["image"] . '" alt="' . $row["libelle"] . '">';
                echo '</div>';
                echo '<div class="event-weapon-info">';
                echo '<h3>' . $row["libelle"] . '</h3>';
                echo '<p>Prix: ' . $row["prix"] . ' €</p>';
                echo '<p class="unavailable">Évènement terminé - De retour dans <span id="timer-' . $row["id"] . '"></span></p>';
                echo '</div>';
                echo '</div>';

                echo '<script>
                function updateTimer(id, secondsLeft) {
                    var timerElement = document.getElementById("timer-" + id);
                    var days = Math.floor(secondsLeft / (60 * 60 * 24));
                    var hours = Math.floor((secondsLeft % (60 * 60 * 24)) / (60 * 60));
                    var minutes = Math.floor((secondsLeft % (60 * 60)) / 60);
                    var seconds = Math.floor(secondsLeft % 60);

                    timerElement.innerHTML = days + " jours " + hours + " heures " + minutes + " minutes " + seconds + " secondes";

                    if (secondsLeft > 0) {
                        setTimeout(function() {
                            updateTimer(id, secondsLeft - 1);
                        }, 1000);
                    }
                }

                document.addEventListener("DOMContentLoaded", function() {
                    updateTimer(' . $row["id"] . ', ' . $seconds_left . ');
                });
                </script>';
            }
        } else {
            echo "Aucune arme d'évènement disponible";
        }
        $conn->close();
        ?>
    </div>
</section>

<section id="about" class="section">
    <h2>À propos de nous</h2>
    <p>Chez Titane Défense, nous croyons que chaque arme de poing a une histoire à raconter. Depuis notre création, nous nous sommes engagés à offrir à nos clients des produits d'exception, qui allient à la fois performance, esthétisme et authenticité.

Notre passion pour les armes de poing nous pousse à rechercher et sélectionner les meilleurs modèles, qu'il s'agisse de répliques fidèles d'armes légendaires de la pop culture ou d'armes de poing contemporaines de haute qualité. Nous travaillons avec les fabricants les plus réputés pour garantir que chaque pièce de notre collection répond aux standards les plus élevés.

Titane Défense n'est pas seulement un magasin, c'est une expérience. Nous nous adressons aux collectionneurs avertis, aux passionnés de cinéma et aux amateurs éclairés qui cherchent à posséder des pièces uniques. Chaque arme que nous proposons est minutieusement choisie pour sa précision, sa fiabilité et son design élégant.

Notre équipe d'experts est toujours prête à partager sa connaissance approfondie et à vous guider dans votre choix. Nous sommes fiers de créer une communauté de passionnés qui partagent notre amour pour les armes de poing d'exception.

Nous vous invitons à explorer notre collection et à plonger dans l'univers fascinant des armes de poing, où chaque modèle raconte une histoire unique et captivante. Chez Titane Défense, la qualité et l'élégance sont à portée de main.
</p>
</section>

<section id="contact" class="section">
    <h2>Contactez-nous</h2>
    <form action="contact.php" method="post">
        <label for="name">Nom:</label>
        <input type="text" id="name" name="name" required>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        <label for="message">Message:</label>
        <textarea id="message" name="message" required></textarea>
        <button type="submit">Envoyer</button>
    </form>
</section>

<?php include 'footer.php'; ?>
