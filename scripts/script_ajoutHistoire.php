<?php
session_start();
include("connect.php");

if (isset($_POST["titre"]) &&  isset($_POST["categorie"]) && isset($_POST["auteur"]) && isset($_POST["annee"]) && isset($_POST["description"]))
{
    if (isset($_POST["image"]))
    {
        return;
    }
    $histTitre = $_POST['titre'];
    $histCategorie = $_POST['categorie'];
    $histAuteur = $_POST['auteur'];
    $histAnnee = $_POST['annee'];
    $histDescription = $_POST['description'];

    //Première requête : Vérification de la non existence d'une histoire avec le même titre
    $requete = "SELECT * FROM histoire WHERE titre= $histTitre";
    $response = $BDD->query($requete);
    $n = $response->rowCount();
    if ($n>0)
    {
        $_SESSION["doublon_histoire"] = true;
        header('location: ../histoire_ajout.php');
        exit();
    }

    //deuxieme requete : Création de l'histoire dans la BDD
    $sqlVerif = "INSERT INTO histoire(titre,categorie,auteur,annee,description) VALUES (?,?,?,?,?)";
    $response = $BDD->prepare($sqlVerif);
    $response->execute(array($histTitre, $histCategorie, $histAuteur, $histAnnee,$histDescription));

    $_SESSION["id_histoire"] = $response->lastInsertId();

    $_SESSION["ajout_hist"] = true;
}
//header("Location: ../paragraphe_ajout.php");
