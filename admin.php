<?php
/* Appel du fichier init */
require("inc/init.inc.php");

/* requête de sélection pour récupérer les informations des utilisateurs */
$requete = $pdoMysteryMaze->query("SELECT * FROM utilisateurs");

/* requête de sélection pour récupérer les informations des évènements */
$fiche = $pdoMysteryMaze->query("SELECT * FROM evenements");

/* requête de sélection pour récupérer les commentaires */
$affichageCom = $pdoMysteryMaze->query("SELECT * FROM commentaires, utilisateurs, evenements WHERE commentaires.id_user = utilisateurs.id_user AND commentaires.id_evenement = evenements.id_evenement");

/* Si je ne suis pas administrateur */
if (!estAdmin()) {
    /* redirection vers la page accueil */
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

        <!-- début de la section -->
        <section class="p-2">

            <!-- titre -->
            <h2>Tout les utilisateurs</h2>

            <div class="row">
                <?php while ($infoUser = $requete->fetch(PDO::FETCH_ASSOC)) { ?>
                    <div class="col-md-3 mb-3">
                        <div class="card p-3" style="background-color:  #dddddd;">
                            <a href="profil.php?id_user=<?php echo $infoUser["id_user"] ?>" class="text-decoration-none text-black">
                                <div class="d-flex justify-content-center mb-5"><img src="./assets/img/avatar.png" class="w-25" alt="..."></div>
                                <p><span class="fw-bold">prénom : </span><?php echo $infoUser["prenom"] ?></p>
                                <p><span class="fw-bold">nom: </span><?php echo $infoUser["nom"] ?></p>
                                <p><span class="fw-bold">pseudonyme: </span><?php echo $infoUser["pseudo"] ?></p>
                                <p><span class="fw-bold">mail: </span><?php echo $infoUser["mail"] ?></p>
                                <p><span class="fw-bold">rôle: </span><?php if ($infoUser["role"] > 0) {
                                                                            echo "administrateur";
                                                                        } else {
                                                                            echo "utilisateur";
                                                                        } ?>
                                </p>
                            </a>
                        </div>
                    </div>
                <?php } ?>
            </div>

        </section>
        <!-- fin de la section -->

        <section class="p-2">

            <!-- titre -->
            <h2>Tout les commentaires</h2>
            <div class="row">
                <?php while ($commentaires = $affichageCom->fetch(PDO::FETCH_ASSOC)) { ?>
                    <div class="col-md-3 mb-3">
                        <div class="card p-3" style="background-color:  #dddddd;">
                            <div class="d-flex justify-content-center mb-5"><img src="./assets/img/avatar.png" class="w-25" alt="..."></div>
                            <p><span class="fw-bold">titre: </span><?php echo $commentaires["titre"] ?></p>
                            <p><span class="fw-bold">pseudonyme: </span><?php echo $commentaires["pseudo"] ?></p>
                            <p><span class="fw-bold">date d'ajout: </span><?php echo $commentaires["date"] ?></p>
                            <p><span class="fw-bold">commentaire: </span><?php echo $commentaires["commentaire"] ?></p>
                            <a href="suppression-des-commentaires.php?action=suppression&id_commentaire=<?php echo $commentaires["id_commentaire"] ?>" class="btn btn-danger" onclick="return (confirm('Êtes-vous sûr de vouloir supprimer ce commentaire ?'))"><i class="bi bi-trash-fill"></i></a>
                        </div>
                    </div>
                <?php } ?>
            </div>

        </section>
        <!-- fin de la section -->

        <section class="p-2">

            <!-- titre -->
            <h2>Évènements</h2>

            <div class="row">
                <!-- boucle while -->
                <?php while ($evenement = $fiche->fetch(PDO::FETCH_ASSOC)) { ?>
                    <div class="col-md-3 mb-3">
                        <div class="card p-3" style="background-color:  #dddddd;">
                            <a href="voir-evenement.php?id_evenement=<?php echo $evenement["id_evenement"] ?>" class="text-decoration-none text-black">
                                <h3><?php echo $evenement["titre"]; ?></h3>
                                <div class="d-flex justify-content-around">
                                    <img src="<?php echo $evenement["photo_1"]; ?>" style="width: 100%; height: 200px;" alt="...">
                                </div>
                                <p><span class="fw-bold">description: </span><?php echo $evenement["description"]; ?></p>
                                <p><span class="fw-bold">durée: </span><?php echo $evenement["duree"]; ?></p>
                                <p><span class="fw-bold">date: </span><?php echo $evenement["date"]; ?></p>
                                <p><span class="fw-bold">prix: </span><?php echo $evenement["prix"]; ?></p>
                                <p><span class="fw-bold">thème: </span><?php echo $evenement["theme"]; ?></p>
                            </a>
                        </div>
                    </div>
                <?php } ?>
                <!-- fin de la boucle while -->
            </div>
        </section>

    </div>
    <!-- fin du conteneur -->

</main>
<!-- fin du MAIN -->

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