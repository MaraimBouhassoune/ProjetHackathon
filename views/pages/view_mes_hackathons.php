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
		include_once("../views/include/nav_participant.php")
		?>
	</nav>
	<main>
		<h1>Mes Hackathons : </h1>
		<p>Nombre de Hackathons auquels vous avez participé : <?php echo sizeof($mesHackathons) ?> </p>
		<table border>
			<tr>
				<th>id</th>
				<th>nom</th>
				<th>date de début</th>
			</tr>
			<?php foreach ($mesHackathons as $monHackathon) { ?>
				<tr>
					<td><?php echo $monHackathon->getId() ?></td>
					<td><?php echo $monHackathon->getNom() ?></td>
					<td><?php echo $monHackathon->getDateDebut() ?></td>
				</tr>
			<?php } ?>
		</table>
	</main>
	<footer>
		<?php include("../views/include/footer.php"); ?>
	</footer>	
</body>

</html>