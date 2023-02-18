<?php 
include_once('connect.php');

mysqli_select_db($con,'produtos');
$run = mysqli_query($con,"SELECT * FROM products");
$result = mysqli_fetch_assoc($run);


?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/comandas/Comanda_PHP/css/add_product.css" rel="stylesheet">
    <title>Mesas</title>
</head>
<body> 
<header>
        <nav>
            <ul class="nav_links">
                <li><a href="#">Fechamento</a></li>
                <li><a href="/comandas/Comanda_PHP/index.php">Mesas</a></li>
                <li><a href="#">Admin</a></li>
            </ul>
        </nav>
        <form method="POST" action="tables.php?id=<?php echo $table_id ?>">
        <div class="button-div">
            <button class="button_delete"><a href="delete_table.php?id=<?php echo $table_id ?>">deletar</a></button>
        </div>
    </header>

    <div class="container-mid">
        <div class="itens-display-group">
                <div class="menu">
                    <div class="menu-image">
                        <div class="img-header">
                            <?php 
                            mysqli_select_db($con,'produtos');
                            $run = mysqli_query($con,"SELECT * FROM products");
    
                            while ($result = mysqli_fetch_assoc($run)) {
                            ?>
                            <div class="product-block">
                                <img src="<?php echo $result['image']; ?>" class="product-image">
                                <div class="product-details">
                                    <form class="product-form" action="add.php">
                                        <span class="iten-name"><?php echo $result['product']; ?></span>
                                        <span class="item-price"><?php if($result['price'] == 0){}else{echo $result['price'];} ?></span>
                                        <input type="hidden" id="<?php echo $result['id'] ?>">
                                        <input type="submit" value="ADICIONAR">
                                    </form>
                                </div>
                            </div>
                            <?php
                            }
                            ?>
                        </div>


                    </div>
        </div>
    </div>
</body>
<script>

</script>
</html>
