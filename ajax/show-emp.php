<?php
include('../cookies/session2.php');
if (isset($_POST['product_id'])) {
    // Retrieve the product ID from the AJAX request
    $selectedValue = $_POST['selected'];

    // Perform a database query to get the kh_per_peice value based on $productId
    // Replace the following line with your database query
    $query = "SELECT * FROM employee WHERE department='$selectedValue'";
    $result = mysqli_query($conn, $query);// Perform your query to get the kh_per_peice

    if ($result) {
        // Fetch the kh_per_peice value
        $row = mysqli_fetch_assoc($result);
        $kh_per_peice = $row['quantity_per_piece'];

        echo $kh_per_peice; // Send the kh_per_peice value back as the response
    }
    
}
?>