<?php
try {
    $BDD = new PDO( "mysql:host=185.98.131.176;dbname=trist1844575;charset=utf8", "trist1844575","5yo2zfulwb", array(PDO::ATTR_ERRMODE =>PDO::ERRMODE_EXCEPTION));
}
catch (Exception $e) {
    die('Erreur fatale : ' . $e->getMessage());
}