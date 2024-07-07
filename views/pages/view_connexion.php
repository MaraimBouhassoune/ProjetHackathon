<!DOCTYPE html>
<html lang="fr">

<head>
	<?php include_once("../views/include/head.php") ?>
	<style>
        /* Style pour changer la couleur du placeholder en blanc */
        #Login::placeholder {
            color: white;
        }
        
        #Password::placeholder {
            color: white;
        }
    </style>
</head>

<body class="login-page">
	<header>
		<?php include_once("../views/include/header.php") ?>
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
			<form action="appel_ctrl_connexion.php" method="POST">

				<h1>Login</h1>

				<article class="place">
					<input id="Login" type="text" name="loginUser" placeholder="Login" color="white" required>
					<box-icon type="solid" name='user' color="black" size="ml"></box-icon>
				</article>

				<article class="place">
					<input id="Password" type="password" name="passwordUser" placeholder="Password" required>
					<box-icon type="solid" name='lock-alt' color="black" size="ml"></box-icon>
				</article>

				<select name="typeUser">
					<option value="participant">participant</option>
					<option value="jury">jury</option>
					<option value="admin">admin</option>
				</select>

				<article class="remember">
					<label><input type="checkbox" class="checkbox">Remember me</label>
					<a href="#" class="link">Forgot password?</a>
				</article>

				<input type="submit" class="btn" name="okConnexion" value="Login">

				<article class="register">
					<p>Don't have an account? <a href="ctrl_inscription.php">Signup</a></p>
				</article>

			</form>
		</section>
	</main>
	<footer>
		<p>Copyright <?php echo $copyright ?></p>
	</footer>
</body>

</html>