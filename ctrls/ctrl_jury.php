<?php

// ---------------------------------------------------------------------------
// Modèle --------------------------------------------------------------------
// ---------------------------------------------------------------------------
// Modèle général (pour toutes les pages) : initialisation
include("../modele/initialisation/initialisation.php");

// ---------------------------------------------------------------------------
// Modèle spécifique (pour cette page) : je charge les outils de BD pour mon controleur
include("../modele/modele_hackathon.php");
include("../modele/modele_projet.php");

// ---------------------------------------------------------------------------
// Modèle spécifique SESSION : initialise la session
if(
   !isset($_SESSION["typeUser"])
){
   $_SESSION=array();
   $_SESSION["typeUser"]="public";
   $_SESSION["messageErreur"]="";
   $_SESSION["messageErreurURL"]=""; // pour les accès directs interdits
}
// ex bouton RAZ
// on remet le messageErreur à messageErreurURL

// ex bouton RAZ
// on remet le messageErreur à messageErreurURL
// le messageErreurURL vaut "" ou le message d'accès par URL interdit
if (isset($_SESSION["messageErreurURL"])) {
   $_SESSION["messageErreur"] = $_SESSION["messageErreurURL"];
} else {
   $_SESSION["messageErreur"] = ""; // Utilisez une valeur par défaut si messageErreurURL n'existe pas
}
$_SESSION["messageErreurURL"] = ""; // on raz pour la suite

// ---------------------------------------------------------------------------
// Modèle spécifique GET POST : récupérer les données get et post
// si je viens de l'insert du formulaire


// ---------------------------------------------------------------------------
// Controleur ----------------------------------------------------------------
// ---------------------------------------------------------------------------

// ---------------------------------------------------------------------------
// Cas particuliers

// ---------------------------------------------------------------------------
// cas général
// on sélectionnera le ou les hackathons en cours
// et peut-être les projet

// ---------------------------------------------------------------------------
// Vue : afficher les résultats ----------------------------------------------
// ---------------------------------------------------------------------------
debug_get_post();
debug('<hr>', '<hr>'); // pour séparer les debug de la page html
include("../views/pages/view_jury.php");
