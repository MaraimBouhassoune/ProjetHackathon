<?php
/*
CREATE TABLE Participants(
	idParticipant integer auto_increment,
	loginParticipant varchar(30) not null unique,
	passwordParticipant varchar(30) not null, 
	nomParticipant varchar(30) not null,   
	prenomParticipant varchar(30) not null,   
	mailParticipant varchar(30) not null unique,   
	telephoneParticipant varchar(10),  
	dateDeNaissanceParticipant date,
	lienPorteFolioParticipant varchar(30),
	primary key(idParticipant)
) engine innodb;
*/

/* La fonction selectParticipantParId() SELECT un participant par son id 
 *    et retourne le participant
 * Entrées : 
 *		$bdd : l'objet PDO de la bdd ($reqPHP sera un objet PDOstatement)
 *    $idParticipant : l'id du participant à récupérer
 *	Sorties : 
 *		$objet : le participant (une seule ligne) : objet
*/
function selectParticipantConnected($bdd, $loginParticipant, $passwordParticipant)
{
   // 0 : on écrit la requête SQL
   $reqSQL = 'SELECT * 
      FROM participants
      WHERE loginParticipant = :alias_login
      AND passwordParticipant = :alias_password
   ';

   // 1 : on fabrique la requête PHP 
   $reqPHP = $bdd->prepare($reqSQL);
   $resultat = $reqPHP->execute(array(
      'alias_login' => $loginParticipant,
      'alias_password' => $passwordParticipant,
   ));
   $reqPHP->setFetchMode(PDO::FETCH_CLASS, 'Participant');

   // 2 : on récupère les résultats
   $participant = $reqPHP->fetch();

   // 3 : on libère les tables de la requête
   $reqPHP->closeCursor(); // pour finir le traitement

   // 4 : on return le résultat
   return $participant;
}

// else if (func_num_args() == 5) { // on a les 2 arguments dans un tableau
//    $this->idParticipant = 0;     // pas d'id : on met 0 en dur
//    $this->loginParticipant = func_get_arg(0);       // argument 1 : $loginParticipant
//    $this->passwordParticipant = func_get_arg(1); // argument 2 : $passwordParticipant
//    $this->nomParticipant = func_get_arg(2);
//    $this->prenomParticipant = func_get_arg(3);
//    $this->mailParticipant = func_get_arg(4);
// }

function insertParticipant($bdd, $participant)
{
   // 0 : reqSQL : version avec ? qui sera passé en dur
   $reqSQL = 'INSERT INTO participants (loginParticipant, passwordParticipant, nomParticipant, prenomParticipant, mailParticipant) 
           VALUES (:alias_login, :alias_password, :alias_nom, :alias_prenom, :alias_mail)';

   debug($reqSQL, "reqSQL");
   // debug($participant->getDateDebut(), "getDateDebut");

   // 1 :  prepare et debug
   $reqPHP = $bdd->prepare($reqSQL);
   debug($reqPHP, "reqPHP");

   // 2 : execute : version avec alias dans le reqSQL
   // $resultat c'est le nombre d'insert effectué
   try {
      // connexion à la BD : new PDO
      $resultat = $reqPHP->execute(array(
         'alias_login' => $participant->getLogin(),
         'alias_password' => $participant->getPassword(),
         'alias_nom' => $participant->getNom(),
         'alias_prenom' => $participant->getPrenom(),
         'alias_mail' => $participant->getMail()
      ));
      // 3 : on libère les tables de la requête
      $reqPHP->closeCursor();
      // 4 : on return le résultat
      // $_SESSION["typeUser"] = "participant";
      return $resultat;
   } catch (PDOException $e) {
      echo 'Insert échouée : ' . $e->getMessage();
      // 3 : on libère les tables de la requête
      $reqPHP->closeCursor();
      // 4 : on return le résultat
      return 0; // $resultat vaut 0 : pas d'insert effectué
   }
}

function inscriptionHackathon($bdd, $participantHackathon)
{

   // Obtenir la date et l'heure actuelles pour l'inscription
   $dateInscription = date("Y-m-d H:i:s");

   // Requête SQL pour insérer les données dans la table participantsHackathons
   $reqSQL = 'INSERT INTO participantshackathons (idParticipant, idHackathon, dateInscriptionParticipantHackathon) 
              VALUES (:alias_idParticipant, :alias_idHackathon, :alias_dateInscription)';

   // Préparation de la requête SQL
   $reqPHP = $bdd->prepare($reqSQL);

   try {
      // Exécution de la requête avec les valeurs correspondantes
      $resultat = $reqPHP->execute(array(
         'alias_idParticipant' => $participantHackathon->getId(),
         'alias_idHackathon' => $participantHackathon->getIdHackathon(),
         'alias_dateInscription' => $dateInscription
      ));

      // Fermeture du curseur
      $reqPHP->closeCursor();

      // Retourner le résultat de l'insertion
      return $resultat;
   } catch (PDOException $e) {
      echo 'Insertion échouée : ' . $e->getMessage();
      // Fermeture du curseur en cas d'erreur
      $reqPHP->closeCursor();
      // Retourner 0 en cas d'échec
      return 0;
   }
}

function selectParticipants($bdd)
{
   // 0 : on écrit la requête SQL
   $reqSQL = 'SELECT 
            COALESCE(idParticipant, "null") AS idParticipant, 
            COALESCE(loginParticipant, "null") AS loginParticipant, 
            COALESCE(passwordParticipant, "null") AS passwordParticipant, 
            COALESCE(nomParticipant, "null") AS nomParticipant, 
            COALESCE(prenomParticipant, "null") AS prenomParticipant, 
            COALESCE(mailParticipant, "null") AS mailParticipant, 
            COALESCE(telephoneParticipant, "null") AS telephoneParticipant, 
            COALESCE(dateDeNaissanceParticipant, "null") AS dateDeNaissanceParticipant, 
            COALESCE(lienPorteFolioParticipant, "null") AS lienPorteFolioParticipant
        FROM participants  
   ';

   // 1 : on fabrique la requête PHP 
   $reqPHP = $bdd->prepare($reqSQL);
   $reqPHP->execute();
   $reqPHP->setFetchMode(PDO::FETCH_CLASS, 'Participant');

   // 2 : on récupère les résultats
   $participants = $reqPHP->fetchAll();

   // 3 : on libère les tables de la requête
   $reqPHP->closeCursor(); // pour finir le traitement

   // 4 : on return le résultat
   return $participants;
}

function selectMesHackathons($idParticipant, $bdd)
{
   $reqSQL = 'SELECT idHackathon
   FROM participantshackathons
   WHERE idParticipant = :alias_idParticipant';

   $reqPHP = $bdd->prepare($reqSQL);
   
   $reqPHP->execute(array('alias_idParticipant' => $idParticipant));
   return $reqPHP->fetchAll(PDO::FETCH_COLUMN, 0); // Récupérer seulement les IDs
}
