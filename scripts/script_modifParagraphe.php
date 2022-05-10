<?php
session_start();
include("connect.php");
// Première requete, selectionne le paragraphe qu'il souhaite modifier
$verif_parag = "SELECT * FROM `paragraphe` WHERE id_histoire =? AND parag_numero=?";
$prep_parag = $BDD -> prepare($verif_parag);
$prep_parag-> execute(array($_GET['numHist'],$_GET['numParag']));
$ligne_parag = $prep_parag->fetch();

if($_SESSION['connected'] && $_SESSION['admin']==1){
    if(isset($_POST["titre_parag0"])){
        $titre_parag = htmlspecialchars($_POST["titre_parag0"], ENT_QUOTES, 'UTF-8', false);
        $numero_parag =  htmlspecialchars($_POST["numero_parag0"], ENT_QUOTES, 'UTF-8', false);
        $contenu_parag = htmlspecialchars($_POST["contenu_parag"], ENT_QUOTES, 'UTF-8', false);
        $id_histoire = $_GET['numHist'];
        if ($_FILES["image"]["type"]!="")
        {
            $image = basename($_FILES['image']['name']);
            $dossier = '../images/';
            $extensions = array('.png', '.gif', '.jpg', '.jpeg');
            $extension = strrchr($_FILES['image']['name'], '.');
            if(!in_array($extension, $extensions))
            {
                $erreur = 'Vous devez uploader un fichier de type png, gif, jpg ou jpeg...';
            }
            if(!isset($erreur))
            {
                $fichier = htmlspecialchars($image, ENT_QUOTES, 'UTF-8', false);
                if(move_uploaded_file($_FILES['image']['tmp_name'], $dossier . $fichier)) {

                    //deuxieme requete : Modification de l'histoire dans la BDD (avec image)
                    $sqlVerif = "UPDATE `paragraphe` SET parag_numero=? ,parag_nom=?,parag_contenu=?,parag_image=? WHERE id_histoire =? AND parag_numero=?";
                    $response = $BDD->prepare($sqlVerif);
                    $response->execute(array($numero_parag, $titre_parag, $contenu_parag,$fichier,$_GET['numHist'],$_GET['numParag']));

                }
                else {
                    echo 'Echec de l\'upload !';
                }
            }
        }
        else{
            //deuxieme requete : Modification de l'histoire dans la BDD (sans image)
            $sqlVerif = "UPDATE `paragraphe` SET parag_numero=? ,parag_nom=?,parag_contenu=? WHERE id_histoire =? AND parag_numero=?";
            $response = $BDD->prepare($sqlVerif);
            $response->execute(array($numero_parag, $titre_parag, $contenu_parag,$_GET['numHist'],$_GET['numParag']));
        }
    }
    $id_histoire =$_GET['numHist'];
    header('Location: ../liste_paragraphe.php?id='.$id_histoire);
    exit();
}
header('Location: ../index.php');



