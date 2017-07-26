<h1 class='text-center'>Edit Student</h1>

<hr>

<div class="container_15">
    <div class="suffix_3 prefix_3">

    <a class="btn btn-warning" href='<?php echo Router::url('/Students',true) ?>' role="button"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>

    <hr>

    <div class="mother-group">

    <?php 

        foreach($data as $item => $value) {

            echo $this->Form->create(false, array('url' => array('controller' => 'Students', 'action' => 'edit' , $value['Student']['id'])));

            echo $this->Form->input('username', array('default'=> $value['Student']['username'],'class'=>'form-control'));

            echo (isset($errors) && isset($errors['username'])) ? $errors['username'] : '';

            echo $this->Form->input('email', array('default'=> $value['Student']['email'],'class'=>'form-control','disabled' => 'disabled'));
            echo (isset($errors) && isset($errors['email'])) ? $errors['email'] : '';

        }

    ?>

    <hr>

    <?php

        $options = array('label' => 'Update','class' => 'btn btn-danger',);

        echo $this->Form->end($options);

    ?>

    </div>

</div>
