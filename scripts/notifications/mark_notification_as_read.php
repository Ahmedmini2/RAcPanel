<?php
session_start();
$email_address= !empty($_SESSION['email'])?$_SESSION['email']:'';
$id= !empty($_SESSION['id'])?$_SESSION['id']:'';
$role = !empty($_SESSION['role'])?$_SESSION['role']:'';
$position = !empty($_SESSION['position'])?$_SESSION['position']:'';
if($email_address == '')
{
  header("location:../../Auth/sign-in.php");
}
include '../../db/connection.php';

if (isset($_POST['notification_id'])) {
    $notificationId = $_POST['notification_id'];

    $currentTimestamp = date('Y-m-d H:i:s');
    $updateQuery = "UPDATE notifications SET read_at = '$currentTimestamp' WHERE id = $notificationId";

    if ($conn->query($updateQuery) === TRUE) {
        // Successfully marked as read
        echo json_encode(['message' => 'Notification marked as read']);
    } else {
        // Error occurred while marking as read
        echo json_encode(['message' => 'Error marking notification as read with id ' . $notificationId .' and Timestamp ' . $currentTimestamp]);
    }
}
?>