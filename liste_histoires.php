<?php include("entete.php");
$requete = "SELECT * FROM histoire";
$resultat = $BDD -> query($requete);
$n = $resultat -> rowCount();

$tab = $resultat->fetchAll();


if ($_SESSION["connected"]){
    foreach ($tab as $key => $ligne) {
        ?>
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <div class="col ">
                <div class="card h-100">
                    <img src="..." class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title text-dark"><?=$ligne['titre'] ?> </h5>
                        <p class="card-text text-dark"> <?=$ligne['description'] ?> </p>
                    </div>
                    <div class="card-footer text-end">
                        <small class="text-muted"><?=$ligne['auteur'] ?>, <?=$ligne['annee'] ?></small>
                    </div>
                </div>
            </div>
        </div>

        <?php     echo $ligne["titre"];
    }}  ?>

<?php include("footer.php") ?>


