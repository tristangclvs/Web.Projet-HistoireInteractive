<?php include("entete.php");

    $requete = "SELECT DISTINCT categorie FROM histoire";
    $resultat = $BDD -> query($requete);
    $n = $resultat -> rowCount();

    $tab = $resultat->fetchAll();

?>
<div class="category-container text-center " >
    <div class="category-cards" id="cards">
<?php
    if ($_SESSION["connected"]){
    foreach ($tab as $key => $ligne) {
    ?>
        <div class="category-cards-item bg-danger">
            <h1> <?=$ligne["categorie"] ?></h1>
        </div>
<?php
}}  ?>

        <!--
        <div class="category-cards-item bg-primary">
            <h1>BYE</h1>
        </div>
        <div class="category-cards-item bg-info">
            <h1>Hi again</h1>
        </div>
        -->


    </div>
</div>
<div class="container">
    <button onclick="carousel()"> Click me ! </button>
</div>



<?php include("footer.php") ?>

