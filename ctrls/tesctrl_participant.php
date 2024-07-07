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
// si je viens de l'insert du formulaire
$insertParticipant = False;
if (isset($_POST["insertParticipant"])) {
   // Mise au propre des données du $_POST

   // htmlentities comme htmlspecialchars protège contre les intrusions XSS
   $dateDebutHackathon = htmlentities($_POST["dateDebutHackathon"]);
   $nomHackathon = htmlentities($_POST["nomHackathon"]);
   debug_ec($dateDebutHackathon, "dateDebutHackathon");

   // trim supprime les espaces au début et à la fin
   // ce n'est pas utile pour dateDebutHackathon et l'id car c'est protégé par le formulaire de saisie
   $dateDebutHackathon = trim($dateDebutHackathon);
   $nomHackathon = trim($nomHackathon);

   // Vérification de base : si on a saisi quelque chose, c'est gon
   if ($nomHackathon != "" && $dateDebutHackathon != "")
      $insertHackathon = True; // c'est bon on peut inserter
   else {
      $_SESSION["messageErreur"] = "Echec de l'insertion";
   }
   debug_ec($insertHackathon, "insertHackathon");
}

// ---------------------------------------------------------------------------
// Controleur ----------------------------------------------------------------
// ---------------------------------------------------------------------------

// ---------------------------------------------------------------------------
// Cas particuliers

// si on vient d'un insert : 
if ($insertParticipant == True) {
   $participant = new Participant($idParticipant,$loginParticipant, $loginParticipant,$passwordParticipant,$nomParticipant,$prenomParticipant,$mailParticipant,$telephoneParticipant,$dateDeNaissanceParticipant,$lienPorteFolioParticipant);
   $resinsertParticipant = insertHackathon($bdd, $hackathon);
   debug_ec($resinsertParticipant, "resinsertParticipant");
}

// ---------------------------------------------------------------------------
// cas général
$hackathons = selectParticipantConnected($bdd, $loginParticipant, $passwordParticipant);// $hackathons: c'est une liste d'objets de la classe hHackathon
debug($participants, 'participants');

// ---------------------------------------------------------------------------
// Vue : afficher les résultats ----------------------------------------------
// ---------------------------------------------------------------------------
debug_get_post();
debug('<hr>', '<hr>'); // pour séparer les debug de la page html
include("../views/pages/view_accueil.php");
