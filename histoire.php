<?php include("entete.php");

// Selectionne l'histoire
$verif = "SELECT * FROM histoire WHERE id =?";
$prep = $BDD -> prepare($verif);
$prep-> execute(array($_GET['id']));
$ligne = $prep->fetch();
//titre,categorie,auteur,annee,description,image

// Selectionne

?>
<?php if($_SESSION["connected"]){?>
    <div class="container">
        <div class="row">
            <?php if ($ligne['image']!=NULL){ ?>
                <div class="col-md-5 col-sm-7 ml-2">
                    <img class="img-fluid histoireImage w-30 h-30" src="images/<?=$ligne['image']?>" alt="<?=$ligne['titre']?>" />
                </div>
            <?php }?>
            <div class="col-md-7 col-sm-5 mr-2 pl-1">
                <h2><?=$ligne['titre']?></h2>
                <p><?=$ligne['auteur']?>, <?=$ligne['annee']?></p>
                <p><small><?=$ligne['description']?></small></p>
                </h2>
                <br>
                <div class="container">
                    <button onclick="location.href='paragraphe.php?id=1' <?php $_SESSION['id_histoire_enCours'] = $_GET['id'];?>" type="button" class="btn btn-outline-light">Commencer l'histoire</button>
                    <?php if ($_SESSION["admin"] == 1){?>
                        <br>
                        <br>
                        <hr>
                        <div class="container d-flex justify-content-center p-0">
                            <button type="button" class="btn btn-outline-warning me-3">Modifier l'histoire</button>
                            <button type="button" class="btn btn-outline-danger ms-3">Supprimer l'histoire</button>
                        </div>
                    <?php }?>
                </div>
            </div>
        </div>
    </div>
<?php }
else {



}?>

<?php include("footer.php") ?>

