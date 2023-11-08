<?php

// Set CORS headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");


// Handle preflight requests
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(204);
    exit();
}

// Database configuration
$host = 'localhost';
$dbname = 'ruknam5_app';
$username = 'ruknam5_root';
$password = 'Roek9933@';



$conn = new mysqli($host, $username, $password, $dbname);

$sSQL= 'SET CHARACTER SET utf8'; 

mysqli_query($conn,$sSQL) 
or die ('Can\'t charset in DataBase'); 

$conn->query("SET NAMES 'utf8'");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process form data
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $message = $_POST["message"];

    // Prepare and execute the SQL statement
    $sql = "INSERT INTO contact_form (user_name, email, message) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $name, $email, $message);
    
    if ($stmt->execute()) {
        echo "Data inserted successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();

?>