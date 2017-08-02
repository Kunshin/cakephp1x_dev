<?php if (isset($User) && count($User) > 0) { ?>

	<h1>Dear <?php echo $User['Student']['username'] ?></h1>

	<br />

	<h3>Your Password :</h3>

	<p>Password : <?php echo $User['Student']['password'] ?></p>

<?php } ?>