<!DOCTYPE html>
<html lang="fr">

<head>
	<?php include_once("../views/include/head.php") ?>
</head>

<body class="login-page">
	<header>
		<?php include_once("../views/include/header.php") ?>
		<style>
        /* Style pour changer la couleur du placeholder en blanc */
        input::placeholder {
            color: white;
        }
    </style>
	</header>
	<nav>
		<?php
		if ($_SESSION["typeUser"] == "public") {
			include_once("../views/include/nav_public.php");
		} else if ($_SESSION["typeUser"] == "admin") {
			include_once("../views/include/nav_admin.php");
		} else if ($_SESSION["typeUser"] == "jury") {
			include_once("../views/include/nav_jury.php");
		} else if ($_SESSION["typeUser"] == "participant") {
			include_once("../views/include/nav_participant.php");
		}
		?>
	</nav>
	<main>
		<section>
			<?php if (isset($erreur)) {
				echo $erreur;
			} ?>
			<form action="appel_ctrl_inscription.php" method="POST">

				<h1>Signin</h1>

				<!-- CREATE TABLE participants(
				idParticipant integer auto_increment,
				loginParticipant varchar(30) not null unique,
				passwordParticipant varchar(30) not null,
				nomParticipant varchar(30) not null,
				prenomParticipant varchar(30) not null,
				mailParticipant varchar(30) not null unique,
				telephoneParticipant varchar(10),
				dateDeNaissanceParticipant date,
				lienPorteFolioParticipant varchar(30),
				primary key(idParticipant)
				) engine innodb;
			 -->

				<article class="place">
					<input type="text" name="loginUser" placeholder="Login" required>
					<!-- <box-icon type="solid" name='user' color="black" size="ml"></box-icon> -->
				</article>

				<article class="place">
					<input type="password" name="passwordUser" placeholder="Password" required>
					<!-- <box-icon type="solid" name='lock-alt' color="black" size="ml"></box-icon> -->
				</article>

				<article class="place">
					<input type="password" name="passwordUser2" placeholder="Confirmed Password" required>
					<!-- <box-icon type="solid" name='lock-alt' color="black" size="ml"></box-icon> -->
				</article>

				<article class="place">
					<input type="text" name="nomUser" placeholder="Nom" required>
					<!-- <box-icon type="solid" name='user' color="black" size="ml"></box-icon> -->
				</article>

				<article class="place">
					<input type="text" name="prenomUser" placeholder="Prenom" required>
					<!-- <box-icon type="solid" name='user' color="black" size="ml"></box-icon> -->
				</article>

				<article class="place">
					<input type="text" name="mailUser" placeholder="Email" required>
					<!-- <box-icon type="solid" name='user' color="black" size="ml"></box-icon> -->
				</article>
				<input type=hidden name="typeUser" value="public">

				<!-- <article class="remember">
					<label><input type="checkbox" class="checkbox">Remember me</label>
					<a href="#" class="link">Forgot password?</a>
				</article> -->

				<input type="submit" class="btn" name="okInscription" value="Signin">

				<article class="register">
					<p>Already have an account? <a href="ctrl_connexion.php">Login</a></p>
				</article>

			</form>
		</section>
	</main>
	<footer>
		<p>Copyright <?php echo $copyright ?></p>
	</footer>

	<script>
		function validateForm() {
			var password1 = document.getElementById("passwordUser").value;
			var password2 = document.getElementById("passwordUser2").value;

			if (password1 !== password2) {
				alert("Les mots de passe ne correspondent pas.");
				return false; // Empêche l'envoi du formulaire
			}
			return true; // Permet l'envoi du formulaire si les mots de passe correspondent
		}
	</script>
</body>

</html>