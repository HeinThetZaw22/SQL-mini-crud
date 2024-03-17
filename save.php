<?php
require_once('./db_connect.php');
// echo "<pre>";
// // print_r($_POST);

// //mysql connect
// $servername = "localhost";
// $username = "htz";
// $password = "2212";

// //create connection
// $conn = mysqli_connect($servername, $username, $password, "MyShop");
// // var_dump($conn);
// if(!$conn){
//     die("connection failed: " . mysqli_connect_error());
// }
// // echo "Connected successfully";



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
