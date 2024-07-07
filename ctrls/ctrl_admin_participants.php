<?php
/*
   class Hackathon : 
      private int $id;
      private string $nom;
      private string $date_debut; 
*/

// ---------------------------------------------------------------------------
// Modèle --------------------------------------------------------------------
// ---------------------------------------------------------------------------
// Modèle général (pour toutes les pages) : initialisation
include("../modele/initialisation/initialisation.php");

// ---------------------------------------------------------------------------
// Modèle spécifique (pour cette page) : je charge les outils de BD pour mon controleur
include("../modele/modele_participant.php");

// ---------------------------------------------------------------------------
// Modèle spécifique SESSION : on regarde l'état de la SESSION
if (
   !isset($_SESSION["typeUser"])
   or
   $_SESSION["typeUser"] != "admin"
) {
   $_SESSION = array();
   $_SESSION["typeUser"] = "public";
   $_SESSION["messageErreurURL"] = "accès interdit-retour à l'accueil";
   header("Location: " . "../_index.php");
}
// on remet le message à ""
$_SESSION["messageErreur"] = "";

// ---------------------------------------------------------------------------
// Modèle spécifique GET POST : récupérer les données get et post

// ---------------------------------------------------------------------------
// Controleur ----------------------------------------------------------------
// ---------------------------------------------------------------------------

// ---------------------------------------------------------------------------
// Cas particuliers


// ---------------------------------------------------------------------------
// cas général
$participants = selectParticipants($bdd); // $hackathons: c'est une liste d'objets de la classe hHackathon
debug($participants, 'participants');

// ---------------------------------------------------------------------------
// Vue : afficher les résultats ----------------------------------------------
// ---------------------------------------------------------------------------
debug_get_post();
debug('<hr>', '<hr>'); // pour séparer les debug de la page html
include("../views/pages/view_admin_participant.php");
