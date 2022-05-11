<?php include("entete.php");
$idMarquePage =0;

if ($_SESSION["connected"]) {
    if(isset($_GET['id']) && isset($_SESSION['id_histoire_enCours'])){
        $id_parag = htmlspecialchars($_GET['id']);


        $reqParag = "SELECT * FROM paragraphe WHERE id_histoire=? AND parag_numero=?";
        $prepParag = $BDD -> prepare($reqParag);
        $prepParag -> execute(array($_SESSION['id_histoire_enCours'],$id_parag));
        $ligneParag = $prepParag ->fetch();


        $verifExistence = "SELECT * FROM marquePage WHERE id_user = ?";
        $prep = $BDD -> prepare($verifExistence);
        $prep-> execute(array($_SESSION["id_user"]));
        $tab = $prep->fetchAll();
        $test = false;

        //$n = $prep->rowCount();
        foreach ($tab as $key => $ligneMarquePage ){
            $verif = "SELECT * FROM paragraphe WHERE id=?";
            $prep = $BDD -> prepare($verif);
            $prep-> execute(array($ligneMarquePage["id_paragraphe"]));
            $ligne = $prep->fetch();

            if($ligne['id_histoire']==$_SESSION['id_histoire_enCours']){
                $verifUser= "UPDATE marquePage SET id_paragraphe=? WHERE id_user=? AND id_paragraphe=? ";
                $prepUser = $BDD -> prepare($verifUser);
                $prepUser -> execute(array($ligneParag["id"],$_SESSION["id_user"],$ligneMarquePage['id_paragraphe']));

                $idMarquePage = $ligneMarquePage['id'];
                $test = true;
                break;
            }
        }
        if ($test == false){
            $verifReq = "INSERT INTO `marquePage`(id_paragraphe,id_user) VALUES (?,?)";
            $prepReq = $BDD -> prepare($verifReq);
            $prepReq -> execute(array($ligneParag['id'],$_SESSION["id_user"]));
            $idMarquePage = $BDD->lastInsertId();
        }


        $verif = "SELECT * FROM paragraphe WHERE parag_numero =? AND id_histoire = ?";
        $prep = $BDD -> prepare($verif);
        $prep-> execute(array($_GET['id'],$_SESSION['id_histoire_enCours']));
        $ligne = $prep->fetch();

        ?>
<?php include("scripts/script_MAJ_Chemin.php"); ?>

        <div class="text-center"><h2><?=$ligne["parag_nom"]?></h2></div>
        <div class="container text-white  ">
            <div class="row">
                <?php if ($ligne['parag_image']!=NULL){?>
                    <div class="col-md-5 col-sm-7 ml-2 d-flex">
                        <img class="img-fluid histoireImage w-30 h-30" src="images/<?=$ligne['parag_image']?>" alt="<?=$ligne['parag_nom']?>" />
                    </div>
                <?php }?>

                <div class="col-md-7 col-sm-5 mr-2 pl-1">
                    <p class="p-3"><?=$ligne['parag_contenu'] ?> </p>
                </div>

                <div class="d-flex justify-content-around  mt-4">
                    <?php
                    // Si on a indiqué qu'il y aurait une suite au paragraphe
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
                        <button onclick="location.href='victoire.php?id=<?=$idMarquePage?>'" type="button" class="btn btn-outline-success">Continuer</button>

                    <?php }
                    else{ ?>
                        <button onclick="location.href='defaite.php?id=<?=$idMarquePage?>'" type="button" class="btn btn-outline-warning">Continuer</button>
                    <?php }
                    ?>
                </div>
            </div>
        </div>


    <?php } ?>
<?php }
include("footer.php") ?>
