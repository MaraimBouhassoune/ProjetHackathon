<ul>
   <li><a href="../ctrls/ctrl_participant.php">Accueil participant</a></li>
   <li><a href="../ctrls/ctrl_mes_hackathons.php">Mes Hackathons</a></li>
</ul>
<div>
   <form action="appel_ctrl_deconnexion.php" method="POST">
      <label class="loginUser"><?php echo $_SESSION["loginUser"] . " est connecté comme " . $_SESSION["typeUser"]?></label>
      <button type="submit">Déconnexion</button>
   </form>
</div>