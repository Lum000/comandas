<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once('connect.php');

if(isset($_POST['product-id'])) {
    mysqli_select_db($con,'produtos');
    $table_id = $_POST['table-id'];
    $table_name = 'mesa'. $table_id;
    $product_id = $_POST['product-id'];
    $column_table_name = $table_name . $table_id;
    $run = mysqli_query($con,'SELECT * FROM products WHERE id='.$product_id);
    $result = mysqli_fetch_assoc($run);
    $product = $result['product'];
    $price = $result['price'];
    $image = $result['image'];
    $id = $result['id'];
    mysqli_select_db($con,$table_name);
    $run = mysqli_query($con,"SELECT * FROM $column_table_name WHERE id=$id");
    $result = mysqli_fetch_assoc($run);
    if($result){
        $quantidade = $result['qty'] + 1;
        $sql = "UPDATE $column_table_name SET qty=$quantidade WHERE id=$id";
        mysqli_query($con,$sql);
        header("Location: http://localhost/comandas/Comanda_PHP/php/tables.php?id=$table_id");
        exit();
    }
    else{
        $sql = "INSERT INTO $column_table_name(product,price,qty,image,id) VALUES('$product',$price,1,'$image',$id)";
        mysqli_query($con,$sql);
        header("Location: http://localhost/comandas/Comanda_PHP/php/tables.php?id=$table_id");
        exit();
    }
    // A partir daqui, você pode usar o $product_id para fazer o que precisa com o produto escolhido.
    // Por exemplo, você pode adicionar o produto ao carrinho de compras do usuário ou incluí-lo na comanda.
}
?>
