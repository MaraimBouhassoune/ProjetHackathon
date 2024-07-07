<!DOCTYPE html>
<html lang="fr">

<head>
	<?php include_once("../views/include/head.php") ?>
	<!-- Favicon -->
    <link rel="icon" type="image/png" href="../public/img/Logo.PNG">
    
    <!-- Balises de Données Structurées pour le Logo -->
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "Organization",
      "url": "https://projethackathon.fr",
      "logo": "https://projethackathon.fr/public/img/Logo.PNG"
    }
    </script>
</head>

<body>
	<header>
		<?php include_once("../views/include/header.php") ?>
	</header>
	<nav>
		<?php
		if ($_SESSION["typeUser"] == "public") {
			include_once("../views/include/nav_public.php");
		}
		?>
	</nav>
	<main>
		<h2>Accueil Public</h2>
		<section>
			<h1>Les Hackathons : </h1>
			<p>Nombre de Hackthons : <?php echo sizeof($hackathonsActuels) ?> </p>
			<table border>
				<tr>
					<th>id</th>
					<th>nom</th>
					<th>date de début</th>
					<th>Compte a rebours </th>
				</tr>
				<?php foreach ($hackathonsActuels as $hackathonActuel) { ?>
					<tr>
						<td><?php echo $hackathonActuel->getId() ?></td>
						<td><?php echo $hackathonActuel->getNom() ?></td>
						<td><?php echo $hackathonActuel->getDateDebut() ?></td>
						<td id="countdown-<?php echo $hackathonActuel->getId() ?>"></td>
					</tr>
				<?php } ?>
			</table>
		</section>
	</main>
	<footer>
		<?php include("../views/include/footer.php"); ?>
	</footer>
	<script>
		// Fonction pour mettre à jour le compte à rebours
		function updateCountdown() {
			<?php foreach ($hackathonsActuels as $hackathonActuel) { ?>
				// Calcul du temps restant jusqu'à la date de début du hackathon
				var countdownElement = document.getElementById("countdown-<?php echo $hackathonActuel->getId() ?>");
				var startDate = new Date("<?php echo $hackathonActuel->getDateDebut() ?>").getTime();
				var now = new Date().getTime();
				var timeleft = startDate - now;

				// Calcul des jours, heures, minutes et secondes
				var days = Math.floor(timeleft / (1000 * 60 * 60 * 24));
				var hours = Math.floor((timeleft % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
				var minutes = Math.floor((timeleft % (1000 * 60 * 60)) / (1000 * 60));
				var seconds = Math.floor((timeleft % (1000 * 60)) / 1000);

				// Affichage du compte à rebours dans la cellule correspondante
				countdownElement.innerHTML = days + "j " + hours + "h " + minutes + "m " + seconds + "s ";

				// Gérer le cas où le compte à rebours est terminé
				if (timeleft < 0) {
					clearInterval(updateInterval);
					countdownElement.innerHTML = "Commencé";
				}
			<?php } ?>
		}

		// Mise à jour du compte à rebours toutes les secondes
		var updateInterval = setInterval(updateCountdown, 1000);
	</script>

</body>

</html>
