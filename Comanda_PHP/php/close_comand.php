<?php
include_once("connect.php");

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$table_id = $_GET['id'];
$table_name = 'mesa' . $table_id;
$column_table_name = $table_name . $table_id;
mysqli_select_db($con,'mesas');
$run = mysqli_query($con,"SELECT nome FROM mesas WHERE id=$table_id");
$result = mysqli_fetch_assoc($run);
$name = $result['nome'];

$backup_name = $name . date('Y-m-dH:i:s');
$date = date('Y-m-d H:i:s');
mysqli_select_db($con,$table_name);

$run = mysqli_query($con,"SELECT total FROM $column_table_name WHERE id=1");
$result = mysqli_fetch_assoc($run);
$paid = $_POST['value'];

$produtos = array(); // criando um array vazio

$run = mysqli_query($con,"SELECT product FROM $column_table_name");
while ($row = mysqli_fetch_assoc($run)) {
    // adicionando o produto ao array
    $produtos[] = $row['product'];
}
if(isset($_POST['fechar'])){
    if($result['total'] <= 0){
        $total = $result['total'];
        mysqli_select_db($con,'backup_mesas');
        mysqli_query($con,"CREATE TABLE `backup_mesas`.`$backup_name` (`id` INT NOT NULL AUTO_INCREMENT , `number` INT NOT NULL , `name` VARCHAR(255) NOT NULL DEFAULT '' , `time` VARCHAR(255) NOT NULL , `products` INT(255), `total` DOUBLE NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;");
        $sql = "INSERT INTO `$backup_name`(name,number,time,total) VALUES('$name',$table_id,'$date',$total)";
        mysqli_query($con,$sql);
        mysqli_select_db($con,$table_name);
        $run = mysqli_query($con,"DROP DATABASE $table_name");
        mysqli_select_db($con,'mesas');
        $run = mysqli_query($con,"DELETE FROM mesas WHERE id=$table_id");
        header("location:/comandas/Comanda_PHP/index.php");
    }
    else if($result['total'] == $paid){
        $total = $result['total'];
        mysqli_select_db($con,'backup_mesas');
        mysqli_query($con,"CREATE TABLE `backup_mesas`.`$backup_name` (`id` INT NOT NULL AUTO_INCREMENT , `number` INT NOT NULL , `name` VARCHAR(255) NOT NULL DEFAULT '' , `time` VARCHAR(255) NOT NULL , `products` INT(255), `total` DOUBLE NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;");
        $sql = "INSERT INTO `$backup_name`(name,number,time,total) VALUES('$name',$table_id,'$date',$total)";
        mysqli_query($con,$sql);
        mysqli_select_db($con,$table_name);
        $run = mysqli_query($con,"DROP DATABASE $table_name");
        mysqli_select_db($con,'mesas');
        $run = mysqli_query($con,"DELETE FROM mesas WHERE id=$table_id");
        header("location:/comandas/Comanda_PHP/index.php");
    }
    else{
        $total_pos = $result['total'] - $paid;
        mysqli_select_db($con,$table_name);
        mysqli_query($con,"UPDATE $column_table_name SET total=$total_pos");
        mysqli_query($con,"INSERT INTO $column_table_name(paid) VALUES($paid)");
        header("location:close_comand.php?id=$table_id");
    }
}


?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/comandas/Comanda_PHP/css/close_comand.css" rel="stylesheet">
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

    </header>

    <div class="container-mid">
        <div class="itens-display-group">
                <div class="menu">
                    <div class="menu-image">
                        <div class="img-header">
                            <div class="Total">
                                <h1>SEU TOTAL É R$<?php if(isset($result['total'])){echo $result['total'];} ?></h1>
                                <h2>VALOR DIVIDIDO EM 2 R$<?php if(isset($result['total'])){echo $result['total'] / 2;}?></h2>
                                <form method="POST" action="close_comand.php?id=<?php echo $table_id ?>">
                                <div class="input_number">
                                        <label for="valor">Valor que deseja pagar:</label>
                                        <input type="number" class="input_valor" step="0.01" id="value" name="value" placeholder="0.00"><br>
  
                                        <label for="pago">Valor pago:</label>
                                        <input type="number" class="input_paid" step="0.01" id="pago" name="pago" placeholder="0.00"><br><br>
  
                                        <h3> <span class="troco"></span></h3>
                                    </div>

                                    <div class="button">
                                        <button class="voltar"><a href="tables.php?id=<?php echo $table_id?>">VOLTAR</a></button>
                                        <input type="submit" class="submit" name="fechar" value="FECHAR COMANDA">
                                        <input type="submit" class="submit" name="total_fechar" value="PAGAR TOTAL">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
        </div>
    </div>
</body>
<script>
  const inputValor = document.querySelector('.input_valor');
  const inputPaid = document.querySelector('.input_paid');
  const trocoElement = document.querySelector('.troco');

  inputValor.addEventListener('input', calcularTroco);
  inputPaid.addEventListener('input', calcularTroco);

  function calcularTroco() {
    const valor = parseFloat(inputValor.value) || 0;
    const pago = parseFloat(inputPaid.value) || 0;
    if (pago < valor || pago === 0) {
        trocoElement.innerText = 'VALOR PAGO É MENOR OU IGUAL AO PEDIDO OU O VALOR PAGO É ZERO';
    }
    else if(pago == valor){
        const troco = pago - valor;
        trocoElement.innerText = 'Troco: R$ ' + troco.toFixed(2);
    }
    else {
        const troco = pago - valor;
        trocoElement.innerText = 'Troco: R$ ' + troco.toFixed(2);
    }

  }
</script>
</html>