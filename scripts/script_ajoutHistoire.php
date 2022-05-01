<?php
session_start();
include("connect.php");

if (isset($_POST["titre"]) &&  isset($_POST["categorie"]) && isset($_POST["auteur"]) && isset($_POST["annee"]) && isset($_POST["description"]))
{
    $histTitre = $_POST['titre'];
    $histCategorie = $_POST['categorie'];
    $histAuteur = $_POST['auteur'];
    $histAnnee = $_POST['annee'];
    $histDescription = $_POST['description'];
    //Première requête : Vérification de la non existence d'une histoire avec le même titre
    $requete = "SELECT * FROM histoire WHERE titre=?";
    $response = $BDD->prepare($requete);
    $response -> execute(array($histTitre));
    $n = $response->rowCount();
    if ($n>0)
    {
        $_SESSION["doublon_histoire"] = true;
        header('location: ../histoire_ajout.php');
        exit();
    }


    if (!empty($_FILES["fileToUpload"]))
    {

        echo 'On est dedans';
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
            echo 'Avant upload';
            echo $dossier . $fichier;
            echo $_FILES["fileToUpload"]['tmp_name'];
            // Demander a Gabriel pourquoi le move uploaded files ne marche pas, pck pas en local ?
            if(move_uploaded_file($_FILES["fileToUpload"]['tmp_name'], $dossier . $fichier)) {
                echo 'upload réussi';
                //deuxieme requete : Création de l'histoire dans la BDD
                $sqlVerif = "INSERT INTO histoire(titre,categorie,auteur,annee,description,image) VALUES (?,?,?,?,?,?)";
                $response = $BDD->prepare($sqlVerif);
                $response->execute(array($histTitre, $histCategorie, $histAuteur, $histAnnee,$histDescription,$fichier));
                //$_SESSION["id_histoire"] = $response->lastInsertId();

            }
            else {
                echo 'Echec de l\'upload !';
            }
        }
    }
    else{
        //deuxieme requete : Création de l'histoire dans la BDD
        $sqlVerif = "INSERT INTO histoire(titre,categorie,auteur,annee,description) VALUES (?,?,?,?,?)";
        $response = $BDD->prepare($sqlVerif);
        $response->execute(array($histTitre, $histCategorie, $histAuteur, $histAnnee,$histDescription));
        //$_SESSION["id_histoire"] = $response->lastInsertId();

    }



    $_SESSION["ajout_hist"] = true;
    //header("Location: ../paragraphe_ajout.php");
    exit();
}
else{
    //Image de chat
}

