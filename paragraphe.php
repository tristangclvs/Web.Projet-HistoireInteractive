<?php include("entete.php");

$verif = "SELECT * FROM paragraphe WHERE id =?";
$prep = $BDD -> prepare($verif);
$prep-> execute(array($_GET['id']));
$ligne = $prep->fetch();
//titre,categorie,auteur,annee,description,image

?>



<?php include("footer.php") ?>
