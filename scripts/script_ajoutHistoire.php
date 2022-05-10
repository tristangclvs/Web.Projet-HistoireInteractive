<?php
session_start();
include("connect.php");

if (isset($_POST["titre"]) &&  isset($_POST["categorie"]) && isset($_POST["auteur"]) && isset($_POST["annee"]) && isset($_POST["description"]))
{
    $histTitre = htmlspecialchars( $_POST['titre'], ENT_QUOTES, 'UTF-8', false);
    $histCategorie = htmlspecialchars( $_POST['categorie'], ENT_QUOTES, 'UTF-8', false);
    $histAuteur = htmlspecialchars( $_POST['auteur'], ENT_QUOTES, 'UTF-8', false);
    $histAnnee = htmlspecialchars( $_POST['annee'], ENT_QUOTES, 'UTF-8', false);
    $histDescription = htmlspecialchars( $_POST['description'], ENT_QUOTES, 'UTF-8', false);

    //Première requête : Vérification de la non existence d'une histoire avec le même titre
    $requete = "SELECT * FROM histoire WHERE titre=?";
    $response = $BDD->prepare($requete);
    $response -> execute(array($histTitre));
    $n = $response->rowCount();
    if ($n>0)
    {
        // Si il s'agit d'un doublon on redemande une autre histoire
        $_SESSION["doublon_histoire"] = true;
        header('location: ../histoire_ajout.php');
        exit();
    }

    //Vérification si le POST possède une image ou non (car elle est facultative)
    if ($_FILES["fileToUpload"]["type"]!="")
    {
        $image = basename($_FILES['fileToUpload']['name']);
        $dossier = '../images/';
        $extensions = array('.png', '.gif', '.jpg', '.jpeg');
        $extension = strrchr($_FILES["fileToUpload"]['name'], '.');
        if(!in_array($extension, $extensions))
        {
            $erreur = 'Vous devez uploader un fichier de type png, gif, jpg ou jpeg...';
        }
        if(!isset($erreur))
        {
            //deuxieme requete : Création de l'histoire dans la BDD
            $fichier = $_FILES["fileToUpload"]['name'];
            if(move_uploaded_file($_FILES["fileToUpload"]['tmp_name'], $dossier . $fichier)) {
                //deuxieme requete : Création de l'histoire dans la BDD
                $sqlVerif = "INSERT INTO `histoire`(titre,categorie,auteur,annee,description,image) VALUES (?,?,?,?,?,?)";
                $response = $BDD->prepare($sqlVerif);
                $response->execute(array($histTitre, $histCategorie, $histAuteur, $histAnnee,$histDescription,$fichier));
                $_SESSION["id_histoire"] = $BDD->lastInsertId();
            }
            else {
                echo 'Echec de l\'upload !';
            }
        }
        else
        {
            echo $erreur;
        }

    }
    else{
        //deuxieme requete : Création de l'histoire dans la BDD
        $sqlVerif = "INSERT INTO histoire(titre,categorie,auteur,annee,description) VALUES (?,?,?,?,?)";
        $response = $BDD->prepare($sqlVerif);
        $response->execute(array($histTitre, $histCategorie, $histAuteur, $histAnnee,$histDescription));
        $_SESSION["id_histoire"] = $BDD->lastInsertId();

    }

    $_SESSION["ajout_hist"] = true;
    header("Location: ../paragraphe_ajout.php");
    exit();
}
else{
    header("Location: ../histoire_ajout.php");
}
