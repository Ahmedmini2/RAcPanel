<?php
include('../cookies/session2.php');
$_SESSION['sidebar'] = "Factory";

if(isset($_GET['edit']) && isset($_GET['project_id'])){
    
    $delivery_id = $_GET['edit'];
    $id = $_GET['project_id'];
    $query = "SELECT * FROM product_delivery WHERE id = $delivery_id";
    $res = $conn->query($query);
    $editData = $res->fetch_assoc();
    $del_id = $editData['id'];
    $product_id = $editData['product_id'];
    $quantity = $editData['quantity'];
    $deliverd_by = $editData['deliverd_by'];
    $on_date = $editData['on_date'];
    $phone = $editData['phone'];
    $truck_no = $editData['truck_no'];
    $approved_by = $editData['approved_by'];

    if(isset($_POST['submit'])){
        $str = explode(",",$_POST['name']);
        $product_id = $str[0];
        $quantity = $_POST['quantity'];
        $del_quantity = $_POST['del_quantity'];
        $del_by = $_POST['del_by'];
        $del_no = $_POST['del_no'];
        $on_date = $_POST['on_date'];
        $truck_no = $_POST['truck_no'];
        $approved_by = $_POST['approved_by'];


        $update_product_del= "UPDATE `product_delivery` SET `quantity` = '$del_quantity' ,`deliverd_by` = '$del_by' ,`on_date` = '$on_date' ,`phone` = '$del_no',
        `truck_no` = '$truck_no',`approved_by` = '$approved_by' WHERE `id` = '$delivery_id'";
        $res = $conn->query($update_product_del);
        if ($res) {
            $_SESSION['notification'] = "تم تعديل تقرير الإستلام بنجاح";
            header('location: ../Projects/view-projects.php?id='.$id.'');
            exit();
          } else {
            $_SESSION['notification'] = "خطأ في الادخال";
            header('location: ../Projects/view-projects.php?id='.$id.'');
            exit();
          }
    }
    
}
else if (isset($_GET['project_id'])) {
    $id = $_GET['project_id'];

    if(isset($_POST['submit'])){
        $str = explode(",",$_POST['name']);
        $product_id = $str[0];
        $quantity = $_POST['quantity'];
        $del_quantity = $_POST['del_quantity'];
        $del_by = $_POST['del_by'];
        $del_no = $_POST['del_no'];
        $on_date = $_POST['on_date'];
        $truck_no = $_POST['truck_no'];
        $approved_by = $_POST['approved_by'];
        
       

        $insert_product_del= "INSERT INTO `product_delivery` (`id`,`project_id`, `product_id`, `quantity`,`deliverd_by`,`on_date`,`phone`,`truck_no`,`approved_by`, `created_at`) VALUES
         (NULL,'$id', '$product_id', '$del_quantity', '$del_by','$on_date','$del_no','$truck_no','$approved_by', NOW())";
        $res = $conn->query($insert_product_del);
        if ($res) {
            $_SESSION['notification'] = "تم اضافة تقرير الإستلام بنجاح";
            header('location: view-factory.php?id='.$id.'');
            exit();
          } else {
            $_SESSION['notification'] = "خطأ في الادخال";
            header('location: view-factory.php?id='.$id.'');
            exit();
          }
   
    }
} else{

    $product_id = '';
    $quantity = '';
    $deliverd_by = '';
    $on_date = '';
    $phone = '';
    $truck_no = '';
    $approved_by = '';
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
        تقرير المشروع
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

<body class="g-sidenav-show rtl">

    <!-- Side Bar -->
    <?php require_once('../components/sidebar.php'); ?>
    <!-- End Of side Bar -->

    <main class="main-content position-relative lg:max-height-vh-100 lg:h-100 mt-1 border-radius-lg overflow-hidden">
        <!-- Navbar -->
        <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
            <div class="container-fluid py-1 px-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 ">
                        <li class="breadcrumb-item text-sm ps-2"><a class="opacity-5 text-dark" href="javascript:;">تقرير المشروع </a></li>

                    </ol>

                </nav>
                <div class="collapse navbar-collapse mt-sm-0 mt-2 px-0" id="navbar">
                   
                    <ul class="navbar-nav me-auto ms-0 justify-content-end">
                        <li class="nav-item d-flex align-items-center">
                            <a href="javascript:;" class="nav-link text-body font-weight-bold px-0">
                                <i class="fa fa-user me-sm-1"></i>
                                <span class="d-sm-inline d-none">تسجيل الخروج</span>
                            </a>
                        </li>
                        <li class="nav-item d-xl-none pe-3 d-flex align-items-center">
                            <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                                <div class="sidenav-toggler-inner">
                                    <i class="sidenav-toggler-line"></i>
                                    <i class="sidenav-toggler-line"></i>
                                    <i class="sidenav-toggler-line"></i>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item px-3 d-flex align-items-center">
                            <a href="javascript:;" class="nav-link text-body p-0">

                                <i class="fa fa-arrow-left me-sm-1 cursor-pointer" onclick="history.back()"></i>
                            </a>
                        </li>
                        <li class="nav-item dropdown ps-2 d-flex align-items-center">
                            <a href="javascript:;" class="nav-link text-body p-0" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa fa-bell cursor-pointer"></i>
                            </a>
                            <ul class="dropdown-menu  px-2 py-3 me-sm-n4" aria-labelledby="dropdownMenuButton">
                                <li class="mb-2">
                                    <a class="dropdown-item border-radius-md" href="javascript:;">
                                        <div class="d-flex py-1">
                                            <div class="my-auto">
                                                <img src="../assets/img/team-2.jpg" class="avatar avatar-sm  ms-3 ">
                                            </div>
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="text-sm font-weight-normal mb-1">
                                                    <span class="font-weight-bold">New message</span> from Laur
                                                </h6>
                                                <p class="text-xs text-secondary mb-0">
                                                    <i class="fa fa-clock me-1"></i>
                                                    13 minutes ago
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li class="mb-2">
                                    <a class="dropdown-item border-radius-md" href="javascript:;">
                                        <div class="d-flex py-1">
                                            <div class="my-auto">
                                                <img src="../assets/img/small-logos/logo-spotify.svg" class="avatar avatar-sm bg-gradient-dark  ms-3 ">
                                            </div>
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="text-sm font-weight-normal mb-1">
                                                    <span class="font-weight-bold">New album</span> by Travis Scott
                                                </h6>
                                                <p class="text-xs text-secondary mb-0">
                                                    <i class="fa fa-clock me-1"></i>
                                                    1 day
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item border-radius-md" href="javascript:;">
                                        <div class="d-flex py-1">
                                            <div class="avatar avatar-sm bg-gradient-secondary  ms-3  my-auto">
                                                <svg width="12px" height="12px" viewBox="0 0 43 36" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                                    <title>credit-card</title>
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <g transform="translate(-2169.000000, -745.000000)" fill="#FFFFFF" fill-rule="nonzero">
                                                            <g transform="translate(1716.000000, 291.000000)">
                                                                <g transform="translate(453.000000, 454.000000)">
                                                                    <path class="color-background" d="M43,10.7482083 L43,3.58333333 C43,1.60354167 41.3964583,0 39.4166667,0 L3.58333333,0 C1.60354167,0 0,1.60354167 0,3.58333333 L0,10.7482083 L43,10.7482083 Z" opacity="0.593633743"></path>
                                                                    <path class="color-background" d="M0,16.125 L0,32.25 C0,34.2297917 1.60354167,35.8333333 3.58333333,35.8333333 L39.4166667,35.8333333 C41.3964583,35.8333333 43,34.2297917 43,32.25 L43,16.125 L0,16.125 Z M19.7083333,26.875 L7.16666667,26.875 L7.16666667,23.2916667 L19.7083333,23.2916667 L19.7083333,26.875 Z M35.8333333,26.875 L28.6666667,26.875 L28.6666667,23.2916667 L35.8333333,23.2916667 L35.8333333,26.875 Z"></path>
                                                                </g>
                                                            </g>
                                                        </g>
                                                    </g>
                                                </svg>
                                            </div>
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="text-sm font-weight-normal mb-1">
                                                    Payment successfully completed
                                                </h6>
                                                <p class="text-xs text-secondary mb-0">
                                                    <i class="fa fa-clock me-1"></i>
                                                    2 days
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="row">
                <div class="block block-themed">
                    <div class="block-header bg-warning col-lg-3 col-md-4 col-sm-6 col-xs-6 rounded">
                        <?php require_once('../components/notification.php'); ?>
                    </div>
                    <div class="block-header bg-gradient-dark col-md-3 col-sm-6 col-xs-6  rounded-pill">
                        <h6 class="block-title text-center text-white py-2 px-4 ">اضافة تقرير جديد عن الاستلام</h6>
                    </div>
                    <form method="post" action="" enctype="multipart/form-data">

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>اختيار الصنف</label>
                                    <select name="name" id="name" class="form-control" placeholder="اختيار النوع">
                                        <option value="0"></option>
                                        <?php
                                        $s_items = mysqli_query($conn, "SELECT * FROM products WHERE `project_id` = $id ");
                                        while ($item = mysqli_fetch_array($s_items)) {
                                            $inv_id = $item['id'];
                                            $warehouse = 0 ;
                                            $delivery = 0 ;
                                            $inv_items = mysqli_query($conn, "SELECT * FROM product_status WHERE `product_id` = $inv_id ");
                                            while ($inv_item = mysqli_fetch_array($inv_items)) {
                                                $warehouse += $inv_item['warehouse'];
                                            }
                                            $del_items = mysqli_query($conn, "SELECT * FROM product_delivery WHERE `product_id` = $inv_id ");
                                            while ($del_item = mysqli_fetch_array($del_items)) {
                                                $delivery += $del_item['quantity'];
                                            }
                                            echo '<option value="'.$item['id'].','.($warehouse-$delivery).'">' . $item['product_name'] . '</option>';
                                        }
                                        ?>

                                    </select>
                                    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                                    <script>
                                    var i = 1;




                                    $(document).on('change', 'input , select', function() {
                                       var name = $('#name').val();
                                       const myArray = name.split(",");
                                       $('#quantity').val(myArray[1]);
                                    });




                                   
                                    </script>

                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label> الكمية الموجودة في المستودع </label>
                                    <input type="text" placeholder="الرجاء كتابة الكميةالموجودة في المستودع" class="form-control" name="quantity" id="quantity" value="" readonly>

                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label> الكمية التي سيتم تسليمها </label>
                                    <input type="text" placeholder="الرجاء كتابة كمية التي سيتم تسليمها" class="form-control" name="del_quantity" value="<?=$quantity?>">

                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label> تم الاستلام عن طريق </label>
                                    <input type="text" placeholder="الرجاء كتابة اسم الموصل" class="form-control" name="del_by" value="<?=$del_by?>">

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label> رقم الهاتف </label>
                                    <input type="text" placeholder="الرجاء كتابة رقم هاتف صاحب التوصيل" class="form-control" name="del_no" value="<?=$phone?>">

                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label> تاريخ </label>
                                    <input type="date" placeholder="" class="form-control" name="on_date" value="<?=$on_date?>">

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label> رقم الشاحنة </label>
                                    <input type="text" placeholder="الرجاء كتابة رقم الشاحنة" class="form-control" name="truck_no" value="<?=$truck_no?>">

                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label> تم الموافقه عن طريق </label>
                                    <input type="text" placeholder="الرجاء كتابة اسم الشخص" class="form-control" name="approved_by" value="<?=$approved_by?>">

                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <button type="submit" name="submit" class="btn btn-secondary"> اضافه التقريرالاستلام</button>
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
    
    <!--   Core JS Files   -->
    <script src="../assets/js/core/popper.min.js"></script>
    <script src="../assets/js/core/bootstrap.min.js"></script>
    <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
    <script src="../assets/js/plugins/fullcalendar.min.js"></script>
    <script src="../assets/js/plugins/chartjs.min.js"></script>
    
    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="../assets/js/soft-ui-dashboard.min.js?v=1.0.3"></script>
    <script src="../Admin/darkmode.js"></script>
</body>

</html>