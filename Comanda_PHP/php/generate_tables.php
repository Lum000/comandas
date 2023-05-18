<?php
include_once('connect.php');
$numTables = $_GET['id'];
mysqli_select_db($con, 'mesas');
for ($i = 1; $i <= $numTables; $i++) {
    $run = mysqli_query($con,"SELECT * FROM mesas WHERE id = $i");
    $result = mysqli_fetch_assoc($run);
    if($result){
        echo " $i NAO FOI POSSIVEL CRIAR POIS A MESA JA EXISTE <br>";
    }
    else{
        $run = mysqli_query($con,"INSERT INTO mesas(id,cor) VALUES($i,0)");
        echo "$i CRIADA COM SUCESSO<br>";
    }
}
?>
