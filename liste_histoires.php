<?php include("entete.php");
$requete = "SELECT * FROM histoire";
$resultat = $BDD -> query($requete);
$n = $resultat -> rowCount();

$tab = $resultat->fetchAll();
if (isset($_SESSION['suppresion_hist'])){
    if ($_SESSION['suppresion_hist']){
        ?>
        <div class="alert alert-danger text-center"><span style="font-weight: bold">Bravo ! </span>L'histoire a bien été supprimée</div>
        <br>
        <?php
    }
}
$_SESSION['suppresion_hist'] = false;
?>

<div class="row row-cols-1 row-cols-md-3 row-cols-lg-5 p-3">
    <?php
    if ($_SESSION["connected"]){
    $response = include("scripts/script_verifMarquePage.php");
    $tabMarquePage = $response -> fetchAll();
    $nombreHistoireEnCours = $response->rowCount();

    if($nombreHistoireEnCours!=0){
        foreach ($tabMarquePage as $key => $ligne){
            $requete2 = "SELECT * FROM paragraphe WHERE id=?";
            $response2 = $BDD->prepare($requete2);
            $response2 -> execute(array(intval($ligne["id_paragraphe"])));
            
            $ligneParagraphe= $response2 -> fetch();
        

            $requete3 = "SELECT * FROM histoire WHERE id=?";
            $response3 = $BDD->prepare($requete3);
            $response3 -> execute(array($ligneParagraphe['id_histoire']));
            $ligneHistoire = $response3 -> fetch();
            ?>
            <div class="col mb-4 ">
                <div class="card h-100 cardHist ">
                    <?php if ($ligneHistoire['image'] != null){ ?>
                        <img src="images/<?=$ligneHistoire['image']?>" class="card-img-top" alt="...">
                    <?php }
                    else{?>
                        <img src="images/book.png" class="card-img-top" alt="...">
                    <?php } ?>
                    <div class="card-body">
                        <h5 class="card-title text-dark "> <a class="linkHist" href="scripts/script_HistoireEnCours.php?idParag=<?=$ligne['id_paragraphe']?>&idHist=<?=$ligneHistoire['id']?>"> <?=$ligneHistoire['titre'] ?></a></h5>
                        <p class="card-text text-dark"> <?=$ligneHistoire['description'] ?></p>
                    </div>
                    <div class="card-footer text-end">
                        <small class="text-muted"><?=$ligneHistoire['auteur'] ?>, <?=$ligneHistoire['annee'] ?></small>
                    </div>
                </div>
            </div>

        <?php
        }
        ?>

        <div class="col mb-4 ">

        </div>

    <?php }?>
    <br>
    <h2 class="text-white titreCategories">&nbsp;&nbsp; <u>Histoires en cours</u></h2>
    <?php
    foreach ($tab as $key => $ligne) {
        if ($ligne["hidden"] == 0){
            ?>
            <div class="col mb-4 ">
                <div class="card h-100 cardHist ">
                    <?php if ($ligne['image'] != null){ ?>
                        <img src="images/<?=$ligne['image']?>" class="card-img-top" alt="...">
                    <?php }
                    else{?>
                        <img src="images/book.png" class="card-img-top" alt="...">
                    <?php } ?>
                    <div class="card-body">
                        <h5 class="card-title text-dark "> <a class="linkHist" href="histoire.php?id=<?=$ligne['id'] ?>"> <?=$ligne['titre'] ?></a></h5>

                        <p class="card-text text-dark"> <?=$ligne['description'] ?></p>

                        <?php
                        if ($_SESSION["admin"]){?>
                            <form action="scripts/script_cacherHistoire.php?id=<?=$ligne['id']?>" method="post">
                                <button type="submit" class="btn btn-outline-dark">Cacher l'histoire</button>
                            </form>
                            <?php
                        }
                        ?>
                    </div>
                    <div class="card-footer text-end">
                        <small class="text-muted"><?=$ligne['auteur'] ?>, <?=$ligne['annee'] ?></small>
                    </div>
                </div>
            </div>
            <?php
        }} ?>
</div>
<?php if ($_SESSION["admin"]==1){ ?>
<br>
    <h2 class="text-white titreCategories">&nbsp;&nbsp; <u>Histoires cachées</u></h2>
<div class="row row-cols-1 row-cols-md-3 row-cols-lg-5 p-3">
    <?php
    foreach ($tab as $key => $ligne) {
        if ($ligne["hidden"] == 1){
            ?>
            <div class="col mb-4 ">
                <div class="card h-100 cardHist ">
                    <?php if ($ligne['image'] != null){ ?>
                        <img src="images/<?=$ligne['image']?>" class="card-img-top" alt="...">
                    <?php }
                    else{?>
                        <img src="images/book.png" class="card-img-top" alt="...">
                    <?php } ?>
                    <div class="card-body">
                        <h5 class="card-title text-dark "> <a class="linkHist" href="histoire.php?id=<?=$ligne['id'] ?>"> <?=$ligne['titre'] ?> </a></h5>

                        <p class="card-text text-dark"> <?=$ligne['description'] ?></p>

                        <?php
                        if ($_SESSION["admin"]){?>
                            <form action="scripts/script_cacherHistoire.php?id=<?=$ligne['id']?>" method="post">
                                <button type="submit" class="btn btn-outline-dark">Afficher l'histoire</button>
                            </form>
                            <?php
                        }
                        ?>
                    </div>
                    <div class="card-footer text-end">
                        <small class="text-muted"><?=$ligne['auteur'] ?>, <?=$ligne['annee'] ?></small>
                    </div>
                </div>
            </div>
            <?php
        }}
    }
    }  ?>
</div>
</div>
<?php include("footer.php") ?>


