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
		include_once("../views/include/nav_admin.php")
		?>
	</nav>
	<main>
		<h1>Les Participants : </h1>
		<p>Nombre de Participants : <?php echo sizeof($participants) ?> </p>
		<table border>
			<tr>
				<th>id</th>
				<th>login</th>
				<th>password</th>
				<th>nom</th>
				<th>prenom</th>
				<th>mail</th>
				<th>telephone</th>
				<th>date de naissance</th>
				<th>lien portfolio</th>
			</tr>
			<?php foreach ($participants as $participant) { ?>
				<tr>
					<td><?php echo $participant->getId() ?></td>
					<td><?php echo $participant->getLogin() ?></td>
					<td><?php echo $participant->getPassword() ?></td>
					<td><?php echo $participant->getNom() ?></td>
					<td><?php echo $participant->getPrenom() ?></td>
					<td><?php echo $participant->getMail() ?></td>
					<td><?php echo $participant->getTelephone()?></td>
					<td><?php echo $participant->getDateDeNaissance() ?></td>
					<td><?php echo $participant->getLienPorteFolio() ?></td>
				</tr>
			<?php } ?>
		</table>
	</main>
	<footer>
		<?php include("../views/include/footer.php"); ?>
	</footer>	
</body>

</html>