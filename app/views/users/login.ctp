<div class=container_15>
	<div class="suffix_5 prefix_5">
		<div class="login_fr" id="login-box">
			<?php echo $this->Form->create(); ?>
			<?php echo $this->Form->input("username",array("class"=>"form-control")); ?>
			<?php echo $this->Form->input("password",array("class"=>"form-control")); ?>
			<?php             
				$options = array(
		            "label" => "Submit",
		            "class" => "btn btn-success"
		        );
		    ?>
			<?php echo $this->Form->end($options); ?>
			<a class="btn btn-success" href="<?php echo Router::url('/Users/forgotPassword',true) ?>" role="button"><i class="fa fa-address-card-o" aria-hidden="true"></i> Forgot Password >></a>
		</div>
	</div>
</div>