<?php
include('../cookies/session2.php');
$_SESSION['sidebar'] = "Factory";

if (isset($_GET['id'])) {
    $project_cost = 0;
    $id = $_GET['id'];

    $query = "SELECT * FROM projects WHERE `id` = $id";
    $res = $conn->query($query);
    $project = $res->fetch_assoc();

    $res2 = mysqli_query($conn, "SELECT * FROM projects_bills WHERE `project_id` = $id");
    while ($r = mysqli_fetch_array($res2)) {
        $total_bills += $r['price'];
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
        المصنع
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
                        <li class="breadcrumb-item text-sm ps-2"><a class="opacity-5 text-dark" href="javascript:;">المصنع</a></li>

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
                            <a href="../Auth/logout.php" class="nav-link text-body font-weight-bold px-0">
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
                <div class="col-md-3 col-sm-6 col-xs-6">

                    <?php require_once('../components/notification.php'); ?>
                </div>
                <!--********* -->
                <div class="col-12 mt-4">
                    <div class="card mx-4 p-3">

                        <div class="row ">
                            <div class="text-right col-lg-10 col-sm-6">
                                <a href="project-report.php?project_id=<?=$id?>" 
                                class="btn bg-gradient-dark mb-0">
                                 رفع التقرير عن الانتاج
                                 <i class="fas fa-plus" aria-hidden="true"></i>
                                </a>
                                <a href="receipt-report.php?project_id=<?=$id?>"  
                                class="btn bg-gradient-dark mb-0">
                                 رفع التقرير عن الاستلام
                                 <i class="fas fa-plus" aria-hidden="true"></i>
                                </a>
                                
                            </div>
                            <div class="text-left col-lg-2 col-sm-6">
                            <a href="bills_factory.php?project_id=<?=$id?>" 
                                class="btn bg-gradient-dark mb-0 ">
                                 رفع الفواتير
                                 <i class="fas fa-plus" aria-hidden="true"></i>
                                </a>
                            </div>
                        </div>

                        <script>
                            function printDiv(divName) {

                                document.getElementById('btn1').style.display = "none";
                                document.getElementById('btn2').style.display = "none";
                                document.getElementById('btn3').style.display = "none";
                                window.print();
                                document.getElementById('btn1').style.display = "inline";
                                document.getElementById('btn2').style.display = "inline";
                                document.getElementById('btn3').style.display = "inline";

                            }
                        </script>
                        <!-- Change Status Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">حالة المشروع</h5>
                                        <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close" style="position: relative;left: 0%;right: 80%;">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="post" action="../scripts/update-status/update.php?bank_req=<?= $id ?>">
                                            <?php if ($position == 'Admin' || $position == 'Accounts' && $status == 1) { ?> <button type="submit" name="account" class="btn bg-gradient-dark rounded-pill" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                                    تأكيد المشروع عن طريق المحاسب
                                                </button>
                                            <?php } ?>
                                            <br>
                                            <?php if ($position == 'Admin' || $position == 'Manager' && $status == 2) { ?> <button type="submit" name="manager" class="btn bg-gradient-dark rounded-pill" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                                    تأكيد المشروع عن طريق طريق المدير العام
                                                </button>
                                            <?php } ?>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>

                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>


                </div>
                <div class="col-12 mt-4">
                    <!--********* -->
                    <div class="container-fluid py-4">
                        <div class="row">
                            <div class="col-xl-6 mb-xl-0 mb-4">
                                <div class="card h-100">
                                    <div class="card-body p-3">

                                        <dl class="dl-horizontal">
                                            <h6>معلومات المشروع</h6>

                                            <dt>الجهة الطالبة المشروع: </dt>
                                            <dd><?= $project['name'] ?></dd>

                                            <dt>تفاصيل المشروع: </dt>
                                            <dd> <?= $project['description'] ?></dd>

                                            <!--  <dt>مدة الموافقة على المشروع: </dt>
                                              <dd>للموافقة قبل:
                                                   <?= $project['valid_till'] ?> 
                                                </dd> 
                                              -->

                                            <dt>مدة تنفيذ المشروع: </dt>
                                            <dd><?= $project['duration'] ?></dd>

                                            <dt>طريقة الدفع: </dt>
                                            <dd><?= $project['payment_type'] ?></dd>

                                        </dl>

                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="row">
                                    <div class="col-md-4 col-sm-2 mb-3">
                                        <div class="card ">
                                            <div class="card-header mx-4 p-3 text-center">
                                                <div class="icon icon-shape icon-lg color-bg-icon shadow text-center border-radius-lg">
                                                    <i class="fas fa-landmark opacity-10"></i>
                                                </div>
                                            </div>
                                            <div class="card-body pt-0 p-3 text-center">
                                                <h6 class="text-center mb-0">تكلفة المشروع</h6>
                                                <hr class="horizontal dark my-3">

                                                <h5 class="mb-0"><?= number_format($project['project_cost']) ?> ريال</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-2 mt-md-0 mt-4">
                                        <div class="card ">
                                            <div class="card-header mx-4 p-3 text-center">
                                                <div class="icon icon-shape icon-lg color-bg-icon shadow text-center border-radius-lg">
                                                    <i class="fas fa-landmark opacity-10"></i>
                                                </div>
                                            </div>
                                            <div class="card-body pt-0 p-3 text-center">
                                                <h6 class="text-center mb-0">متبقي من تكلفة المشروع</h6>

                                                <hr class="horizontal dark my-3">
                                                <h5 class="mb-0"><?=number_format($project['project_cost'] - $total_bills)?></h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-2 mt-md-0 mt-4">
                                        <div class="card ">
                                            <div class="card-header mx-4 p-3 text-center">
                                                <div class="icon icon-shape icon-lg color-bg-icon shadow text-center border-radius-lg">
                                                    <i class="fas fa-landmark opacity-10"></i>
                                                </div>
                                            </div>
                                            <div class="card-body pt-0 p-3 text-center">
                                                <h6 class="text-center mb-0"> ما تم صرفه </h6>

                                                <hr class="horizontal dark my-3">
                                                <h5 class="mb-0"><?=number_format($total_bills)?></h5>
                                            </div>
                                        </div>
                                    </div>


                                </div>

                            </div>

                        </div>

                        <!--Table-->
                        <div class="row mt-5">
                            <div class="col-12">
                                <div class="card mb-4">
                                    <div class="card-header pb-0">
                                        <h6>خرسانة المشروع</h6>
                                    </div>
                                    <div class="card-body px-0 pt-0 pb-2 mx-3">
                                        <div class="table-responsive p-0">
                                            <table class="table table-hover table-fixed">

                                                <!--Table head-->
                                                <thead class="bg-dark text-light text-center">
                                                    <tr>
                                                        <th>الرقم</th>
                                                        <th>الصنف</th>
                                                        <th>كمية الخرسانة</th>
                                                        <th>سعر الخرسانة</th>
                                                        <th>كمية الخرسانة المستخدمة</th>
                                                        <th>سعر الخرسانة المستخدمة</th>
                                                    </tr>
                                                </thead>
                                                <!--Table head-->

                                                <!--Table body-->
                                                <tbody class="text-center">
                                                    <?php
                                                    $i = 0;
                                                    
                                                    $res3 = mysqli_query($conn, "SELECT * FROM products WHERE `project_id` = $id");
                                                    while ($products = mysqli_fetch_array($res3)) {
                                                        $i++;
                                                        $kh_quan = 0;
                                                    ?>
                                                        <tr>
                                                            <th scope="row"><?= $i ?></th>
                                                            <td><?= $products['product_name'] ?></td>
                                                    <?php
                                                    $kh_id = $products['id'];
                                                     $res4 = mysqli_query($conn, "SELECT * FROM kharasana WHERE `product_id` = $kh_id");
                                                     while ($kh = mysqli_fetch_array($res4)) {
                                                        $kh_quan = $kh['quantity_per_piece'] * $products['quantity'];
                                                        $kh_total = $kh['total_price'];
                                                        
                                                     }
                                                    ?>
                                                            <td><?= $kh_quan ?></td>
                                                            <td><?= number_format($kh_total) ?></td>
                                                    <?php
                                                    $status_id = $products['id'];
                                                    $kh_used = 0;
                                                    $kh_used_price = 0;
                                                     $res5 = mysqli_query($conn, "SELECT * FROM product_status WHERE `product_id` = $status_id AND `status` ='إنتاج'");
                                                     while ($status = mysqli_fetch_array($res5)) {
                                                        $kh_used += $status['kharasana_used'];
                                                        $kh_used_price += $status['total_price'];
                                                        
                                                     }
                                                    ?>
                                                    
                                                            <td><?= number_format($kh_used,2) ?></td>
                                                            <td><?= number_format($kh_used_price) ?></td>

                                                        </tr>
                                                    <?php } ?>

                                                </tbody>
                                                <!--Table body-->

                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="card mb-4">
                                    <div class="card-header pb-0">
                                        <h6>اصناف المشروع</h6>
                                    </div>
                                    <div class="card-body px-0 pt-0 pb-2 mx-3">
                                        <div class="table-responsive p-0">
                                            <table class="table table-hover table-fixed">

                                                <!--Table head-->
                                                <thead class="bg-dark text-light text-center">
                                                    <tr>
                                                        <th>الرقم</th>
                                                        <th>الصنف</th>
                                                        <th>الكمية الكلية للصنف</th>
                                                        <th>موجود في المستودع</th>
                                                        <th>تم انتاج</th>
                                                        <th>تم الاستلام</th>
                                                        <th>المتبقي</th>

                                                    </tr>
                                                </thead>
                                                <!--Table head-->

                                                <!--Table body-->
                                                <tbody class="text-center">
                                                    <?php
                                                    $i = 0;
                                                    $res3 = mysqli_query($conn, "SELECT * FROM products WHERE `project_id` = $id");
                                                    while ($products = mysqli_fetch_array($res3)) {
                                                        $i++;
                                                        $inventory = 0;
                                                        $production = 0;
                                                        $deliverd = 0;
                                                    ?>
                                                        <tr>
                                                            <th scope="row"><?= $i ?></th>
                                                            <td><?= $products['product_name'] ?></td>
                                                            <td><?= $products['quantity'] ?></td>
                                                            <?php 
                                                            $inv_id =  $products['id'];
                                                            $inv_res = mysqli_query($conn, "SELECT * FROM product_status WHERE `product_id` = $inv_id");
                                                            
                                                            while ($inv = mysqli_fetch_array($inv_res)) {
                                                                $inventory += $inv['warehouse'];
                                                                $production += $inv['production'];
                                                            }
                                                            ?>
                                                            <?php 
                                                            $del_id =  $products['id'];
                                                            $del_res = mysqli_query($conn, "SELECT * FROM product_delivery WHERE `product_id` = $del_id");
                                                            
                                                            while ($del = mysqli_fetch_array($del_res)) {
                                                                
                                                                $deliverd += $del['quantity'];
                                                                
                                                            }
                                                            ?>
                                                            <td><?= number_format($inventory - $deliverd) ?></td>
                                                            <td><?= number_format($production ) ?></td>

                                                            

                                                            <td><?= number_format($deliverd) ?></td>



                                                            <td><?=$products['quantity']-$production?></td>
                                                        </tr>
                                                    <?php } ?>

                                                </tbody>
                                                <!--Table body-->


                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--Table -->

                        <div class="row">

                            <div class="col-lg-12  mt-4">
                                <div class="card h-100">
                                    <div class="card-header pb-0 p-3">
                                        <div class="row">
                                            <div class="col-12 d-flex align-items-center">
                                                <h6 class="mb-0 text-lg">الفواتير المشروع</h6>
                                            </div>
                                           
                                        </div>
                                    </div>
                                    <div class="card-body p-3 pb-0">
                                        <ul class="list-group">

                                        <?php 
                                          $get_bills = mysqli_query($conn, "SELECT * FROM projects_bills WHERE `project_id` = $id ");
                                          while ($bill = mysqli_fetch_array($get_bills)){

                                        ?>
                                            <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                                                <div class="d-flex flex-column">
                                                    <h6 class="mb-1 text-dark font-weight-bold text-sm"><?=$bill['bill_date']?> <span class="badge text-dark badge-success"> Added by: <?=$bill['added_by']?> </span></h6>
                                                    <span class="text-xs">#<?=$bill['id']?></span>
                                                </div>
                                                <div class="d-flex align-items-center text-sm">
                                                    ريال <?=$bill['price']?>
                                                    <a href="../Signed-Docs/Project-Bills/<?=$bill['project_id']?>/<?=$bill['bill_img']?>" target="_blank" class="btn btn-link text-dark text-sm mb-0 px-0 ms-4"><i class="fas fa-file-pdf text-lg me-1"></i> PDF</a>
                                                </div>
                                            </li>
                                           <?php } ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
            <button type="button" id="btnD" class=" btn bg-gradient-dark rounded-pill col-md-2 col-sm-6 col-xs-6 mx-4 ">
                حذف المشروع
            </button>
        </div>


        <footer class="footer pt-3  ">
            <div class="container-fluid">
                <div class="row align-items-center justify-content-lg-between">
                    <div class="col-lg-6 mb-lg-0 mb-4">
                        <div class="copyright text-center text-sm text-muted text-lg-end">
                            © <script>
                                document.write(new Date().getFullYear())
                            </script>,
                            made with <i class="fa fa-heart"></i> by
                            <a href="" class="font-weight-bold" target="_blank">Rukn Amial</a>

                        </div>
                    </div>
                    <div class="col-lg-6">
                        <ul class="nav nav-footer justify-content-center justify-content-lg-end">
                            <li class="nav-item">
                                <a href="https://ruknamial.com" class="nav-link text-muted" target="_blank">Rukn Amial</a>
                            </li>
                            <li class="nav-item">
                                <a href="https://files.ruknamial.com" class="nav-link text-muted" target="_blank">Files</a>
                            </li>
                            <li class="nav-item">
                                <a href="https://ruknamial.com/blogs" class="nav-link text-muted" target="_blank">Blog</a>
                            </li>

                        </ul>
                    </div>
                </div>
        </footer>


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