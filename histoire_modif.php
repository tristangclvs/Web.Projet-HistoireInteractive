<?php
include("entete.php");

// Selectionne l'histoire
$verif = "SELECT * FROM histoire WHERE id =?";
$prep = $BDD -> prepare($verif);
$prep-> execute(array($_GET['id']));
$ligne = $prep->fetch();

if(isset($_GET['id'])){
    if($_SESSION["connected"] && $_SESSION['admin']==1){

    ?>
    <!-- Si il n'est pas connecté, il ne peut accéder a cette page-->

    <div class="text-center"><h2>Modification d'une histoire :</h2></div>

    <br>
    <div class="container mx-auto" id="containerConnexion" style="width:30%;">
        <fieldset class="border border-light border-2 rounded">
            <form class="px-4 py-3" method="POST" enctype="multipart/form-data" action="scripts/script_modif_hist.php?id=<?=$_GET['id']?>">
                <div class="mb-3">
                    <label for="FormTitre" class="form-label">Titre</label>
                    <input type="text" name="titre" class="form-control" id="FormTitre" placeholder="Titre" value="<?=$ligne['titre']?>" required>
                    <!-- Attention ne pas lui permettre de renseigner le meme titre qu'une histoire déjà existante ici -->
                </div>
                <div class="mb-3 form-group">
                    <label for="choixCategories" class="form-label">Catégorie de l'histoire</label>
                    <select name="categorie" id="choixCategories" class="form-select text-dark" style="color: black !important;">
                        <?php if($ligne['categorie']=='Action'){?>
                            <option value="horreur">Horreur</option>
                        <option value="romantique">Romantique</option>
                        <option value="action" selected>Action</option>
                        <?php }
                         else if($ligne['categorie']=='romantique') {?>
                            <option value="horreur">Horreur</option>
                        <option value="romantique" selected>Romantique</option>
                        <option value="action">Action</option>
                        <?php }
                         else {?>
                             <option value="horreur" selected>Horreur</option>
                            <option value="romantique">Romantique</option>
                            <option value="action">Action</option>
                         <?php }
                         ?>

                    </select>
                </div>
                <div class="mb-3">
                    <label for="TextAuteur" class="form-label">Auteur</label>
                    <input type="text" name="auteur" class="form-control" id="TextAuteur" placeholder="Auteur" value="<?=$ligne['auteur']?>">
                </div>
                <div class="mb-3">
                    <label for="TextAnnee" class="form-label">Année de parution</label>
                    <input type="number" name="annee" class="form-control" id="TextAnnee" placeholder="Annee" value="<?=$ligne['annee']?>" required>
                </div>
                <div class="mb-3">
                    <label for="TextDescription" class="form-label">Description</label>
                    <textarea name="description" class="form-control" id="TextDescription" required><?=$ligne['description']?></textarea>
                </div>
                <div class="mb-3 ">
                    <label for="TextImage" class="form-label custom-file-label">Image <small>(facultative)</small></label>
                    <input type="file" name="fileToUpload" class="form-control custom-file-input" id="TextImage">
                </div>

                <div class="dropdown-divider bg-light mb-3"></div>

                <button type="submit" class="btn text-white" id="button" aria-describedby="poursuivre">Modifier l'Histoire</button>
            </form>
        </fieldset>
    </div>
<?php
}
    else{?>
        <div class="alert alert-danger text-center"><span style="font-weight: bold">Ceci est un panel administrateur ! Veuillez vous connecter !</div>
        <br>
   <?php }}
include("footer.php")?>
