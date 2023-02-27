<?php
include_once('connect.php');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


if($_GET['id'] == 0){
    $product = $_POST['produto'];
    $price = $_POST['price'];
    $type = $_POST['type'];
    $database = $_POST['database'];
    mysqli_select_db($con,$database);
    if($database == 'produtos'){
        $run = mysqli_query($con,"INSERT INTO products(product,price,type) VALUES ('$product',$price,'$type')");
        if($run){
            echo "ADICIONADO COM SUCESSO";
            echo "<a href='new-index.php'>voltar</a>";
        }
    }
}
else if($_GET['id'] == 1){
    $product = $_POST['product'];
    $price = $_POST['price'];
    $product_id = $_POST['id'];
    $type = $_POST['type'];
    mysqli_select_db($con,'produtos');
    try {
        $sql = "UPDATE `products`
        SET `product`='$product',
        `price`= $price,
        `type`='$type' 
        WHERE id = $product_id";
        $run = mysqli_query($con,$sql);
    } catch (mysqli_sql_exception $e) { 
    var_dump($e);
    exit; 
 } 
    if($run){
        header('location:new-index.php');
    }
}
?>