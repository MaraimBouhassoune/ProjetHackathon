<ul>
   <li><a href="../ctrls/ctrl_jury.php">Accueil jury</a></li>
</ul>
<div>
   <form action="appel_ctrl_deconnexion.php" method="POST">
      <label class="loginUser"><?php echo $_SESSION["loginUser"] . " est connecté comme " . $_SESSION["typeUser"]?></label>
      <button type="submit">Déconnexion</button>
   </form>
</div>