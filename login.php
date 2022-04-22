<?php include("entete.php") ?>

<?php if ($_SESSION["erreur_connexion"]) {
    echo '<div class="alert alert-danger text-center"><span style="font-weight: bold">Erreur ! </span>Utilisateur non reconnu.</div><br>';
    $_SESSION["erreur_connexion"] = false;
}
if (!$_SESSION["connected"]){
?>
<!-- Ne pas pouvoir de rendre sur cette page si déjà connecté -->
<div class="text-center text-white"><h2>Connexion</h2></div>

<div class="container mx-auto text-white" id="containerConnexion" style="width:30%;">
    <form class="px-4 py-3" method="post" action="scripts/script_connexion.php">
        <div class="mb-3">
            <label for="FormUsername" class="form-label">Username</label>
            <input type="text" name="usrName" class="form-control" id="FormUsername" placeholder="Username">
        </div>
        <div class="mb-3">
            <label for="FormPassword" class="form-label">Password</label>
            <input type="password" name="usrPass" class="form-control" id="FormPassword" placeholder="Password">
        </div>
        <div class="dropdown-divider"></div>
        <button type="submit" class="btn btn-primary">Sign in</button>
        <a type="button" class="btn btn-danger" href="inscription.php">Sign up</a>
    </form>
</div>
<?php
}
else{
    ?>
    <img src="images/chat.png" alt="Je te vois petit malin" style="width: 100%;height: 100vh; z-index: 100000;position: absolute; top: 0;">
<?php
}
?>

<?php include("footer.php")?>
