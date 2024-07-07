<?php
// ---------------------------------------------------------------------------
// Modèle --------------------------------------------------------------------
// ---------------------------------------------------------------------------
// Modèle général : initialisation
include("../modele/initialisation/initialisation.php");

// ---------------------------------------------------------------------------
// Modèle spécifique : je charge les outils de BD pour mon controleur
include("../modele/modele_participant.php");
include("../modele/modele_hackathon.php");
// ---------------------------------------------------------------------------
// $bpassword = $_POST["passwordUser"];
// $cpassword = $_POST["passwordUser2"];
// if ($bpassword != $cpassword) {
//    header("Location: ctrl_inscription.php");
// }
// Modèle général SESSION : initialiser la SESSION 
if (
   !isset($_SESSION["typeUser"]) // c'est vrai à l'entrée dans le site
) {
   $_SESSION = array();
   $_SESSION["typeUser"] = "public";
   $_SESSION["messageErreur"] = "";
   header("Location: " . "./_index.php");
}

// ---------------------------------------------------------------------------
// Modèle spécifique GET POST : récupérer les données get et post

// je viens du ok du login
$okInscription = False;
if (isset($_POST["okInscription"])) {
   $loginParticipant = $_POST["loginUser"];
   $passwordParticipant = $_POST["passwordUser"];
   $nomParticipant = $_POST["nomUser"];
   $prenomParticipant = $_POST["prenomUser"];
   $mailParticipant = $_POST["mailUser"];
   // $_SESSION["typeUser"] = $_POST["typeUser"];

   // vérifications à envisager : 
   // htmlspecialchars(), htmlentities(), trim(), 
   // on considère qu'on a tenté la connexion dans tous les cas : 
   //   on vérifiera dans le controleur si ça passe
   $okInscription = True;
}

$okInscriptionHack = False;
if (isset($_POST["okInscriptionHack"])) {
   $idParticipant = $_SESSION["idUser"];
   $idHackathon = $_POST["idHackathon"];
   debug_ec($idHackathon, "idHackathon");
   $okInscriptionHack = True;
}

if ($okInscriptionHack == true) {

   $participantHackathon = new ParticipantHackathon($idParticipant, $idHackathon);
   $inscription = inscriptionHackathon($bdd, $participantHackathon);
   debug_ec($inscription);
}


// je viens du déconnexion du login
$okDeconnexion = False;
if (isset($_POST["okDeconnexion"])) {
   $okDeconnexion = True;
}

// ---------------------------------------------------------------------------
// Controleur ----------------------------------------------------------------
// ---------------------------------------------------------------------------

$hackathonsActuels = selectHackathonsActuels($bdd);
if ($okInscription == True) {
   // on inscrit le nouveau particiant

   $participant = new Participant($loginParticipant, $passwordParticipant, $nomParticipant, $prenomParticipant, $mailParticipant);
   $resultat = insertParticipant($bdd, $participant);
   debug_ec($participant, 'participant');
   debug_ec($resultat, 'resultat');

   header("Location: ctrl_connexion.php");
}


// if ($okInscription == True) {
//    // on charge l'administrateur de la BD correpondans au login et au password
//    $administrateurConnected = selectAdministrateurConnected($bdd, $_SESSION["loginUser"], $_SESSION["passwordUser"]);
//    $juryConnected = selectJuryConnected($bdd, $_SESSION["loginUser"], $_SESSION["passwordUser"]);
//    $participantConnected = selectParticipantConnected($bdd, $_SESSION["loginUser"], $_SESSION["passwordUser"]);
//    debug($_SESSION["typeUser"], "typeUser");
//    debug($administrateurConnected, "administrateurConnected");
//    debug($juryConnected, "juryConnected");
//    debug($participantConnected, "participantConnected");
//    if(
//       ($administrateurConnected != null AND $_SESSION["typeUser"] == "admin") 
//    OR ($juryConnected != null           AND $_SESSION["typeUser"] == "jury")
//    OR ($participantConnected != null    AND $_SESSION["typeUser"] == "participant")
//    ){
//       // on a un admin et typeUser = admin, il n'y a pas d'erreur
//       $_SESSION["messageErreur"] = "";
//    } 
//    else {
//       // si on n'a pas d'admin ou si typeUser n'est pas admin : on retourne en typeUser public
//       $_SESSION["messageErreur"] = "echec de connexion";
//       $_SESSION["typeUser"] = "public";
//    }
// }
if ($okDeconnexion == True) {
   $_SESSION = array();
   $_SESSION["typeUser"] = "public";
   $_SESSION["messageErreur"] = "";
}


// ---------------------------------------------------------------------------
// Vue : afficher les résultats ----------------------------------------------
// ---------------------------------------------------------------------------
debug_get_post();
debug('<hr>', '<hr>'); // pour séparer les debug de la page html
if ($_SESSION["typeUser"] == "public") {
   header('Location:' . "ctrl_accueil.php");
} else if ($_SESSION["typeUser"] == "admin") {
   $_SESSION["idUser"] = $idUser;
   header('Location:' . "ctrl_admin.php");
} else if ($_SESSION["typeUser"] == "jury") {
   $_SESSION["idUser"] = $idUser;
   header('Location:' . "ctrl_jury.php");
} else if ($_SESSION["typeUser"] == "participant") {
   $_SESSION["idUser"] = $idUser;
   header('Location:' . "ctrl_participant.php");
}
