<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include_once('connect.php');

if($table_id = $_GET['id']){
    if($table_id > 0 ){
        $table_name = "mesa". $table_id;
        $sql = "DROP DATABASE $table_name";
        if(mysqli_query($con,$sql)){
            mysqli_select_db($con,'mesas');
            $run = mysqli_query($con,"UPDATE mesas SET cor = 0 WHERE id = $table_id");
            if($run){
                header('location:new-index.php');
            }
        }
    }
}



?>