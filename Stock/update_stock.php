<?php
include('../cookies/session2.php');

// التأكد من أن الاتصال بقاعدة البيانات موجود
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['id']) && isset($_POST['used_quantity'])) {
    $id = $_POST['id'];
    $used_quantity = $_POST['used_quantity'];
    $use_image = '';

    // التعامل مع الصورة المرفوعة
    if (isset($_FILES['use_image']) && $_FILES['use_image']['error'] == 0) {
        $uploadDir = '../Signed-Docs/Stock-Use-Bills/' . $id . '/';
        
        // التحقق من وجود المجلد وإنشاؤه إذا لم يكن موجوداً
        if (!is_dir($uploadDir)) {
            if (!mkdir($uploadDir, 0777, true)) {
                echo "خطأ في إنشاء المجلد";
                exit;
            }
        }
        
        $use_image = basename($_FILES['use_image']['name']);
        $uploadFile = $uploadDir . $use_image;

        // نقل الصورة المرفوعة إلى المجلد المناسب
        if (!move_uploaded_file($_FILES['use_image']['tmp_name'], $uploadFile)) {
            echo "خطأ في رفع الصورة";
            exit;
        }
    }

    // التحقق من الكمية المتاحة
    $sql = "SELECT quantity FROM stock WHERE id=?";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die("خطأ في إعداد الاستعلام: " . $conn->error);
    }
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($current_quantity);
    $stmt->fetch();
    $stmt->close();

    if ($current_quantity === null) {
        echo "المنتج غير موجود!";
        exit;
    }

    if ($used_quantity > $current_quantity) {
        echo "الكمية المسحوبة تتجاوز الكمية المتاحة!";
        exit;
    }

    // تحديث الكمية المتبقية
    $new_quantity = $current_quantity - $used_quantity;
    $query = "UPDATE stock SET stock = $new_quantity, used_quantity = ?";
    if ($use_image) {
        $query .= ", use_image = ?";
    }
    $query .= " WHERE id = ?";

    $stmt = $conn->prepare($query);
    if (!$stmt) {
        die("خطأ في إعداد الاستعلام: " . $conn->error);
    }

    if ($use_image) {
        $stmt->bind_param("isis", $new_quantity, $used_quantity, $use_image, $id);
    } else {
        $stmt->bind_param("iii", $new_quantity, $used_quantity, $id);
    }

    if ($stmt->execute()) {
        echo "نجاح";
    } else {
        echo "خطأ: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "معلمات غير صحيحة";
}

$conn->close();
?>
