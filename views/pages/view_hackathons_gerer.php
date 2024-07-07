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
		<h1>Les Hackathons : </h1>
		<p>Nombre de Hackthons : <?php echo sizeof($hackathons) ?> </p>
		<table border>
			<tr>
				<th>id</th>
				<th>nom</th>
				<th>date de début</th>
				<th>delete</th>
				<th>select update</th>
				<th>details</th>
			</tr>
			<?php foreach ($hackathons as $hackathon) { ?>
				<tr>
					<td><?php echo $hackathon->getId() ?></td>
					<td><?php echo $hackathon->getNom() ?></td>
					<td><?php echo $hackathon->getDateDebut() ?></td>

					<form id="form_suppression" action="#" method="POST" onsubmit="return confirmerDeleteHackathon(<?php echo $hackathon->getId(); ?>);">
						<input type=hidden name=idHackathon value=<?php echo $hackathon->getId(); ?>>
						<input type="hidden" name="confirmationDeleteHackathon" id="confirmationDeleteHackathon<?php echo $hackathon->getId(); ?>" value="">
						<td><input type="submit" value="delete" name="deleteHackathon"></td>
					</form>

					<form action="#" method="POST">
						<input type=hidden name=idHackathon value=<?php echo $hackathon->getId() ?>>
						<td><button type="submit" name=selectUpdateHackathon>select update</button></td>
					</form>

					<form action="../ctrls/appel_ctrl_hackathon_details.php" method="POST">
						<input type=hidden name=idHackathon value=<?php echo $hackathon->getId() ?>>
						<td><button type="submit">details</button></td>
					</form>
				</tr>
			<?php } ?>
		</table>
		<h2>
			<?php if (isset($hackathonAModifier)) {
				echo "Modification du hachathon n°" . $hackathonAModifier->getId();
			} else {
				echo "Ajout d'un nouveau hackathon";
			} ?>
		</h2>
		<form action="#" method="POST">
			<label>Nom :</label>
			<input type=text name=nomHackathon value="<?php // des guillemets sur value pour le cas où le getter
														// contient des espaces et la balise php collée aux guillemets
														if (isset($hackathonAModifier)) {
															echo $hackathonAModifier->getNom();
														}
														?>">

			<label>Date et heure de début : </label>
			<input type="text" name="dateDebutHackathon" placeholder="2023-12-31 09:30:00" value="<?php
																									if (isset($hackathonAModifier)) {
																										echo $hackathonAModifier->getDateDebut();
																									}
																									?>">

			<input type=hidden name=idHackathon value="<?php
														if (isset($hackathonAModifier)) {
															echo $hackathonAModifier->getId();
														}
														?>">

			<button type="submit" name=<?php
										if (isset($hackathonAModifier)) echo "updateHackathon";
										else echo "insertHackathon";
										?>>
				<?php
				if (isset($hackathonAModifier)) echo "Update Hackathon";
				else echo "Insert Hackathon : ";
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
		function confirmerDeleteHackathon(id) {
			// Demander une confirmation
			reponse = confirm("Êtes-vous sûr de vouloir supprimer cette ressource?")
			console.log("reponse: "+reponse)
			if (reponse) {
				// Si l'utilisateur confirme, définir la valeur de l'input hidden sur "oui" pour confirmer la suppression
				document.getElementById("confirmationDeleteHackathon"+id).value = "oui";
				return true;
			} else {
				// Si l'utilisateur annule, ne pas confirmer la suppression et rester sur la page
				document.getElementById("confirmationDeleteHackathon"+id).value = "non";
				return true; // Retourner true pour soumettre le formulaire malgré l'annulation de la suppression
			}
		}
	</script>
</body>

</html>