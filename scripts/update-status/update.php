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

if(isset($_POST['account'])){

$id= $_GET['bank_req'];
$update = "UPDATE bank_request SET status = '2' WHERE id = '$id'";
$up_res = $conn->query($update);
if($up_res){
  $_SESSION['notification'] = "تم تغير الحالة الى  ّ تم التعميد عن طريق المحاسب ّ بنجاح";
  header('location:../../bank-req-info.php?bank_req='.$id);
}else{
  $_SESSION['notification'] = "خلل في تغير الحالة";
}
}

if(isset($_POST['manager'])){

$id= $_GET['bank_req'];
$update = "UPDATE bank_request SET status = '3' WHERE id = '$id'";
$up_res = $conn->query($update);
if($up_res){
  $_SESSION['notification'] = "تم تغير الحالة الى  ّ تم التأكيد عن طريق المدير العام ّ بنجاح";
  header('location:../../bank-req-info.php?bank_req='.$id);
}else{
  $_SESSION['notification'] = "خلل في تغير الحالة";
}
}

if(isset($_POST['upload'])){

$id= $_GET['bank_req'];
$target_dir = "../../Signed-Docs/".$id."/";
if(!is_dir($target_dir)) {
  mkdir($target_dir, 0777, true);
}
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$filename = basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
  $update = "UPDATE bank_request SET doc = '$filename' WHERE id = '$id'";
  $up_res = $conn->query($update);
  $_SESSION['notification'] = "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
  header('location:../../bank-req-info.php?bank_req='.$id);
} else {
  $_SESSION['notification'] = "Sorry, there was an error uploading your file.";
}
}

?>