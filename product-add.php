<?php
require_once('./db_connect.php');

$name = $_POST["name"];
$price = $_POST["price"];
$stock = $_POST["stock"];

//SQL
$sql = "INSERT INTO products (name, price, stock) VALUES ('$name', $price, $stock)";
$query = mysqli_query($conn, $sql);
// var_dump($query);
if($query){
    header("location:product-create.php");
}
