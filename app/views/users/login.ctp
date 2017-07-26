<html>
	<body>
		<div class="form-box" id="login-box">
		<div class="header">Sign In</div>
		<?=$this->Form->create();?>
		<?=$this->Form->input('username');?>
		<?=$this->Form->input('password');?>
		<button type="submit">Sign me in</button>
		<?=$this->Form->end();?>
		</div>
	</body>
</html>