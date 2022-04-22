<?php
session_start();
if (!isset($_SESSION["connected"])) {
    $_SESSION["connected"] = false;
}
if (!isset($_SESSION["erreur_connexion"])) {
    $_SESSION["erreur_connexion"] = false;
}
include("scripts/connect.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Fantastic Stories</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="css/style.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="images/book.png">
</head>

<body>
<header id="heads" class="py-4">
    <nav id="navb" class="navbar navbar-expand-md fixed-top navbar-dark " style="background-color: rgb(38,41,45);">
        <div class="container">
            <div class="col-10">
                <a class="navbar-brand text-uppercase fw-bold" href="index.php" id="baliseb">
                    <img src="images/book.png" alt="book_logo" class="me-2" style="height: 48px; padding-bottom: 1%;">
                    <!-- icon by Icongeek26 -->
                    <span class="bg-gradient bg-light p-1 rounded-3 text-dark" id="spanb">Fantastic</span> Stories
                </a>
            </div>
            <div class="col-2">
                <div class="dropdown">
                    <button class="btn btn-dark dropdown-toggle" type="button" id="dropdownMenuButton1"
                            data-bs-toggle="dropdown" aria-expanded="false">
                        <?php if ($_SESSION["connected"] == false) {
                            echo 'Non connecté';
                        } else {
                            echo "Bonjour, " . $_SESSION["nomUtilisateur"];
                        }
                        ?>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-dark " aria-labelledby="dropdownMenuButton1">

                        <?php
                        if ($_SESSION['connected'] == false) {
                            echo '<li class="nav-item"><a class="nav-link dropdown-item text-white" href="login.php">' . "Se connecter" . '</a></li>';
                        } else {
                            echo '<li class="nav-item"><a class="nav-link  dropdown-item  text-white" href="scripts/script_deconnexion.php">Se déconnecter</a></li>';
                        }
                        ?>

                    </ul>
                </div>
            </div>
        </div>
    </nav>
</header>
