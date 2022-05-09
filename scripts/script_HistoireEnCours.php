<?php
include("connect.php");
if (isset($_GET["idHist"]) && isset($_GET["idParag"]))
{
    $idParag = htmlspecialchars($_GET["idParag"]);
    if (isset($_SESSION['id_histoire_enCours'])){
        unset($_SESSION['id_histoire_enCours']);
    }

    $requete = "SELECT * FROM paragraphe WHERE id=?";
    $response = $BDD->prepare($requete);
    $response -> execute(array($idParag));
    $paragraphe = $response-> fetch();

    $parag_numero = $paragraphe["parag_numero"];
    $_SESSION['id_histoire_enCours'] = $_GET["idHist"];
    header("Location: ../paragraphe.php?id=$parag_numero");
}