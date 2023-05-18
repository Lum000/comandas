<?php
$ids = $_GET['id_product']; // irá armazenar a string com os IDs separados por vírgula
$ids_array = explode(',', $ids); // irá criar um array com cada ID separado
$table_id = $_GET['id'];
// Crie variáveis com o nome "id" seguido do número correspondente
foreach ($ids_array as $key => $id_product) {
    ${"id".($key+1)} = $id_product;
}

// Agora você pode acessar cada ID individualmente usando as variáveis criadas

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <label for="qty">Quantos voce deseja pagar ?<br>No momento há <?php
    include_once('connect.php');
    $table_name = 'mesa' . $table_id;
    $column_table_name = $table_name . $table_id;
    mysqli_select_db($con,$table_name);
    $run = mysqli_query($con,"SELECT qty from $column_table_name WHERE id = $id_product")
    ?></label>
    <input type="number" name="qty">
</body>
</html>