<?php
/* Appel du fichier init */
require("inc/init.inc.php");

/* Traitement du formulaire */
if (!empty($_POST)) {

    /* On vérifie si le pseudo existe déjà dans la BDD */
    $verifPseudo = $pdoMysteryMaze->prepare("SELECT * FROM utilisateurs WHERE pseudo = :pseudo");
    $verifPseudo->execute([
        ':pseudo' => $_POST['pseudo'],
    ]);
    /* Si c'est le cas on envoie un message pour l'indiquer à l'utilisateur */
    if ($verifPseudo->rowCount() > 0) {
        $message .= "<p class=\"alert alert-danger\">Ce pseudo est déjà pris !</p>";
    } else { /* Sinon le pseudo est disponible, la personne peut donc s'inscrire, on entre les infos en BDD */

        $mdp = password_hash($_POST["mdp"], PASSWORD_DEFAULT);
        /* Grâce à la fonction prédéfinie password_hash(), on définit que l'on
        veut hasher un mdp. Cette fonction prend deux arguments : 1- la string, 2 La façon de hasher (ici avec PASSWORD DEFAULT) */

        /* requete d'insertion pour envoyer les informations obtenues vers la BDD */
        $insert = $pdoMysteryMaze->prepare("INSERT INTO utilisateurs (prenom, nom, pseudo, mail, mdp) VALUES (:prenom, :nom, :pseudo, :mail, :mdp)");
        $insert->execute([
            ":prenom" => $_POST["prenom"],
            ":nom" => $_POST["nom"],
            ":pseudo" => $_POST["pseudo"],
            ":mail" => $_POST["mail"],
            ":mdp" => $mdp, /* je récupère le mdp déjà hashé dans ma variable */
        ]);

        /* redirection vers la page d'accueil */
        header("location:accueil.php");
        exit();
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

        <!-- début de la section -->
        <section class="p-2">

            <!-- titre -->
            <h2>Inscription</h2>

            <div class="rounded p-4" style="background-color: #dddddd;">

                <!-- formulaire d'inscription -->
                <form action="#" method="post">

                    <!-- message -->
                    <?php echo $message ?>
                    <!-- fin du message -->

                    <!-- prénom -->
                    <div class="mb-3">
                        <input type="text" name="prenom" id="prenom" placeholder="Votre prénom" class="form-control" required>
                    </div>
                    <!-- fin du prénom -->

                    <!-- nom -->
                    <div class="mb-3">
                        <input type="text" name="nom" id="nom" placeholder="Votre nom" class="form-control" required>
                    </div>
                    <!-- fin du nom -->

                    <!-- pseudo -->
                    <div class="mb-3">
                        <input type="text" name="pseudo" id="pseudo" placeholder="Votre pseudo" class="form-control" required>
                    </div>
                    <!-- fin du pseudo -->

                    <!-- email -->
                    <div class="mb-3">
                        <input type="email" name="mail" id="mail" placeholder="Indiquez votre adresse email" class="form-control" required>
                    </div>
                    <!-- fin de l'email -->

                    <!-- mot de passe -->
                    <div class="mb-3">
                        <input type="password" name="mdp" id="mdp" placeholder="Saisissez un mot de passe" class="form-control" required>
                        <!-- Un élément pour basculer entre la visibilité du mot de passe -->
                        <input type="checkbox" onclick="myFunction()">
                        <span class="text-dark">afficher le mot de passe</span>
                    </div>
                    <!-- fin du mot de passe -->

                    <!-- bouton -->
                    <div>
                        <input type="submit" value="S'inscrire" class="btn btn-dark">
                    </div>
                    <!-- fin du bouton -->

                </form>
                <!-- fin du formulaire -->

            </div>

        </section>
        <!-- fin de la section -->

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