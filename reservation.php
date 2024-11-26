<?php
/* Appel du fichier init */
require("inc/init.inc.php");

/* panier */
if (!isset($_SESSION['panier'])) {
    $_SESSION['panier'] = array();
}

if (isset($_SESSION['utilisateurs']['id_user'])) { // Vérifie si l'utilisateur est connecté
    if (isset($_GET['id_evenement']) && !empty($_GET['id_evenement'])) {
        $id_produit = $_GET['id_evenement'];
        $produit = $pdoMysteryMaze->prepare("SELECT * FROM evenements WHERE id_evenement = :id_evenement");
        $produit->execute([':id_evenement' => $id_produit]);

        if ($produit->rowCount() == 0) {
            echo "<div class=\"alert alert-danger\">Ce produit n'existe pas !</div>";
        }

        if (isset($_SESSION['panier'][$id_produit])) {
            $_SESSION['panier'][$id_produit]++; //  produit est déjà présent dans le panier. incrémente simplement sa quantité.
        } else {
            $_SESSION['panier'][$id_produit] = 1;
        }
    }
    /* redirection vers la page panier */
    header("location:panier.php");
    exit();
} else {
    /* Si l'utilisateur n'est pas connecté, afficher un message d'erreur */
    echo "<div class=\"alert alert-danger\">Vous devez être connecté pour ajouter des produits au panier.</div>";
}

/* HEADER */
require("inc/header.inc.php");
/* fin du HEADER */
?>

<?php
/* FOOTER */
require("inc/footer.inc.php");
/* fin du FOOTER */
?>
<!-- bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

<!-- javascript -->
<script src="../assets/js/script.js"></script>
</body>

</html>