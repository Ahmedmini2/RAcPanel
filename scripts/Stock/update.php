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
                        if(isset($_POST['upd']))
                        {
                            $password = $_POST['pas'];
                            $password=  md5($password);
                            if($password == $_SESSION['password']){
                        $id = $_GET['id'];
                        $udp= mysqli_query($conn, "UPDATE `stock` SET `name_stock` = '$name_stock', `description` = '$description', `quantity` = '$quantity' , `used_quantity` = '$used_quantity' ,`price_per_piece` = '$price_per_piece' , `total_price` = '$total_price',  `stock_date` = '$c_date' WHERE `id` = $id");
                        if($udp)
                        {


                            $_SESSION['notification'] = "تم  المنتج بنجاح";
                            header('location:../../Stock/add-stock.php');
                        } }else{
                            $_SESSION['notification'] = "كلمة مرور خاطئة";
                            header('location:../../Stock/stock.php');
                            }
                        }
                    }
                    

                    ?>