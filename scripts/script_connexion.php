<?php
session_start();
include("connect.php");

if (isset($_POST["usrName"]) && isset($_POST["usrPass"])) {
    $usrName = $_POST['usrName'];
    $usrPass = $_POST['usrPass'];

    $sqlVerif = "SELECT * FROM user WHERE pseudo=? AND password=?";
    $response = $BDD->prepare($sqlVerif);
    $response->execute(array($usrName, $usrPass));
    $n = $response->rowCount();

    $ligne = $response->fetch();
    $_SESSION["nomUtilisateur"] = $ligne['prenom'];
    $_SESSION["admin"] = $ligne["admin"];

}



if ($n==0){
    $_SESSION["connected"] = false;
    $_SESSION["erreur_connexion"] = true;
    header('location: ../login.php');
    exit;
}
else {$_SESSION["connected"]  = true;}
header('location: ../index.php');
