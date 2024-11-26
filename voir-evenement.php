<?php
/* Appel du fichier init */
require("inc/init.inc.php");

/* réception des informations de l'évènement par son id */
if (isset($_GET["id_evenement"]) && !isset($_SESSION["utilisateurs"]["id_user"])) {

    $requete = $pdoMysteryMaze->prepare("SELECT * FROM evenements WHERE id_evenement = :id_evenement");
    $requete->execute([
        ':id_evenement' => $_GET['id_evenement'],
    ]);

    if ($requete->rowCount() == 0) {
        header("location:accueil.php");
        exit();
    }
} elseif (isset($_GET["id_evenement"]) && isset($_SESSION["utilisateurs"]["id_user"])) {
    $requete = $pdoMysteryMaze->prepare("SELECT * FROM evenements, utilisateurs WHERE evenements.id_user = utilisateurs.id_user AND id_evenement = :id_evenement");
    $requete->execute([
        ':id_evenement' => $_GET['id_evenement'],
    ]);
    if ($requete->rowCount() == 0) {
        header("location:accueil.php");
        exit();
    }
} else { /* si pas d'id_evenement dans l'url */
    /* redirection vers la page d'accueil */
    header("location:accueil.php");
    exit();
}

/* Si vous êtes connectés */
/* Traitement du formulaire */
if (!empty($_POST["Ajouter"]) && isset($_SESSION["utilisateurs"]["id_user"])) {
    /* Si le champ commentaire est pas vide */
    if (empty($_POST["commentaire"])) {
        /* le message d'erreur s'éxecute */
        $message .= "<p class=\"alert alert-danger\">Votre commentaire est vide !</p>";
    } else {/* Si le champ commentaire est pas remplis */
        /* requête d'insertion des informations du formulaire dans la BDD*/
        $insert = $pdoMysteryMaze->prepare("INSERT INTO commentaires (commentaire, id_evenement, id_user, date) VALUES (:commentaire, :id_evenement, :id_user, NOW())");
        $insert->execute([
            ":commentaire" => $_POST["commentaire"],
            ":id_evenement" => $_GET["id_evenement"],
            ":id_user" => $_SESSION["utilisateurs"]["id_user"],
        ]);
    }
} else if (!isset($_SESSION["utilisateurs"]["id_user"])) {/* Si vous n'êtes pas connectés */
    /* le message d'erreurs s'affiche */
    $message .= "<p class=\"bg-emphasis\">Vous devez être connecté pour commenter !</p>";
}

/* requête de sélection pour afficher les commentaires */
$affichageCom = $pdoMysteryMaze->prepare("SELECT * FROM commentaires, utilisateurs WHERE commentaires.id_evenement = :id_evenement AND commentaires.id_user = utilisateurs.id_user");
$affichageCom->execute([
    ':id_evenement' => $_GET['id_evenement'],
]);

/* HEADER */
require("inc/header.inc.php");
/* fin du HEADER */
?>

<!-- MAIN -->
<main>
    <!-- conteneur -->
    <div class="container">
        <!-- zone de réservation -->
        <section class="booking-aria">

            <!-- début de la boucle while -->
            <?php while ($evenement = $requete->fetch(PDO::FETCH_ASSOC)) { ?>

                <h2><?php echo $evenement['titre']; ?></h2>

                <!-- début de la carte -->
                <div class="d-flex row col-12 m-auto pt-3 text-dark" style="background-color: #dddddd;">
                    <!--  -->
                    <div class="col-md-6 col-12">
                        <div id="carouselExample" class="carousel slide">
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <figure class="mb-0">
                                        <!-- 1ère photo -->
                                        <img src="<?php echo $evenement["photo_1"]; ?>" class="d-block w-100" alt="...">
                                    </figure>
                                </div>
                                <div class="carousel-item">
                                    <figure class="mb-0">
                                        <!-- 2ème photo -->
                                        <img src="<?php echo $evenement["photo_2"]; ?>" class="d-block w-100" alt="...">
                                    </figure>
                                </div>
                                <div class="carousel-item">
                                    <figure class="mb-0">
                                        <!-- 3ème photo -->
                                        <img src="<?php echo $evenement["photo_3"]; ?>" class="d-block w-100" alt="...">
                                    </figure>
                                </div>
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    </div>

                    <div class="col-md-6 col-12 p-auto">
                        <!-- titre -->
                        <h3 class="text-center mb-3 text-uppercase"><?php echo $evenement["titre"]; ?></h3>
                        <hr>
                        <div class="fiche-produit">
                            <div class="w-50">
                                <!-- prix -->
                                <p><span class="fw-bold text-uppercase">prix : </span><?php echo $evenement["prix"]; ?> €</p>
                                <!-- thème -->
                                <p><span class="fw-bold text-uppercase">thème : </span><?php echo $evenement["theme"]; ?></p>
                                <!-- difficulté -->
                                <?php if ($evenement["difficulte"] == 1) {
                                    echo "<div class=\"d-flex align-items-center mb-3\">
                                    <p class=\"fw-bold text-uppercase m-0\">difficulté :</p>
                                    <div class=\"mx-2\">
                                    <i class=\"bi bi-star-fill text-warning\"></i>
                                    </div>
                                    </div>";
                                } elseif ($evenement["difficulte"] == 2) {
                                    echo "<div class=\"d-flex align-items-center mb-3\">
                                    <p class=\"fw-bold text-uppercase m-0\">difficulté :</p>
                                    <div class=\"mx-2\">
                                    <i class=\"bi bi-star-fill text-warning\"></i>
                                    <i class=\"bi bi-star-fill text-warning\"></i>
                                    </div>
                                    </div>";
                                } elseif ($evenement["difficulte"] == 3) {
                                    echo "<div class=\"d-flex align-items-center mb-3\">
                                    <p class=\"fw-bold text-uppercase m-0\">difficulté :</p>
                                    <div class=\"mx-2\">
                                    <i class=\"bi bi-star-fill text-warning\"></i>
                                    <i class=\"bi bi-star-fill text-warning\"></i>
                                    <i class=\"bi bi-star-fill text-warning\"></i>
                                    </div>
                                    </div>";
                                } elseif ($evenement["difficulte"] == 4) {
                                    echo "<div class=\"d-flex align-items-center mb-3\">
                                    <p class=\"fw-bold text-uppercase m-0\">difficulté :</p>
                                    <div class=\"mx-2\">
                                    <i class=\"bi bi-star-fill text-warning\"></i>
                                    <i class=\"bi bi-star-fill text-warning\"></i>
                                    <i class=\"bi bi-star-fill text-warning\"></i>
                                    <i class=\"bi bi-star-fill text-warning\"></i>
                                    </div>
                                    </div>";
                                } elseif ($evenement["difficulte"] == 5) {
                                    echo "<div class=\"d-flex align-items-center mb-3\">
                                    <p class=\"fw-bold text-uppercase m-0\">difficulté :</p>
                                    <div class=\"mx-2\">
                                    <i class=\"bi bi-star-fill text-warning\"></i>
                                    <i class=\"bi bi-star-fill text-warning\"></i>
                                    <i class=\"bi bi-star-fill text-warning\"></i>
                                    <i class=\"bi bi-star-fill text-warning\"></i>
                                    <i class=\"bi bi-star-fill text-warning\"></i>
                                    </div>
                                    </div>";
                                } ?>
                                <!-- capacité -->
                                <p><span class="fw-bold text-uppercase">capacité : </span><?php echo $evenement["capacite"]; ?></p>
                                <!-- durée -->
                                <p><span class="fw-bold text-uppercase">durée : </span><?php echo $evenement["duree"]; ?> </p>
                                <!-- date -->
                                <p><span class="fw-bold text-uppercase">date : </span><?php echo $evenement["date"]; ?> </p>
                                <?php if ($evenement["disponibilite"] == 0) {
                                    echo "<div class=\"d-flex align-items-center mb-3\">
                                    <p class=\"fw-bold text-uppercase m-0\">disponibilité :</p>
                                    <div class=\"mx-2\">
                                    <i class=\"bi bi-check-circle-fill text-success\"></i>
                                    </div>
                                    </div>";
                                } else {
                                    echo "<div class=\"d-flex align-items-center mb-3\">
                                    <p class=\"fw-bold text-uppercase m-0\">disponibilité :</p>
                                    <div class=\"mx-2\">
                                    <i class=\"bi bi-x-circle-fill text-danger\"></i>
                                    </div>
                                    </div>";
                                } ?>
                                <!-- bouton de réservation -->
                                <a href="reservation.php?id_evenement=<?php echo $evenement["id_evenement"]; ?>" class="btn btn-dark"><i class="bi bi-bookmark-fill pe-2"></i> réserver</a>
                            </div>


                            <div class="w-50">
                                <!-- description -->
                                <p><?php echo $evenement["description"]; ?></p>
                            </div>
                        </div>
                    </div>

                    <div class="w-100 p-2">
                        <hr>
                        <!-- formulaire -->
                        <form action="#" method="post">
                            <?php echo $message ?>
                            <div class="mb-3">
                                <textarea name="commentaire" id="commentaire" cols="30" rows="5" class="form-control"></textarea>
                            </div>
                            <div class="mb-3">
                                <input type="submit" value="Ajouter un commentaire" name="Ajouter" class="btn btn-dark">
                            </div>
                        </form>
                        <!-- fin du formulaire -->
                    </div>

                </div>
                <hr>
                <!-- commentaires -->
                <div class="commentaire">
                    <?php
                    /* Si la variable renvoie 0 c'est qu'il n'y a aucun commentaire */
                    if ($affichageCom->rowCount() == 0) {
                        /* le message s'affiche */
                        echo "<div class=\"alert alert-secondary\">Il n'y a pas encore de commentaire</div>";
                    } else {/* Si la variable renvoie 1 c'est qu'il y a des commentaires */
                        /* boucle while */
                        while ($affichage = $affichageCom->fetch(PDO::FETCH_ASSOC)) {
                            echo "<div class=\"bg-dark text-light p-2 my-2\">
                                    <h4>Publié par $affichage[pseudo] le $affichage[date]</h4>
                                    <p>$affichage[commentaire]</p>
                                </div>";
                        }
                        /* fin de la boucle while */
                    }
                    ?>
                </div>
                <!-- fin des commentaires -->
                <!-- fin de la carte -->
            <?php } ?>
            <!-- fin de la boucle while -->
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