<?php include("entete.php") ;

if(!isset($_SESSION['connected']) || !isset($_GET['id']) ){
    header("Location: index.php");
}
// Selectionne l'histoire
$verif = "SELECT * FROM histoire WHERE id =?";
$prep = $BDD -> prepare($verif);
$prep-> execute(array($_SESSION['id_histoire_enCours']));
$ligne = $prep->fetch();
$nbVictTot = $ligne["nb_victoires"] + 1;

//Incrémenter le nombre de victoires
$verif = "UPDATE histoire SET nb_victoires=? WHERE id =?";
$prep = $BDD -> prepare($verif);
$prep-> execute(array($nbVictTot, $_SESSION['id_histoire_enCours']));

if(isset($_GET['id'])){
    $requete = 'DELETE FROM marquePage WHERE id=?';
    $response = $BDD->prepare($requete);
    $response->execute(array($_GET['id']));
}

$reqCheminSelect = "SELECT * FROM parcours_user WHERE id_user = ? AND id_histoire=?";
$prepCheminSelect = $BDD -> prepare($reqCheminSelect);
$prepCheminSelect-> execute(array($_SESSION["id_user"], $_SESSION['id_histoire_enCours']));
$ligneChemin = $prepCheminSelect->fetch();

//Définir le chemin comme étant terminé
$reqChemin = "UPDATE parcours_user SET chemin = ?, parcours_termine=? WHERE id_user = ? AND id_histoire=?";
$prepChemin = $BDD -> prepare($reqChemin);
$nouveauChemin = $ligneChemin['chemin'] . '&nbsp; <div  class="bg-success text-white ">VICTOIRE</div> ' ;

$prepChemin-> execute(array($nouveauChemin,1, $_SESSION["id_user"], $_SESSION['id_histoire_enCours']));

unset($_SESSION['id_histoire_enCours']);
?>
<br>
<br>
<img src="images/test.png" alt="logo victoire" class="zoomer mx-auto d-block"/>

<div class="text-center">
    <button type="button" onclick="location.href='liste_histoires.php'" class="btn btn-success text-white mb-2" id="button">Retour à la liste des histoires</button>
</div>


<?php include("footer.php")?>

