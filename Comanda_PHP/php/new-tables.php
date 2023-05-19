<?php 
include_once('connect.php');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$table_id = $_GET['id'];

//pegar nome da mesa da url
mysqli_select_db($con, 'mesas');
if (isset($_GET['name'])) {
    $name = $_GET['name'];
    $sql = "UPDATE mesas SET nome=? WHERE id=?";
    $stmt = mysqli_prepare($con, $sql);
    
    // Verifica se a preparação da declaração teve sucesso
    if ($stmt) {
        // Define os valores dos parâmetros
        mysqli_stmt_bind_param($stmt, 'si', $name, $table_id);

        // Executa a declaração preparada
        mysqli_stmt_execute($stmt);

        // Fecha a declaração preparada
        mysqli_stmt_close($stmt);
    } else {
        // Se houver um erro na preparação da declaração
        echo "Erro na preparação da declaração: " . mysqli_error($con);
    }
}
else{
    //pegar nome do banco
    $run = mysqli_query($con,"SELECT nome FROM mesas WHERE id = $table_id");
    if($result = mysqli_fetch_assoc($run)){
        $name = $result['nome'];
    }
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
            $sql = "CREATE TABLE IF NOT EXISTS $table_name.$column_table_name (`id` INT NOT NULL , `product` VARCHAR(255) NULL , `price` DOUBLE  NULL , `total` DOUBLE  NULL,`qty` INT Default 1, `image` VARCHAR(255)) ENGINE = InnoDB;";
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
                <li><a href="new-index.php">Link1</a></li>
                <li><a href="admin-panel.php">Link2</a></li>
                <li><a href="#">Link3</a></li>
                <?php if($table_id !== null){?>
                <li><a href="delete_table.php?id=<?php echo $table_id?>">deletar</a></li>
                    
                <?php
                }?>
            </ul>
        </nav>
        <button><a>haha</a></button>
    </header>
    <section class="container_mid">
        <div class="table">
            <div class="header_table">
                <span class="table_number"><h1>Mesa : <?php echo $table_id ?></h1></span>
                <span class="table_name"><h1>Nome : <?php
                mysqli_select_db($con,'mesas');
                $run = mysqli_query($con,"SELECT nome FROM mesas WHERE id = $table_id");
                $result = mysqli_fetch_assoc($run);
                if($result['nome'] != ''){
                    echo $result['nome'];
                }
                else{
                    ?>
                    <input type='text' name='name' id="table_name_alter" placeholder='NOME DA MESA'>
                    <button type='submit' name='create_name' onclick='altername()'>enviar</button>
                    <?php
                };
                mysqli_select_db($con,$table_name);
                ?></h1>
            </div>
            <div class="rotulos">
                    <span>PRODUTO</span>
                    <span>QUANTIDADE</span>
                    <span>PRECO</span>
                </div>
            <?php
            $column_table_name = $table_name . $table_id;
            $sql = "SELECT * FROM $column_table_name";
            $run = mysqli_query($con,$sql);
            while ($result = mysqli_fetch_assoc($run)){?>
                <div class="produto_mesa">
                    <form action="add.php" method="POST">
                        <div class="name_product">
                            <span><?php echo $result['product'] ?></span>   
                        </div>
                        <div class="qty">
                            <input type="hidden" name="item_id" value="<?php echo $result['id']?>">
                            <input type="submit" name="more" value="+">
                            <span><?php echo $result['qty']?></span>
                            <input type="submit" name="minus" value="-">
                            <input type="hidden" name="table_id" value="<?php echo $table_id?>">
                        </div>
                        <div class="price_product">
                            <span> R$ <?php echo $result['price'] ?></span>
                        </div>
                    </form>
                </div>
            <?php
            }
            ?>
            <div class="total">
                <?php 
                mysqli_select_db($con,$table_name);
                $run = mysqli_query($con,"SELECT SUM(price * qty) as total FROM $column_table_name");
                $result = mysqli_fetch_assoc($run);
                ?>
                <span>TOTAL = R$ <?php echo $result['total']?></span>
            </div>
            <button class="dialog_ola" id="ola" onclick="openPopup()">PAGAR</button>
        </div>
        <div class="add_product">
  <div class="header_products">
    <button id="burguer" data-search="lanche">HAMBURGUER</button>
    <button id="porcao" data-search="porcao">PORCAO</button>
    <button id="diversos">DIVERSOS</button>
    <button id="bebidas">BEBIDAS</button>
  </div>
  <?php
  if(isset($_GET['pagar'])){
    mysqli_select_db($con,$table_name);
    $sql = "SELECT * FROM $column_table_name";
    $run = mysqli_query($con,$sql);
    while($result = mysqli_fetch_assoc($run)){?>
    <div class="produto_mesa">
        <form action="pagar_comanda.php" method="POST">
            <div class="name_product">
                <span><?php echo $result['product'] ?></span>   
            </div>
            <div class="qty">
                <input type="hidden" name="item_id" value="<?php echo $result['id']?>">
                <input type="submit" name="more" value="+">
                <span><?php echo $result['qty']?></span>
                <input type="submit" name="minus" value="-">
                <input type="hidden" name="table_id" value="<?php echo $table_id?>">
            </div>
            <div class="price_product">
                <span> R$ <?php echo $result['price'] ?></span>
            </div>
            <div class="checkbox">
                <input type="checkbox" name="paid" value="<?php echo $result['id'] ?>">
                <label for="paid">PAGAR</label>
            </div>
        </form>
    </div>
    <?php
    }
    ?>
    <button id="pagar-btn">OLA</button>
    <?php
  }
  else{
    mysqli_select_db($con,'produtos');
    $sql = "SELECT * FROM products";
    $run = mysqli_query($con,$sql);
    $products_array = array();
    while($result = mysqli_fetch_assoc($run)){
        $products_array[] = $result;
    }
}
  ?>
  <div class="products_add">
  </div>
</div>
<dialog id="products-dialog">
    <div class="header_dialog">
        <span>Mesa : <?php echo $table_id?></span>
        <button id="exit">X</button>
    </div>
    <div class="products_dialog">
        <span>PRODUTOS: 
        <?php
        mysqli_select_db($con,$table_name);
        $run = mysqli_query($con,"SELECT * FROM $column_table_name");
        $result = mysqli_fetch_assoc($run);
        if($result){
            while ($result['product']){
                echo $result['product'] + "<br>";
            }
        }
        ?>

        </span>
    </div>
  <form action="pagar_comanda.php" method="POST">
  <?php
        mysqli_select_db($con,$table_name);
        $sql = "SELECT * FROM $column_table_name";
        $run = mysqli_query($con,$sql);
        if($run){
            $dialogs = array(); // criar uma lista vazia
            while($result = mysqli_fetch_assoc($run)){
                // criar o elemento dialog e adicionar à lista
            $dialog = '<dialog id="dialog'.$result['id'].'">';
            $dialog .= '<span>Produto: '.$result['product'].'</span>';
            $dialog .= '<span>Preço: R$ '.$result['price'].'</span>';
            $dialog .= '<label for="people">Dividir em:</label>';
            $dialog .= '<select name="people" id="people">';
            $dialog .= '<option value="1">1</option>';
            $dialog .= '<option value="2">2</option>';
            $dialog .= '<option value="3">3</option>';
            $dialog .= '<option value="4">4</option>';
            $dialog .= '<option value="5">5</option>';
            $dialog .= '</select>';
            $dialog .= '<input type="hidden" name="id_send" value="'.$result['id'].'">';
            $dialog .= '<input type="button" value="Pagar" onclick="pagarProduto('.$result['id'].')">';
            $dialog .= '</dialog>';
            array_push($dialogs, $dialog);
        }
        foreach ($dialogs as $dialog) {
            echo $dialog; // exibir cada diálogo na página
        }
    }
    ?>
    </form>


</body>
<script>
const burguer = document.getElementById('burguer');
const porcao = document.getElementById('porcao');
const bebidas = document.getElementById('bebidas');
const diversos = document.getElementById('diversos');

// Adicione um ouvinte de evento de clique para cada botão
burguer.addEventListener('click', function() {
  fetchProducts('lanche'); // chama a função para obter produtos
  burguer.style.backgroundColor = "red";
  porcao.style.backgroundColor = "rgb(2, 95, 244)";
    bebidas.style.backgroundColor = "rgb(2, 95, 244)";
  diversos.style.backgroundColor = "rgb(2, 95, 244)";
});

porcao.addEventListener('click', function() {
  fetchProducts('porcao'); // chama a função para obter produtos
  burguer.style.backgroundColor = "rgb(2, 95, 244)";
  porcao.style.backgroundColor = "red";
    bebidas.style.backgroundColor = "rgb(2, 95, 244)";
  diversos.style.backgroundColor = "rgb(2, 95, 244)";
});
bebidas.addEventListener('click', function() {
  fetchProducts('bebidas'); // chama a função para obter produtos
  burguer.style.backgroundColor = "rgb(2, 95, 244)";
  porcao.style.backgroundColor = "rgb(2, 95, 244)";
  bebidas.style.backgroundColor = "red";
  diversos.style.backgroundColor = "rgb(2, 95, 244)";
});
diversos.addEventListener('click', function() {
  fetchProducts('diversos'); // chama a função para obter produtos
  burguer.style.backgroundColor = "rgb(2, 95, 244)";
  porcao.style.backgroundColor = "rgb(2, 95, 244)";
  bebidas.style.backgroundColor = "rgb(2, 95, 244)";
  diversos.style.backgroundColor = "red";
});

// Função para obter produtos com base no parâmetro de pesquisa
function fetchProducts(searchParam) {
  const productsDiv = document.querySelector('.products_add');
  productsDiv.innerHTML = ''; // Limpa os resultados anteriores

  // Faz uma solicitação ao banco de dados com base no parâmetro de pesquisa
  fetch(`get_products.php?search=${searchParam}`)
    .then(response => response.json())
    .then(data => {
      // Percorre os resultados e adiciona cada produto à div de produtos
      data.forEach(product => {
        const productDiv = document.createElement('div');
        productDiv.className = 'product';
        productDiv.innerHTML = `
        <form action="add.php" method="POST">
          <span class="product_name"><h2 id='span'>${product.product}</h2></span>
          <span class="product_price"><h3>R$ ${product.price}</h3></span>
          <input type="hidden" name="id_product" value="${product.id}">
          <input type="hidden" name="table_id" value="<?php echo $table_id?>">
          <input type="submit" name="add" value="+">
        </form>
        `;
        productsDiv.appendChild(productDiv);
      });
    })
    .catch(error => console.error(error));
}
function cach_products(){
    console.log('OLA')
};

//dialog pop up

var showProductsButton = document.querySelector('#dialog');
var productsDialog = document.querySelector('#products-dialog');

const pagarBtn = document.getElementById('pagar-btn');
    
    // Adicione um ouvinte de evento para o clique do botão
    pagarBtn.addEventListener('click', function() {
        // Selecione todos os checkboxes com nome "paid"
        const checkboxes = document.querySelectorAll('input[name="paid"]:checked');
        // Crie um array para armazenar os valores dos IDs
        const ids = [];
        // Adicione cada valor de ID ao array
        checkboxes.forEach(function(checkbox) {
            ids.push(checkbox.value);
        });
        // Crie a URL com os IDs concatenados
        const url = `pagar_comanda.php?id=<?php echo $table_id?>&id_product=${ids.join(',')}`;
        // Redirecione para a nova URL
        window.location.href = url;
    });

function altername(){
    name = document.getElementById('table_name_alter').value;
    window.location.href = `new-tables.php?id=<?php echo $table_id?>&name=${name}`;
}


function openPopup() {
    const dialog = document.getElementById("products-dialog");
    dialog.showModal();
    }

function closePopup() {
    const dialog = document.getElementById("products-dialog");
        dialog.close();
    }

    document.getElementById("exit").addEventListener("click", closePopup);
</script>

</html>