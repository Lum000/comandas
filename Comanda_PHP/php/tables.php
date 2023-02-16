<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$table_id = $_GET['id'];
$table_name = "mesa". $table_id;
$con = mysqli_connect('localhost','root','');
$column_table_name = $table_name. $table_id;
$sql = "CREATE DATABASE IF NOT EXISTS $table_name";

if(mysqli_query($con,$sql)){
    mysqli_select_db($con,$table_name);
    $sql = "CREATE TABLE IF NOT EXISTS $column_table_name (`id` INT NOT NULL AUTO_INCREMENT,`name` VARCHAR(255) NOT NULL DEFAULT '',`product` VARCHAR(255) NOT NULL DEFAULT '',`price` DOUBLE NOT NULL DEFAULT 0.0, PRIMARY KEY (`id`)) ENGINE = InnoDB";
    mysqli_query($con,$sql);
}

if(isset($_POST['SALVAR'])){
    $name = $_POST['name'];
    $sql = "INSERT INTO $column_table_name(name) VALUES ('$name')";
    mysqli_query($con,$sql);
    $result_id = mysqli_insert_id($con);
    mysqli_select_db($con,'mesas');
    mysqli_query($con,"INSERT INTO mesas(nome,id,cor) VALUES ('$name',$table_id,1)");
    mysqli_select_db($con,$table_name);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/tables.css" rel="stylesheet">
    <title>Mesas</title>
</head>
<body> 
    <form method="POST" action="tables.php?id=<?php echo $table_id ?>">
    <?php
    $run = mysqli_query($con,"SELECT name FROM $column_table_name");
    $result = mysqli_fetch_assoc($run);
    if(isset($result['name'])){
        echo "<h1 class='name_h1'> Nome atual:".$result['name']."</h1>";
        echo "<button class='button_name'> <a href='modify_name.php?id='".$table_id.">Modificar</a></button>";
    }  else {
        echo "<h1 class='name_h1' >Deseja adicionar um nome?</h1>";
        echo "<input class='input_text' type='text' name='name'>";
        echo "<input class='input_submit' type='submit' name='SALVAR' value='SALVAR'>";
      }  
    ?>
    <button><a href="delete_table.php?id=<?php echo $table_id ?>">deletar</a></button>
</body>
<script>

</script>
</html>
