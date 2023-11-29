<?php 
session_start();
include('../../cookies/insert-method.php');
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

    $id= $_GET['id'];
    $target_dir = "../../Signed-Docs/Covers_Purchase/".$id."/";
    if(!is_dir($target_dir)) {
      mkdir($target_dir, 0777, true);
    }
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $filename = basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
      $update = "UPDATE covers_purchase_id SET image = '$filename' WHERE purchase_id = '$id'";
      $up_res = $conn->query($update);
      $_SESSION['notification'] = "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
      header('location:../../Cover/purchase_cover.php?id='.$id);
    } else {
      $_SESSION['notification'] = "Sorry, there was an error uploading your file.";
    }
    }

if(isset($_POST['delete'])) {
  $id= $_GET['id'];
  $table = 'covers_purchase_id';

  delete_image($table, $id);
  $_SESSION['notification'] = 'Image Deleted';
  header('location:../../Cover/purchase_cover.php?id='.$id);
}
?>