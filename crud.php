<?php 

  class Crud{

    public $connection;
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $databaseName = "php_ajax_crud";

    function __construct(){
      $this->database_connect();
    }

    public function database_connect(){
      $this->connection = mysqli_connect($this->host, $this->username, $this->password, $this->databaseName);
    }

    public function execute_query($query){
      return mysqli_query($this->connection, $query);
    }

    public function upload_file($file){
      if(isset($file)){
        $extension = explode('.', $file['name']);
        $new_name = rand() . '.' . $extension[1];
        $destination = './images/' . $new_name;
        move_uploaded_file($file['tmp_name'], $destination);

        return $new_name;
      }
    }

    public function get_data_in_table($query){
      $output = "";
      $result = $this->execute_query($query);
      $output .= '
        <table class="table table-bordered table-striped">
          <tr>
            <th width="10%">IMAGE</th>
            <th width="35%">FIRST NAME</th>
            <th width="35%">LAST NAME</th>
            <th width="10%">&nbsp;</th>
            <th width="10%">&nbsp;</th>
          </tr>
      ';
      while($row = mysqli_fetch_object($result)){
        $output .= '
          <tr>
            <td><img src="images/' . $row->image . '" class="img-thumbnail" width="50" height="15"></td>
            <td><span class="user-data">' . $row->first_name . '</span></td>
            <td><span class="user-data">' . $row->last_name . '</span></td>
            <td><span class="user-data"><button type="button" name="update" id="' . $row->id . '" class="btn btn-warning btn-xs update">Update</button></span></td>
            <td><span class="user-data"><button type="button" name="delete" id="' . $row->id . '" class="btn btn-danger btn-xs delete">Delete</button></span></td>
          </tr>  
        ';
      }

      $output .= '</table>';

      return $output;
    }
  }




?>