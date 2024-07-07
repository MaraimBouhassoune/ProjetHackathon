<?php
/*
CREATE TABLE Jurys(
	idJury integer auto_increment,
	loginJury varchar(30) unique,
	passwordJury varchar(30), 
	nomJury varchar(30) not null,   
	prenomJury varchar(30) not null,   
	mailJury varchar(30) unique, -- pas de doublon possible : unique : clé secondaire  
	telephoneJury varchar(10),  
	primary key(idJury)
) engine innodb;
*/

/* La fonction selectJuryParId() SELECT un jury à par son id 
 *    et retourne le jury
 * Entrées : 
 *		$bdd : l'objet PDO de la bdd ($reqPHP sera un objet PDOstatement)
 *    $idJury : l'id du hackaton à récupérer
 *	Sorties : 
 *		$objet : le jury (une seule ligne) : objet
*/
function selectJurys($bdd)
{
   // 0 : on écrit la requête SQL
   $reqSQL = 'SELECT * 
      FROM jurys
   ';

   // 1 : on fabrique la requête PHP 
   $reqPHP = $bdd->prepare($reqSQL);
   $reqPHP->execute();
   $reqPHP->setFetchMode(PDO::FETCH_CLASS, 'Jury');

   // 2 : on récupère les résultats
   $jurys = $reqPHP->fetchAll();

   // 3 : on libère les tables de la requête
   $reqPHP->closeCursor(); // pour finir le traitement

   // 4 : on return le résultat
   return $jurys;
}

function selectJuryConnected($bdd, $loginJury, $passwordJury)
{
   // 0 : on écrit la requête SQL
   $reqSQL = 'SELECT * 
      FROM jurys
      WHERE loginJury = :alias_login
      AND passwordJury = :alias_password
   ';

   // 1 : on fabrique la requête PHP 
   $reqPHP = $bdd->prepare($reqSQL);
   $resultat = $reqPHP->execute(array(
      'alias_login' => $loginJury,
      'alias_password' => $passwordJury,
   ));
   $reqPHP->setFetchMode(PDO::FETCH_CLASS, 'Jury');

   // 2 : on récupère les résultats
   $jury = $reqPHP->fetch();

   // 3 : on libère les tables de la requête
   $reqPHP->closeCursor(); // pour finir le traitement

   // 4 : on return le résultat
   return $jury;
}

function insertJury($bdd, $jury)
{
   // 0 : reqSQL : version avec ? qui sera passé en dur
   $reqSQL = 'INSERT INTO jurys (idJury, loginJury, passwordJury, nomJury) 
      VALUES (NULL, :alias_login, :alias_password, :alias_nom)
   ';
   debug($reqSQL, "reqSQL");
   // debug($jury->getDateDebut(), "getDateDebut");

   // 1 :  prepare et debug
   $reqPHP = $bdd->prepare($reqSQL);
   debug($reqPHP, "reqPHP");

   // 2 : execute : version avec alias dans le reqSQL
   // $resultat c'est le nombre d'insert effectué
   try {
      // connexion à la BD : new PDO
      $resultat = $reqPHP->execute(array(
         'alias_login' => $jury->getLogin(),
         'alias_password' => $jury->getPassword(),
         'alias_nom' => $jury->getNom()
      ));
      // 3 : on libère les tables de la requête
      $reqPHP->closeCursor();
      // 4 : on return le résultat
      return $resultat;
   } catch (PDOException $e) {
      echo 'Insert échouée : ' . $e->getMessage();
      // 3 : on libère les tables de la requête
      $reqPHP->closeCursor();
      // 4 : on return le résultat
      return 0; // $resultat vaut 0 : pas d'insert effectué
   }
}

function deleteJury($bdd, $idJury)
{
   // 0 : reqSQL : version avec ? qui sera passé en dur
   $reqSQL = 'DELETE FROM jurys 
      WHERE idJury = :alias_id
   ';
   debug($reqSQL, "reqSQL");

   // 1 :  prepare et debug
   $reqPHP = $bdd->prepare($reqSQL);
   debug($reqPHP, "reqPHP");

   // 2 : execute : version avec alias dans le reqSQL
   // $resultat c'est le nombre d'insert effectué
   try {
      // connexion à la BD : new PDO
      $resultat = $reqPHP->execute(array(
         'alias_id' => $idJury,
      ));
      // 3 : on libère les tables de la requête
      $reqPHP->closeCursor();
      // 4 : on return le résultat
      return $resultat;
   } catch (PDOException $e) {
      // echo 'Delete échouée : ' . $e->getMessage();
      // 3 : on libère les tables de la requête
      $reqPHP->closeCursor();
      // 4 : on return le résultat
      return 0; // $resultat vaut 0 : pas d'insert effectué
   }
}

/* la fonction updateJury() modifie un jury dans la BD à partir de son id
 *    et à partir d'un nouveau jury
 * Entrées : 
 *		$bdd : l'objet PDO de la bdd ($reqPHP sera un objet PDOstatement)
 *     $idJury : id du Jury à supprimer
 *	Sorties : 
 *		$resultat : le nombre de lignes délétées dans la BD
*/
function updateJury($bdd, $idJury, $jury)
{
   // 0 : reqSQL : version avec ? qui sera passé en dur
   $reqSQL = 'UPDATE jurys 
      SET 
         loginJury = :alias_login,
         passwordJury = :alias_password,
         nomJury = :alias_nom

      WHERE idJury = :alias_id
   ';
   debug($reqSQL, "reqSQL");

   // 1 :  prepare et debug
   $reqPHP = $bdd->prepare($reqSQL);
   debug($reqPHP, "reqPHP");

   // 2 : execute : version avec alias dans le reqSQL
   // $resultat c'est le nombre d'insert effectué
   try {
      // connexion à la BD : new PDO
      $resultat = $reqPHP->execute(array(
         'alias_login' => $jury->getLogin(),
         'alias_password' => $jury->getPassword(),
         'alias_nom' => $jury->getNom(),
         'alias_id' => $idJury
      ));
      // 3 : on libère les tables de la requête
      $reqPHP->closeCursor();
      // 4 : on return le résultat
      return $resultat;
   } catch (PDOException $e) {
      echo 'Update échouée : ' . $e->getMessage();
      // 3 : on libère les tables de la requête
      $reqPHP->closeCursor();
      // 4 : on return le résultat
      return 0; // $resultat vaut 0 : pas d'insert effectué
   }
}

// CREATE TABLE jurysHackathons(
// 	idJury integer,
// 	idHackathon integer,
// 	primary key(idJury, idHackathon)
// ) engine innodb;

function selectJurysHackathons($bdd)
{
    // 0 : on écrit la requête SQL
    $reqSQL = 'SELECT * 
    FROM juryshackathons
 ';

 // 1 : on fabrique la requête PHP 
 $reqPHP = $bdd->prepare($reqSQL);
 $reqPHP->execute();
 $reqPHP->setFetchMode(PDO::FETCH_CLASS, 'Jury');

 // 2 : on récupère les résultats
 $jurys = $reqPHP->fetchAll();

 // 3 : on libère les tables de la requête
 $reqPHP->closeCursor(); // pour finir le traitement

 // 4 : on return le résultat
 return $jurys;
}

function insertJuryHackathon($bdd, $jury)
{
   // 0 : reqSQL : version avec ? qui sera passé en dur
   $reqSQL = 'INSERT INTO juryshackathons (idJury, idHackathon) 
      VALUES (:alias_idJury, :alias_idHackathon)
   ';
   debug($reqSQL, "reqSQL");

   // 1 :  prepare et debug
   $reqPHP = $bdd->prepare($reqSQL);
   debug($reqPHP, "reqPHP");

   // 2 : execute : version avec alias dans le reqSQL
   // $resultat c'est le nombre d'insert effectué
   try {
      // connexion à la BD : new PDO
      $resultat = $reqPHP->execute(array(
         'alias_idJury' => $jury->getId(),
         'alias_idHackathon' => $jury->getIdHackathon()
      ));
      // 3 : on libère les tables de la requête
      $reqPHP->closeCursor();
      // 4 : on return le résultat
      return $resultat;
   } catch (PDOException $e) {
      echo 'Insert échouée : ' . $e->getMessage();
      // 3 : on libère les tables de la requête
      $reqPHP->closeCursor();
      // 4 : on return le résultat
      return 0; // $resultat vaut 0 : pas d'insert effectué
   }
}
