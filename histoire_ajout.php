<?php include("entete.php") ?>
<?php
if (isset($_SESSION["doublon_histoire"])){
    if ($_SESSION["doublon_histoire"]) { ?>
        <div class="alert alert-danger text-center"><span style="font-weight: bold">Erreur ! </span>L'histoire existe déjà ou le titre correspond à une histoire déjà existante.</div><br>
        <?php
        $_SESSION["doublon_histoire"] = false;
    }
}
if($_SESSION["connected"]){

?>
<!-- Si il n'est pas connecté, il ne peut accéder a cette page-->

<div class="text-center"><h2>Ajout d'une histoire :</h2></div>

<br>
<div class="container mx-auto" id="containerConnexion" style="width:30%;">
    <fieldset class="border border-light border-2 rounded">
        <form class="px-4 py-3" method="POST" enctype="multipart/form-data" action="scripts/script_ajoutHistoire.php">
            <div class="mb-3">
                <label for="FormTitre" class="form-label">Titre</label>
                <input type="text" name="titre" class="form-control" id="FormTitre" placeholder="Titre" required>
            </div>
            <div class="mb-3 form-group">
                <label for="choixCategories" class="form-label">Catégorie de l'histoire</label>
                <select name="categorie" id="choixCategories" class="form-select text-dark" style="color: black !important;">
                    <option value="horreur">Horreur</option>
                    <option value="romantique">Romantique</option>
                    <option value="action">Action</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="TextAuteur" class="form-label">Auteur</label>
                <input type="text" name="auteur" class="form-control" id="TextAuteur" placeholder="Auteur" value="<?=$_SESSION["nomUtilisateur"]?>">
            </div>
            <div class="mb-3">
                <label for="TextAnnee" class="form-label">Année de parution</label>
                <input type="number" name="annee" class="form-control" id="TextAnnee" placeholder="Annee" value="<?php $year = date("Y"); echo $year?>" required>
            </div>
            <div class="mb-3">
                <label for="TextDescription" class="form-label">Description</label>
                <textarea type="text" name="description" class="form-control" id="TextDescription" maxlength="50" required></textarea>
            </div>
            <div class="mb-3 ">
                <label for="TextImage" class="form-label custom-file-label">Image <small>(facultative)</small></label>
                <input type="file" name="fileToUpload" class="form-control custom-file-input" id="TextImage">
            </div>

            <div class="dropdown-divider bg-light mb-3"></div>

            <button type="submit" class="btn text-white button" aria-describedby="poursuivre">Ajout de l'histoire</button><br>

        </form>
    </fieldset>
</div>
<?php
} ?>


<?php include("footer.php")?>
