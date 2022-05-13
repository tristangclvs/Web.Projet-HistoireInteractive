<?php
// Selectionne le chemin en cours
$reqChemin = "SELECT * FROM parcours_user WHERE id_user = ? AND id_histoire=?";
$prepChemin = $BDD -> prepare($reqChemin);
$prepChemin-> execute(array($_SESSION["id_user"], $_SESSION['id_histoire_enCours']));

//Vérifie s'il existe déjà un chemin pour cette histoire
if ($prepChemin->rowCount()==0){
// Si non, en crée un
    $verifChemin = "INSERT INTO `parcours_user`(id_histoire,id_user,chemin,id_dernierParagraphe) VALUES (?,?,?,?)";
    $prepChemin = $BDD -> prepare($verifChemin);
    $newChemin = $ligne['parag_nom'];
    $prepChemin -> execute(array($_SESSION['id_histoire_enCours'],$_SESSION["id_user"],$newChemin, $id_parag));
}
else{
// Si oui, le modifie
    $ligneChemin = $prepChemin -> fetch();
    if($ligneChemin['id_dernierParagraphe'] != $id_parag){
        // histoire non terminée, on peut ajouter selon ce qui était déjà défini
        if($ligneChemin['parcours_termine'] == 0){
            $verifParcours= "UPDATE parcours_user SET id_dernierParagraphe=?, chemin=? WHERE id_user=? AND id_histoire=? ";
            $prepParcours = $BDD -> prepare($verifParcours);
            $nouveauChemin = $ligneChemin['chemin'] . '&nbsp; <i class="fa-solid fa-arrow-right"></i>&nbsp; ' . $ligne["parag_nom"];
            $prepParcours -> execute(array($id_parag , $nouveauChemin, $_SESSION["id_user"], $_SESSION['id_histoire_enCours']));
        }
        else{
            $verifParcours= "UPDATE parcours_user SET id_dernierParagraphe=?, chemin=?,parcours_termine=? WHERE id_user=? AND id_histoire=? ";
            $prepParcours = $BDD -> prepare($verifParcours);
            $nouveauChemin = $ligne["parag_nom"];
            $prepParcours -> execute(array($id_parag , $nouveauChemin, 0 , $_SESSION["id_user"], $_SESSION['id_histoire_enCours']));

        }


    }
}
