<?php

// Script de connection à la BDD
// Les images ne sont pas chargées sur la BDD car trop grosses lorsqu'on veut les envoyer en modifiant les histoires

try {
    $BDD = new PDO( "mysql:host=localhost;dbname=tgoncalve002;charset=utf8", "tgoncalve002","BDD_ServeurZZZ", array(PDO::ATTR_ERRMODE =>PDO::ERRMODE_EXCEPTION));
}
catch (Exception $e) {
    die('Erreur fatale : ' . $e->getMessage());
}