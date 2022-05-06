<?php
session_start();
include("connect.php");

if (isset($_POST["usrName"]) && isset($_POST["usrPass"])) {
    $usrName = $_POST['usrName'];
    $usrPass = $_POST['usrPass'];
    $hash = password_hash($usrPass, PASSWORD_BCRYPT);

    $sqlVerif = "SELECT * FROM user WHERE pseudo=?";
    $response = $BDD->prepare($sqlVerif);
    $response->execute(array($usrName));
    $n = $response->rowCount();
    $ligne = $response->fetch();

    if ($n==0) {
        $_SESSION["connected"] = false;
        $_SESSION["erreur_connexion"] = true;
        header('location: ../login.php');
        exit();
    }

    else if(password_verify($hash,$ligne["password"])){
        echo "la personne est bien connectée";
        $_SESSION["nomUtilisateur"] = $ligne['prenom'];
        $_SESSION["admin"] = $ligne["admin"];
        $_SESSION["connected"]  = true;
        //header('location: ../index.php');
        exit();
    }
    else{
        echo "mdp incorrect";
        $_SESSION["connected"] = false;
        $_SESSION["erreur_connexionMDP"] = true;

        header('location: ../login.php');
        //exit();
    }

}




