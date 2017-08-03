<?php if (isset($User) && count($User) > 0) { ?>

	<h1>Dear <?php echo $User['Student']['username'] ?></h1>

	<br />

	<h3>Activate User</h3>

	<?php if (isset($key) && count($key) > 0) { ?>

		<p>Please click link to active Your User : <?php echo Router::url('/Students/Active', true ).'/'.$key ?></p>

	<?php } ?>

<?php } ?>