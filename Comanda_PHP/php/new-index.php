<?php
include_once('connect.php');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/comandas/Comanda_PHP/css/new-index.css" rel="stylesheet">
    <title>Document</title>
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
        <div class="first-container">
            <span>MESAS ABERTAS</span><br>
            <div class="open_tables">
                <?php
                    $sql = "SELECT * FROM mesas WHERE cor = 1";
                    mysqli_select_db($con,'mesas');
                    $run = mysqli_query($con,$sql);

                if(isset($run)){ 
                ?>
                <div class="products">
                    <?php 
                    while ($result = mysqli_fetch_assoc($run)){ 
                    ?>
                        <div class="product" onclick="window.location.href='new-tables.php?id=<?php echo $result['id']?>'">
                            <span class="name"><?php echo $result['nome'] ?></span><br>
                            <span class="table_number"><?php echo $result['id']?></span>
                            <input type="hidden" name="id">
                            </div>
                        <?php 
                        } 
                        ?>
                        </div>
            <?php 
            } 
            ?>

            </div>
        </div>
        <div class="second-container">
        <span>MESAS FECHADAS</span><br>
            <div class="open_tables">
                <?php
                    $sql = "SELECT * FROM mesas WHERE cor = 0";
                    mysqli_select_db($con,'mesas');
                    $run = mysqli_query($con,$sql);

                if(isset($run)){ 
                ?>
                <div class="products">
                    <?php 
                    while ($result = mysqli_fetch_assoc($run)){ 
                    ?>
                        <div class="product" onclick="window.location.href='new-tables.php?id=<?php echo $result['id']?>'">
                            <span class="name"><?php echo $result['nome'] ?></span><br>
                            <span class="table_number"><?php echo $result['id']?></span>
                            <input type="hidden" name="id">
                            </div>
                        <?php 
                        } 
                        ?>
                        </div>
            <?php 
            } 
            ?>

            </div>
        </div>
            
        </div>
    </section>
</body>
</html>