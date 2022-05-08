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

    <h2 class="text-white"><u>Histoires cachées</u></h2>
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


