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
		<h1>Les Jurys : </h1>
		<?php foreach ($hackathons as $hackathon) : ?>
			<!-- Tableau pour afficher les détails du hackathon -->
			<table border>
				<h4>Détails du Hackathon <?php echo $hackathon->getNom(); ?></h4>
				<tr>
					<th>id</th>
					<th>nom</th>
					<th>date de début</th>
				</tr>
				<tr>
					<td><?php echo $hackathon->getId() ?></td>
					<td><?php echo $hackathon->getNom() ?></td>
					<td><?php echo $hackathon->getDateDebut() ?></td>
				</tr>
			</table>

			<!-- Tableau pour afficher les jurys du hackathon -->
			<table border>
				<h4>Jurys du Hackathon <?php echo $hackathon->getNom(); ?></h4>
				<tr>
					<th>Membre du Jury</th>
				</tr>
				<?php foreach ($jurys as $jury) : ?>
					<?php if ($jury->getIdHackathon() == $hackathon->getId()) : ?>
						<tr>
							<td><?php echo $jury->getId(); ?></td>
						</tr>
					<?php endif; ?>
				<?php endforeach; ?>
			</table>
		<?php endforeach; ?>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		
		<form action="#" method="POST">


			<label>idJury :</label>
			<input type="number" name="idJury" value="<?php // des guillemets sur value pour le cas où le getter
													// contient des espaces et la balise php collée aux guillemets
													if (isset($juryAModifier)) {
														echo $juryAModifier->getLogin();
													}
													?>">
			<label>idHackathon :</label>
			<input type="number" name="idHackathon" value="<?php // des guillemets sur value pour le cas où le getter
														// contient des espaces et la balise php collée aux guillemets
														if (isset($juryAModifier)) {
															echo $juryAModifier->getPassword();
														}
														?>">

			<label>nomJury :</label>
			<input type="text" name="nomJury" value="<?php // des guillemets sur value pour le cas où le getter
													// contient des espaces et la balise php collée aux guillemets
													if (isset($juryAModifier)) {
														echo $juryAModifier->getNom();
													}
													?>">


			<button type="submit" name=<?php
										if (isset($juryAModifier)) echo "updateJury";
										else echo "insertJury";
										?>>
				<?php
				if (isset($juryAModifier)) echo "Update Jury";
				else echo "Ajouter Jury";
				?>
			</button>
		</form>


</body>

</html>