<?php
// Clarification du code histoire,
// Evite les conflits des variables non set coté serveur
if (!isset($_SESSION["connected"])) {
    $_SESSION["connected"] = false;
}
if (!isset($_SESSION["erreur_connexion"])) {
    $_SESSION["erreur_connexion"] = false;
}
if (!isset($_SESSION["inscription"])){
    $_SESSION["inscription"] = false;
}
if (!isset($_SESSION["erreur_connexionMDP"])){
    $_SESSION["erreur_connexionMDP"] = false;
}
if (!isset($_SESSION["doublonPseudo"])){
    $_SESSION["doublonPseudo"] = false;
}
if (!isset($_SESSION["repriseLecture"])){
    $_SESSION["repriseLecture"] = false;
}
if (!isset($_SESSION["erreur_histoire"])){
    $_SESSION["erreur_histoire"] = false;
}
