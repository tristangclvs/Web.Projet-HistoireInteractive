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
if ($nbPartiesJouees == 0){ $nbPartiesJouees = 1; } // éviter de diviser par zéro

// Selectionne le paragraphe
$verif_parag = "SELECT * FROM `paragraphe` WHERE id_histoire =?";
$prep_parag = $BDD -> prepare($verif_parag);
$prep_parag-> execute(array($_GET['id']));
$ligne_parag = $prep_parag->fetch();

// Sélectionne le dernier chemin parcouru
$reqChemin = "SELECT * FROM parcours_user WHERE id_histoire = ? AND id_user = ?";
$prepChemin = $BDD -> prepare($reqChemin);
$prepChemin -> execute(array($_GET['id'],$_SESSION["id_user"]));
$ligneChemin = $prepChemin -> fetch();

$_SESSION['id_histoire_enCours'] = $_GET['id'];

// Selectionne
if (isset($_SESSION["modif_hist"])){
    if ($_SESSION["modif_hist"]) { ?>
        <div class="alert alert-success text-center"><span style="font-weight: bold">Bravo ! </span>L'histoire a été modifiée avec succès !</div><br>
        <?php
        $_SESSION["modif_hist"] = false;
    }
}
    if (isset($_SESSION["erreur_histoire"])){
        if ($_SESSION["erreur_histoire"]) { ?>
            <div class="alert alert-danger text-center"><span style="font-weight: bold">Attention ! </span>Le paragraphe que vous essayez d'atteindre n'est pas disponible, veuillez contacter un administrateur !</div><br>
            <?php
            $_SESSION["erreur_histoire"] = false;
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
                                <td class="text-center"><?=round($nbVictoires/$nbPartiesJouees*100)?>%</td>
                                <td class="text-center"><?=round($nbDefaites/$nbPartiesJouees*100)?>%</td>
                            </tr>
                        </tbody>
                    </table>
                    <?php
                    if ($prepChemin -> rowCount() != 0){ ?>
                        <table class="table">
                            <thead>
                            <tr>
                                <th class="text-center" scope="col">Votre dernière partie</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td class="text-center"><?=$ligneChemin['chemin']?></td>
                            </tr>
                            </tbody>
                        </table>
                        <?php
                    }
                    ?>




                    <?php if ($_SESSION["admin"] == 1){?>

                        <hr>
                        <div class="container d-flex justify-content-center p-0">
                            <form role="form" action="histoire_modif.php?id=<?=$_GET['id']?>" method="post">
                                <button type="submit" class="btn btn-outline-warning me-3">Modifier l'histoire</button>
                            </form>
                            <form role="form" action="liste_paragraphe.php?id=<?=$_GET['id']?>" method="post">
                                <button type="submit" class="btn btn-outline-info mx-3">Modifier les paragraphes</button>
                            </form>
                            <form role="form" action="scripts/script_suppressionHistoire.php?id=<?=$_GET['id']?>" method="post">
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

