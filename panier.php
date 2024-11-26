<?php
/* Appel du fichier init */
require("inc/init.inc.php");

/* HEADER */
require("inc/header.inc.php");
/* fin du HEADER */
?>

<!-- MAIN -->
<main class="background-light">

    <!-- conteneur -->
    <div class="container">

        <section class="content-aria p-2">
            <!-- titre -->
            <h2>Accueil</h2>

            <table class="table border-dark table-bordered">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Titre</th>
                        <th>Prix</th>
                        <th>Quantité</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    $total = 0;
                    // Vérification si la variable de session 'panier' est définie
                    if (isset($_SESSION['panier'])) {
                        // Récupération des clés (identifiants de produits) de la variable de session 'panier' dans un tableau $ids
                        $ids = array_keys($_SESSION['panier']);

                        // Vérification si le tableau $ids est vide
                        if (empty($ids)) {
                            // Affichage d'un message indiquant que le panier est vide
                            echo "Votre panier est vide";
                        } else {
                            // Requête SQL pour récupérer les informations des produits correspondant aux identifiants présents dans $ids
                            $produits = $pdoMysteryMaze->query("SELECT * FROM evenements WHERE id_evenement IN (" . implode(',', $ids) . ")");
                            /* implode(',', $ids): Cette fonction implode() est utilisée pour fusionner les éléments d'un tableau $ids en une chaîne de caractères où chaque élément du tableau est séparé par une virgule (,). Ainsi, si $ids est un tableau contenant les identifiants des produits [1, 2, 3], implode(',', $ids) produira la chaîne "1,2,3". */

                            // Boucle foreach pour parcourir les produits récupérés
                            foreach ($produits as $produit) {

                                // Calcul du prix total en ajoutant le prix du produit multiplié par sa quantité dans le panier à la variable $total
                                $total += $produit['prix'] * $_SESSION['panier'][$produit['id_evenement']];
                                $id_produit = $produit['id_evenement']; // Identifiant du produit
                    ?>
                                <!-- Affichage des détails du produit dans une ligne de tableau HTML -->
                                <tr>
                                    <td><img src="<?php echo $produit['photo_1'] ?>" alt="image produit"></td>
                                    <td><?php echo $produit['titre'] ?></td>
                                    <td><?php echo $produit['prix'] ?></td>
                                    <td><?php echo $_SESSION['panier'][$produit['id_evenement']] ?></td>

                                    <!--  supprimer un produit du panier  -->
                                    <td><a href="suppression-du-panier.php?action=suppression&id_evenement=<?php echo $produit['id_evenement'] ?>" onclick="return(confirm('Êtes-vous sûr de vouloir supprimer ce produit ?'))" class="btn btn-warning">Supprimer</a></td>
                                </tr>
                        <?php }
                        }
                        ?>
                        <!-- Affichage des totaux de quantité et de prix total -->
                        <tr>
                            <th colspan="1">Quantité Total: <?php echo array_sum($_SESSION['panier']) ?></th>
                            <!-- est une fonction PHP qui calcule la somme des valeurs d'un tableau. Dans ce cas, elle est utilisée pour calculer la somme des valeurs des produits dans le panier, qui sont stockées dans la variable de session 'panier' -->
                            <th colspan="4">Prix Total: <?php echo $total ?> euro</th>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>

            </table>
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