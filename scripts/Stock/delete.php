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
                        if(isset($_POST['del']))
                        {
                            $password = $_POST['pas'];
                            $password=  md5($password);
                            if($password == $_SESSION['password']){
                        $id = $_GET['id'];
                        $del= mysqli_query($conn, "delete from stock where id = '$id'");
                        if($del)
                        {
                            $_SESSION['notification'] = "تم حذف المنتج بنجاح";
                            header('location:../../Stock/stock.php');
                        } }else{
                            $_SESSION['notification'] = "كلمة مرور خاطئة";
                            header('location:../../Stock/stock.php');
                            }
                        }
                    }
                    

                    ?>