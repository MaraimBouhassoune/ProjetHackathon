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
include("../modele/modele_hackathon.php");

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
$insertHackathon = False;
if (isset($_POST["insertHackathon"])) {
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

// si je viens du modifier du formulaire
$updateHackathon = False;
if (isset($_POST["updateHackathon"])) {
   // Mise au propre des données du $_POST

   // htmlentities comme htmlspecialchars protège contre les intrusions XSS
   $dateDebutHackathon = htmlentities($_POST["dateDebutHackathon"]);
   $nomHackathon = htmlentities($_POST["nomHackathon"]);
   $idHackathon = htmlentities($_POST["idHackathon"]);

   // trim supprime les espaces au début et à la fin
   // ce n'est pas utile pour dateDebutHackathon et l'id car c'est protégé par le formulaire de saisie
   $dateDebutHackathon = trim($dateDebutHackathon);
   $nomHackathon = trim($nomHackathon);
   $idHackathon = trim($idHackathon);

   $hackathon = new Hackathon($nomHackathon, $dateDebutHackathon);

   // vérifications à envisager...
   // Vérification de base : si on a saisi quelque chose, c'est gon
   if ($nomHackathon != "" && $dateDebutHackathon != "")
      $updateHackathon = True; // c'est bon on peut updater
   else {
      $_SESSION["messageErreur"] = "Echec de la modification";
   }
   debug($updateHackathon, "updateHackathon");
}

// si je viens d'un delete du tableau
$deleteHackathon = False;
if (
   isset($_POST["deleteHackathon"]) &&
   isset($_POST["confirmationDeleteHackathon"]) &&
   $_POST["confirmationDeleteHackathon"] == "oui"
) {
   $idHackathon = $_POST["idHackathon"];
   debug($idHackathon, "deleteHackathon");
   // Pas de vérifications puisque c'est contrôlé par nous 
   $deleteHackathon = True; // c'est bon on peut deleter
}

// si je viens d'un update du tableau (on a sélectionner un update)
$selectUpdateHackathon = False;
if (isset($_POST["selectUpdateHackathon"])) {
   $idHackathon = $_POST["idHackathon"];
   // Pas de vérifications puisque c'est contrôlé par nous 
   $selectUpdateHackathon = True; // c'est bon on peut delete
   debug($selectUpdateHackathon, "selectUpdateHackathon");
}

// ---------------------------------------------------------------------------
// Controleur ----------------------------------------------------------------
// ---------------------------------------------------------------------------

// ---------------------------------------------------------------------------
// Cas particuliers

// si on vient d'un insert : 
if ($insertHackathon == True) {
   $hackathon = new Hackathon($nomHackathon, $dateDebutHackathon);
   $resInsertHackathon = insertHackathon($bdd, $hackathon);
   debug_ec($resInsertHackathon, "resInsertHackathon");
}
// si on vient d'un modifier : 
else if ($updateHackathon == True) {
   $resUpdateHackathon = updateHackathon($bdd, $idHackathon, $hackathon);
   debug($resUpdateHackathon, "resUpdateHackathon");
}
// si on vient d'un delete : 
else if ($deleteHackathon == True) { // true c'est 1
   $resDeleteHackathon = deleteHackathon($bdd, $idHackathon);
   debug_ec($resDeleteHackathon, "resDeleteHackathon");
   if ($resDeleteHackathon == 0) {
      $_SESSION["messageErreur"] = "Pas de suppression";
   }
}
// si on vient d'un select-update : 
else if ($selectUpdateHackathon == True) {
   $hackathonAModifier = selectHackathonParId($bdd, $idHackathon);
   debug($selectUpdateHackathon, "selectUpdateHackathon");
}

// ---------------------------------------------------------------------------
// cas général
$hackathons = selectHackathons($bdd); // $hackathons: c'est une liste d'objets de la classe hHackathon
debug($hackathons, 'hackathons');

// ---------------------------------------------------------------------------
// Vue : afficher les résultats ----------------------------------------------
// ---------------------------------------------------------------------------
debug_get_post();
debug('<hr>', '<hr>'); // pour séparer les debug de la page html
include("../views/pages/view_hackathons_gerer.php");
