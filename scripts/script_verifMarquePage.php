<?php
session_start();
include("connect.php");

$requete = "SELECT * FROM marquePage WHERE id_user=? ";
$response = $BDD->prepare($requete);
$response -> execute(array($_SESSION['id_user']));
return $response;