<?php
$table_id = $_GET['id'];
$table_name = "mesa". $table_id;

if($table_id > 0){
    $con = mysqli_connect('localhost','root','');
    $sql = "DROP DATABASE $table_name";
    if(mysqli_query($con,$sql)){
        mysqli_select_db($con,'mesas');
        $run = mysqli_query($con,"DELETE FROM mesas WHERE id = $table_id");
        if($run){
            header('location:/comandas/Comanda_PHP/index.php');
        }
    }

}



?>