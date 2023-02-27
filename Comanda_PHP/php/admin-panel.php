<?php


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
    <form action="add_admin.php" method="POST">
        <label for="database">DATABASE</label>
        <select name="database" id="database">
            <option value="mesas">mesas</option>
            <option value="produtos">produtos</option>
        </select>
        <label for="produto">produto</label>
        <input type="text" name="produto">
        <label for="type">TYPE</label>
        <select name="type" id="type">
            <option value="porcao">porcao</option>
            <option value="lanche">lanche</option>
            <option value="bebidas">bebidas</option>
            <option value="diversos">diversos</option>
        </select>
        <label for="price">preco</label>
        <input type="text" name="price">
        <input type="submit">
    </form>
</body>
</html>