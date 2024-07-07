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
if (
   !isset($_SESSION["typeUser"])
) {
   $_SESSION = array();
   $_SESSION["typeUser"] = "public";
   $_SESSION["messageErreur"] = "";
   $_SESSION["messageErreurURL"] = ""; // pour les accès directs interdits
}

// ex bouton RAZ
// on remet le messageErreur à messageErreurURL
// le messageErreurURL vaut "" ou le message d'accès par URL interdit

// if (
//    isset($_SESSION["messageErreur"]) && isset($_SESSION["messageErreurURL"])
// ) {
//    $_SESSION["messageErreur"] = $_SESSION["messageErreurURL"];
//    $_SESSION["messageErreurURL"] = ""; // on raz pour la suite
// } else{
//    $_SESSION["messageErreurURL"] = "";
// }

// $_SESSION["messageErreur"] = $_SESSION["messageErreurURL"];
// $_SESSION["messageErreurURL"] = ""; // on raz pour la suite

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

// if (isset($_POST['login'])) {
//    // Validez les identifiants de l'utilisateur avec la base de données ici.
//    // Si les identifiants sont corrects, définissez une variable de session pour marquer l'utilisateur comme connecté.

//    // Exemple de validation (veuillez adapter à votre propre système de gestion des utilisateurs et de la base de données) :
//    $login = $_POST['Login'];
//    $password = $_POST['password'];

//    if (validerUtilisateur($login, $password)) {
//       $_SESSION['user'] = $login;
//       header("Location: user_accueil.php");
//       exit();
//    } else {
//       $erreur = "Identifiants incorrects. Veuillez réessayer.";
//    }
// }

// on sélectionnera le ou les hackathons en cours
// et peut-être les projet

// ---------------------------------------------------------------------------
// Vue : afficher les résultats ----------------------------------------------
// ---------------------------------------------------------------------------
debug_get_post();
debug('<hr>', '<hr>'); // pour séparer les debug de la page html
include("../views/pages/view_connexion.php");
