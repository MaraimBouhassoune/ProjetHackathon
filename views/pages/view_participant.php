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
		if ($_SESSION["typeUser"] == "participant") {
			include_once("../views/include/nav_participant.php");
		}
		?>
	</nav>
	<main>
		<h2>Accueil Participant : pour s'inscrire au Hackathon</h2>
		<section>
			<h1>Les Hackathons : </h1>
			<p>Nombre de Hackthons : <?php echo sizeof($hackathonsActuels) ?> </p>
			<table border>
				<tr>
					<th>id</th>
					<th>nom</th>
					<th>date de début</th>
					<th>Inscription</th>
				</tr>
				<?php foreach ($hackathonsActuels as $hackathonActuel) { ?>
					<tr>
						<td><?php echo $hackathonActuel->getId() ?></td>
						<td><?php echo $hackathonActuel->getNom() ?></td>
						<td><?php echo $hackathonActuel->getDateDebut() ?></td>
					

						<form action="appel_ctrl_inscription.php" method="POST">
							<input type=hidden name=idHackathon value=<?php echo $hackathonActuel->getId() ?>>
							<td><button type="submit" name=okInscriptionHack>S'inscrire</button></td>
						</form>
					</tr>
				<?php } ?>
			</table>
		</section>
	</main>
	<footer>
		<?php include("../views/include/footer.php"); ?>
	</footer>
</body>

</html>