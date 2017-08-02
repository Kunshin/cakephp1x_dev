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
		</div>
	</div>
</div>