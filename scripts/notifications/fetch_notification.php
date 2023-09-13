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
$query = "SELECT * FROM notifications ORDER BY created_at DESC LIMIT 10";
$result = $conn->query($query);

$notifications = array();

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $notifications[] = array(
            'title' => $row['name'],
            'message' => $row['message'],
            'timestamp' => $row['created_at'],
            'read_at' => $row['read_at']
        );
    }
}

// Return the notifications as JSON
header('Content-Type: application/json');
echo json_encode($notifications);

?>