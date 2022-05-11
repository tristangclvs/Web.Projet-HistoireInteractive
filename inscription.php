<?php include("entete.php") ?>

<!-- Ne pas pouvoir de rendre sur cette page si déjà connecté -->


<div class="text-center"><h2>Inscription</h2></div>
<?php
if ($_SESSION["doublonPseudo"]){ ?>
    <div class="alert alert-danger text-center"><span style="font-weight: bold"> Pseudo déjà existant, veuillez recommencer </span></div><br>
    <?php
    $_SESSION["doublonPseudo"] =false;
} ?>
<div  class="container mx-auto" id="containerConnexion" style="width:30%;">
    <form role="form" class="px-4 py-3" method="post" action="scripts/script_inscription.php">
        <div class="mb-3">
            <label for="FormName" class="form-label">Prénom</label>
            <input type="text" name="prenom" class="form-control" id="FormName" placeholder="Prénom">
        </div>
        <div class="mb-3">
            <label for="FormUsrname" class="form-label">Username</label>
            <input type="text" name="usrName" class="form-control" id="FormUsrname" placeholder="Username">
        </div>
        <div class="mb-3">
            <label for="FormPass" class="form-label">Password</label>
            <input type="password" name="usrPass" class="form-control" id="FormPass" placeholder="Password">
        </div>
        <div class="dropdown-divider"></div>
        <button type="submit" class="btn btn-danger">Sign up</button>
    </form>
</div>



<?php include("footer.php")?>
