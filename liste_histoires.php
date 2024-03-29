<?php include("entete.php");
$requete = "SELECT * FROM histoire";
$resultat = $BDD -> query($requete);
$n = $resultat -> rowCount();

$tab = $resultat->fetchAll();

if (isset($_SESSION['suppression_hist'])){
    if ($_SESSION['suppression_hist']){
        ?>
        <div class="alert alert-success text-center"><strong style="color:#0f5132">Bravo ! </strong>L'histoire a bien été supprimée</div>
        <br>
        <?php
    }
}

$_SESSION['suppression_hist'] = false;
?>
<?php
if ($_SESSION["connected"]){
$response = include("scripts/script_verifMarquePage.php");
$tabMarquePage = $response -> fetchAll();
$nombreHistoireEnCours = $response->rowCount();

if($nombreHistoireEnCours!=0){ ?>
    <h2 class="text-white titreCategories">&nbsp;&nbsp; <u>Reprendre avec le profil de <?=$_SESSION["nomUtilisateur"]?> </u></h2>

    <div class=" one row row-cols-1 row-cols-md-3 row-cols-lg-5 p-3">

        <?php
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
                            <img src="images/<?=$ligneHistoire['image']?>" class="card-img-top" alt="Image de <?=explode('.',$ligneHistoire['image'])[0]?>">
                        <?php }
                        else{?>
                            <img src="images/book.png" class="card-img-top" alt="Logo Fantastic Stories">
                        <?php } ?>
                        <div class="card-body">
                            <h5 class="card-title text-dark "> <a class="linkHist" href="scripts/script_HistoireEnCours.php?idParag=<?=$ligne['id_paragraphe']?>&idHist=<?=$ligneHistoire['id']?>"> <?=$ligneHistoire['titre'] ?> </a></h5>
                            <p class="card-text text-dark"> <?=$ligneHistoire['description'] ?></p>
                        </div>
                        <div class="card-footer text-end">
                            <small class="text-black"><?=$ligneHistoire['auteur'] ?>, <?=$ligneHistoire['annee'] ?></small>
                        </div>
                    </div>
                </div>

                <?php
            }

        ?>
    </div>
<?php }?>
    </div>
<br>
    <h2 class="text-white titreCategories">&nbsp;&nbsp; <u>Histoires disponibles</u></h2>
    <div class=" two row row-cols-1 row-cols-md-3 row-cols-lg-5 p-3">

        <?php
        foreach ($tab as $key => $ligne) {
            if ($ligne["hidden"] == 0){
                ?>
                <div class="col mb-4 ">
                    <div class="card h-100 cardHist ">
                        <?php if ($ligne['image'] != null){ ?>
                            <img src="images/<?=$ligne['image']?>" class="card-img-top" alt="image de <?=explode('.',$ligne['image'])[0]?>">
                        <?php }
                        else{?>
                            <img src="images/book.png" class="card-img-top" alt="Logo de Fantastic Stories">
                        <?php } ?>
                        <div class="card-body">
                            <h5 class="card-title text-dark "> <a class="linkHist" href="histoire.php?id=<?=$ligne['id']?>"> <?=$ligne['titre'] ?></a></h5>

                            <p class="card-text text-dark"> <?=$ligne['description'] ?></p>

                            <?php
                            if ($_SESSION["admin"]){?>
                                <form  role="form" action="scripts/script_cacherHistoire.php?id=<?=$ligne['id']?>" method="post">
                                    <button type="submit" class="btn btn-outline-dark">Cacher l'histoire</button>
                                </form>
                                <?php
                            }
                            ?>
                        </div>
                        <div class="card-footer text-end">
                            <small class="text-black"><?=$ligne['auteur'] ?>, <?=$ligne['annee'] ?></small>
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
                        <img src="images/<?=$ligne['image']?>" class="card-img-top" alt="image de <?=explode('.',$ligne['image'])[0]?>">
                    <?php }
                    else{?>
                        <img src="images/book.png" class="card-img-top" alt="Logo de Fantastic Stories">
                    <?php } ?>
                    <div class="card-body">
                        <h5 class="card-title text-dark "> <a class="linkHist" href="histoire.php?id=<?=$ligne['id'] ?>"> <?=$ligne['titre'] ?> </a></h5>

                        <p class="card-text text-dark"> <?=$ligne['description'] ?></p>

                        <?php
                        if ($_SESSION["admin"]){?>
                            <form role="form"  action="scripts/script_cacherHistoire.php?id=<?=$ligne['id']?>" method="post">
                                <button type="submit" class="btn btn-outline-dark">Afficher l'histoire</button>
                            </form>
                            <?php
                        }
                        ?>
                    </div>
                    <div class="card-footer text-end">
                        <small class="text-black"><?=$ligne['auteur'] ?>, <?=$ligne['annee'] ?></small>
                    </div>
                </div>
            </div>
            <?php
        }}
    }
    }  ?>
</div>
<?php include("footer.php") ?>


