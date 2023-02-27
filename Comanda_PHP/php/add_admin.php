<?php
$product = $_POST['produto'];
$price = $_POST['price'];
$type = $_POST['type'];
$database = $_POST['database'];
include_once('connect.php');
mysqli_select_db($con,$database);
if($database == 'produtos'){
    $run = mysqli_query($con,"INSERT INTO products(product,price,type) VALUES ('$product',$price,'$type')");
    if($run){
        echo "ADICIONADO COM SUCESSO";
        echo "<a href='new-index.php'>voltar</a>";
    }
}
?>