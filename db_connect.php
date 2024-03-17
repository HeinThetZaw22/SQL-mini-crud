<?php
$servername = "localhost";
$username = "htz";
$password = "2212";
$dbname = "MyShop";
$conn = mysqli_connect($servername, $username, $password, $dbname);
if(!$conn){
    die("connection failed: " . mysqli_connect_error());
}
?>