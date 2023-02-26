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
    $sql = "CREATE TABLE IF NOT EXISTS $column_table_name (`id` INT NOT NULL AUTO_INCREMENT,`paid` DOUBLE DEFAULT 0,`total` DOUBLE NOT NULL DEFAULT 0,`qty` INT,`product` VARCHAR(255) NOT NULL DEFAULT '',`price` DOUBLE NOT NULL DEFAULT 0.0,`image` VARCHAR(255) DEFAULT '', PRIMARY KEY (`id`)) ENGINE = InnoDB";
    mysqli_query($con,$sql);
}

if(isset($_POST['SALVAR'])){
    mysqli_select_db($con,'mesas');
    $sql = "SELECT nome FROM mesas WHERE id=$table_id";
    $run = mysqli_query($con,$sql);
    $result = mysqli_fetch_assoc($run);
    if($result){
        null;
    }
    else{
        $name = $_POST['name'];
        $result_id = mysqli_insert_id($con);
        mysqli_select_db($con,'mesas');
        mysqli_query($con,"INSERT INTO mesas(nome,id,cor) VALUES ('$name',$table_id,1)");
        mysqli_select_db($con,$table_name);
    }
}
if(isset($_POST['modificar'])){
    mysqli_select_db($con,'mesas');
    $sql = "SELECT nome FROM mesas WHERE id=$table_id";
    $run = mysqli_query($con,$sql);
    $result = mysqli_fetch_assoc($run);
    if($result){
        $name = $_POST['name'];
        $result_id = mysqli_insert_id($con);
        mysqli_select_db($con,'mesas');
        mysqli_query($con,"UPDATE mesas SET nome='$name' WHERE id= $table_id");
        mysqli_select_db($con,$table_name);
    }
    else{
        $name = $_POST['name'];
        $result_id = mysqli_insert_id($con);
        mysqli_select_db($con,'mesas');
        mysqli_query($con,"INSERT INTO mesas(nome,id,cor) VALUES ('$name',$table_id,1)");
        mysqli_select_db($con,$table_name);
    }
}
mysqli_select_db($con,$table_name);
$sql = "SELECT * FROM $column_table_name";
$run = mysqli_query($con,$sql);
$result = mysqli_fetch_assoc($run);
if($result){
    $result_id = mysqli_insert_id($con);
    mysqli_select_db($con,'mesas');
    mysqli_query($con,"INSERT INTO mesas(nome,id,cor) VALUES ('sem nome',$table_id,1)");
    mysqli_select_db($con,$table_name);
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/comandas/Comanda_PHP/css/tables.css" rel="stylesheet">
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
        <?php
        mysqli_select_db($con,'mesas');
        $run = mysqli_query($con,"SELECT nome FROM mesas WHERE id = $table_id");
        $result = mysqli_fetch_assoc($run);
        if(isset($result['nome'])){
            echo "<div class='inputs'>";
            echo "<input type='text' class='name_h1' name='name' value='".$result['nome']."'>";
            echo "<input class='input_submit' type='submit' name='modificar' value='MODIFICAR'>";
            echo "</div>";
        }  else {
            echo "<h1 class='name_h1' >Deseja adicionar um nome?</h1>";
            echo "<div class='inputs'>";
            echo "<input class='input_text' type='text' name='name'>";
            echo "<input class='input_submit' type='submit' name='SALVAR' value='SALVAR'>";
            echo "</div>";
        }  
        ?>
        <div class="button-div">
            <button class="button_delete"><a href="delete_table.php?id=<?php echo $table_id ?>">deletar</a></button>
        </div>
    </header>

    <div class="container-mid">
        <section class="command-open">
            <div class="itens-display-group">
                    <div class="menu">
                        <div class="rotulos">
                                <h1>PRODUTO</h1>
                                <h1>QUANTIDADE</h1>
                                <h1>VALOR</h1>
                        </div>
                        <div class="menu-image">
                            <div class="img-header">
                                <?php 
                                mysqli_select_db($con,$table_name);
                                $run = mysqli_query($con,"SELECT product,price,qty,image FROM $column_table_name");
    
                                while ($result = mysqli_fetch_assoc($run)) {
                                ?>
                                <div class="product-block">
                                    <img src="<?php echo $result['image']; ?>" class="product-image">
                                    <div class="product-details">
                                        <span class="iten-name"><?php echo $result['product']; ?></span>
                                        <span class="item-qty"><?php echo $result['qty']; ?> </span>
                                        <span class="item-price"><?php if($result['price'] == 0){}else{echo $result['price'];} ?></span>
                                    </div>
                                </div>
                                <?php
                                }
                                ?>
                            <?php
                            mysqli_select_db($con,$table_name);
                            $run = mysqli_query($con,"SELECT SUM(price * qty) as total FROM $column_table_name");
                            $result = mysqli_fetch_assoc($run);
                            $total = $result['total'];
                            ?>
                            <div class="buttons">
                                <button class="add_button"><a href="add_product.php?id=<?php echo $table_id ?>">ADICIONAR</a></button>
                            <button class="close_comand_button"><a href="close_comand.php?id=<?php echo $table_id?>">FECHAR COMANDA</a></button>
                        </div>
                        <h1 class="total"><?php if($total){
                            mysqli_select_db($con,$table_name);
                            $run = mysqli_query($con,"SELECT SUM(paid) as total_pos FROM $column_table_name");
                            $result = mysqli_fetch_assoc($run);
                            $paid = $result['total_pos'];
                            $total_pos = $total - $paid;
                            $run = mysqli_query($con,"UPDATE $column_table_name SET total=$total_pos WHERE id=1");
                            echo "<h3>Valor pago: R$". number_format($paid,2,',', '.') ."</h3><br>";
                            echo "<h1 class='total'>Valor total: R$" . number_format($total_pos, 2, ',', '.') ."</h1>";}
                            else{
                                echo "Valor total: R$0,00";
                            } ?> </h1>
                        </div>


                    </div>
        </div>
    </div>
</body>
<script>

</script>
</html>
