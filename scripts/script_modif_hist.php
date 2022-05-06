<?php
session_start();
include("connect.php");

$idHist = $_GET['id'];

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
        header('location: ../histoire_modif.php?id='.$idHist);
        exit();
    }

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
                $sqlVerif = "UPDATE `histoire` SET titre=? ,categorie=?,auteur=?,annee=?,description=?,image=? WHERE id=?";
                $response = $BDD->prepare($sqlVerif);
                $response->execute(array($histTitre, $histCategorie, $histAuteur, $histAnnee,$histDescription,$fichier,$idHist));
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
        $sqlVerif = "UPDATE `histoire` SET titre=? ,categorie=?,auteur=?,annee=?,description=? WHERE id=?";
        $response = $BDD->prepare($sqlVerif);
        $response->execute(array($histTitre, $histCategorie, $histAuteur, $histAnnee,$histDescription,$idHist));

    }

    $_SESSION["modif_hist"] = true;
    header('location: ../histoire.php?id='.$idHist);
    exit();
}
else{?>
    <img src="../images/chat.jpg" alt="Tu t'es fait piégé eh oui !"/>
<?php }?>


