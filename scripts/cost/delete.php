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
                        $del= mysqli_query($conn, "delete from cost_center where id = '$id'");
                        if($del)
                        {
                            $_SESSION['notification'] = "تم حذف التكلفة بنجاح";
                            header('location:../../cost/cost.php');
                        }
                    }

                    ?>