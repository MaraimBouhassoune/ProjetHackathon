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
		if ($_SESSION["typeUser"] == "jury") {
			include_once("../views/include/nav_jury.php");
		} 
		?>
	</nav>
	<main>
		<h2>Accueil Jury : à faire !</h2>
		<section>
			<h3>Voici la liste des nouveaux hackathons : incrivez vous !</h2>
		</section>
	</main>
	<footer>
		<?php include("../views/include/footer.php"); ?>
	</footer>
</body>

</html>