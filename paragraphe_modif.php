<?php include("entete.php");

$verif_parag = "SELECT * FROM `paragraphe` WHERE id_histoire =? AND parag_numero=?";
$prep_parag = $BDD -> prepare($verif_parag);
$prep_parag-> execute(array($_GET['numHist'],$_GET['numParag']));
$ligne_parag = $prep_parag->fetch();

if($_SESSION['connected']){?>
    <div class="text-center"><h2>Modifier le paragraphe :</h2></div>

    <br>
    <div class="container mx-auto" id="containerConnexion" style="width:30%;">
        <fieldset class="border border-light border-2 rounded">
            <form role="form" id="formParag" class="px-4 py-3" method="post" enctype="multipart/form-data" action="scripts/script_modifParagraphe.php?numParag=<?=$_GET["numParag"]?>&numHist=<?=$_GET['numHist']?>">
                <div class="mb-3">
                    <label for="FormTitre" class="form-label">Titre du paragraphe</label>
                    <input type="text" name="titre_parag0" value="<?=$ligne_parag['parag_nom']?>" class="form-control" id="FormTitreParag" placeholder="Titre du paragraphe" required>
                </div>
                <div class="mb-3">
                    <label for="ParagNumero" class="form-label">Numéro du paragraphe</label>
                    <input type="number" name="numero_parag0" value="<?=$ligne_parag['parag_numero']?>" class="form-control" id="ParagNumero" placeholder="Numéro du paragraphe" required>
                </div>
                <div class="mb-3">
                    <label for="ParagContenu" class="form-label">Contenu</label>
                    <textarea type="textarea" name="contenu_parag" class="form-control" id="ParagContenu" required><?=$ligne_parag['parag_contenu']?></textarea>
                </div>

                <div class="mb-3 ">
                    <label for="TextImage" class="form-label custom-file-label">Image <small>(facultative)</small></label>
                    <input type="file" name="image" class="form-control custom-file-input" id="TextImage">
                </div>

                <div class="dropdown-divider bg-light mb-3"></div>

                <button type="submit" class="btn text-white mb-2 button" >Modifier le paragraphe</button>
                <br>
            </form>
        </fieldset>
    </div>

<?php }
else {?>
    <img src="images/chat.jpg" alt="Tu t'es fait piégé eh oui !"/>
<?php }?>



<?php include("footer.php")?>
