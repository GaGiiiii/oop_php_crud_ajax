<?php 

  include "crud.php";
  $object = new Crud();

  if(isset($_POST['action'])){

    if($_POST['action'] == "Load"){
      echo $object->get_data_in_table("SELECT * FROM users ORDER BY id DESC");
    }

    if($_POST['action'] == "Insert"){
      $first_name = mysqli_real_escape_string($object->connection, $_POST['first_name']);
      $last_name = mysqli_real_escape_string($object->connection, $_POST['last_name']);
      $image = $object->upload_file($_FILES['user_image']);
      $query = "INSERT INTO users (first_name, last_name, image) VALUES ('" . $first_name . "', '" . $last_name . "', '" . $image . "')";
      $object->execute_query($query);
      echo "Data Inserted";
    }

    if($_POST['action'] == "Fetch Single Data"){
      $output = array();
      $query = "SELECT * FROM users WHERE id = '" . $_POST["user_id"] . "'";
      $result = $object->execute_query($query);
      while($row = mysqli_fetch_array($result)){
        $output['first_name'] = $row['first_name'];
        $output['last_name'] = $row['last_name'];
        $output['user_image'] = $row['image'];
        $output['image'] = '<img src="images/' . $row['image'] . '" class="img-thumbnail" width="50" height="35">';
      }

      echo json_encode($output);
    }

    if($_POST['action'] == "Edit"){
      $image = '';

      if($_FILES['user_image']['name'] != ''){
        $image = $object->upload_file($_FILES['user_image']);
        $myFile = "images/" . $_POST['hidden_user_image'];
        unlink($myFile);
        echo "HIDDEN IMAGE: " . $_POST['hidden_user_image'] . "\nIMAGE: " . $image . "\n";
      }else{
        $image = $_POST['hidden_user_image'];
      }

      $first_name = mysqli_real_escape_string($object->connection, $_POST["first_name"]);  
      $last_name = mysqli_real_escape_string($object->connection, $_POST["last_name"]);

      $query = "UPDATE users SET first_name = '" . $first_name . "', last_name = '" . $last_name . "', image = '" . $image . "' WHERE id = '" . $_POST["user_id"] . "'";  
      $object->execute_query($query);  

      echo "Data Updated";
    }

    if($_POST['action'] == "Delete"){ 
      $query = "SELECT image FROM users WHERE id = '" . $_POST["user_id"] . "'";
      $result = $object->execute_query($query); 

      $image = mysqli_fetch_all($result, MYSQLI_ASSOC);
      $imageToDelete = $image[0]['image'];

      $myFile = "images/" . $imageToDelete;
      unlink($myFile);

      $query = "DELETE FROM users WHERE id = '" . $_POST["user_id"] . "'";
      $object->execute_query($query);  

      echo "Data Deleted";
    }
  }







?>