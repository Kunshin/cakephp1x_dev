<h1 class='text-center'>Manager Student</h1>
<hr>
<div class=container_15>
  <a class='btn btn-success' href='<?php echo Router::url('/Students/load_add', true); ?>' role='button'><i class='fa fa-address-card-o' aria-hidden='true'></i> Add New Student</a>
  <hr>
  <h1 id='respose' style='text-align: center;color: green' ></h1>
  <br>
  <table class='table table-striped table-bordered'>
    <tr>
      <th><input type='checkbox' id='select_all'/></th>
      <th>ID</th>
      <th>Student Name</th>
      <th>Email</th>
      <th>Pasword</th>
      <th>Action</th>
    </tr>
  <?php 
    foreach($data as $item) {
      echo "<tr>";
      echo "<td class='td-center'><input class='checkbox' type='checkbox' name='check[]' value=".$item['Student']['id']."></td>";
      echo "<td>".$item['Student']['id']."</td>";
      echo "<td>".$item['Student']['username']."</td>";
      echo "<td>".$item['Student']['email']."</td>";
      echo "<td>".$item['Student']['password']."</td>";
      echo "<td><a type='button' class='btn btn-info' href='".Router::url('/Students/edit/'.$item['Student']['id'].'', true)."'>Edit</a>
      <a type='button' class='btn btn-danger' href='".Router::url('/Students/delete/'.$item['Student']['id'].'', true)."'>Delete</a></td>";
      echo "</tr>";
    } 
  ?>
