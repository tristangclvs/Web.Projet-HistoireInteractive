<?php

// Script de connection à la BDD avec la méthode PDO

try {
    $BDD = new PDO( "mysql:host=localhost;dbname=tgoncalve002;charset=utf8", "tgoncalve002","BDD_ServeurZZZ", array(PDO::ATTR_ERRMODE =>PDO::ERRMODE_EXCEPTION));
}
catch (Exception $e) {
    die('Erreur fatale : ' . $e->getMessage());
}