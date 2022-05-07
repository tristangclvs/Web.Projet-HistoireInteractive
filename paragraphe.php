<?php include("entete.php");

if ($_SESSION["connected"]) {
    if(isset($_GET['id']) && isset($_SESSION['id_histoire_enCours'])){


    $verif = "SELECT * FROM paragraphe WHERE parag_numero =? AND id_histoire = ?";
$prep = $BDD -> prepare($verif);
$prep-> execute(array($_GET['id'],$_SESSION['id_histoire_enCours']));
$ligne = $prep->fetch();
//titre,categorie,auteur,annee,description,image
?>


<div class="text-center"><h2><?=$ligne["parag_nom"]?></h2></div>
<div class="container text-white  ">
    <div class="row">
        <?php if ($ligne['parag_image']!=NULL){ ?>
            <div class="col-md-5 col-sm-7 ml-2">
                <img class="img-fluid histoireImage w-30 h-30" src="images/<?=$ligne['parag_image']?>" alt="<?=$ligne['parag_nom']?>" />
            </div>
        <?php }?>

        <div class="col-md-7 col-sm-5 mr-2 pl-1">
            <p class="p-3"><?=$ligne['parag_contenu'] ?> </p>
        </div>
        <br>
        <div class="d-flex justify-content-around">
            <?php
            if($ligne["suiteHistoire"] == "continuer"){
                $requete = "SELECT * FROM lien WHERE id_parag_debut =? AND id_histoire=?";
                $prep = $BDD -> prepare($requete);
                $prep-> execute(array($_GET['id'], $_SESSION['id_histoire_enCours']));
                $tab = $prep->fetchAll();
                foreach ($tab as $key => $ligneLien) { ?>

                    <button onclick="location.href='paragraphe.php?id=<?=$ligneLien['id_parag_cible']?>'" type="button" class="btn btn-outline-info"><?=$ligneLien['lien_nomaction']?></button>


                    <?php
                }}
            else if($ligne["suiteHistoire"] == "victoire")
            {?>
                <button onclick="location.href='victoire.php'" type="button" class="btn btn-outline-success">Continuer</button>

            <?php }
            else{ ?>

                <button onclick="location.href='defaite.php'" type="button" class="btn btn-outline-warning">Continuer</button>
            <?php }
            ?>
        </div>
    </div>
</div>


<?php }    }
include("footer.php") ?>
