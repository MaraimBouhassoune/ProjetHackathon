<!DOCTYPE html>
<html lang="fr">

<head>
    <?php include_once("../views/include/head.php") ?>
</head>

<body>
    <header>
        <?php include_once("../views/include/header.php") ?>
    </header>
    <nav>
        <?php include_once("../views/include/nav_jury.php") ?>
    </nav>
    <main>
        <?php
$equipes = selectEquipes($bdd);

echo "<h3>Liste des Équipes</h3>";
if (count($equipes) > 0) {
    echo "<ul>";
    foreach ($equipes as $equipe) {
        echo "<li>" .
            "ID Equipe: " . htmlspecialchars($equipe->getIdEquipe()) . ", " .
            "Nom: " . htmlspecialchars($equipe->getNomEquipe()) . ", " .
            "Lien Projet: " . htmlspecialchars($equipe->getLienProjetEquipe()) . ", " .
            "Note: " . htmlspecialchars($equipe->getNoteProjetEquipe()) . ", " .
            "Classement: " . htmlspecialchars($equipe->getClassementEquipe()) . ", " .
            "ID Chef: " . htmlspecialchars($equipe->getIdParticipantChef()) . ", " .
            "ID Projet: " . htmlspecialchars($equipe->getIdProjet()) .
            "</li>";
    }
    echo "</ul>";
} else {
    echo "<p>Aucune équipe trouvée.</p>";
}

?>
    </main>
    <footer>
        <?php include("../views/include/footer.php"); ?>
    </footer>
</body>

</html>