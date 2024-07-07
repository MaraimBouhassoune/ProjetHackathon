<?php
function selectEquipes($bdd) {
    $reqSQL = 'SELECT e.*
               FROM equipes e
               JOIN participantsEquipes pe ON e.idEquipe = pe.idEquipe
               GROUP BY e.idEquipe';

    $reqPHP = $bdd->prepare($reqSQL);
    $reqPHP->execute();
    $reqPHP->setFetchMode(PDO::FETCH_CLASS, 'Equipe');

    $equipes = $reqPHP->fetchAll();

    $reqPHP->closeCursor();

    return $equipes;
}
