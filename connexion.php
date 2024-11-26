<?php
/* Appel du fichier init */
require("inc/init.inc.php");

/* Traitement du formulaire */
if (!empty($_POST)) {
    /* Si le pseudo ou le mot de passe est vide : afficher le message d'erreur */
    if (empty($_POST['pseudo']) || empty($_POST['mdp'])) {
        $message .= '<div class="alert alert-danger">Le pseudo et le mot de passse sont requis</div>';
    }
    /* Si la variable $message est vide alors je n'ai pas d'erreurs, je peux donc commencer par vérifier le pseudo de mon utilisateur */
    if (empty($message)) {
        /* Je vérifie si le pseudo entré par l'utilisateur correspond à un pseudo dans ma BDD */
        $verifPseudo = $pdoMysteryMaze->prepare("SELECT * FROM utilisateurs WHERE pseudo = :pseudo");

        $verifPseudo->execute([
            ":pseudo" => $_POST['pseudo'],
        ]);

        /* Si la vérification du pseudo renvoie 1 */
        if ($verifPseudo->rowCount() == 1) {
            /* Je récupère les infos de la personne dont le pseudo a été donné */
            $membre = $verifPseudo->fetch(PDO::FETCH_ASSOC);

            /* Si le mot de passe inscrit dans le formulaire correspond à celui dans ma BDD */
            if ($_POST['mdp'] == $membre['mdp']) {

                /* J'assigne les informations de l'utilisateur qui se connecte que j'ai récupéré ici grâce à $_SESSION qui comme toute les super globales va créer un tableau multidimensionnel qui contient les informations */
                $_SESSION['utilisateurs'] = $membre;

                /* puis je retourne vers la page d'accueil */
                header("location:accueil.php");
                exit();
            } else {
                $message .= '<p class="alert alert-danger">Mot de passe incorrect !</p>';
            }
        } else {
            $message .= '<p class="alert alert-danger">Pseudo incorrect !</p>';
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

        <!-- début de la section -->
        <section class="p-2">

            <!-- titre -->
            <h2>Connexion</h2>

            <!-- formulaire -->
            <form action="#" method="post" class="card p-4" style="background-color: #dddddd;">

                <!-- message -->
                <?php echo $message; ?>
                <!-- fin du message -->

                <!-- pseudo -->
                <div class="mb-3">
                    <input type="text" name="pseudo" id="pseudo" placeholder="Pseudo" class="form-control">
                </div>
                <!-- fin du pseudo -->

                <!-- mot de passe -->
                <div class="mb-3">
                    <input type="password" name="mdp" id="mdp" placeholder="Mot de passe" class="form-control" required>
                    <!-- Un élément pour basculer entre la visibilité du mot de passe -->
                    <input type="checkbox" onclick="myFunction()">
                    <span class="text-dark">afficher le mot de passe</span>
                </div>
                <!-- fin du mot de passe -->

                <!-- bouton -->
                <div>
                    <input type="submit" value="Se connecter" class="btn btn-dark" required>
                </div>
                <!-- fin du bouton -->

            </form>
            <!-- fin du formulaire -->

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