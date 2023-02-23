<?php 
include_once('connect.php');

if(isset($_POST['product-id'])) {
    $product_id = $_POST['product-id'];
    $run = mysqli_query($con,'SELECT * FROM products WHERE id='.$product_id);
    $result = mysqli_fetch_assoc($run);
    echo $result['product'];
    // A partir daqui, você pode usar o $product_id para fazer o que precisa com o produto escolhido.
    // Por exemplo, você pode adicionar o produto ao carrinho de compras do usuário ou incluí-lo na comanda.
}
?>
