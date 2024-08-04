<?php
include('../cookies/session2.php');

if (isset($_POST['id']) && isset($_POST['used_quantity'])) {
    $id = $_POST['id'];
    $used_quantity = $_POST['used_quantity'];
    $use_image = '';

    // // التعامل مع الصورة المرفوعة
    // if (isset($_FILES['use_image']) && $_FILES['use_image']['error'] == 0) {
    //     $uploadDir = '../Signed-Docs/Stock-Use-Bills/' . $id . '/';
    //     if (!is_dir($uploadDir)) {
    //         mkdir($uploadDir, 0777, true);
    //     }
    //     $use_image = basename($_FILES['use_image']['name']);
    //     $uploadFile = $uploadDir . $use_image;

    //     if (!move_uploaded_file($_FILES['use_image']['tmp_name'], $uploadFile)) {
    //         echo "error";
    //         exit;
    //     }
    // }

    // تحديث البيانات في قاعدة البيانات
    $query = "UPDATE stock SET used_quantity = ?";
    if ($use_image) {
        $query .= ", use_image = ?";
    }
    $query .= " WHERE id = ?";

    $stmt = $conn->prepare($query);
    if ($use_image) {
        $stmt->bind_param("iisi", $used_quantity, $use_image, $id);
    } else {
        $stmt->bind_param("iii", $used_quantity, $id);
    }

    if ($stmt->execute()) {
        echo "success";
    } else {
        echo "error";
    }

    $stmt->close();
} else {
    echo "Invalid parameters";
}

$conn->close();
?>