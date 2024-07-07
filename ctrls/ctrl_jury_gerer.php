<?php
/*
   class Jury : 
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
include("../modele/modele_hackathon.php");
include("../modele/modele_jury.php");

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
$insertJury = False;
if (isset($_POST["insertJury"])) {
   // Mise au propre des données du $_POST

   // htmlentities comme htmlspecialchars protège contre les intrusions XSS
//   $dateDebutJury = htmlentities($_POST["dateDebutJury"]);
   $idJury = htmlentities($_POST["idJury"]);
   $idHackathon = htmlentities($_POST["idHackathon"]);
   $nomJury = htmlentities($_POST["nomJury"]);
   
//   debug_ec($dateDebutJury, "dateDebutJury");

   // trim supprime les espaces au début et à la fin
   // ce n'est pas utile pour dateDebutJury et l'id car c'est protégé par le formulaire de saisie
//   $dateDebutJury = trim($dateDebutJury);

   $idJury = trim($idJury);
   $idHackathon = trim($idHackathon);
   $nomJury = trim($nomJury);

   // Vérification de base : si on a saisi quelque chose, c'est gon
   if ($nomJury != "" && $idHackathon != "" && $idJury != "")
      $insertJury = True; // c'est bon on peut inserter
   else {
      $_SESSION["messageErreur"] = "Echec de l'insertion";
   }
   debug_ec($idJury, "idJury");
   debug_ec($idHackathon, "idHackathon");
   debug_ec($nomJury, "nomJury");
   debug_ec($insertJury, "insertJury");
   
}

// si je viens du modifier du formulaire
$updateJury = False;
if (isset($_POST["updateJury"])) {
   // Mise au propre des données du $_POST

   // htmlentities comme htmlspecialchars protège contre les intrusions XSS
   $dateDebutJury = htmlentities($_POST["dateDebutJury"]);
   $nomJury = htmlentities($_POST["nomJury"]);
   $idJury = htmlentities($_POST["idJury"]);

   // trim supprime les espaces au début et à la fin
   // ce n'est pas utile pour dateDebutJury et l'id car c'est protégé par le formulaire de saisie
   $dateDebutJury = trim($dateDebutJury);
   $nomJury = trim($nomJury);
   $idJury = trim($idJury);

   $jury = new Jury($idJury, $nomJury);

   // vérifications à envisager...
   // Vérification de base : si on a saisi quelque chose, c'est gon
   if ($nomJury != "" && $dateDebutJury != "")
      $updateJury = True; // c'est bon on peut updater
   else {
      $_SESSION["messageErreur"] = "Echec de la modification";
   }
   debug($updateJury, "updateJury");
}

// si je viens d'un delete du tableau
$deleteJury = False;
if (
   isset($_POST["deleteJury"]) &&
   isset($_POST["confirmationDeleteJury"]) &&
   $_POST["confirmationDeleteJury"] == "oui"
) {
   $idJury = $_POST["idJury"];
   debug($idJury, "deleteJury");
   // Pas de vérifications puisque c'est contrôlé par nous 
   $deleteJury = True; // c'est bon on peut deleter
}

// si je viens d'un update du tableau (on a sélectionner un update)
$selectUpdateJury = False;
if (isset($_POST["selectUpdateJury"])) {
   $idJury = $_POST["idJury"];
   // Pas de vérifications puisque c'est contrôlé par nous 
   $selectUpdateJury = True; // c'est bon on peut delete
   debug($selectUpdateJury, "selectUpdateJury");
}

// ---------------------------------------------------------------------------
// Controleur ----------------------------------------------------------------
// ---------------------------------------------------------------------------

// ---------------------------------------------------------------------------
// Cas particuliers

// si on vient d'un insert : 
if ($insertJury == True) {
   $jury = new Jury($idJury, $idHackathon);
   $resInsertJury = insertJuryHackathon($bdd, $jury);
   debug_ec($resInsertJury, "resInsertJury");
}
// si on vient d'un modifier : 
else if ($updateJury == True) {
   $resUpdateJury = updateJury($bdd, $idJury, $jury);
   debug($resUpdateJury, "resUpdateJury");
}
// si on vient d'un delete : 
else if ($deleteJury == True) { // true c'est 1
   $resDeleteJury = deleteJury($bdd, $idJury);
   debug_ec($resDeleteJury, "resDeleteJury");
   if ($resDeleteJury == 0) {
      $_SESSION["messageErreur"] = "Pas de suppression";
   }
}
// // si on vient d'un select-update : 
// else if ($selectUpdateJury == True) {
//    $juryAModifier = selectJuryParId($bdd, $idJury);
//    debug($selectUpdateJury, "selectUpdateJury");
// }

// ---------------------------------------------------------------------------
// cas général
$hackathons = selectHackathons($bdd);
$jurys = selectJurysHackathons($bdd); // $jurys: c'est une liste d'objets de la classe Jury
debug($jurys, 'jurys');

// ---------------------------------------------------------------------------
// Vue : afficher les résultats ----------------------------------------------
// ---------------------------------------------------------------------------
debug_get_post();
debug('<hr>', '<hr>'); // pour séparer les debug de la page html
include("../views/pages/view_jurys_gerer.php");
