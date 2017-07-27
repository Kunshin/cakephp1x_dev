<div class="form-box" id="login-box">
	<?php echo $this->Form->create(); ?>
	<?php echo $this->Form->input("username"); ?>
	<?php echo $this->Form->input("password"); ?>
	<?php             
		$options = array(
            "label" => "Submit",
            "class" => "btn btn-success"
        ); 
    ?>
	<?php echo $this->Form->end($options); ?>
</div>