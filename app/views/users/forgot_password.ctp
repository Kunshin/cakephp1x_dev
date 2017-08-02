<div class="form-box" id="forgot-password-box">

	<?php echo $this->Form->create(); ?>

	<?php echo $this->Form->input("email",array("class"=>"form-control")); ?>

    <?php echo (isset($errors) && isset($errors["email"])) ? $errors["email"] : ""; ?>

	<?php                     
		$options = array(
	        "label" => "Send Mail",
	        "class" => "btn btn-success"
        ); 
    ?>
    
	<?php echo $this->Form->end($options); ?>
</div>