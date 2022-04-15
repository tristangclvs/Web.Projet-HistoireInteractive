<?php
session_start();
if(!isset($_SESSION['nav'])){
    $_SESSION['nav'] = 'Se connecter';
}
if(!isset($_SESSION['verif'])){
    $_SESSION['verif'] = true;
}
if(!isset($_SESSION['verif2'])) {
    $_SESSION['verif2'] = true;
}
include("scripts/connect.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>MyMovies</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="css/style.css" rel="stylesheet">

</head>
<body>
<header id="heads" class="py-4">
    <nav id="navb" class="navbar navbar-expand-md fixed-top navbar-light bg-light">
        <div class="container">
            <div class="col-10">
                <a class="navbar-brand text-uppercase fw-bold" href="../index.php" id="baliseb">
                    <span class="bg-secondary bg-gradient p-1 rounded-3 text-light" id="spanb">Histoire</span> Interactive
                </a>
            </div>
            <div class="col-2">
                <div class="dropdown">
                    <button class="btn btn-dark dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        <?php if ($_SESSION['nav']=='Se connecter'){
                            echo 'Non connecté';
                        }
                        else{
                            echo $_SESSION['nav'];
                        }
                        ?>
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">

                        <?php
                        if($_SESSION['nav']=='Se connecter'){
                            echo '<li class="nav-item"><a class="nav-link text-black" href="../login.php">' .$_SESSION['nav'].'</a></li>';
                        }
                        else{
                            echo '<li class="nav-item"><a class="nav-link text-black" href="deconnection.php">Se déconnecter</a></li><li class="nav-item"><a class="nav-link text-black" href="../movie_add.php">Ajouter un Film</a></li>';
                        }
                        ?>

                    </ul>
                </div>
            </div>
        </div>
    </nav>
</header>
