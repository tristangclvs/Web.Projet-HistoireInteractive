<?php
session_start();
include("connect.php");

if (isset($_POST["prenom"]) &&  isset($_POST["usrName"]) && isset($_POST["usrPass"])) {
    $usrName =htmlspecialchars($_POST['usrName'], ENT_QUOTES, 'UTF-8', false) ;
    $usrPass = $_POST['usrPass'];
    $prenom = $_POST['prenom'];
    $hash = password_hash($usrPass, PASSWORD_BCRYPT);

    //Vérification de l'unicité du pseudo
    $requeteVerif = "SELECT * FROM user WHERE pseudo=?";
    $response = $BDD->prepare($requeteVerif);
    $response->execute(array($usrName));
    $n = $response->rowCount();
    if ($n==0){
        //Insertion dans la BDD
        $sqlInsert = "INSERT INTO user(prenom,pseudo,password,admin) VALUES (?,?,?,?)";
        $response = $BDD->prepare($sqlInsert);
        $response->execute(array($prenom, $usrName, $hash, 0));

        $_SESSION["inscription"] = true;
        $_SESSION["usrNameInscription"] = $usrName;

    }
    else{
        $_SESSION["doublonPseudo"] = true;
    }
    header('location: ../login.php');
}
else{
    echo "Vous ne devriez pas être ici, oust.";
    header('location: ../login.php');
}


