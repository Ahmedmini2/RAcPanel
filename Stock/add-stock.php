<?php
include('../cookies/session2.php');
$_SESSION['sidebar'] = "Stock";
if (!empty($_GET['edit'])) {

    $id = $_GET['edit'];
    $query = "SELECT * FROM stock WHERE id=$id";
    $res = $conn->query($query);
    $editData = $res->fetch_assoc();
    $name_stock = $editData['name_stock'];
    $description = $editData['description'];
    $quantity = $editData['quantity'];
    $price_per_peice = $editData['price_per_piece'];
    $total_price = $editData['total_price'];
    $c_date = $editData['c_date'];

    if (isset($_POST['submit'])) {

        $name_stock = $_POST['name_stock'];
        $description = $_POST['description'];
        $quantity = $_POST['quantity'];
        $price_per_peice = $_POST['price_per_piece'];
        $total_price = str_replace(',', '', $_POST['total_price']);
        $c_date = $_POST['c_date'];
        //here
        $target_dir = "../Signed-Docs/Stock-Bills/" . $id . "/";
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        } else {
        }
        $target_file = $target_dir . basename($_FILES["bill"]["name"]);
        $filename = basename($_FILES["bill"]["name"]);
        $uploadOk = 1;
        move_uploaded_file($_FILES["bill"]["tmp_name"], $target_file);

        $update = "UPDATE `stock` SET `name_stock` = '$name_stock', `description` = '$description', `quantity` = '$quantity' ,`price_per_piece` = '$price_per_piece' , `total_price` = '$total_price', `image` = '$filename' , `stock_date` = '$c_date' WHERE `id` = $id";
        $updateResult = $conn->query($update);
        if ($updateResult) {

            $_SESSION['notification'] = "تم تعديل المخزن بنجاح";
            header('location: stock.php');
            exit();
        } else {
            $_SESSION['notification'] = "يوجد خلل في النظام";
            header('location: stock.php');
            exit();
        }
    }
} else if (isset($_POST['submit'])) {

    $name_stock = $_POST['name_stock'];
    $description = $_POST['description'];
    $quantity = $_POST['quantity'];
    $price_per_peice = $_POST['price_per_piece'];
    $total_price = str_replace(',', '', $_POST['total_price']);
    $c_date = $_POST['c_date'];


    $filename = basename($_FILES["bill"]["name"]);
    $uploadOk = 1;


    $insert = "INSERT INTO cost_center (`id`, `name_stock`, `description`, `quantity` , `price_per_piece` , `total_price`, `image` , `stock_date` , `created_at`) VALUES (NULL, '$name_stock', '$description', '$quantity', '$price_per_piece', 'total_price', $filename','$c_date', NOW())";
    $insertResult = $conn->query($insert);
    if ($insertResult) {
        $id = $conn->insert_id;
        $target_dir = "../Signed-Docs/Stock-Bills/" . $id . "/";
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        } else {
        }
        $target_file = $target_dir . basename($_FILES["bill"]["name"]);
        move_uploaded_file($_FILES["bill"]["tmp_name"], $target_file);

        $_SESSION['notification'] = "تم اضافة المخزن بنجاح";
        header('location: stock.php');
        exit();
    } else {
        $_SESSION['notification'] = "يوجد خلل في النظام";
        header('location: stock.php');
        exit();
    }
} else {
    $name_stock = "";
    $description = "";
    $quantity = "";
    $price_per_peice = "";
    $total_price = "";
}

?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../assets/img/favicon.png">
    <title>
        أضافة منتج في المخزن
    </title>
    <!--     Fonts and icons     -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600;700&display=swap" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- CSS Files -->
    <link id="pagestyle" href="../assets/css/soft-ui-dashboard.css?v=1.0.3" rel="stylesheet" />
</head>

<body class="g-sidenav-show rtl ">

    <!-- Side Bar -->
    <?php require_once('../components/sidebar.php'); ?>
    <!-- End Of side Bar -->
    <main class="main-content position-relative lg:max-height-vh-100 lg:h-100 mt-1 border-radius-lg overflow-hidden">
        <!-- Navbar -->
        <?php
        $titleNav = 'أضافة منتج جديد';
        require_once('../components/navbar.php');
        ?>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="row">
                <div class="block block-themed">
                    <div class="block-header bg-warning col-md-3 col-sm-6 col-xs-6 rounded">
                        <?php require_once('../components/notification.php'); ?>
                    </div>
                    <div class="block-header bg-gradient-dark col-md-2 col-sm-6 col-xs-6  rounded-pill">
                        <h6 class="block-title text-white py-2 px-4 ">إضافة منتج جديد</h6>
                    </div>
                    <form id="<?php echo $idAttr; ?>" action="" method="post" enctype="multipart/form-data">
                        <div class="row">
                        <div class="col">
                                <div class="form-group">
                                    <label>اسم الشركة</label>
                                    <input type="text" placeholder="ادخل اسم منتج" class="form-control" name="name" value="<?php echo $name_stock; ?>">
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>التفاصيل و الملاحظات</label>
                                    <textarea placeholder="التفاصيل" class="form-control" name="description"><?php echo $description; ?></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">

                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label>كمية المنتج</label>
                                        <input type="number" placeholder="ادخل كمية المنتج" class="form-control" name="quantity" id="quantity" value="<?php echo $quantity; ?>">
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="form-group">
                                        <label>سعر منتج الواحد</label>
                                        <input type="number" placeholder="ادخل سعر المنج الواحد" class="form-control" name="price_per_peice" id="price_per_peice" value="<?php echo $price_per_peice; ?>">
                                    </div>
                                </div>

                            </div>


                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label>السعر الكلي</label>
                                        <input type="number" placeholder="" class="form-control" name="total_price" id="total_price" value="<?php echo $total_price; ?>" readonly>
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="form-group">
                                        <label>تاريخ الفاتورة</label>
                                        <input type="date" placeholder="" class="form-control" name="c_date" value="<?php echo $c_date; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>صورة الفاتورة</label>
                                    <input type="file" placeholder="" class="form-control" name="bill" value="">
                                </div>
                            </div>
                        </div>

                        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                    <script>
                      var a = 1;

                      $(document).on('change', 'input', function() {
                       
                          var peice = (parseFloat($("#quantity").val()) * parseFloat($("#price_per_peice").val() || '0'));
                          $("#total_price").val(peice);
                      });
                    
                      
                    </script>


                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <button type="submit" name="submit" class="btn btn-secondary">تقديم المنتج</button>
                                </div>
                            </div>
                            <div class="col">

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <script src="../assets/js/core/popper.min.js"></script>
    <script src="../assets/js/core/bootstrap.min.js"></script>
    <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
    <script src="../assets/js/plugins/fullcalendar.min.js"></script>
    <script src="../assets/js/plugins/chartjs.min.js"></script>

    <script src="../assets/js/plugins/choices.min.js"></script>
    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script>
    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="../assets/js/soft-ui-dashboard.min.js?v=1.0.3"></script>
    <script src="../Admin/darkmode.js"></script>
</body>

</html>