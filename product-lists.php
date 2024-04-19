<?php
echo "<pre>";
$servername = "localhost";
$username = "htz";
$password = "2212";

$conn = mysqli_connect($servername, $username, $password, "MyShop");
if(!$conn){
    die("connection failed: " . mysqli_connect_error());
}

$sql = "SELECT * FROM products";
$query = mysqli_query($conn, $sql);
// var_dump($query);

//give one arr/obj at a time
// var_dump(mysqli_fetch_assoc($query));

while($row = mysqli_fetch_assoc($query)){
    print_r($row);
}