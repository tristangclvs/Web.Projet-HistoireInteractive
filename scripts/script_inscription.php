<?php
session_start();
include("connect.php");

if (isset($_POST["prenom"]) &&  isset($_POST["usrName"]) && isset($_POST["usrPass"])) {
    $usrName = $_POST['usrName'];
    $usrPass = $_POST['usrPass'];
    $prenom = $_POST['prenom'];

    $sqlVerif = "INSERT INTO user(prenom,pseudo,password,admin) VALUES (?,?,?,?)";
    $response = $BDD->prepare($sqlVerif);
    $response->execute(array($prenom, $usrName, $usrPass, 0));

    $_SESSION["inscription"] = true;
}



header('location: ../login.php');
