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


?>



<div class="row row-cols-1 row-cols-md-3 g-4">
    <?php
    if ($_SESSION["connected"]){
        foreach ($tab as $key => $ligne) {
            ?>

            <div class="col ">
                <div class="card h-100">
                    <?php if ($ligne['image'] != null){ ?>
                        <img src="images/<?=$ligne['image']?>" class="card-img-top" alt="...">
                    <?php }
                    else{?>
                        <img src="images/book.png" class="card-img-top" alt="...">
                    <?php } ?>
                    <div class="card-body">

                        <h5 class="card-title text-dark"><a href="histoire.php?id=<?=$ligne['id'] ?>"> <?=$ligne['titre'] ?> </a></h5>
                        <p class="card-text text-dark"> <?=$ligne['description'] ?></p>
                    </div>
                    <div class="card-footer text-end">
                        <small class="text-muted"><?=$ligne['auteur'] ?>, <?=$ligne['annee'] ?></small>
                    </div>
                </div>
            </div>


            <?php
        }}  ?>
</div>
<?php include("footer.php") ?>


