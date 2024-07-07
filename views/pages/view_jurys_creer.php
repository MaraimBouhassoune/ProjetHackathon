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
		<p>Nombre de Jurys : <?php echo sizeof($jurys) ?> </p>
		<table border>
			<tr>
				<th>id</th>
				<th>login</th>
				<th>password</th>
				<th>nom</th>
				<th>delete</th>
			</tr>
			<?php foreach ($jurys as $jury) { ?>
				<tr>
					<td><?php echo $jury->getId() ?></td>
					<td><?php echo $jury->getLogin() ?></td>
					<td><?php echo $jury->getPassword() ?></td>
					<td><?php echo $jury->getNom() ?></td>

					<form id="form_suppression" action="#" method="POST" onsubmit="return confirmerDeleteJury(<?php echo $jury->getId(); ?>);">
						<input type=hidden name=idJury value=<?php echo $jury->getId(); ?>>
						<input type="hidden" name="confirmationDeleteJury" id="confirmationDeleteJury<?php echo $jury->getId(); ?>" value="">
						<td><input type="submit" value="delete" name="deleteJury"></td>
					</form>
				</tr>
			<?php } ?>
		</table>
		<h2>
			<?php if (isset($juryAModifier)) {
				echo "Modification du hachathon n°" . $juryAModifier->getId();
			} else {
				echo "Ajout d'un nouveau jury";
			} ?>
		</h2>
		<form action="#" method="POST">


			<label>Login :</label>
			<input type=text name=loginJury value="<?php // des guillemets sur value pour le cas où le getter
													// contient des espaces et la balise php collée aux guillemets
													if (isset($juryAModifier)) {
														echo $juryAModifier->getLogin();
													}
													?>">
			<label>Password :</label>
			<input type=text name=passwordJury value="<?php // des guillemets sur value pour le cas où le getter
													// contient des espaces et la balise php collée aux guillemets
													if (isset($juryAModifier)) {
														echo $juryAModifier->getPassword();
													}
													?>">

			<label>Nom :</label>
			<input type=text name=nomJury value="<?php // des guillemets sur value pour le cas où le getter
													// contient des espaces et la balise php collée aux guillemets
													if (isset($juryAModifier)) {
														echo $juryAModifier->getNom();
													}
													?>">

			<input type=hidden name=idJury value="<?php
													if (isset($juryAModifier)) {
														echo $juryAModifier->getId();
													}
													?>">

			<button type="submit" name=<?php
										if (isset($juryAModifier)) echo "updateJury";
										else echo "insertJury";
										?>>
				<?php
				if (isset($juryAModifier)) echo "Update Jury";
				else echo "Insert Jury ";
				?>
			</button>
		</form>

	</main>
	<footer>
		<?php include("../views/include/footer.php"); ?>
	</footer>

	<script>
		// un peu de JavaScript pour gérer la confirmation d'un delete
		// on pourrait faire pareil pour d'autres confirmations
		function confirmerDeleteJury(id) {
			// Demander une confirmation
			reponse = confirm("Êtes-vous sûr de vouloir supprimer cette ressource?")
			console.log("reponse: " + reponse)
			if (reponse) {
				// Si l'utilisateur confirme, définir la valeur de l'input hidden sur "oui" pour confirmer la suppression
				document.getElementById("confirmationDeleteJury" + id).value = "oui";
				return true;
			} else {
				// Si l'utilisateur annule, ne pas confirmer la suppression et rester sur la page
				document.getElementById("confirmationDeleteJury" + id).value = "non";
				return true; // Retourner true pour soumettre le formulaire malgré l'annulation de la suppression
			}
		}
	</script>
</body>

</html>