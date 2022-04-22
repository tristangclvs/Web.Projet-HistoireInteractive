<?php include("entete.php") ?>



<div class="text-center"><h2>Connexion</h2></div>

<div class="container mx-auto">
    <form class="px-4 py-3">
        <div class="mb-3">
            <label for="FormUsername" class="form-label">Username</label>
            <input type="text" name="usrName" class="form-control" id="FormUsername" placeholder="Username">
        </div>
        <div class="mb-3">
            <label for="exampleDropdownFormPassword1" class="form-label">Password</label>
            <input type="password" class="form-control" id="exampleDropdownFormPassword1" placeholder="Password">
        </div>
        <div class="dropdown-divider"></div>
        <button type="submit" class="btn btn-primary">Sign in</button>
        <a type="button" class="btn btn-danger" href="inscription.php">Sign up</a>
    </form>
    <div class="dropdown-divider"></div>
    <a class="dropdown-item" href="#">New around here? Sign up</a>
    <a class="dropdown-item" href="#">Forgot password?</a>
</div>



<?php include("footer.php")?>
