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

    if(!empty($_GET['bank_req']))
                    {
                        $id = $_GET['bank_req'];
                        $del= mysqli_query($conn, "delete from bank_request where id = '$id'");
                        if($del)
                        {
                            $_SESSION['notification'] = "تم حذف الطلب";
                            header('location:../../accounts.php');
                        }
                    }

                    ?>