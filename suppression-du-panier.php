<?php
/* Appel du fichier init */
require("inc/init.inc.php");

/* Réception de l'id par l'URL */
if (isset($_GET['action']) && $_GET['action'] == 'suppression' && isset($_GET['id_evenement'])) {
    /* suppression de l'article */
    unset($_SESSION["panier"]);

    if (isset($_SESSION["panier"]) && $_GET['id_evenement']->rowCount() == 0) {
        /* Si ça nous renvois 0 c'est que le résultat est vide : il n'y a pas cet article avec cet id à supprimer */
        $message .= "<div class=\"alert alert-danger\">Erreur de suppression de l'article</div>";
    } else
    /* redirection vers le panier */ {
        header("location:panier.php");
        exit();
    }
}

/* HEADER */
require("inc/header.inc.php");
/* fin du HEADER */

/* Affichage du message d'erreur */
echo $message;
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