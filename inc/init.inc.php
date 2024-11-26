<?php
/* 1 - création du PDO */
$pdoMysteryMaze = new PDO(
    'mysql:host=localhost;dbname=mystery-maze',
    'root', // utilisateur
    '', // mot de passe
    array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, // La première ligne demande l'affichage des erreurs sql sous forme de warning
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8', // précise le jeu de caratère lorsque ces erreurs apparaissent
    )
);

/* 2 - ouverture de session */
session_start();

/* 3 - initialisation de la variable message qui va nous servir pour afficher des erreurs ou des validations */
$message = "";

/* 4 - on inclus le fichier fonctions */
require("function.inc.php");