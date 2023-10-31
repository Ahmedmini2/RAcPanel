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

if(isset($_GET['Approved'])){
$id = $_GET['Approved'];
$update = "UPDATE advance_salary SET status = 'Approved' WHERE id = '$id'";
$up_res = $conn->query($update);
if($up_res){
  $_SESSION['notification'] = "تم تغير الحالة الى  ّ تم اعتماد السلفية  ّ بنجاح";
  header('location:../../Admin/Advance_Salary/index.php');
  exit();
}else{
  $_SESSION['notification'] = "خلل في تغير الحالة";
  header('location:../../Admin/Advance_Salary/index.php');
  exit();
}
}

if(isset($_GET['Declined'])){
    $id = $_GET['Declined'];
    $update = "UPDATE advance_salary SET status = 'Declined' WHERE id = '$id'";
    $up_res = $conn->query($update);
    if($up_res){
      $_SESSION['notification'] = "تم تغير الحالة الى  ّ تم رفض السلفية  ّ بنجاح";
      header('location:../../Admin/Advance_Salary/index.php');
      exit();
    }else{
      $_SESSION['notification'] = "خلل في تغير الحالة";
      header('location:../../Admin/Advance_Salary/index.php');
      exit();
    }
    }

    if(isset($_GET['Delete'])){
        $id = $_GET['Delete'];
        $update = "DELETE from advance_salary WHERE id = '$id'";
        $up_res = $conn->query($update);
        if($up_res){
          $_SESSION['notification'] = " تم حذف السلفية بنجاح";
          header('location:../../Admin/Advance_Salary/index.php');
          exit();
        }else{
          $_SESSION['notification'] = "خلل في تغير الحالة";
          header('location:../../Admin/Advance_Salary/index.php');
          exit();
        }
        }

?>