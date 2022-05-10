<?php
session_start();
include("connect.php");
if($_SESSION['connected'] && $_SESSION['admin']==1){

    //Selectionne l'histoire et change sa value ''hidden'' si l'on clique sur Cacher histoire
    $verif = "SELECT * FROM histoire WHERE id =?";
    $prep = $BDD -> prepare($verif);
    $prep-> execute(array($_GET['id']));
    $ligne = $prep->fetch();
    if($ligne['hidden']==0){
        $hidden = 1;
    }
    else{
        $hidden = 0;
    }
    $sqlVerif = "UPDATE `histoire` SET hidden=? WHERE id =?";
    $response = $BDD->prepare($sqlVerif);
    $response->execute(array($hidden,$_GET['id']));

}
header("Location: ../liste_histoires.php");