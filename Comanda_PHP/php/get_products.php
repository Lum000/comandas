<?php
include_once('connect.php');
mysqli_select_db($con,'produtos');
$searchParam = $_GET['search'];
$sql = "SELECT * FROM products WHERE type = '{$searchParam}'";
$run = mysqli_query($con,$sql);
$products_array = array();
while($result = mysqli_fetch_assoc($run)){
  $products_array[] = $result;
}
echo json_encode($products_array);
?>
