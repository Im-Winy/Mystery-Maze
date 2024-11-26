<?php
/* 1 - Création de la fonction pour vérifier qu'un utilisateur est connecté */
function estConnecte()
{
    if (isset($_SESSION['utilisateurs'])) {/* $_SESSION permet de récupérer les infos sur la personne se trouvant sur notre site. 
        Ici je précise que $_SESSION doit aller chercher les infos concernant les tables utilisateurs */
        return true;
    } else {
        return false;
    }
}

/* 2 - Création de la fonction pour vérifier qu'un utilisateur est administrateur */
function estAdmin()
{
    if (estConnecte() && $_SESSION['utilisateurs']['role'] == "1") {
        /* on vérifie que l'utilisateur remplie les conditions de notre fonction estConncte() et que son statut en BDD correspond à 1 (admin) */
        return true;
    } else {
        return false;
    }
}