<?php
session_start();
include("connect.php");

if($_SESSION['connected'] && $_SESSION['admin']==1){
    $requete = 'DELETE FROM histoire WHERE id=?';
    $response = $bdd->prepare($requete);
    $response->execute(array($_GET['id']));
    $_SESSION['suppresion_hist']=true;
}

header('location: ../liste_histoires.php');