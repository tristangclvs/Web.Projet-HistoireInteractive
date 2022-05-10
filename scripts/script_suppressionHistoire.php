<?php
session_start();
include("connect.php");

// Supprime l'histoire
if($_SESSION['connected'] && $_SESSION['admin']==1){
    if(isset($_GET['id'])){
        $requete = 'DELETE FROM histoire WHERE id=?';
        $response = $BDD->prepare($requete);
        $response->execute(array($_GET['id']));
        $_SESSION['suppresion_hist']=true;
        header('location: ../liste_histoires.php');
    }
}
header('location: ../index.php');