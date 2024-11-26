<?php
/* Appel du fichier init */
require("inc/init.inc.php");

if (!estAdmin()) {
    header("location:accueil.php");
    exit();
}

/* Traitement du formulaire */
if (!empty($_POST)) {
    if (empty($_POST["date"]) || empty($_POST["prix"])) {
        $message .= "<p class=\"alert alert-danger\">Le formulaire n'est pas remplis !</p>";
    } else {
        /* requête d'insertion pour ajouter un nouvel evenement */
        $requete = $pdoMysteryMaze->prepare("INSERT INTO evenements (titre, photo_1, photo_2, photo_3, description, duree, date, prix, difficulte, theme, capacite, id_user, disponibilite) VALUES (:titre, :photo_1, :photo_2, :photo_3, :description, :duree, :date, :prix, :difficulte, :theme, :capacite, :id_user, :disponibilite)");

        $requete->execute([
            ":titre" => $_POST["titre"],
            ":photo_1" => $_POST["photo_1"],
            ":photo_2" => $_POST["photo_2"],
            ":photo_3" => $_POST["photo_3"],
            ":description" => $_POST["description"],
            ":disponibilite" => $_POST["disponibilite"],
            ":duree" => $_POST["duree"],
            ":date" => $_POST["date"],
            ":prix" => $_POST["prix"],
            ":difficulte" => $_POST["difficulte"],
            ":theme" => $_POST["theme"],
            ":capacite" => $_POST["capacite"],
            ":id_user" => $_SESSION["utilisateurs"]["id_user"],
        ]);
        /* redirection vers la page accueil */
        /* header("location:accueil.php");
        exit(); */
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
        <!-- titre -->
        <h2>Ajout d'évènement</h2>
        <section class="">
            <!-- message -->
            <?php echo $message; ?>
            <!-- fin du message -->
            <!-- formulaire -->
            <form action="#" method="post" class="p-5">
                <!-- titre -->
                <div class="mb-3">
                    <input type="text" name="titre" id="titre" placeholder="Ajouter un titre" class="form-control">
                </div>
                <!-- fin du titre -->
                <!-- 1ère photo -->
                <div class="mb-3">
                    <input type="text" name="photo_1" id="photo_1" placeholder="Ajouter une première photo" class="form-control">
                </div>
                <!-- fin de la 1ère photo -->
                <!-- 2ème photo -->
                <div class="mb-3">
                    <input type="text" name="photo_2" id="photo_2" placeholder="Ajouter une seconde photo" class="form-control">
                </div>
                <!-- fin de la 2ème photo -->
                <!-- 3ème photo -->
                <div class="mb-3">
                    <input type="text" name="photo_3" id="photo_3" placeholder="Ajouter une troisième photo" class="form-control">
                </div>
                <!-- fin de la 3ème photo -->
                <!-- description -->
                <div class="mb-3">
                    <textarea name="description" id="description" cols="30" rows="10" placeholder="Ajouter une description" class="form-control"></textarea>
                </div>
                <!-- fin de la description -->
                <!-- durée -->
                <div class="mb-3">
                    <input type="text" name="duree" id="duree" placeholder="Ajouter une durée" class="form-control">
                </div>
                <!-- fin de la durée -->
                <!-- date -->
                <div class="mb-3">
                    <label for="date">date</label>
                    <input type="date" name="date" id="date" class="form-control">
                </div>
                <!-- fin de la date -->
                <!-- prix -->
                <div class="mb-3">
                    <label for="prix">prix</label>
                    <input type="number" name="prix" id="prix" placeholder="Ajouter un prix" class="form-control">
                </div>
                <!-- fin du prix -->
                <!-- difficulté -->
                <div class="mb-3">
                    <select name="difficulte" id="difficulte" class="form-control">
                        <option value="1">1 étoile</option>
                        <option value="2">2 étoiles</option>
                        <option value="3">3 étoiles</option>
                        <option value="4">4 étoiles</option>
                        <option value="5">5 étoiles</option>
                    </select>
                </div>
                <!-- fin de la difficulté -->
                <!-- thème -->
                <div class="mb-3">
                    <input type="text" name="theme" id="theme" placeholder="Ajouter un thème" class="form-control">
                </div>
                <!-- fin du thème -->
                <!-- capacité -->
                <div class="mb-3">
                    <select name="capacite" id="capacite" class="form-control">
                        <option value="1 - 3 joueurs">1 - 3 joueurs</option>
                        <option value="2 - 4 joueurs">2 - 4 joueurs</option>
                        <option value="3 - 5 joueurs">3 - 5 joueurs</option>
                    </select>
                </div>
                <!-- fin de la capacité -->
                <!-- disponibilité -->
                <div class="mb-3">
                    <select name="disponibilite" id="disponibilite" class="form-control">
                        <option value="0">disponible</option>
                        <option value="1">reservé</option>
                    </select>
                </div>
                <!-- fin de la disponibilité -->
                <!-- bouton -->
                <input type="submit" value="Ajouter l'évènement" class="btn btn-dark">
                <!-- fin du bouton -->
            </form>
            <!-- fin du formulaire -->
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