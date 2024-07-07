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
include("../modele/modele_hackathon.php");

// ---------------------------------------------------------------------------
// Modèle spécifique SESSION : on regarde l'état de la SESSION
if (
   !isset($_SESSION["typeUser"])
   or
   $_SESSION["typeUser"] != "participant"
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
$idParticipant = $_SESSION["idUser"];
$IDMesHackathons = selectMesHackathons($idParticipant, $bdd); // liste d'IDs

$mesHackathons = [];
foreach ($IDMesHackathons as $IDHackathon) {
    $hackathon = selectHackathonParId($bdd, $IDHackathon);
    if ($hackathon) {
        $mesHackathons[] = $hackathon;
    }
}

// ---------------------------------------------------------------------------
// Vue : afficher les résultats ----------------------------------------------
// ---------------------------------------------------------------------------
debug_get_post();
debug('<hr>', '<hr>'); // pour séparer les debug de la page html
include("../views/pages/view_mes_hackathons.php");
