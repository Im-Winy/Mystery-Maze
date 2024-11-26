<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- titre -->
    <title>Mystery Maze - Escape Game</title>
    <!-- favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="../assets/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../assets/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/favicon/favicon-16x16.png">
    <link rel="manifest" href="../assets/favicon/site.webmanifest">
    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- icône bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- feuilles de style -->
    <link rel="stylesheet" href="../assets/css/navbar.css">
    <link rel="stylesheet" href="../assets/css/accueil.css">
    <link rel="stylesheet" href="../assets/css/a-propos.css">
    <link rel="stylesheet" href="../assets/css/dark-mode.css">
    <link rel="stylesheet" href="../assets/css/voir-evenement.css">
    <link rel="stylesheet" href="../assets/css/tous-les-evenements.css">
    <!-- google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap" rel="stylesheet">
</head>

<body>
    <!-- HEADER -->
    <header>
        <!-- navbar -->
        <nav class="navbar navbar-expand-lg bg-light">
            <!-- conteneur -->
            <div class="container-fluid">
                <!-- lien vers la page d'accueil -->
                <a class="navbar-brand" href="../accueil.php">
                    <!-- logo - Mystery Maze -->
                    <img src="../assets/img/logo.png" style="width: 222px; height: 100px;" alt="logo">
                    <!-- fin du logo - Mystery Maze -->
                </a>
                <!-- fin du lien vers la page d'accueil -->
                <!-- bouton du menu -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <!-- fin du bouton du menu -->
                <!-- navbar responsive-->
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto">
                        <hr>
                        <!-- 1er item -->
                        <li class="nav-item">
                            <!-- lien de navigation -->
                            <a class="nav-link" href="../accueil.php">
                                <div class="square-1 d-flex w-100 p-4">
                                    <!-- icône -->
                                    <i class="bi bi-house-door-fill pe-2"></i>
                                    <!-- nom -->
                                    <span>Accueil</span>
                                </div>
                            </a>
                            <!-- fin du lien de navigation -->
                        </li>
                        <!-- fin du 1er item -->
                        <!-- 2ème item -->
                        <li class="nav-item">
                            <!-- lien de navigation -->
                            <a class="nav-link" href="../tous-les-evenements.php">
                                <div class="square-2 d-flex w-100 p-4">
                                    <!-- icône -->
                                    <i class="bi bi-bookmark-fill pe-2"></i>
                                    <!-- nom -->
                                    <span>Réserver</span>
                                </div>
                            </a>
                            <!-- fin du lien de navigation -->
                        </li>
                        <!-- fin du 2ème item -->
                        <!-- 3ème item -->
                        <li class="nav-item">
                            <!-- lien de navigation -->
                            <a class="nav-link" href="../contact.php">
                                <div class="square-3 d-flex w-100 p-4">
                                    <!-- icône -->
                                    <i class="bi bi-telephone-fill pe-2"></i>
                                    <!-- nom -->
                                    <span>Contact</span>
                                </div>
                            </a>
                            <!-- fin du lien de navigation -->
                        </li>
                        <!-- fin du 3ème item -->
                        <!-- 4ème item -->
                        <li class="nav-item">
                            <!-- lien de navigation -->
                            <a class="nav-link" href="../a-propos.php">
                                <div class="square-4 d-flex w-100 p-4">
                                    <!-- icône -->
                                    <i class="bi bi-info-circle-fill pe-2"></i>
                                    <!-- nom -->
                                    <span>À propos</span>
                                </div>
                            </a>
                            <!-- fin du lien de navigation -->
                        </li>
                        <!-- fin du 4ème item -->
                        <?php if (estAdmin()) { ?>
                            <!-- 5ème item -->
                            <li class="nav-item">
                                <!-- lien de navigation -->
                                <a class="nav-link" href="../admin.php">
                                    <div class="square-5 d-flex w-100 p-4">
                                        <!-- icône -->
                                        <i class="bi bi-person-fill-gear pe-2"></i>
                                        <!-- nom -->
                                        <span>Admin</span>
                                    </div>
                                </a>
                                <!-- fin du lien de navigation -->
                            </li>
                            <!-- fin du 5ème item -->
                        <?php } ?>
                    </ul>
                    <hr>
                    <!-- div - connexion/inscription -->
                    <div class="connexion me-xxl-2 p-3">
                        <?php if (!estConnecte()) { ?>
                            <!-- lien vers la page de connexion -->
                            <a href="connexion.php" class="nav-link text-dark"><i class="bi bi-person-fill-lock"></i> Se connecter</a>
                            <!-- lien vers la page d'inscription -->
                            <a href="inscription.php" class="nav-link text-dark"> <i class="bi bi-pencil-square"></i> S'inscrire</a>
                        <?php } ?>
                        <?php if (estConnecte()) { ?>
                            <!-- lien vers la page de profil -->
                            <a href="profil.php?id_user=<?php echo $_SESSION["utilisateurs"]["id_user"]; ?>" class="nav-link text-dark"><i class="bi bi-person-circle"></i> Profil</a>
                            <!-- lien vers la page du panier -->
                            <a href="panier.php" class="nav-link text-dark"><i class="bi bi-cart2"></i> Panier</a>
                            <!-- lien de déconnexion -->
                            <a href="deconnexion.php" class="nav-link text-danger"><i class="bi bi-person-fill-x"></i> Se déconnecter</a>
                        <?php } ?>
                    </div>
                    <!-- fin de la div - connexion/inscription -->
                    <hr>
                    <!-- interrupteur -->
                    <div class="turn-on">
                        <div class="circle"></div>
                    </div>
                    <!-- fin de l'interrupteur -->
                </div>
                <!-- fin de la navbar responsive -->
            </div>
            <!-- fin du conteneur -->
        </nav>
        <!-- fin du navbar -->
    </header>
    <!-- fin du HEADER -->