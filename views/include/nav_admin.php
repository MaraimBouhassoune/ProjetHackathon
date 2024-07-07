<ul>
   <li><a href="../ctrls/ctrl_admin.php">Accueil admin</a></li>
   <li><a href="../ctrls/ctrl_hackathons_gerer.php">Gérer Hackathons</a></li>
   <li><a href="../ctrls/ctrl_projets_gerer.php">Gérer Projets</a></li>
   <li><a href="../ctrls/ctrl_jury_creer.php">Créer Jurys</a></li>
   <li><a href="../ctrls/ctrl_jury_gerer.php">Gérer Jurys</a></li>
   <li><a href="../ctrls/ctrl_admin_participants.php">Participants</a></li>
</ul>
<div>
   <form action="appel_ctrl_deconnexion.php" method="POST">
      <label><?php echo $_SESSION["messageErreur"] ?></label>
      <label class="loginUser"><?php echo $_SESSION["loginUser"] . " est connecté comme " . $_SESSION["typeUser"]?></label>
      <button type="submit">Déconnexion</button>
   </form>
</div>