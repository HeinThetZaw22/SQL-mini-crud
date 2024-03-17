<?php
// var_dump($_POST);
require_once('./db_connect.php');

$id = $_POST['row_id'];
$name = $_POST["name"];
$price = $_POST["price"];
$stock = $_POST['stock'];
$sql = "UPDATE products SET name='$name', price=$price, stock=$stock WHERE id=$id";
// echo $sql;
$qeury = mysqli_query($conn, $sql);
if($qeury){
    header("location:product-create.php");
}