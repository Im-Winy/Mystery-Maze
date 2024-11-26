<?php
/* Appel du fichier init */
require("inc/init.inc.php");

/* HEADER */
require("inc/header.inc.php");
/* fin du HEADER */

/* Traitment du formulaire */
if (!empty($_POST)) {

    /* on s'assure que chaque champs soient remplis */
    if (empty($_POST["nom"]) || empty($_POST["email"]) || empty($_POST["message"])) {
        $message .= "<p class=\"alert alert-danger\">Vous devez remplir tout les champs du formulaire !</p>";
    } else {
        /* requête d'insertion des informations du formulaire vers la BDD */
        $insert = $pdoMysteryMaze->prepare("INSERT INTO contacts (nom, email, message) VALUES (:nom, :email, :message)");
        $insert->execute([
            ":nom" => $_POST["nom"],
            ":email" => $_POST["email"],
            ":message" => $_POST["message"],
        ]);
        $message .= "<p class=\"alert alert-success\">Votre message a bien été envoyé !</p>";
    }
}
?>

<!-- MAIN -->
<main>
    <!-- conteneur -->
    <div class="container">

        <!-- début de la section -->
        <section class="p-2">

            <!-- titre -->
            <h2>Contact</h2>

            <!-- zone de contact -->
            <div class="contact-aria rounded p-4" style="background-color: #dddddd;">

                <!-- début de la rangée -->
                <div class="row">

                    <!-- 1ère colonne -->
                    <div class="col-md-4 text-center text-dark">
                        <!-- icône -->
                        <i class="bi bi-geo-alt-fill fs-3"></i>
                        <!-- titre -->
                        <h4>Adresse</h4>
                        <!-- paragraphe -->
                        <p>8 boulevard Louis Loucheur, 92150 Suresnes</p>
                    </div>
                    <!-- fin de la 1ère colonne -->

                    <!-- 2ème colonne -->
                    <div class="col-md-4 text-center text-dark">
                        <!-- icône -->
                        <i class="bi bi-telephone-fill fs-3"></i>
                        <!-- titre -->
                        <h4>Téléphone</h4>
                        <!-- paragraphe -->
                        <p>06.51.47.81.23</p>
                    </div>
                    <!-- fin de la 2ème colonne -->

                    <!-- 3ème colonne -->
                    <div class="col-md-4 text-center text-dark">
                        <!-- icône -->
                        <i class="bi bi-envelope-at-fill fs-3"></i>
                        <!-- titre -->
                        <h4>Email</h4>
                        <!-- paragraphe -->
                        <p>service-client@mystery-maze.fr</p>
                    </div>
                    <!-- fin de la 3ème colonne -->

                </div>
                <!-- fin de la rangée -->

                <hr class="text-dark">

                <!-- formulaire de contact -->
                <form action="#" method="post">

                    <!-- message -->
                    <?php echo $message ?>
                    <!-- fin du message -->

                    <!-- nom -->
                    <div class="mb-2">
                        <input type="text" id="nom" name="nom" placeholder="Entrer votre nom" class="form-control">
                    </div>
                    <!-- fin du nom -->

                    <!-- email -->
                    <div class="mb-2">
                        <input type="email" id="email" name="email" placeholder="Saisir une adresse email valide" class="form-control">
                    </div>
                    <!-- fin de l'email -->

                    <!-- message -->
                    <div class="mb-2">
                        <textarea name="message" id="message" cols="30" rows="10" placeholder="Entrer votre message" class="form-control"></textarea>
                    </div>
                    <!-- fin du message -->

                    <!-- bouton -->
                    <div>
                        <input type="submit" value="Envoyer votre message" class="btn btn-dark">
                    </div>
                    <!-- fin du bouton -->

                </form>
                <!-- fin du formulaire de contact -->

            </div>
            <!-- fin de la zone de contact -->

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