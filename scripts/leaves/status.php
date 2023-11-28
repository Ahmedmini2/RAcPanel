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
$position = $_GET['Position'];
$role = $_GET['Role'];
if(isset($_GET['Approved'])){
$id = $_GET['Approved'];

if($position == 'Worker' ){
  $update = "UPDATE leaves SET factory_approve = 'Approved' WHERE id = '$id'";
}else if($position == 'Admin' && $role == '1' ){
  $update = "UPDATE leaves SET manager_approve = 'Approved' WHERE id = '$id'";
}else if($position == 'Admin' && $role == '3' ){
$update = "UPDATE leaves SET status = 'Approved', admin_approve = 'Approved' WHERE id = '$id'";
}
$up_res = $conn->query($update);
if($up_res){
  $_SESSION['notification'] = "تم تغير الحالة الى  ّ تم اعتماد الاجازة  ّ بنجاح";
  header('location:../../Admin/leave/index.php');
  exit();
}else{
  $_SESSION['notification'] = "خلل في تغير الحالة";
  header('location:../../Admin/leave/index.php');
  exit();
}
}

if(isset($_GET['Declined'])){
    $id = $_GET['Declined'];
    if($position == 'Worker' ){
      $update = "UPDATE leaves SET status = 'Declined', factory_approve = 'Declined' WHERE id = '$id'";
    }else if($position == 'Admin' && $role == '1' ){
      $update = "UPDATE leaves SET status = 'Declined', manager_approve = 'Declined' WHERE id = '$id'";
    }else if($position == 'Admin' && $role == '3' ){
    $update = "UPDATE leaves SET status = 'Declined', admin_approve = 'Declined' WHERE id = '$id'";
    }
    $up_res = $conn->query($update);
    if($up_res){
      $_SESSION['notification'] = "تم تغير الحالة الى  ّ تم رفض الاجازة  ّ بنجاح";
      header('location:../../Admin/leaves/index.php');
      exit();
    }else{
      $_SESSION['notification'] = "خلل في تغير الحالة";
      header('location:../../Admin/leave/index.php');
      exit();
    }
    }

    if(isset($_GET['Delete'])){
        $id = $_GET['Delete'];
        $update = "DELETE from leaves WHERE id = '$id'";
        $up_res = $conn->query($update);
        if($up_res){
          $_SESSION['notification'] = " تم حذف الاجازة بنجاح";
          header('location:../../Admin/leave/index.php');
          exit();
        }else{
          $_SESSION['notification'] = "خلل في تغير الحالة";
          header('location:../../Admin/leave/index.php');
          exit();
        }
        }

?>