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

if(isset($_POST['confirm'])){

$id= $_GET['id'];
$update = "UPDATE projects SET status = ' تم التأكيد ' WHERE id = '$id'";
$up_res = $conn->query($update);
if($up_res){
  $_SESSION['notification'] = "تم تغير الحالة الى  ّ تم التأكيد ّ بنجاح";
  header('location:../../Projects/view-projects.php?id='.$id);
}else{
  $_SESSION['notification'] = "خلل في تغير الحالة";
}
}

if(isset($_POST['progress'])){

$id= $_GET['id'];
$update = "UPDATE projects SET status = 'قيد التنفيذ' WHERE id = '$id'";
$up_res = $conn->query($update);
if($up_res){
  $_SESSION['notification'] = "تم تغير الحالة الى  ّ قيد التنفيذ ّ بنجاح";
  header('location:../../Projects/view-projects.php?id='.$id);
}else{
  $_SESSION['notification'] = "خلل في تغير الحالة";
}
}

if(isset($_POST['done'])){

    $id= $_GET['id'];
    $update = "UPDATE projects SET status = 'تم الإنتهاء' WHERE id = '$id'";
    $up_res = $conn->query($update);
    if($up_res){
      $_SESSION['notification'] = "تم تغير الحالة الى  ّ تم الإنتهاء  ّ بنجاح";
      header('location:../../Projects/view-projects.php?id='.$id);
    }else{
      $_SESSION['notification'] = "خلل في تغير الحالة";
    }
    }



?>