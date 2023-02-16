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
                <li><a href="#">Mesas</a></li>
                <li><a href="#">Admin</a></li>
            </ul>
        </nav>
    </header>
    <div class="container-mid">
        <div class="tables" onclick="window.location.href='php/tables.php?id=1'">
            <div class="name">
                <h1>lucas</h1>
            </div>
            <div class="number">
                <h2>2</h2>
            </div>
        </div>
        <div class="tables" onclick="window.location.href='php/tables.php?id=2'">
            <div class="name">
                <?php 
                include_once('connect.php');
                $sql = ?>
            </div>
            <div class="number">
                <h2>2</h2>
            </div>
        </div>
        <div class="tables">
            <div class="name">
                <h1>lucas</h1>
            </div>
            <div class="number">
                <h2>2</h2>
            </div>
        </div>
        <div class="tables">
            <div class="name">
                <h1>lucas</h1>
            </div>
            <div class="number">
                <h2>3</h2>
            </div>
        </div>
        <div class="tables">
            <div class="name">
                <h1>lucas</h1>
            </div>
            <div class="number">
                <h2>4</h2>
            </div>
        </div>
        <div class="tables">
            <div class="name">
                <h1>lucas</h1>
            </div>
            <div class="number">
                <h2>2</h2>
            </div>
        </div>
    </div>
</body>
</html>