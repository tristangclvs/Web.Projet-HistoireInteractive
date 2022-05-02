<?php include("entete.php");

$verif = "SELECT * FROM paragraphe WHERE id =?";
$prep = $BDD -> prepare($verif);
$prep-> execute(array($_GET['id']));
$ligne = $prep->fetch();
//titre,categorie,auteur,annee,description,image

?>
<div class="text-center"><h2><?=$ligne["parag_nom"]?></h2></div>
<div class="container text-white border border-light rounded ">
    <?php echo $ligne["parag_image"]; ?>
    <p class="p-3"><?=$ligne['parag_contenu'] ?> </p>
</div>

<?php
$requete = "SELECT * FROM lien WHERE id_parag_debut =? AND id_histoire=?";
$prep = $BDD -> prepare($requete);
$prep-> execute(array($_GET['id'], $_SESSION['id_histoire_enCours']));
$tab = $prep->fetchAll();
foreach ($tab as $key => $ligne) { ?>

    <button onclick="location.href='paragraphe.php?id=<?=$ligne['id_parag_cible']?>'" type="button" class="btn btn-sucess btn-outline-primary"><?=$ligne['lien_nomaction']?></button>


    <?php
}
?>

<?php include("footer.php") ?>
