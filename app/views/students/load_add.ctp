<h1 class="text-center">Add Student</h1>
<hr>
<div class=container_15>
    <div class="suffix_5 prefix_5">
        <legend>Add New Student</legend>
        <a class="btn btn-warning" href="<?php echo Router::url("/Students",true) ?>"" role="button"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
        <hr>
        <?php

            echo $this->Session->flash();

            if (isset($smtp_errors)) {

                echo $smtp_errors;

            }

            echo $this->Form->create(false, array("url" => array("controller" => "Students", "action" => "loadAdd")));

            echo $this->Form->input("username",array("class"=>"form-control"));

            echo (isset($errors) && isset($errors["username"])) ? $errors["username"] : "";

            echo $this->Form->input("email",array("class"=>"form-control"));

            echo (isset($errors) && isset($errors["email"])) ? $errors["email"] : "";

            echo $this->Form->input("info",array("class"=>"form-control"));

            echo (isset($errors) && isset($errors["info"])) ? $errors["info"] : "";

            echo $this->Form->input("role", array(
                "options" => array(
                    "1" => "Admin",
                    "2" => "Director",
                    "3" => "User"),
                "class"=>"form-control"
            ));

            echo (isset($errors) && isset($errors["role"])) ? $errors["role"] : "";

            echo $this->Form->input("password",array("type" => "password","class"=>"form-control"));

            echo (isset($errors) && isset($errors["password"])) ? $errors["password"] : "";

            echo $this->Form->input("password_confirm", array("type" => "password","class"=>"form-control"));

            echo (isset($errors) && isset($errors["password_confirm"])) ? $errors["password_confirm"] : "";

        ?>
        <hr>
        <?php

            $options = array(
                "label" => "Submit",
                "class" => "btn btn-success"
            );

            echo $this->Form->end($options);

        ?>
        <hr>
    </div>
</div>
