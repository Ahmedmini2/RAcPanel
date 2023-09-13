<?php 

// $db = "ruknamial";
// $host = "localhost";
// $dbusername = "root";
// $dbpassword = "";

$db = "ruknam5_test_app";
$host = "localhost";
$dbusername = "ruknam5_root";
$dbpassword = "Roek9933@";



$conn = mysqli_connect($host,$dbusername,$dbpassword,$db)
or die ( mysqli_error($conn) ); 

$sSQL= 'SET CHARACTER SET utf8'; 

mysqli_query($conn,$sSQL) 
or die ('Can\'t charset in DataBase'); 

$conn->query("SET NAMES 'utf8'");

?>
