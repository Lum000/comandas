<?php 
include_once('connect.php');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if(isset($_POST['add'])){
    mysqli_select_db($con,'produtos');
    $product_id = $_POST['id_product'];
    $table_id = $_POST['table_id'];
    $table_name = 'mesa' . $table_id;
    $column_table_name = $table_name . $table_id;
    $product_query = "SELECT * FROM products WHERE id = $product_id";
    $run = mysqli_query($con,$product_query);
    $product = mysqli_fetch_assoc($run);
    $product_name = $product['product'];
    $product_price = $product['price'];
    mysqli_select_db($con,$table_name);
    $sql = "SELECT * FROM $column_table_name WHERE id = $product_id";
    $run = mysqli_query($con,$sql);
    if($result = mysqli_fetch_assoc($run)){
        $qty = $result['qty'];
        $quantidade = $qty + 1;
        mysqli_query($con,"UPDATE $column_table_name SET qty = $quantidade WHERE id = $product_id");
        header("Location:new-tables.php?id=$table_id");
    }
    else{
        $insert_query = "INSERT INTO $column_table_name (`id`, `product`, `price`, `total`) VALUES ($product_id, '$product_name', $product_price, $product_price)";
        mysqli_query($con,$insert_query);
        header("Location:new-tables.php?id=$table_id");
    }
}
else if(isset($_POST['minus'])){
    $product_id_minus = $_POST['item_id'];
    $table_id_minus = $_POST['table_id'];
    $table_name_minus = 'mesa' . $table_id_minus;
    $column_table_name_minus = $table_name_minus . $table_id_minus;

    mysqli_select_db($con,$table_name_minus);
    $run = mysqli_query($con,"SELECT * FROM $column_table_name_minus WHERE id = $product_id_minus");
    if($result = mysqli_fetch_assoc($run)){
        $qty_minus = $result['qty'];
        $quantidade_minus = $qty_minus - 1;
        mysqli_query($con,"UPDATE $column_table_name_minus SET qty = $quantidade_minus WHERE id = $product_id_minus");
        header("Location:new-tables.php?id=$table_id_minus");
    }
}
else if(isset($_POST['more'])){
    $product_id_minus = $_POST['item_id'];
    $table_id_minus = $_POST['table_id'];
    $table_name_minus = 'mesa' . $table_id_minus;
    $column_table_name_minus = $table_name_minus . $table_id_minus;

    mysqli_select_db($con,$table_name_minus);
    $run = mysqli_query($con,"SELECT * FROM $column_table_name_minus WHERE id = $product_id_minus");
    if($result = mysqli_fetch_assoc($run)){
        $qty_minus = $result['qty'];
        $quantidade_minus = $qty_minus + 1;
        mysqli_query($con,"UPDATE $column_table_name_minus SET qty = $quantidade_minus WHERE id = $product_id_minus");
        header("Location:new-tables.php?id=$table_id_minus");
    }
}
?>
