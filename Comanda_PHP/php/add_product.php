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
                            while ($row = mysqli_fetch_assoc($run)) {
                                echo "<div class='product-block'>";
                                echo "<img src='" . $row['image'] . "' class='product-image'>";
                                echo "<div class='product-details'>";
                                echo "<span>" . $row['id'] . "</span>";
                                echo '<form id="product-form-' . $row['id'] . '" class="product-form" action="add.php" method="POST">';
                                echo "<span class='item-name'>" . $row['product'] . "</span>";
                                echo "<span class='item-price'>" . $row['price'] . "</span>";
                                echo "<input type='hidden' name='product-id' value='" . $row['id'] . "'>";
                                echo '<button type="submit" form="product-form-' . $row['id'] . '">ADICIONAR</button>';
                                echo "</form>";
                                echo "</div>";
                                echo "</div>";
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
