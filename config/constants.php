

<?php

session_start();

// create some constants 

// global $conn;
// define('LOCALHOST','localhost');
// define('DB_USERNAME','root');
// define('DB_PASSWORD','');
// define('DB_NAME','food-order');
define('SITEURL','https://localhost/food-order/');

$host = "localhost";
$db_username = "root";
$db_password = "";
$db_name = "food-order";  

$conn = mysqli_connect($host,$db_username,$db_password,$db_name) or die(mysqli_error());



?>