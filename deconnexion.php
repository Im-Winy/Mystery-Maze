<?php
/* Appel du fichier init */
require("inc/init.inc.php");

/* déconnexion */
session_start();
session_destroy();

/* redirection vers ma page d'accueil */
header("location:accueil.php");
exit();
