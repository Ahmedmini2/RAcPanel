<?php 
session_start();
$email_address= !empty($_SESSION['email'])?$_SESSION['email']:'';

if(empty($email_address))
{
  header("location:../../Auth/sign-in.php");
}
// session_start();
// if(empty($_SESSION['role'] || $_SESSION['role'] != '1')){
    
//     header('location:index');
// }
include '../../db/connection.php';



if(isset($_POST['upload'])){

$id= $_GET['del_id'];
$target_dir = "../../Signed-Docs/Delivery/".$id."/";
if(!is_dir($target_dir)) {
  mkdir($target_dir, 0777, true);
}
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$filename = basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
  $update = "UPDATE product_delivery SET image = '$filename' WHERE id = '$id'";
  $up_res = $conn->query($update);
  $_SESSION['notification'] = "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
  header('location:../../Factory/index.php');
} else {
  $_SESSION['notification'] = "Sorry, there was an error uploading your file.";
}
}

?>