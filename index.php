<?php

  include "crud.php";
  $object = new Crud();

?>


<!DOCTYPE html>
<html class="no-js">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>OOP PHP CRUD WITH AJAX</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- BOOTSTRAP CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <!-- CUSTOM CSS -->
    <link rel="stylesheet" href="style.css">
    <!-- JQUERY  -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>   -->
    <!-- BOOTSTRAP JS -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>  
  </head>
  <body>

    <div class="container box">  
      <h3 align="center">PHP Mysql Ajax Crud using OOPS - Fetch Data</h3>
      <br>
      <button type="button" name="add" class="btn btn-primary" id="add-user-button" data-toggle="collapse" data-target="#user_collapse">Add User</button>
      <br><br>
      <div id="user_collapse" class="collapse">
        <form method="POST" id="user_form">
          <label>First Name</label>
          <input required type="text" name="first_name" id="first_name" class="form-control">
          <br>
          <label>Last Name</label>
          <input required type="text" name="last_name" id="last_name" class="form-control">
          <br>
          <label>Image</label>
          <input type="file" required name="user_image" id="user_image" class="form-control">
          <input type="hidden" name="hidden_user_image" id="hidden_user_image">
          <br>
          <span id="uploaded_image"></span>
          <br>
          <div align="center">
            <input type="hidden" name="action" id="action">
            <input type="hidden" name="user_id" id="user_id">
            <input type="submit" name="button_action" id="button_action" class="btn btn-primary" value="Submit">
          </div>
          <br>
        </form>
      </div>
      <div id="user_table" class="table-responsive">  

      </div>  
    </div>   

<script src="script.js"></script>  

  </body>
</html>