<?php
include('../cookies/session2.php');
$_SESSION['sidebar'] = "Factory";
if(isset($_GET['project_id'])){
    $id = $_GET['project_id'];

    if(isset($_POST['submit'])){

        $str = explode(",",$_POST['name']);
        $product_id = $str[0];
        $product_name = $str[1];
        $description = $_POST['description'];
        $product_quantity = $_POST['product_quantity'];
        $type = $_POST['type'];
        $price = $_POST['price'];
        $quantity = $_POST['quantity'];
        $extra = $_POST['extra'];

        if($description == "صب كامل"){
            $status = "إنتاج";
            $insert_product_status = "INSERT INTO product_status (`id`, `product_id`, `status`, `name`, `description`, `quantity`, `kharasana_type`, `kharasana_price`, `kharasana_used`,`extra_price`,`production`,`warehouse`, `created_at`)
            VALUES (NULL, '$product_id' ,'$status', '$product_name' , '$description' , '$product_quantity' , '$type' , '$price' ,'$quantity','$extra','$product_quantity','$product_quantity', NOW())";
            $res = $conn->query($insert_product_status);
        }else{
            $status = "قيد التصنيع";
            $insert_product_status = "INSERT INTO product_status (`id`, `product_id`, `status`, `name`, `description`, `quantity`, `kharasana_type`, `kharasana_price`, `kharasana_used`,`extra_price`,`production`,`warehouse`, `created_at`)
          VALUES (NULL, '$product_id' ,'$status', '$product_name' , '$description' , '$product_quantity' , '$type' , '$price' ,'$quantity','$extra','0','0', NOW())";
          $res = $conn->query($insert_product_status);
        }
        if ($res) {
            $_SESSION['notification'] = "تم اضافة تقرير الانتاج بنجاح";
            header('location: view-factory.php?id='.$id.'');
            exit();
          } else {
            $_SESSION['notification'] = "خطأ في الادخال";
            header('location: view-factory.php?id='.$id.'');
            exit();
          }

        

    }
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

<body class="g-sidenav-show rtl bg-gray-100">

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
                    <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                        <div class="input-group">
                            <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
                            <input type="text" class="form-control" placeholder="أكتب هنا...">
                        </div>
                    </div>
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
                        <h6 class="block-title text-center text-white py-2 px-4 ">اضافة تقرير جديد عن الانتاج</h6>
                    </div>
                    <form method="post" action="">

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>اختيار الصنف</label>
                                    <select name="name" id="name" class="form-control" placeholder="اختيار النوع" >
                                        <option value="0"></option>
                                        <?php
                                        $s_items = mysqli_query($conn, "SELECT * FROM products WHERE `project_id` = $id ");
                                        while ($item = mysqli_fetch_array($s_items)){
                                            echo '<option value="'.$item['id'].','.$item['product_name'].'">'.$item['product_name'].'</option>';
                                        }

                                        ?>

                                    </select>

                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>نوع الاجراء</label>
                                    <select name="description" id="description" class="form-control" placeholder="نوع الاجراء" onchange="showDiv2(this)">
                                        <option value="0"></option>
                                        <option value="صب ارضية">صب ارضية</option>
                                        <option value="صب جوانب">صب جوانب</option>
                                        <option value="صب سقفية">صب سقفية</option>
                                        <option value="صب رقبية">صب رقبية</option>
                                        <option value="صب كامل">صب كامل</option>
                                    </select>
                                    <script>
                                        function showDiv2(select) {
                                            if (select.value == "صب كامل") {
                                                document.getElementById('kh-row1').style.display = "block";
                                                document.getElementById('kh-row2').style.display = "block";
                                                document.getElementById('kh-row3').style.display = "none";
                                            } else {
                                                document.getElementById('kh-row1').style.display = "none";
                                                document.getElementById('kh-row2').style.display = "none";
                                                document.getElementById('kh-row3').style.display = "block";
                                            }
                                        }
                                    </script>
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label> كمية الاصناف </label>
                                    <input type="text" placeholder="الرجاء كتابة كمية الاصناف    " class="form-control" name="product_quantity" id="product_quantity" value="0">
                                    <input type="text" placeholder="" class="form-control" name="kh_per_peice" id="kh_per_peice" hidden>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>نوع الخرسانة</label>
                                    <select name="type" id="type" class="form-control" placeholder="نوع الخرسانة">
                                        <option value="0"></option>
                                        <option value="خرسانة شركة">خرسانة شركة</option>
                                        <option value="خرسانة رجيع">خرسانة رجيع</option>

                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label> سعر الخرسانة </label>
                                    <input type="text" placeholder="الرجاء كتابة سعر الخرسانة " class="form-control" name="price" id="price" value="0">

                                </div>
                            </div>

                            <div class="col" id="kh-row3">
                                <div class="form-group">
                                    <label> وصف كمية الخرسانة المستخدمة</label>
                                    <input type="text" placeholder="الرجاء كتابة وصف كمية الخرسانة المستخدمة " class="form-control" name="kh_text" name="kh_text" value="">

                                </div>
                            </div>

                            <div class="col" id="kh-row1" style="display:none">
                                <div class="form-group" >
                                    <label> كمية الخرسانة </label>
                                    <input type="text" placeholder="الرجاء كتابة كمية الخرسانة " class="form-control" name="quantity" id="quantity" value="0" readonly>

                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label> مبلغ اضافي </label>
                                    <input type="text" placeholder="الرجاء كتابة المبلغ " class="form-control" name="extra" id="extra" value="0">

                                </div>
                            </div>
                            <div class="col"  id="kh-row2" style="display:none">
                                <div class="form-group">
                                    <label>المجموع</label>
                                    <input type="text" placeholder="الرجاء كتابة المبلغ " class="form-control" name="total_price" id="total_price" value="" readonly>

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <button type="submit" name="submit" class="btn btn-secondary"> اضافه التقرير الانتاج</button>
                                </div>
                            </div>
                           
                        </div>
                        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                        <script>

                            $(document).ready(function() {
                                $('#name').on('change', function() {
                                    var selectedOption = $(this).find('option:selected');
                                    var productId = selectedOption.val().split(',')[0];
                                    
                                    if (productId !== "") {
                                        $.ajax({
                                            type: 'POST',
                                            url: '../ajax/fetch_kh_per_peice.php', // Create this PHP file to handle the AJAX request
                                            data: { product_id: productId },
                                            success: function(response) {
                                                $('#kh_per_peice').val(response);
                                            }
                                        });
                                    } else {
                                        $('#kh_per_peice').val(''); // Clear the display if no option is selected
                                    }
                                });
                            });
                           

                            $(document).on('change', 'input , select', function() {
                            var quantity = $('#product_quantity').val();
                            var kh_per_peice = $('#kh_per_peice').val();
                            var price = $('#price').val();
                            var extra = $('#extra').val();

                            $('#quantity').val(quantity*kh_per_peice);
                            var used_quantity = $('#quantity').val();   

                            $('#total_price').val(used_quantity * price + extra);
                            
                            


                            
                            });
                        </script>
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
</body>

</html>