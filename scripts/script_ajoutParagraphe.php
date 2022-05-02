<?php
session_start();
include("connect.php");
$nbPOSTS = 1;
// Demander à Gabriel s'il faut vérifier tous les isset sachant qu'on est avec des required
if (isset($_POST["titre_parag"]) )
{
    // Variables
    $titre_parag =$_POST["titre_parag"];
    $numero_parag = $_POST["numero_parag"];
    $contenu_parag = $_POST["contenu_parag"];
    $id_histoire = $_SESSION["id_histoire"];

    // Gestion de l'image après
    if (isset($_POST["image"]))
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
            //deuxieme requete : Création de l'histoire dans la BDD
            $fichier = $_FILES['image']['name'];
            if(move_uploaded_file($_FILES['image']['tmp_name'], $dossier . $fichier)) {
                //deuxieme requete : Création de l'histoire dans la BDD
                $sqlVerif = "INSERT INTO paragraphe(parag_numero,id_histoire,parag_nom,parag_contenu,parag_image) VALUES (?,?,?,?,?)";
                $response = $BDD->prepare($sqlVerif);
                $response->execute(array($numero_parag, $id_histoire, $titre_parag, $contenu_parag,$fichier));

            }
            else {
                echo 'Echec de l\'upload !';
            }
        }
    }
    else{
        $sqlVerif = "INSERT INTO paragraphe(parag_numero,id_histoire,parag_nom,parag_contenu) VALUES (?,?,?,?)";
        $response = $BDD->prepare($sqlVerif);
        $response->execute(array($numero_parag, $id_histoire, $titre_parag, $contenu_parag));
    }


    foreach ($_POST as $key => $val)
    {
        $nbPOSTS++;
    }

    $nbPOSTSSupp = $nbPOSTS - 6;
    for($i=0;$i<$nbPOSTSSupp;$i++)
    {
        // Ajout dans la table lien
        $nom_action =$_POST["titre_parag$i"];
        $id_parag_cible = $_POST["numero_parag_cible$i"];

        $sqlVerif = "INSERT INTO paragraphe(id_parag_debut,id_parag_cible,lien_nomaction,id_histoire) VALUES (?,?,?,?)";
        $response = $BDD->prepare($sqlVerif);
        $response->execute(array($numero_parag,$id_parag_cible ,$nom_action , $titre_parag,$id_histoire));
    }
    $_SESSION["num_parag"] = $numero_parag;
    $_SESSION["ajout_parag"] = true;
    header("Location: ../paragraphe_ajout.php");
    exit();


}
else
{?>
    <img src="../images/chat.png" alt="Tu t'es fais piégé"/>
<?php } ?>