<?php
/*
   Version FrameWorké des Tests

// -------------------------------------------------------------------
/* MODELE : les outils de travail : souvent les données */
// -------------------------------------------------------------------
/* On commence par charger la classe et par définir les fonctions dont on a besoin */
require("../Connexion.php");
include("../../initialisation/tools/debug.php"); /* pour permettre les debug dans les classes */
// -------------------------------------------------------------------
/* fonction traiter Test : 
 *    affiche les erreurs si il y en a et retourne 1
 *    n'affiche rien s'il n'y a pas d'erreur et retourne 0
 * Entrées : 
 *    $numTest : numéro du test
 *    $objetDuTest : texte qui dit ce qu'on teste
 *    $objetTeste : l'ojet testé
 *    $methodeTestee : la méthode testée
 *    $resultatAttendu : le résultat attendu via un toString()
 * Sortie : 
 *    1 : s'il y a 1 erreur
 *    0 : s'il y a pas d'erreur
*/
function traiterTest(
   $numTest,
   $message,
   $objetTeste, 
   $methodeTestee, 
   $resultatAttendu
) {
   if($objetTeste->toString() != $resultatAttendu){
      echo "<code>";
      echo "ERREUR test numéro : $numTest<br>";
      echo $message."<br>";
      echo "Méthode testée : $methodeTestee<br>";
      echo "Résultats attendus : $resultatAttendu<br>";
      echo "Résultats obtenus : " . $objetTeste->toString() . "<br>";
      echo "</code><br>";
      return 1; // une erreur en plus
   }
   else{
      return 0; // pas d'erreur en plus
   }
}

// -------------------------------------------------------------------
/* CONTROLEUR */
/* Tests Unitaires : on fait tout les tests.
   Pour chaque test, on définit : 
      le numTest
      L'ojet du test
      Le code à tester dont la méthode testée
      La méthode testée à afficher
      Le résultat attendu à afficher
   Ensuite on appel la fonction traiterTest() et on incrémente le nbErreurs
*/
// -------------------------------------------------------------------
$nbErreurs=0; // on initialise le nombre d'erreurs à 0
// -------------------------------------------------------------------
// -------------------------------------------------------------------
$numTest=1;
$message="On teste l'instanciation à vide";
// code à tester : 
$connexion = new Connexion();
$objetTeste = $connexion;

$methodeTestee = '$connexion = new Connexion();';
$resultatAttendu = "objet vide";
$nbErreurs += traiterTest($numTest, $message, $objetTeste, $methodeTestee, $resultatAttendu);

// -------------------------------------------------------------------
// -------------------------------------------------------------------
/* Vue */
// -------------------------------------------------------------------
// On initialise le nombre d'erreurs trouvées
echo "<hr>Résultats des tests unitaires : <br>";

/* Après tout les tests, on affiche le bilan */
echo "<hr>";
if($nbErreurs == 0){
   echo "Tests unitaires tous OK";
}
else if ($nbErreurs == 1){
   echo $nbErreurs . " erreur dans les " .$numTest. " tests unitaires";
}
else {
   echo $nbErreurs . " erreurs dans les " .$numTest. " tests unitaires";
}

/* Pour finir on teste le printInfo, qui est un print qu'on ne peut pas tester comme les autres */
echo("<hr>");
echo('Test de printInfos de new Connexion("admin", "passwordAdmin");');
echo("<br>");
$connexion = new Connexion(2, "passwordAdmin", "passwordAdmin");
$connexion->printInfos();