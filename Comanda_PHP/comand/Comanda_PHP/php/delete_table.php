<?php
$table_id = $_GET['id'];
$table_name = "mesa". $table_id;

if($table_id > 0){
    $con = mysqli_connect('localhost','root','');
    $sql = "DROP DATABASE $table_name";
    if(mysqli_query($con,$sql)){
        echo "deletado";
        header('location:/Comanda_PHP/index.html');
    }

}



?>