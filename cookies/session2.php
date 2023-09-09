<?php 
session_start();
$email_address= !empty($_SESSION['email'])?$_SESSION['email']:'';
$id= !empty($_SESSION['id'])?$_SESSION['id']:'';
$role = !empty($_SESSION['role'])?$_SESSION['role']:'';
$position = !empty($_SESSION['position'])?$_SESSION['position']:'';
if($email_address == '')
{
  header("location:Auth/sign-in.php");
}
include '../db/connection.php';

?>