<?php
// var_dump($_GET);
require_once('./db_connect.php');

//id number got from php is number string
$id = $_GET['row_id'];
$sql = "DELETE FROM products WHERE id = $id";
$query = mysqli_query($conn, $sql);
// var_dump($query);
if($query){
    header("location:product-create.php");
}
