<?php
include("../entete.php");
$_SESSION["connected"] = false;
$_SESSION["admin"] = false;
header('location: ../index.php');
exit;
