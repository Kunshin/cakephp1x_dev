<h1 class="text-center">Manager Student</h1>
<hr>
<div class=container_15>
    <a class="btn btn-success" href="<?php echo Router::url("/Students/loadAdd", true); ?>" role="button"><i class="fa fa-address-card-o" aria-hidden="true"></i> Add New Student</a>
    <hr>
    <h1 id="respose" style="text-align: center;color: green" ></h1>
    <br>
    <table class="table table-striped table-bordered">
        <tr>
            <th><input type="checkbox" id="select_all"/></th>
            <th>ID</th>
            <th>Student Name</th>
            <th>Email</th>
            <th>Pasword</th>
            <th>Action</th>
        </tr>
        <?php 

            if (isset($data) && count($data) > 0) {

                foreach($data as $item) {

                    echo $this->Session->flash();

                    echo '<tr>';

                    echo '<td class="td-center"><input class="checkbox" type="checkbox" name="check[]" value='.$item["Student"]["id"].'></td>';

                    echo '<td>'.$item["Student"]["id"].'</td>';

                    echo '<td>'.$item["Student"]["username"].'</td>';

                    echo '<td>'.$item["Student"]["email"].'</td>';

                    echo '<td>'.$item["Student"]["password"].'</td>';

                    echo '<td>
                            <a type="button" class="btn btn-info" href="'.Router::url("/Students/edit/".$item["Student"]["id"]."", true).'">Edit</a>
                            <a type="button" class="btn btn-danger confirmDelete" data-toggle="modal" value="'.$item["Student"]["id"].'" data-target="#deleteModal" data-href="'.Router::url("/Students/delete/".$item["Student"]["id"]."", true).'">
                                Delete
                            </a>
                        </td>';

                    echo '</tr>';

                }

            }

        ?>
    </table>
    
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">Delete Student</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger actionDelete" href="">Delete</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

</div>
