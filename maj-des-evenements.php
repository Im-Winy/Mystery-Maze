<?php
/* Appel du fichier init */
require("inc/init.inc.php");

if (!estAdmin()) {
    header("location:accueil.php");
    exit();
}

/* réception des informations de l'évènement par son id */
if (isset($_GET["id_evenement"])) {
    $requete = $pdoMysteryMaze->prepare("SELECT * FROM evenements WHERE id_evenement = :id_evenement");

    $requete->execute([
        ':id_evenement' => $_GET['id_evenement'],
    ]);
    $info = $requete->fetch(PDO::FETCH_ASSOC);
}

/* Traitement du formulaire */
if (!empty($_POST)) {
    $modif = $pdoMysteryMaze->prepare("UPDATE evenements SET titre = :titre, photo_1 = :photo_1, photo_2 = :photo_2, photo_3 = :photo_3, description = :description, date = :date, prix = :prix WHERE id_evenement = :id_evenement");
    $modif->execute([
        ":titre" => $_POST["titre"],
        ":photo_1" => $_POST["photo_1"],
        ":photo_2" => $_POST["photo_2"],
        ":photo_3" => $_POST["photo_3"],
        ":description" => $_POST["description"],
        ":date" => $_POST["date"],
        ":prix" => $_POST["prix"],
        ":id_evenement" => $_GET["id_evenement"],
    ]);
    header("location:accueil.php");
    exit();
}
/* HEADER */
require("inc/header.inc.php");
/* fin du HEADER */
?>

<!-- MAIN -->
<main>
    <!-- conteneur -->
    <div class="container">
        <!-- zone de réservation -->
        <section class="pay-aria">

            <!-- titre -->
            <h2>Mis-à-jour de l'évènement</h2>

            <form action="#" method="post">
                <?php echo $message ?>

                <div class="mb-3">
                    <input type="text" name="titre" id="titre" value="<?php echo $info["titre"]; ?>" class="form-control">
                </div>

                <div class="mb-3">
                    <input type="text" name="photo_1" id="photo_1" value="<?php echo $info["photo_1"] ?>" class="form-control">
                </div>

                <div class="mb-3">
                    <input type="text" name="photo_2" id="photo_2" value="<?php echo $info["photo_2"] ?>" class="form-control">
                </div>

                <div class="mb-3">
                    <input type="text" name="photo_3" id="photo_3" value="<?php echo $info["photo_3"] ?>" class="form-control">
                </div>

                <div class="mb-3">
                    <textarea name="description" id="description" cols="30" rows="10" class="form-control"><?php echo $info["description"] ?></textarea>
                </div>

                <div class="mb-3">
                    <input type="date" name="date" id="date" value="<?php echo $info["date"] ?>" class="form-control">
                </div>

                <div class="mb-3">
                    <input type="number" name="prix" id="prix" value="<?php echo $info["prix"] ?>" class="form-control">
                </div>

                <div class="mb-3">
                    <input type="submit" value="mettre à jour" class="btn btn-dark">
                </div>

            </form>

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