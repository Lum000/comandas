<?php
include_once('connect.php');

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
    <form action="add_admin.php?id=0" method="POST">
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
    <div class="conteudo">
        <?php 
        mysqli_select_db($con,'produtos');
        $run = mysqli_query($con,'SELECT * FROM products');
        while ($result = mysqli_fetch_assoc($run)){?>
            <form action="add_admin.php?id=1" method="POST">
                <input type="hidden" name="id" value="<?php echo $result['id'] ?>">
                <label for="product">produto</label>
                <input type="text" name="product" value="<?php echo $result['product']?>">
                <label for="price">valor</label>
                <input type="number" step="0.01" name="price" value="<?php echo $result['price'] ?>">
                <label for="type">TYPE</label>
                <input type="text" name="type" id="type" value="<?php echo $result['type']?>">
                <input type="submit" name="change" value="change">
                
            </form>
        <?php
        }
        ?>
    </div>
</body>
</html>