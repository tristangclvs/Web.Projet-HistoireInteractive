<?php include("entete.php");

if($_SESSION['connected']){
if (isset($_SESSION["ajout_parag"])){
    if ($_SESSION["ajout_parag"]){
        ?>
        <div class="alert alert-success text-center"><span style="font-weight: bold">Bravo ! </span>Le paragraphe n°<?=$_SESSION["num_parag"]?> a été ajouté</div>
        <br>
        <?php
    }
}
$_SESSION["ajout_parag"] = false;
?>


<!-- Si il n'est pas connecté, il ne peut accéder a cette page-->

<div class="text-center"><h2>Ajout d'un paragraphe :</h2></div>

<br>
<div class="container mx-auto" id="containerConnexion" style="width:30%;">
    <fieldset class="border border-light border-2 rounded">
        <form id="formParag" class="px-4 py-3" method="post" enctype="multipart/form-data" action="scripts/script_ajoutParagraphe.php?finHistoire=0">
            <div class="mb-3">
                <label for="FormTitre" class="form-label">Titre du paragraphe</label>
                <input type="text" name="titre_parag0" class="form-control" id="FormTitreParag" placeholder="Titre du paragraphe" required>
            </div>
            <div class="mb-3">
                <label for="ParagNumero" class="form-label">Numéro du paragraphe</label>
                <input type="number" name="numero_parag0" class="form-control" id="ParagNumero" placeholder="Numéro du paragraphe" required>
            </div>
            <div class="mb-3">
                <label for="ParagContenu" class="form-label">Contenu</label>
                <!--<input type="textarea" name="contenu_parag" class="form-control" id="ParagContenu" placeholder="Contenu" required>-->
                <textarea type="textarea" name="contenu_parag" class="form-control" id="ParagContenu" required></textarea>
            </div>

            <div class="mb-3 ">
                <label for="TextImage" class="form-label custom-file-label">Image <small>(facultative)</small></label>
                <input type="file" name="image" class="form-control custom-file-input" id="TextImage">
            </div>

            <div class="dropdown-divider bg-light mb-3"></div>
            <!-- C'est ici -->
            <div class="mb-3 form-group">
                <label for="choixSuite" class="form-label">Suite de l'histoire: </label>
                <select name="ajoutOuNon" id="choixSuite" class="form-select text-dark">
                    <option value="continuer" selected>Continuer</option>
                    <option value="victoire">Victoire</option>
                    <option value="defaite">Défaite</option>
                </select>
            </div>

            <div id="suiteParag" style="display: block;">
                <div class="mb-3">
                    <label for="FormAction1" class="form-label">Nom de l'action </label>
                    <input type="text" name="titre_parag1" class="form-control" id="FormAction1" placeholder="Nom de l'action" >
                </div>

                <div class="mb-3">
                    <label for="ParagNumero1" class="form-label">Numéro du prochain paragraphe</label>
                    <input type="number" name="numero_parag_cible1" class="form-control" id="ParagNumero1" placeholder="Numéro du paragraphe" >
                </div>

                <div class="dropdown-divider bg-light mb-3"></div>
                <div id="nouveauxLiens">

                </div>

                <!--foreach pour compter le nombre de posts faits -->
                <button type="button" class="btn btn-text-white" id="boutonAjoutLien" aria-describedby="poursuivreLien"><h2>+</h2></button>
                <small id="poursuivreLien" class="text-muted text_white">
                    Cliquer pour ajouter un nouveau lien ... </small>
            </div>
            <div class="dropdown-divider bg-light mb-3"></div>

            <button type="submit" formaction="scripts/script_ajoutParagraphe.php?finHistoire=0" class="btn btn-success text-white mb-2 button"  aria-describedby="poursuivreProchain">Ajout du prochain paragraphe</button>

            <br>
            <button type="submit" formaction="scripts/script_ajoutParagraphe.php?finHistoire=1" class="btn btn-danger text-white button" aria-describedby="poursuivreDernier">Terminer l'histoire</button>

        </form>
    </fieldset>
</div>

<?php $_SESSION["finHistoire"]=false; ?>
<?php }
include("footer.php")?>
