<?php include("entete.php");

if(isset($_GET['id'])){

// Selectionne l'histoire
$verif = "SELECT * FROM histoire WHERE id =?";
$prep = $BDD -> prepare($verif);
$prep-> execute(array($_GET['id']));
$ligne = $prep->fetch();
$nbVictoires = $ligne['nb_victoires'];
$nbDefaites = $ligne['nb_defaites'];
$nbPartiesJouees = $nbVictoires+$nbDefaites;

// Selectionne le paragraphe
$verif_parag = "SELECT * FROM `paragraphe` WHERE id_histoire =?";
$prep_parag = $BDD -> prepare($verif_parag);
$prep_parag-> execute(array($_GET['id']));
$ligne_parag = $prep_parag->fetch();

$_SESSION['id_histoire_enCours'] = $_GET['id'];

// Selectionne
if (isset($_SESSION["modif_hist"])){
    if ($_SESSION["modif_hist"]) { ?>
        <div class="alert alert-success text-center"><span style="font-weight: bold">Bravo ! </span>L'histoire a été modifiée avec succès !</div><br>
        <?php
        $_SESSION["modif_hist"] = false;
    }
}
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
                    <button onclick="location.href='paragraphe.php?id=<?=$ligne_parag['parag_numero']?>'" type="button" class="btn btn-outline-light mb-2">Commencer l'histoire</button>

                    <table class="table">
                        <thead>
                        <tr>
                            <th class="text-center" scope="col">Nombre de parties jouées</th>
                            <th class="text-center" scope="col">Taux de réussite</th>
                            <th class="text-center" scope="col">Taux de défaite</th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-center"><?=$nbPartiesJouees?></td>
                                <td class="text-center"><?=$nbVictoires/$nbPartiesJouees*100?>%</td>
                                <td class="text-center"><?=$nbDefaites/$nbPartiesJouees*100?>%</td>
                            </tr>
                        </tbody>
                    </table>
                    <?php if ($_SESSION["admin"] == 1){?>

                        <hr>
                        <div class="container d-flex justify-content-center p-0">
                            <form action="histoire_modif.php?id=<?=$_GET['id']?>" method="post">
                                <button type="submit" class="btn btn-outline-warning me-3">Modifier l'histoire</button>
                            </form>
                            <form action="liste_paragraphe.php?id=<?=$_GET['id']?>" method="post">
                                <button type="submit" class="btn btn-outline-info mx-3">Modifier les paragraphes</button>
                            </form>
                            <form action="scripts/script_suppressionHistoire.php?id=<?=$_GET['id']?>" method="post">
                                <button type="submit" class="btn btn-outline-danger ms-3">Supprimer l'histoire</button>
                            </form>




                        </div>
                    <?php }?>
                </div>
            </div>
        </div>
    </div>
<?php }
} include("footer.php") ?>

