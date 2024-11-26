<?php
/* Appel du fichier init */
require("inc/init.inc.php");

/* HEADER */
require("inc/header.inc.php");
/* fin du HEADER */

/* requête de sélection pour afficher des évènements (A-Z) */
$requete = $pdoMysteryMaze->query("SELECT * FROM evenements ORDER BY date ASC");

if (isset($_GET['action']) && $_GET["action"] == "suppression" && isset($_GET["id_evenement"])) {
    /* requête de suppression des évènements par leurs id */
    $delete = $pdoMysteryMaze->prepare("DELETE FROM evenements WHERE id_evenement = :id_evenement");

    $delete->execute([
        ":id_evenement" => $_GET["id_evenement"],
    ]);

    if ($delete->rowCount() == 0) {
        /* Si ça nous renvois 0 c'est que le résultat est vide : il n'y a pas cet article avec cet id à supprimer */
        $message .= "<div class=\"alert alert-danger\">Erreur de suppression de l'évènement n°$_GET[id_evenement]</div>";
    } else /* la suppression s'éxecute */ {
        header("location:accueil.php");
        exit();
    }
}
?>

<!-- MAIN -->
<main>
    <?php echo $message ?>
    <!-- conteneur -->
    <div class="container">
        <!-- zone de réservation -->
        <section class="booking-aria p-2">
            <!-- titre -->
            <h2>Tout nos évènements</h2>
            <!-- bouton -->
            <?php if (estAdmin()) { ?>
                <a href="ajout-des-evenements.php" class="btn btn-dark mb-3">créer un nouvel évènement</a>
            <?php } ?>
            <!-- fin du bouton -->
            <!-- début de la rangée -->
            <div class="row">
                <!-- début de la boucle while -->
                <?php while ($evenement = $requete->fetch(PDO::FETCH_ASSOC)) { ?>
                    <!-- début de la colonne -->
                    <div class="col-md-3 mb-3 carte">
                        <!-- lien -->
                        <a href="voir-evenement.php?id_evenement=<?php echo $evenement["id_evenement"]; ?>" class="text-decoration-none text-dark">
                            <!-- carte -->
                            <div class="card" style="background-color: #dddddd;">
                                <!-- photo -->
                                <figure class="photo">
                                    <img src="<?php echo $evenement["photo_1"]; ?>" style="width: 100%; height: 214px; border-radius: 5px 5px 0px 0px ;" alt="...">
                                    <!-- légende -->
                                    <figcaption class="prix d-flex justify-content-center align-items-center">
                                        <!-- prix -->
                                        <strong><?php echo $evenement["prix"]; ?> €</strong>
                                    </figcaption>
                                    <!-- fin de la légende -->
                                </figure>
                                <!-- titre -->
                                <h3 style="text-transform: uppercase; text-align:center; height: 70px"><?php echo $evenement["titre"]; ?></h3>
                                <!-- bouton de suppression des évènements -->
                                <?php if (estAdmin()) { ?>
                                    <div class="btn btn-group rounded-3">
                                        <a href="maj-des-evenements.php?id_evenement=<?php echo $evenement["id_evenement"]; ?>" class="btn btn-success"><i class="bi bi-arrow-repeat"></i></a>
                                        <a href="tous-les-evenements.php?action=suppression&id_evenement=<?php echo $evenement["id_evenement"]; ?>" class="btn btn-danger" onclick="return (confirm('Étes vous sûr de vouloir supprimer cet évènement ?'))"><i class="bi bi-trash-fill"></i></a>
                                    </div>
                                <?php } ?>
                            </div>
                            <!-- fin de la carte -->
                        </a>
                        <!-- fin du lien -->
                    </div>
                    <!-- fin de la colonne -->
                <?php } ?>
                <!-- fin de la boucle while -->
            </div>
            <!-- fin de la rangée -->
        </section>
        <!-- fin de la zone de réservation -->
    </div>
    <!-- fin du conteneur -->
</main>
<!-- fin du MAIN -->

<?php
/* FOOTER */
require 'inc/footer.inc.php';
/* fin du FOOTER */
?>
<!-- bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

<!-- javascript -->
<script src="../assets/js/script.js"></script>
</body>

</html>