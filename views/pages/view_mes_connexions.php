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
		<h1>Mes Connexions : </h1>
		<p>Nombre de vos connexions : <?php echo sizeof($mesConnexions) ?> </p>
		<table border>
			<tr>
				<th>id</th>
				<th>date et heure de connexion</th>
				<th>IP adresse</th>
			</tr>
			<?php foreach ($mesConnexions as $maConnexion) { ?>
				<tr>
					<td><?php echo $maConnexion->getId() ?></td>
					<td><?php echo $maConnexion->getLoginTime() ?></td>
					<td><?php echo $maConnexion->getIP() ?></td>
				</tr>
			<?php } ?>
		</table>
	</main>
	<footer>
		<?php include("../views/include/footer.php"); ?>
	</footer>	
</body>

</html>