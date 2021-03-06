<h1 class="text-center">Edit Student</h1>
<hr>
<div class="container_15">
    <div class="suffix_5 prefix_5">
        <a class="btn btn-warning" href="<?php echo Router::url("/Students",true) ?>" role="button"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
        <hr>
        <div class="mother-group">
            <?php

                echo $this->Session->flash();

                if (isset($data) && count($data) > 0) {

                    echo $this->Form->create(false, array("url" => array("controller" => "Students", "action" => "edit" , $data["id"])));

                    echo $this->Form->input("username", array("default"=> $data["username"],"class"=>"form-control","disabled" => "disabled"));

                    echo (isset($errors) && isset($errors["username"])) ? $errors["username"] : "";

                    echo $this->Form->input("email", array("default"=> $data["email"],"class"=>"form-control","disabled" => "disabled"));

                    echo (isset($errors) && isset($errors["email"])) ? $errors["email"] : "";

                    echo $this->Form->input("info", array("default"=> $data["info"],"class"=>"form-control"));

                    echo (isset($errors) && isset($errors["info"])) ? $errors["info"] : "";

                    echo '<hr>';

                    $options = array(
                        "label" => "Update",
                        "class" => "btn btn-success"
                    );

                    echo $this->Form->end($options);

                }

            ?>
        </div>
    </div>
</div>
