<?php
include("entete.php");

// Selectionne le paragraphe
$verif_parag = "SELECT * FROM `paragraphe` WHERE id_histoire =?";
$prep_parag = $BDD -> prepare($verif_parag);
$prep_parag-> execute(array($_GET['id']));

$tab = $prep_parag->fetchAll();

if($_SESSION["connected"] && $_SESSION['admin']==1){
    ?>

    <div class="container d-flex justify-content-center">
        <table class="table" >
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nom du paragraphe</th>
                <th scope="col">Contenu</th>
                <th scope="col"></th>
            </tr>
            </thead>

            <tbody>
            <?php
            foreach ($tab as $key => $ligne) {
                ?>
                <tr class="tableParag align-middle">
                    <td> <?=$ligne["parag_numero"]?> </td>
                    <td> <?=$ligne["parag_nom"]?> </td>
                    <td> <?=$ligne["parag_contenu"]?> </td>
                    <td>
                        <form role="form" method="post" action="paragraphe_modif.php?numParag=<?=$ligne["parag_numero"]?>&numHist=<?=$_GET['id']?>">
                            <button class="btn btn-outline-light" type="submit">Modifier ce paragraphe</button> </form>
                    </td>
                </tr>

                <?php
            }  ?>

            </tbody>
        </table>


    </div>


<?php }
?>

<?php include("footer.php") ?>