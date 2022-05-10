<?php
session_start();
include("connect.php");
$nbPOSTS = 1;

// Création du paragraphe dans la BDD
if(isset($_SESSION["ajout_hist"])){
    $id_histoire = $_SESSION["id_histoire"];
    if (isset($_POST["titre_parag0"]) )
    {
        // Variables
        $titre_parag = htmlspecialchars($_POST["titre_parag0"], ENT_QUOTES, 'UTF-8', false);
        $numero_parag =  htmlspecialchars($_POST["numero_parag0"], ENT_QUOTES, 'UTF-8', false);
        $contenu_parag = htmlspecialchars($_POST["contenu_parag"], ENT_QUOTES, 'UTF-8', false);


        $suite = $_POST["ajoutOuNon"];

        // Gestion de l'image (si il y en a une ou non)
        if ($_FILES["image"]["type"]!="")
        {
            $image = basename($_FILES['image']['name']);
            $suite = $_POST["ajoutOuNon"]; // ajout si continuer, non sinon
            $dossier = '../images/';
            $extensions = array('.png', '.gif', '.jpg', '.jpeg');
            $extension = strrchr($_FILES['image']['name'], '.');
            if(!in_array($extension, $extensions))
            {
                $erreur = 'Vous devez uploader un fichier de type png, gif, jpg ou jpeg...';
            }
            if(!isset($erreur))
            {
                //deuxieme requete : Création du paragraphe dans la BDD
                $fichier = htmlspecialchars($image, ENT_QUOTES, 'UTF-8', false);
                if(move_uploaded_file($_FILES['image']['tmp_name'], $dossier . $fichier)) {
                    //deuxieme requete : Création de l'histoire dans la BDD
                    $sqlVerif = "INSERT INTO `paragraphe`(parag_numero,id_histoire,parag_nom,parag_contenu,parag_image,suiteHistoire) VALUES (?,?,?,?,?,?)";
                    $response = $BDD->prepare($sqlVerif);
                    $response->execute(array($numero_parag, $id_histoire, $titre_parag, $contenu_parag,$fichier,$suite));
                }
                else {
                    echo 'Echec de l\'upload !';
                }
            }
        }
        else{
            //deuxieme requete : Création du paragraphe dans la BDD (sans image)
            $sqlVerif = "INSERT INTO paragraphe(parag_numero,id_histoire,parag_nom,parag_contenu,suiteHistoire) VALUES (?,?,?,?,?)";
            $response = $BDD->prepare($sqlVerif);
            $response->execute(array($numero_parag, $id_histoire, $titre_parag, $contenu_parag,$suite));
        }

        //Ajout des liens dans la BDD
        if($suite == "continuer"){
            // Récupération du nombre de liens (si l'histoire continue) et les parcourt
            foreach ($_POST as $key => $val)
            {
                $nbPOSTS++;
            }

            $nbPOSTSSupp = $nbPOSTS - 6;
            for($i=0;$i<=$nbPOSTSSupp;$i++)
            {
                // Ajout dans la table lien
                $nom_action =htmlspecialchars($_POST["titre_parag$i"], ENT_QUOTES, 'UTF-8', false);
                $id_parag_cible = htmlspecialchars($_POST["numero_parag_cible$i"], ENT_QUOTES, 'UTF-8', false);

                // Ajout du lien seulement si les infos sont remplies
                if($id_parag_cible!="" && $nom_action!=""){
                    $sqlVerif = "INSERT INTO lien(id_parag_debut,id_parag_cible,lien_nomaction,id_histoire) VALUES (?,?,?,?)";
                    $response = $BDD->prepare($sqlVerif);
                    $response->execute(array($numero_parag,$id_parag_cible ,$nom_action , $id_histoire));
                    echo 'Le paragraphe a bien été ajouté';
                }

            }
        }

        $_SESSION["num_parag"] = $numero_parag;
        $_SESSION["ajout_parag"] = true;

        if($_GET["finHistoire"]==1){
            //Si il a terminé l'ajout des paragraphes: affiche l'histoire
            unset($_SESSION["ajout_hist"]);
            header('Location: ../histoire.php?id='.$id_histoire);
            exit();
        }
        else{
            header("Location: ../paragraphe_ajout.php");
            exit();
        }

    }}
else
{?>
    <img src="../images/chat.png" alt="Tu t'es fais piéger"/>
<?php } ?>