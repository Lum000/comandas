<?php 
include_once('connect.php');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$table_id = $_GET['id'];

//pegar nome da mesa
mysqli_select_db($con,'mesas');
$run = mysqli_query($con,"SELECT nome FROM mesas WHERE id = $table_id");
if($result = mysqli_fetch_assoc($run)){
    $name = $result['nome'];
}
//criar banco de dados
$table_name = 'mesa' . $table_id;
$sql = "CREATE DATABASE IF NOT EXISTS $table_name";
$column_table_name = $table_name . $table_id;
if(mysqli_query($con,$sql)){
    mysqli_select_db($con,'mesas');
    $sql = "UPDATE mesas SET cor=1 WHERE id=$table_id";
    if(mysqli_query($con,$sql)){
        if(mysqli_query($con,$sql)){
            mysqli_select_db($con,$table_name);
            $sql = "CREATE TABLE IF NOT EXISTS $table_name.$column_table_name (`id` INT NOT NULL , `product` VARCHAR(255) NULL , `price` DOUBLE  NULL , `total` DOUBLE  NULL ) ENGINE = InnoDB;";
            mysqli_select_db($con,$table_name);
            mysqli_query($con,$sql);
        }
    }
}
else {
    echo "ERRO AO CRIAR BANCO DE DADOS";
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/comandas/Comanda_PHP/css/new-tables.css" rel="stylesheet">
    <title>MESA <?php echo $table_id ?></title>
</head>
<body>
    <header>
        <span class="text_logo"><h2>BURCA'S</h2></span>
        <nav class="nav_links">
            <ul>
                <li><a href="#">Link1</a></li>
                <li><a href="#">Link2</a></li>
                <li><a href="#">Link3</a></li>
            </ul>
        </nav>
        <button><a>haha</a></button>
    </header>
    <section class="container_mid">
        <div class="table">
            <div class="header_table">
                <span class="table_number"><h1>Mesa : <?php echo $table_id ?></h1></span>
                <span class="table_name"><h1>Nome : <?php echo $name ?></h1>
            </div>
            <?php
            $sql = "SELECT * FROM $table_name"
            ?>
        </div>
        <div class="add_product">
            <div class="header_products">
                <button id="burguer"><a>hamburguer</a></button>
                <button id="porcao"><a>PORCAO</a></button>
                <button><a>DIVERSOS</a></button>
                <button><a>bebidas</a></button>
            </div>
            <?php 
            mysqli_select_db($con,'produtos');
            $sql = "SELECT * FROM products";
            $run = mysqli_query($con,$sql);
            ?>
            <div class="products_add">
                <?php
                while($result = mysqli_fetch_assoc($run)){
                ?>
                    <div class="product">
                        <span id='span' class="product_name"><h2><?php echo $result['product']?></h2></span>
                        <span class="product_price"><h3><?php echo $result['price'] ?></h3></span>
                        <input type="hidden" name="id_product">
                    </div>
                <?php
                }?>
            </div>
        </div>
    </section>
</body>
<script>
    const burguer = document.getElementById('burguer');
    const div1 = document.getElementById('div1');
    const div2 = document.getElementById('div2');
    const container = document.getElementById('span');
    <?php 
    mysqli_select_db($con,'produtos');
    $sql = "SELECT * FROM products";
    $run = mysqli_query($con,$sql);
    $result = mysqli_fetch_assoc($run);
    ?>
    burguer.addEventListener('click', function() {
        const newDiv = document.createElement('div');
        newDiv.innerHTML = `
    <span id='span' class="product_name"><h2><?php echo $result['product'] ?></h2></span>
    <span class="product_price"><h3>R$<?php echo $result['price'] ?></h3></span>
    <input type="hidden" name="id_product">
`;
        newDiv.style.color = 'red';
        container.appendChild(newDiv);
        burguer.style.backgroundColor = "blue";

    });

</script>
</html>