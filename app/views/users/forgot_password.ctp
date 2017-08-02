<div class="form-box" id="forgot-password-box">

	<a class="btn btn-success" href="<?php echo Router::url('/Users/login',true) ?>" role="button"><i class="fa fa-address-card-o" aria-hidden="true"></i> << Back</a>

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