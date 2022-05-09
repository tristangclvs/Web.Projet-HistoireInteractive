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

    if ($n==0) {    // Aucun compte correspondant à ce pseudo
        $_SESSION["connected"] = false;
        $_SESSION["erreur_connexion"] = true;
        header('location: ../login.php');
    }
    else if(password_verify($usrPass,$ligne["password"])){
        //bien connecté
        echo "la personne est bien connectée";
        $_SESSION["nomUtilisateur"] = $ligne['prenom'];
        $_SESSION["id_user"] = $ligne["id"];
        $_SESSION["admin"] = $ligne["admin"];
        $_SESSION["connected"]  = true;
        header('location: ../index.php');
    }
    else{
        //utilisateur existant, mais mot de passe erroné.
        echo "mdp incorrect";
        $_SESSION["connected"] = false;
        $_SESSION["erreur_connexionMDP"] = true;
        header('location: ../login.php');
    }
}
else{
    header('location: ../login.php');
    exit();
}




