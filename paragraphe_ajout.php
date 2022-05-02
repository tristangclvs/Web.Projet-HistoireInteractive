<?php include("entete.php") ?>

<?php
if (isset($_SESSION["ajout_parag"])){
    if ($_SESSION["ajout_parag"]){
        ?>
        <div class="alert alert-success text-center"><span style="font-weight: bold">Bravo ! </span>Le paragraphe n°<?=$_SESSION["numero_parag"]?> a été ajouté</div>
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
        <form id="formParag" class="px-4 py-3" method="post" enctype="multipart/form-data" action="scripts/script_ajoutParagraphe.php">
            <div class="mb-3">
                <label for="FormTitre" class="form-label">Titre du paragraphe</label>
                <input type="text" name="titre_parag" class="form-control" id="FormTitreParag" placeholder="Titre du paragraphe" required>
            </div>
            <div class="mb-3">
                <label for="ParagNumero" class="form-label">Numéro du paragraphe</label>
                <input type="number" name="numero_parag" class="form-control" id="ParagNumero" placeholder="Numéro du paragraphe" required>
            </div>
            <div class="mb-3">
                <label for="ParagContenu" class="form-label">Contenu</label>
                <input type="textarea" name="contenu_parag" class="form-control" id="ParagContenu" placeholder="Contenu" required>
            </div>

            <div class="mb-3 ">
                <label for="TextImage" class="form-label custom-file-label">Image <small>(facultative)</small></label>
                <input type="file" name="image" class="form-control custom-file-input" id="TextImage">
            </div>

            <div class="dropdown-divider bg-light mb-3"></div>


            <div class="mb-3">
                <label for="FormAction1" class="form-label">Nom de l'action </label>
                <input type="text" name="titre_parag1" class="form-control" id="FormAction1" placeholder="Nom de l'action" required>
            </div>

            <div class="mb-3">
                <label for="ParagNumero1" class="form-label">Numéro du prochain paragraphe</label>
                <input type="number" name="numero_parag_cible1" class="form-control" id="ParagNumero1" placeholder="Numéro du paragraphe" required>
            </div>

            <div class="dropdown-divider bg-light mb-3"></div>
            <div id="nouveauxLiens">

            </div>

            <!--foreach pour compter le nombre de posts faits -->
            <button type="button" class="btn btn-text-white" id="boutonAjoutLien" aria-describedby="poursuivreLien"><h2>+</h2></button>
            <small id="poursuivreLien" class="text-muted text_white">
                Cliquer pour ajouter un nouveau lien ... </small>

            <div class="dropdown-divider bg-light mb-3"></div>

            <button type="submit" class="btn btn-success text-white" id="button" aria-describedby="poursuivreProchain">Ajout du prochain paragraphe</button>
            <small id="poursuivreProchain" class="text-muted text_white">
                Cliquer pour continuer ... </small>
            <button type="button" onclick='location.href="histoire.php?id=<?=$_GET['id']?>"' class="btn btn-danger text-white" id="button" aria-describedby="poursuivreDernier">Terminer l'histoire</button>

            <!-- Dans le onclick de ce bouton, créer un fichier histoire qui affiche l'histoire -->

            <small id="poursuivreDernier" class="text-muted text_white">
                Cliquer pour terminer ... </small>
        </form>
    </fieldset>
</div>



<?php include("footer.php")?>
