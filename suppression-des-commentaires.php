<?php
/* Appel du fichier init */
require("inc/init.inc.php");

/* Si l'utilisateur n'est pas admin */
if (!estAdmin()) {
    /* redirection vers la page accueil */
    header("location:accueil.php");
    exit();
}

/* réception des informations du commentaire par son id depuis l'URL */
if (isset($_GET['action']) && $_GET['action'] == 'suppression' && $_GET["id_commentaire"]) {
    /* requête de suppression du commentaire */
    $requete = $pdoMysteryMaze->prepare("DELETE FROM commentaires WHERE id_commentaire = :id_commentaire");
    $requete->execute([
        ":id_commentaire" => $_GET["id_commentaire"],
    ]);

    /* vérification de la suppression du commentaire */
    if ($requete->rowCount() == 0) {
        echo "Erreur de suppression";
    } else {
        header("location:admin.php");
        exit();
    }
} else {
    /* redirection vers la page admin */
    header("location:admin.php");
    exit();
}

/* HEADER */
require("inc/header.inc.php");
/* fin du HEADER */
