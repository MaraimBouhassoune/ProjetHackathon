<?php

function getUserIP() {
    $ip = '';
    if (isset($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

function insertLoginData($bdd, $user_id, $login_time, $ip_address){
    $reqSQL = 'INSERT INTO login_history (user_id, login_time, ip_address) VALUES (:alias_userid, :alias_logintime, :alias_ipadd)';

    $reqPHP = $bdd->prepare($reqSQL);
    $reqPHP->execute(array('alias_userid' => $user_id, 'alias_logintime' => $login_time, 'alias_ipadd' => $ip_address));
    $reqPHP->closeCursor();
}

selectConnexions($bdd);

function selectConnexions($bdd)
{
   // 0 : on écrit la requête SQL
   $reqSQL = 'SELECT * 
      FROM login_history
   ';

   // 1 : on fabrique la requête PHP 
   $reqPHP = $bdd->prepare($reqSQL);
   $reqPHP->execute();
   $reqPHP->setFetchMode(PDO::FETCH_CLASS, 'Connexion');

   // 2 : on récupère les résultats
   $connexions = $reqPHP->fetchAll();

   // 3 : on libère les tables de la requête
   $reqPHP->closeCursor(); // pour finir le traitement
    
   // 4 : on return le résultat
   return $connexions;
}