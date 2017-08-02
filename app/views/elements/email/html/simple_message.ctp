<?php if (isset($User) && count($User) > 0) { ?>

	<h1>Dear <?php echo $User['Student']['username'] ?></h1>

	<br />

	<h3>Your Profiles :</h3>

	<p>Username : <?php  echo $User['Student']['username'] ?></p>

	<p>Email : <?php  echo $User['Student']['email'] ?></p>

	<p>Information : <?php  echo $User['Student']['info'] ?></p>

	<?php if (isset($UserInput) && count($UserInput) > 0) { ?>

		<p>Password : <?php  echo $UserInput['password'] ?></p>

		<?php 

			if ($UserInput['role'] == 1) {

				$role = 'Admin';

			} else if ($UserInput['role'] == 2) {

				$role = 'Director';

			} else {

				$role = 'User';

			}

			echo  '<p>Role : '.$role.'</p>'

		?>

	<?php } ?>

<?php } ?>