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
include("../modele/modele_equipe.php");
include("../modele/modele_hackathon.php");
// ---------------------------------------------------------------------------
// Modèle spécifique SESSION : on regarde l'état de la SESSION



// ---------------------------------------------------------------------------
// Controleur ----------------------------------------------------------------
// ---------------------------------------------------------------------------

// ---------------------------------------------------------------------------
// Cas particuliers


// ---------------------------------------------------------------------------
// cas général


// ---------------------------------------------------------------------------
// Vue : afficher les résultats ----------------------------------------------
// ---------------------------------------------------------------------------
debug_get_post();
debug('<hr>', '<hr>'); // pour séparer les debug de la page html
include("../views/pages/view_note.php");
