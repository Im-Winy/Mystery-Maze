<?php
/* Appel du fichier init */
require("inc/init.inc.php");

/* Si je suis administrateur */
if (estAdmin()) {
    /* je réceptionne les informations de chaque utilisateur */
    if (isset($_GET["id_user"])) {
        /* requête de sélection pour aller chercher les informations de l'utilisateur par son id */
        $requete = $pdoMysteryMaze->prepare("SELECT * FROM utilisateurs WHERE id_user = :id_user");
        $requete->execute([
            ':id_user' => $_GET['id_user'],
        ]);

        /* connexion à la BDD */
        $info = $requete->fetch(PDO::FETCH_ASSOC);
    }

    if (isset($_GET['action']) && $_GET["action"] == "suppression" && isset($_GET["id_user"])) {
        /* requête de suppression des évènements par leurs id */
        $delete = $pdoMysteryMaze->prepare("DELETE FROM utilisateurs WHERE id_user = :id_user");

        $delete->execute([
            ":id_user" => $_GET["id_user"],
        ]);

        if ($delete->rowCount() == 0) {
            /* Si ça nous renvois 0 c'est que le résultat est vide : il n'y a pas cet article avec cet id à supprimer */
            $message .= "<div class=\"alert alert-danger\">Erreur de suppression de l'utilisateur n°$_GET[id_user]</div>";
        } else /* la suppression s'éxecute */ {
            $message .= "<div class=\"alert alert-danger\">l'utilisateur n°$_GET[id_user] a bien été supprimer</div>";
        }
    }
}

/* Si je suis administrateur */
if (estAdmin()) {
    /* Traitement du formulaire */
    if (!empty($_POST)) {
        /* requête pour modifier les informations du profil */
        $modif = $pdoMysteryMaze->prepare("UPDATE utilisateurs SET prenom = :prenom, nom = :nom, pseudo = :pseudo, mail = :mail, mdp = :mdp WHERE id_user = :id_user");
        $modif->execute([
            ":id_user" => $_GET["id_user"],
            ":prenom" => $_POST["prenom"],
            ":nom" => $_POST["nom"],
            ":pseudo" => $_POST["pseudo"],
            ":mail" => $_POST["mail"],
            ":mdp" => $_POST["mdp"],
        ]);
        /* redirection vers la page d'accueil */
        header("location:accueil.php");
        exit();
    }
}

/* Si je suis un utilisateur */
if (estConnecte()) {
    /* je réceptionne mes propres informations */
    if (isset($_GET['id_user']) && $_SESSION['utilisateurs']['id_user'] == $_GET['id_user']) {
        /* requête de sélection pour aller chercher mes informations dans la BDD par mon id */
        $requete = $pdoMysteryMaze->prepare("SELECT * FROM utilisateurs WHERE id_user = :id_user");
        $requete->execute([
            ':id_user' => $_SESSION['utilisateurs']['id_user'],
        ]);
        /* connexion à la BDD */
        $info = $requete->fetch(PDO::FETCH_ASSOC);
    } elseif (isset($_GET['id_user']) && $_SESSION['utilisateurs']['role'] == 1) {/* Seules les administrateurs ont accès aux informations des utilisateurs */
    } else {/* Si l'id dans l'url ne correspond au mien */
        /* redirection vers la page d'accueil */
        header("location:accueil.php");
        exit();
    }
} else {/* Si je ne suis pas connecté */
    /* redirection vers la page d'accueil */
    header("location:accueil.php");
    exit();
}

/* Si je suis un utilisateur */
if (estConnecte()) {
    /* Traitement du formulaire */
    if (!empty($_POST)) {

        /* On vérifie si le pseudo existe déjà dans la BDD */
        $verifPseudo = $pdoMysteryMaze->prepare("SELECT * FROM utilisateurs WHERE pseudo = :pseudo AND id_user != :id_user");
        $verifPseudo->execute([
            ':pseudo' => $_POST['pseudo'],
            ":id_user" => $_SESSION["utilisateurs"]["id_user"],
        ]);
        /* Si c'est le cas on envoie un message pour l'indiquer à l'utilisateur */
        if ($verifPseudo->rowCount() > 0) {
            $message .= "<p class=\"alert alert-danger\">Ce pseudo est déjà pris !</p>";
        } else {
            /* requête pour modifier les informations du profil */
            $modif = $pdoMysteryMaze->prepare("UPDATE utilisateurs SET prenom = :prenom, nom = :nom, pseudo = :pseudo, mail = :mail, mdp = :mdp WHERE id_user = :id_user");
            $modif->execute([
                ":id_user" => $_SESSION["utilisateurs"]["id_user"],
                ":prenom" => $_POST["prenom"],
                ":nom" => $_POST["nom"],
                ":pseudo" => $_POST["pseudo"],
                ":mail" => $_POST["mail"],
                ":mdp" => $_POST["mdp"],
            ]);
            /* redirection vers la page d'accueil */
            header("location:accueil.php");
            exit();
        }
    }
}
/* HEADER */
require("inc/header.inc.php");
/* fin du HEADER */
?>

<!-- MAIN -->
<main>
    <!-- conteneur -->
    <div class="container">
        <!--  -->
        <section class="p-2">
            <!-- titre -->
            <h2>Profil</h2>
            <div class="rounded p-4" style="background-color: #dddddd;">

                <!-- formulaire d'inscription -->
                <form action="#" method="post">

                    <!-- message -->
                    <?php echo $message ?>
                    <!-- fin du message -->

                    <!-- prénom -->
                    <div class="mb-3">
                        <input type="text" name="prenom" id="prenom" value="<?php echo $info["prenom"]; ?>" class="form-control">
                    </div>
                    <!-- fin du prénom -->

                    <!-- nom -->
                    <div class="mb-3">
                        <input type="text" name="nom" id="nom" value="<?php echo $info["nom"]; ?>" class="form-control">
                    </div>
                    <!-- fin du nom -->

                    <!-- pseudo -->
                    <div class="mb-3">
                        <input type="text" name="pseudo" id="pseudo" value="<?php echo $info["pseudo"]; ?>" class="form-control">
                    </div>
                    <!-- fin du pseudo -->

                    <!-- email -->
                    <div class="mb-3">
                        <input type="email" name="mail" id="mail" value="<?php echo $info["mail"]; ?>" class="form-control">
                    </div>
                    <!-- fin de l'email -->

                    <!-- mot de passe -->
                    <div class="mb-3">
                        <input type="password" name="mdp" id="mdp" value="<?php echo $info["mdp"]; ?>" class="form-control">
                        <!-- Un élément pour basculer entre la visibilité du mot de passe -->
                        <input type="checkbox" class="mt-3" onclick="myFunction()">
                        <span class="text-dark">afficher le mot de passe</span>
                    </div>
                    <!-- fin du mot de passe -->

                    <!-- bouton -->
                    <div class="mb-3">
                        <input type="submit" value="Mis à jour du profil" class="btn btn-dark">
                    </div>
                    <!-- fin du bouton -->

                </form>
                <!-- fin du formulaire -->

                <?php if (estAdmin()) { ?>
                    <a href="profil.php?action=suppression&id_user=<?php echo $info["id_user"]; ?>" class="btn btn-danger" onclick="return (confirm('Étes vous sûr de vouloir supprimer cet utilisateur ?'))"><i class="bi bi-trash-fill"></i></a>
                <?php } ?>
            </div>

        </section>
        <!--  -->
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