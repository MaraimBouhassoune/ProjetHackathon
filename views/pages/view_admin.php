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
        <?php
        if ($_SESSION["typeUser"] == "admin") {
            include_once("../views/include/nav_admin.php");
        }
        ?>
    </nav>
    <main>
        <h2>Accueil Admin </h2>
        <section>
            
        </section>
    </main>
    <footer>
        <?php include("../views/include/footer.php"); ?>
    </footer>
</body>

</html>