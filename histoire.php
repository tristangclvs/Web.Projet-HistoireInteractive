<?php include("entete.php");

$verif = "SELECT * FROM histoire WHERE id =?";
$prep = $BDD -> prepare($verif);
$prep-> execute(array($_GET['id']));
$ligne = $prep->fetch();
//titre,categorie,auteur,annee,description,image

?>

<div class="container">
    <div class="row">
        <div class="col-md-5 col-sm-7 ml-2">
            <img class="img-fluid histoireImage w-30 h-30" src="images/<?=$ligne['image']?>" title="<?=$ligne['titre']?>" />
        </div>
        <div class="col-md-7 col-sm-5 mr-2 pl-1">
            <h2><?=$ligne['titre']?></h2>
            <p><?=$ligne['auteur']?>, <?=$ligne['annee']?></p>
            <p><small><?=$ligne['description']?></small></p>
            </h2>
            <?php if($_SESSION["connected"]){
                ?>
                <br>
                <div class="container">
                    <button onclick="location.href='paragraphe.php?id=1'" type="button" class="btn btn-sucess btn-outline-light">Commencer l'histoire</button>
                </div>
            <?php }?>
        </div>
    </div>
</div>

<?php include("footer.php") ?>

