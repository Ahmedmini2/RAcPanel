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

    if(!empty($_GET['id']))
                    {
                        $id = $_GET['id'];
                        $del= mysqli_query($conn, "delete from covers_purchase where id = '$id'");
                        if($del)
                        {
                            $_SESSION['notification'] = "تم حذف طلب شراء الأغطية بنجاح";
                            header('location:../../Cover/index.php');
                        }
                    }

                    ?>