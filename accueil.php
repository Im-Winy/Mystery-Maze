<?php
/* Appel du fichier init */
require("inc/init.inc.php");

/* requête de sélection pour afficher 8 évènements (Z-A) */
$requete = $pdoMysteryMaze->query("SELECT * FROM evenements ORDER BY id_evenement DESC LIMIT 8");

/* Traitement du formulaire */
if (!empty($_POST)) {
    /* requête d'insertion pour obtenir l'email de l'utilisateur pour la newsletter */
    $insert = $pdoMysteryMaze->prepare("INSERT INTO newsletter (email) VALUES (:email)");
    $insert->execute([
        ":email" => $_POST["email"],
    ]);
    /* message de validation */
    $message .= "<p class=\"alert alert-success\">Vous êtes abonné(e) !</p>";
}

/* HEADER */
require("inc/header.inc.php");
/* fin du HEADER */
?>

<!-- MAIN -->
<main>
    <!-- zone d'accueil -->
    <div class="home-aria pt-md-5 mb-3">
        <!-- conteneur -->
        <div class="container">

            <!-- texte -->
            <p class="text-center text-white fs-5">Découvrez l'excitation qui vous enveloppe alors que vous vous aventurez dans les
                dédales de <strong>Mystery Maze</strong>. Vos sens en éveil, chaque pas résonne comme une note
                de suspense dans l'air épais de mystère. Chaque tournant vous plonge plus profondément dans
                l'inconnu, votre cœur battant au rythme de l'excitation et de l'anticipation. Les énigmes vous
                défient, les indices vous guident, mais seule votre perspicacité vous mènera vers la lumière au
                bout du tunnel. Dans ce labyrinthe envoûtant, chaque porte franchie vous rapproche un peu plus
                de la vérité cachée. Réfléchissez vite, agissez avec précision, et peut-être découvrirez-vous
                les secrets enfouis de <strong>Mystery Maze</strong>.</p>
            <!-- fin du texte -->

            <!-- div pour le bouton de réservation -->
            <div class="d-flex justify-content-center justify-content-sm-start align-items-center mb-3 mb-md-5">
                <!-- bouton de réservation -->
                <a href="tous-les-evenements.php" class="btn btn-light"><i class="bi bi-bookmark-fill pe-2"></i>Découvrir tout nos évènements</a>
                <!-- fin du bouton de réservation -->
            </div>
            <!-- fin de la div pour le bouton de réservation -->

        </div>
        <!-- fin du conteneur -->

        <!-- div pour le bouton de réservation -->
        <div class="d-flex justify-content-center">
            <!-- bouton de réservation -->
            <a href="#1" class="text-light"><i class="bi bi-arrow-down-circle-fill fs-1"></i></a>
            <!-- fin du bouton de réservation -->
        </div>
        <!-- fin de la div pour le bouton de réservation -->

    </div>
    <!-- fin de la zone d'accueil -->

    <!-- conteneur -->
    <div class="container">
        <!-- zone de contenu -->
        <section class="content-aria p-2" id="1">
            <!-- titre -->
            <h2>Accueil</h2>
            <!-- début de la rangée -->
            <div class="row">

                <!-- début de la boucle while -->
                <?php while ($evenement = $requete->fetch(PDO::FETCH_ASSOC)) { ?>
                    <!-- début de la colonne -->
                    <div class="col-md-3 mb-3">
                        <!-- lien -->
                        <a href="voir-evenement.php?id_evenement=<?php echo $evenement["id_evenement"]; ?>">
                            <!-- début de la boîte -->
                            <div class="box">
                                <!-- intérieur de la boîte -->
                                <div class="box-inner">
                                    <!-- boîte vue de face -->
                                    <div class="box-front">
                                        <!-- photo -->
                                        <figure class="photo" style="width: 100%; height: 100%;">
                                            <img src="<?php echo $evenement['photo_1'] ?>" style="width:100%; height: 100%;" alt="...">
                                            <!-- titre -->
                                            <h3 class="titre-1"><?php echo $evenement["titre"] ?></h3>
                                            <!-- légende -->
                                            <figcaption class="prix">
                                                <!-- prix -->
                                                <strong><?php echo $evenement["prix"]; ?> €</strong>
                                            </figcaption>
                                            <!-- fin de la légende -->
                                        </figure>
                                    </div>
                                    <!-- fin de la boîte vue de face -->
                                    <!-- boîte vue de dos -->
                                    <div class="box-back">
                                        <!-- difficulté -->
                                        <h3 class="titre-2"><span style="font-weight: bold;"><?php echo $evenement["titre"]; ?></span></h3>
                                        <!-- description -->
                                        <p><?php echo substr($evenement["description"], 0, 320); ?>... <strong>[LIRE LA SUITE]</strong></p>
                                    </div>
                                    <!-- fin de la boîte vue de dos -->
                                </div>
                                <!-- fin de l'intérieur de la boîte -->
                            </div>
                            <!-- fin de la boîte -->
                        </a>
                        <!-- fin du lien -->
                    </div>
                    <!-- fin de colonne -->
                <?php } ?>
                <!-- fin de la boucle while -->
            </div>
            <!-- fin de rangée -->
        </section>
        <!-- fin de la zone de contenu -->
    </div>
    <!-- fin du conteneur -->
    <section class="container">
        <div class="row">
            <div class="col-md-6 mb-3">
                <h4>Horaires</h4>
                <table class="w-100 bg-light text-dark" style="height: 250px;">
                    <thead>
                        <tr>
                            <th class="border border-dark text-center p-2 w-auto">jours</th>
                            <th class="border border-dark text-center p-2 w-auto">matin</th>
                            <th class="border border-dark text-center p-2 w-auto">après-midi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="border border-dark text-center p-2 w-auto">lundi</td>
                            <td class="border border-dark text-center p-2 w-auto">10:00-13:00</td>
                            <td class="border border-dark text-center p-2 w-auto">14:00-17:00</td>
                        </tr>
                        <tr>
                            <td class="border border-dark text-center p-2 w-auto">mardi</td>
                            <td class="border border-dark text-center p-2 w-auto">10:00-13:00</td>
                            <td class="border border-dark text-center p-2 w-auto">14:00-17:00</td>
                        </tr>
                        <tr>
                            <td class="border border-dark text-center p-2 w-auto">mercredi</td>
                            <td class="border border-dark text-center p-2 w-auto">9:00-12:00</td>
                            <td class="border border-dark text-center text-danger p-2 w-auto">fermé</td>
                        </tr>
                        <tr>
                            <td class="border border-dark text-center p-2 w-auto">jeudi</td>
                            <td class="border border-dark text-center p-2 w-auto">10:00-13:00</td>
                            <td class="border border-dark text-center p-2 w-auto">14:00-17:00</td>
                        </tr>
                        <tr>
                            <td class="border border-dark text-center p-2 w-auto">vendredi</td>
                            <td class="border border-dark text-center p-2 w-auto">10:00-13:00</td>
                            <td class="border border-dark text-center p-2 w-auto">14:00-17:00</td>
                        </tr>
                    </tbody>

                </table>
            </div>
            <div class="col-md-6 mb-3">
                <div>
                    <h4>Nos locaux</h4>
                    <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d2624.9013637667113!2d2.2108015268719!3d48.860091250586215!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e664cb1c5294ab%3A0xe6d1b8912603f27!2sBd%20Louis%20Loucheur!5e0!3m2!1sfr!2sfr!4v1701445924525!5m2!1sfr!2sfr" class="w-100" style="height: 250px;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                    <p class="font-switch"><strong>Mystery Maze</strong> Bd Louis Loucheur, 92150 Suresnes, France</p>
                </div>
            </div>
        </div>
    </section>
    <!-- newsletter -->
    <section class="newsletter p-4" style="background-color: #dddddd; height: 10rem;">
        <!-- message -->
        <?php echo $message ?>
        <!-- fin du message -->
        <!-- paragraphe -->
        <p class="fw-bold text-center text-dark">Abonnez-vous à la newsletter !</p>
        <!-- fin du paragraphe -->
        <div class="d-flex justify-content-center align-items-center text-center">
            <!-- formulaire -->
            <form action="#" method="post">
                <!-- champ de saisie -->
                <input type="email" id="email" name="email" placeholder="Saisissez une adresse e-mail" required>
                <!-- fin du champ de saisie -->
                <!-- bouton -->
                <button type="submit" class="btn btn-dark ms-2"><i class="bi bi-send-fill text-light fs-5"></i></button>
                <!-- fin du bouton -->
            </form>
            <!-- fin du formulaire -->
        </div>
    </section>
    <!-- fin de la newsletter -->
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