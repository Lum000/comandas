<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once('php/connect.php');
$ids = array();
mysqli_select_db($con, 'mesas');
$run = mysqli_query($con, "SELECT id FROM mesas WHERE nome != ''");
while ($row = mysqli_fetch_assoc($run)) {
    $ids[] = $row['id'];
}
$id_string = implode(',', $ids);
$cor = 'blue'; /* ou qualquer outra cor que desejar */
echo '<style>';
echo '.table-color[data-id="' . implode('"], .table-color[data-id="', $ids) . '"] {';
echo 'background-color: ' . $cor . ';';
echo '}';
echo '</style>';


?>


<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/index.css" rel="stylesheet">
</head>
<body>
    <header>
        <img src="#" width="70px">
        <nav>
            <ul class="nav_links">
                <li><a href="#">Fechamento</a></li>
                <li><a href="index.php">Mesas</a></li>
                <li><a href="#">Admin</a></li>
            </ul>
        </nav>
    </header>
    <div class="container-mid">
        <div class="tables table-color" data-id='1' onclick="window.location.href='php/tables.php?id=1'">
            <div class="name">
                <?php
                mysqli_select_db($con,'mesas');
                $run = mysqli_query($con,"SELECT nome FROM mesas Where id = 1");
                $result = mysqli_fetch_assoc($run);
                if(isset($result['nome'])){
                    echo "<h1>".$result['nome']."</h1>";
                }
                ?>
            </div>
            <div class="number">
                <h2>1</h2>
            </div>
        </div>
        <div class="tables table-color" data-id='2' onclick="window.location.href='php/tables.php?id=2'">
            <div class="name">
            <?php
                mysqli_select_db($con,'mesas');
                $run = mysqli_query($con,"SELECT nome FROM mesas Where id = 2");
                $result = mysqli_fetch_assoc($run);
                if(isset($result['nome'])){
                    echo "<h1>".$result['nome']."</h1>";
                }
                ?>
            </div>
            <div class="number">
                <h2>2</h2>
            </div>
        </div>
        <div class="tables table-color" data-id='3' onclick="window.location.href='php/tables.php?id=3'">
            <div class="table1">
                <div class="name">
                <?php
                    mysqli_select_db($con,'mesas');
                    $run = mysqli_query($con,"SELECT nome FROM mesas Where id = 3");
                    $result = mysqli_fetch_assoc($run);
                    if(isset($result['nome'])){
                        echo "<h1>".$result['nome']."</h1>";
                    }
                    ?>
                </div>
            </div>
                <div class="number">
                <h2>3</h2>
            </div>
        </div>
        <div class="tables table-color" data-id='4' onclick="window.location.href='php/tables.php?id=4'">
            <div class="name">
                <h1></h1>
            </div>
            <div class="number">
                <h2>4</h2>
            </div>
        </div>
        <div class="tables table-color" data-id='5' onclick="window.location.href='php/tables.php?id=5'">
            <div class="name">
                <h1></h1>
            </div>
            <div class="number">
                <h2>5</h2>
            </div>
        </div>
        <div class="tables table-color" data-id='6' onclick="window.location.href='php/tables.php?id=6'">
            <div class="name">
                <h1></h1>
            </div>
            <div class="number">
                <h2>6</h2>
            </div>
        </div>
    </div>
</body>
<script> 
</script>
</html>
