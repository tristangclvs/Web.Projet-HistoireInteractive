<?php include("entete.php");

// Selectionne l'histoire
$verif = "SELECT * FROM histoire WHERE id =?";
$prep = $BDD -> prepare($verif);
$prep-> execute(array($_GET['id']));
$ligne = $prep->fetch();

// Selectionne le paragraphe
$verif_parag = "SELECT * FROM `paragraphe` WHERE id_histoire =?";
$prep_parag = $BDD -> prepare($verif_parag);
$prep_parag-> execute(array($_GET['id']));
$ligne_parag = $prep_parag->fetch();

$_SESSION['id_histoire_enCours'] = $_GET['id'];

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
                    <button onclick="location.href='paragraphe.php?id=<?=$ligne_parag['parag_numero']?>'" type="button" class="btn btn-outline-light">Commencer l'histoire</button>
                    <?php if ($_SESSION["admin"] == 1){?>
                        <br>
                        <br>
                        <hr>
                        <div class="container d-flex justify-content-center p-0">
                            <form action="histoire_modif.php?id=<?=$_GET['id']?>" method="post">
                                <button type="submit" class="btn btn-outline-warning me-3">Modifier l'histoire</button>
                            </form>
                            <form action="liste_paragraphe.php?id=<?=$_GET['id']?>" method="post">
                                <button type="submit" class="btn btn-outline-info mx-3">Modifier les paragraphes</button>
                            </form>
                            <form action="scripts/script_suppression_hist.php?id=<?=$_GET['id']?>" method="post">
                                <button type="submit" class="btn btn-outline-danger ms-3">Supprimer l'histoire</button>
                            </form>




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

