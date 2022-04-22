<?php include("entete.php") ?>


<div class="text-center"><h2>Inscription</h2></div>

<div class="container mx-auto" id="containerConnexion" style="width:30%;">
    <form class="px-4 py-3" method="post" action="scripts/script_inscription.php">
        <div class="mb-3">
            <label for="FormName" class="form-label">Username</label>
            <input type="text" name="usrName" class="form-control" id="FormName" placeholder="Username">
        </div>
        <div class="mb-3">
            <label for="FormUsername" class="form-label">Username</label>
            <input type="text" name="usrName" class="form-control" id="FormUsername" placeholder="Username">
        </div>
        <div class="mb-3">
            <label for="FormPassword" class="form-label">Password</label>
            <input type="password" name="usrPass" class="form-control" id="FormPassword" placeholder="Password">
        </div>
        <div class="dropdown-divider"></div>
        <button type="submit" class="btn btn-danger">Sign up</button>
    </form>
</div>



<?php include("footer.php")?>
