<?php
session_start();
include("connect.php");

$idHist = $_GET['id'];

if($_SESSION['connected'] && $_SESSION['admin']==1){
    $requete = 'UPDATE `histoire` WHERE id=?'; // A compléter
}

header('location: ../histoire?id=$idHist.php');