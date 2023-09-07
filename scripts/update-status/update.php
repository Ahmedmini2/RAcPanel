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

?>