<?php if (isset($User) && count($User) > 0) { ?>

	<h1>Dear <?php echo $User['Student']['username'] ?></h1>

	<br />

	<h3>Your Password :</h3>

	<?php if (isset($password)) { ?>

	<p>Password : <?php echo $password ?></p>

	<?php } ?>

<?php } ?>