<html>
	<body>
		<div class="form-box" id="login-box">
		<div class="header">Sign In</div>
		<?php echo $this->Form->create();?>
		<?php echo $this->Form->input('username');?>
		<?php echo $this->Form->input('password');?>
		<button type="submit">Sign me in</button>
		<?php echo $this->Form->end();?>
		</div>
	</body>
</html>