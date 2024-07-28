<?php
include('../cookies/session2.php');
include('../cookies/insert-method2.php');
$_SESSION['sidebar_admin'] = "dashboard";
$emp_id = $_SESSION['id'];
$total_left_advance = get_advanced_status('advance_status', $emp_id);

$query = "SELECT * FROM leaves";
$res = mysqli_query($conn, $query);
if ($res) {
    $rowcount = mysqli_num_rows($res);
}

$query = "SELECT * FROM leaves WHERE status='Approved'";
$res = mysqli_query($conn, $query);
if ($res) {
    $rowcountApproved = mysqli_num_rows($res);
}

$query = "SELECT * FROM leaves WHERE status='Pending'";
$res = mysqli_query($conn, $query);
if ($res) {
    $rowcountPending = mysqli_num_rows($res);
}
?>

<html lang="ar" dir="rtl">

<head>



    <!-- Blazor -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css" rel="stylesheet" />
    <link href="_content/Blazor.Bootstrap/blazor.bootstrap.css" rel="stylesheet" /> -->

    <!-- Blazor js -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script> -->
    <!-- Add chart.js reference if chart components are used in your application. -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.0.1/chart.umd.js" integrity="sha512-gQhCDsnnnUfaRzD8k1L5llCCV6O9HN09zClIzzeJ8OJ9MpGmIlCxm+pdCkqTwqJ4JcjbojFr79rl2F1mzcoLMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->
    <!-- Add chartjs-plugin-datalabels.min.js reference if chart components with data label feature is used in your application. -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-datalabels/2.2.0/chartjs-plugin-datalabels.min.js" integrity="sha512-JPcRR8yFa8mmCsfrw4TNte1ZvF1e3+1SdGMslZvmrzDYxS69J7J49vkFL8u6u8PlPJK+H3voElBtUCzaXj+6ig==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="_content/Blazor.Bootstrap/blazor.bootstrap.js"></script> -->

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../assets/img/favicon.png">
    <title>
       سكايب  | Skype Contracting
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
    <link href="../assets/css/custom.css" rel="stylesheet" />

    <!-- CSS Files -->
    <link id="pagestyle" href="../../assets/css/soft-ui-dashboard.css?v=1.0.3" rel="stylesheet" />
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
    <script src="//cdn.datatables.net/plug-ins/1.10.7/integration/bootstrap/3/dataTables.bootstrap.js"></script>
</head>


<body class="g-sidenav-show rtl .bg-gray-100 ">



    <!-- Side Bar -->
    <?php require_once('../components/sidebar_admin.php'); ?>


    <!-- End Of side Bar -->
    <main class="main-content position-relative lg:max-height-vh-100 lg:h-100 mt-1 border-radius-lg overflow-hidden" style="-webkit-overflow-scrolling: touch;overflow-y: scroll;">
        <!-- Navbar -->
        <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
            <div class="container-fluid py-1 px-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 ">
                        <li class="breadcrumb-item text-sm ps-2"><a class="opacity-5 " href="javascript:;">لوحات القيادة</a></li>
                        <li class="breadcrumb-item text-sm  active" aria-current="page">الرئيسية</li>
                    </ol>
                    <h6 class="font-weight-bolder mb-0">الرئيسية</h6>
                </nav>
                <div class="collapse navbar-collapse mt-sm-0 mt-2 px-0" id="navbar">




                    <ul class="navbar-nav me-auto ms-0 justify-content-end">
                        <li class="nav-item d-flex align-items-center px-4">
                            <a href="../Auth/logout.php" class="nav-link text-body font-weight-bold px-0">
                                <i class="fa fa-user me-sm-1"></i>
                                <span class="d-sm-inline d-none"> تسجيل الخروج</span>
                            </a>
                        </li>
                        <li class="nav-item d-xl-none pe-3 d-flex align-items-center px-4">
                            <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                                <div class="sidenav-toggler-inner">
                                    <i class="sidenav-toggler-line"></i>
                                    <i class="sidenav-toggler-line"></i>
                                    <i class="sidenav-toggler-line"></i>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item px-3 d-flex align-items-center">
                            <a href="Messages/chat.php" class="nav-link text-body p-0">

                                <i class="far fa-comments me-sm-1 cursor-pointer"></i>
                            </a>
                        </li>

                        <!-- Notifications -->
                        <li class="nav-item dropdown ps-2 d-flex align-items-center px-4">
                            <a href="javascript:;" class="nav-link text-body p-0" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa fa-bell cursor-pointer"></i>
                                <span id="notification-count" class="notification-badge">0</span> <!-- Add this line -->
                            </a>
                            <ul class="dropdown-menu  px-2 py-3 me-sm-n4" aria-labelledby="dropdownMenuButton" id="notifications-container">
                                <!-- Notifications will be dynamically added here -->
                            </ul>
                        </li>
                        <!-- End of Notifications -->



                    </ul>
                </div>
            </div>
        </nav>
        <!-- End Navbar -->


        <?php if($position != 'Admin'){?>
            <div class="container-fluid py-4">
            <div class="block-header bg-gradient-dark  col-md-3 col-sm-6 col-xs-6  rounded-pill">

                <?php require_once('../components/notification.php'); ?>
            </div>
            <div class="border-radius-xl mt-3 mx-3 position-relative" style="background-image: url('../assets/img/vr-bg.jpg') ; background-size: cover;" dir="ltr">
               
                <main class="main-content mt-1 border-radius-lg">
                    <div class="section min-vh-85 position-relative transform-scale-0 transform-scale-md-7">
                        <div class="container-fluid">
                            <div class="row pt-10">
                                
                                <div class="col-lg-8 col-md-11">
                                    <div class="d-flex">
                                        <div class="me-auto">
                                            <h1 class="display-1 font-weight-bold mt-n4 mb-0">28°C</h1>
                                            <h6 class="text-uppercase mb-0 ms-1">Cloudy</h6>
                                        </div>
                                        <div class="ms-auto">
                                            <img class="w-50 float-end mt-lg-n4" src="../assets/img/small-logos/icon-sun-cloud.png" alt="image sun">
                                        </div>
                                    </div>
                                    <div class="row mt-4">
                                        <div class="col-lg-4 col-md-4">
                                            <div class="card move-on-hover overflow-hidden">
                                                <div class="card-body">
                                                    <div class="d-flex">
                                                        <h6 class="mb-0 me-3">08:00</h6>
                                                        <h6 class="mb-0">Synk up with Mark
                                                            <small class="text-secondary font-weight-normal">Hangouts</small>
                                                        </h6>
                                                    </div>
                                                    <hr class="horizontal dark">
                                                    <div class="d-flex">
                                                        <h6 class="mb-0 me-3">09:30</h6>
                                                        <h6 class="mb-0">Gym <br />
                                                            <small class="text-secondary font-weight-normal">World Class</small>
                                                        </h6>
                                                    </div>
                                                    <hr class="horizontal dark">
                                                    <div class="d-flex">
                                                        <h6 class="mb-0 me-3">11:00</h6>
                                                        <h6 class="mb-0">Design Review<br />
                                                            <small class="text-secondary font-weight-normal">Zoom</small>
                                                        </h6>
                                                    </div>
                                                </div>
                                                <a href="javascript:;" class="bg-gray-100 w-100 text-center py-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Show More">
                                                    <i class="fas fa-chevron-down text-primary"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 mt-4 mt-sm-0">
                                            <div class="card bg-gradient-dark move-on-hover">
                                                <div class="card-body">
                                                    <div class="d-flex">
                                                        <h5 class="mb-0 text-white">To Do</h5>
                                                        <div class="ms-auto">
                                                            <h1 class="text-white text-end mb-0 mt-n2">7</h1>
                                                            <p class="text-sm mb-0 text-white">items</p>
                                                        </div>
                                                    </div>
                                                    <p class="text-white mb-0">Shopping</p>
                                                    <p class="mb-0 text-white">Meeting</p>
                                                </div>
                                                <a href="javascript:;" class="w-100 text-center py-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Show More">
                                                    <i class="fas fa-chevron-down text-white"></i>
                                                </a>
                                            </div>
                                            <div class="card move-on-hover mt-4">
                                                <div class="card-body">
                                                    <div class="d-flex">
                                                        <p class="mb-0">Emails (21)</p>
                                                        <a href="javascript:;" class="ms-auto" data-bs-toggle="tooltip" data-bs-placement="top" title="Check your emails">
                                                            Check
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 mt-4 mt-sm-0">
                                            <div class="card card-background card-background-mask-primary move-on-hover align-items-start">
                                                <div class="cursor-pointer">
                                                    <div class="full-background" style="background-image: url('../assets/img/curved-images/curved1.jpg')"></div>
                                                    <div class="card-body">
                                                        <h5 class="text-white mb-0">Some Kind Of Blues</h5>
                                                        <p class="text-white text-sm">Deftones</p>
                                                        <div class="d-flex mt-5">
                                                            <button class="btn btn-outline-white rounded-circle p-2 mb-0" type="button" data-bs-toggle="tooltip" data-bs-placement="top" title="Prev">
                                                                <i class="fas fa-backward p-2"></i>
                                                            </button>
                                                            <button class="btn btn-outline-white rounded-circle p-2 mx-2 mb-0" type="button" data-bs-toggle="tooltip" data-bs-placement="top" title="Pause">
                                                                <i class="fas fa-play p-2"></i>
                                                            </button>
                                                            <button class="btn btn-outline-white rounded-circle p-2 mb-0" type="button" data-bs-toggle="tooltip" data-bs-placement="top" title="Next">
                                                                <i class="fas fa-forward p-2"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card move-on-hover mt-4">
                                                <div class="card-body">
                                                    <div class="d-flex">
                                                        <p class="my-auto">Messages</p>
                                                        <div class="ms-auto">
                                                            <div class="avatar-group">
                                                                <a href="javascript:;" class="avatar avatar-sm border-0 rounded-circle" data-bs-toggle="tooltip" data-bs-placement="top" title="2 New Messages">
                                                                    <img alt="Image placeholder" src="../assets/img/team-1.jpg">
                                                                </a>
                                                                <a href="javascript:;" class="avatar avatar-sm border-0 rounded-circle" data-bs-toggle="tooltip" data-bs-placement="top" title="1 New Message">
                                                                    <img alt="Image placeholder" src="../assets/img/team-2.jpg">
                                                                </a>
                                                                <a href="javascript:;" class="avatar avatar-sm border-0 rounded-circle" data-bs-toggle="tooltip" data-bs-placement="top" title="13 New Messages">
                                                                    <img alt="Image placeholder" src="../assets/img/team-3.jpg">
                                                                </a>
                                                                <a href="javascript:;" class="avatar avatar-sm border-0 rounded-circle" data-bs-toggle="tooltip" data-bs-placement="top" title="7 New Messages">
                                                                    <img alt="Image placeholder" src="../assets/img/team-4.jpg">
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <?php require_once('../components/footer.php'); ?>
        </div>
     
        <?php } else {?>
            <div class="container-fluid py-4">
            <div class="row">
                <div class="col-lg-3 col-sm-6 mb-lg-0 mb-4">
                    <div class="card">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8">
                                    <div class="numbers">
                                        <p class="text-sm mb-0 text-capitalize font-weight-bold">عدد الاجازات</p>
                                        <h5 class="font-weight-bolder mb-0">
                                            <?= $rowcount ?>
                                        </h5>
                                    </div>
                                </div>
                                <div class="col-4 text-start">

                                    <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                        <i class="fa fa-hourglass text-lg opacity-10" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 mb-lg-0 mb-4">
                    <div class="card">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8">
                                    <div class="numbers">
                                        <p class="text-sm mb-0 text-capitalize font-weight-bold">الاجازة المعتمدة</p>
                                        <h5 class="font-weight-bolder mb-0">
                                            <?= $rowcountApproved ?>
                                        </h5>
                                    </div>
                                </div>
                                <div class="col-4 text-start">
                                    <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                        <i class="fa fa-thumbs-o-up text-lg opacity-10" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 mb-lg-0 mb-4">
                    <div class="card">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8">
                                    <div class="numbers">
                                        <p class="text-sm mb-0 text-capitalize font-weight-bold">انتظار الموافقه على الاجازة</p>
                                        <h5 class="font-weight-bolder mb-0">
                                            <?= $rowcountPending ?>
                                        </h5>
                                    </div>
                                </div>
                                <div class="col-4 text-start">
                                    <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                        <i class="fa fa-spinner text-lg opacity-10" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="card">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8">
                                    <div class="numbers">
                                        <p class="text-sm mb-0 text-capitalize font-weight-bold">إجمالي متبقي السلفيات</p>
                                        <h5 class="font-weight-bolder mb-0">
                                            <?= $total_left_advance ?>
                                        </h5>
                                    </div>
                                </div>
                                <div class="col-4 text-start">
                                    <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                        <i class="fa fa-window-close text-lg opacity-10" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!--Table     -->
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4 mt-3">
                        <div class="card-header pb-0 ">
                            <h6>المخزن</h6>
                        </div>
                        <div class="card-body px-0 pt-0 pb-2 mx-3">
                            <div class="table-responsive p-0">
                                <table class="table table-hover table-bordered table-fixed" id="example">

                                    <!--Table head-->
                                    <thead class="bg-dark text-ligh table-bordered text-center">
                                        <tr>
                                            
                                            <th>اسم المنتح</th>
                                            <th>كميه المنتج</th>
                                            <th>المستهلك</th>
                                            <th>المتبقي</th>



                                        </tr>
                                    </thead>
                                    <!--Table head-->

                                    <!--Table body-->
                                    <tbody class=" text-center">
                                        <?php
                                        $i = 0;
                                        $dataStock = mysqli_query($conn, "SELECT * FROM `stock`");
                                        while ($r = mysqli_fetch_array($dataStock)) {
                                            $i++;
                                            $quantity = $r['quantity'];
                                            $used_quantity= $r['used_quantity'];
                                            $remaining_quantity = $quantity - $used_quantity;
                                          
                                        ?>
                                            <tr>
                                               
                                                <td class="border-1"><?= $r['name_stock'] ?></td>
                                                <td class="border-1"><?= $r['quantity'] ?></td>
                                                <td class="border-1"><?= $r['used_quantity'] ?></td>
                                                <td class="border-1"><?= $remaining_quantity ?></td>



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
            <!--Table     -->
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4 mt-3">
                        <div class="card-header pb-0 ">
                            <h6>اخر الاجازات</h6>
                        </div>
                        <div class="card-body px-0 pt-0 pb-2 mx-3">
                            <div class="table-responsive p-0">
                                <table class="table table-hover table-bordered table-fixed" id="example">

                                    <!--Table head-->
                                    <thead class="bg-dark text-ligh table-bordered text-center">
                                        <tr>
                                            
                                            <th>اسم الموظف</th>
                                            <th>سبب الاجازه</th>
                                            <th>تاريخ طلب الاجازة</th>
                                            <th>حاله الطلب</th>



                                        </tr>
                                    </thead>
                                    <!--Table head-->

                                    <!--Table body-->
                                    <tbody class=" text-center">
                                        <?php
                                        $i = 0;
                                        $show_leaves = mysqli_query($conn, "SELECT * FROM `leaves`");
                                        while ($r = mysqli_fetch_array($show_leaves)) {
                                            $i++;
                                            $emp_id = $r['employee_id'];
                                            $query = "SELECT * FROM users WHERE id=$emp_id";
                                            $resLeaves = $conn->query($query);
                                            $full_name = $resLeaves->fetch_assoc();
                                        ?>
                                            <tr>
                                               
                                                <td class="border-1"><?= $full_name['full_name'] ?></td>
                                                <td class="border-1"><?= $r['type'] ?></td>
                                                <td class="border-1"><?= $r['created_at'] ?></td>

                                                <td class="border-1">
                                                    <?php if ($r['status'] == 'Approved') {
                                                        echo '<span class="badge badge-sm bg-gradient-success">Approved</span>';
                                                    } elseif ($r['status'] == 'Pending') {
                                                        echo '<span class="badge badge-sm bg-gradient-warning">Pending</span>';
                                                    } else {
                                                        echo '<span class="badge badge-sm bg-gradient-danger">Declined</span>';
                                                    } ?>

                                                    

                                                </td>

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
            <!--Table     -->
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4 mt-3">
                        <div class="card-header pb-0 ">
                            <h6>اخر السلفيات</h6>
                        </div>
                        <div class="card-body px-0 pt-0 pb-2 mx-3">
                            <div class="table-responsive p-0">
                                <table class="table table-hover table-bordered table-fixed" id="example">

                                    <!--Table head-->
                                    <thead class="bg-dark text-ligh table-bordered text-center">
                                        <tr>
                                            
                                            <th>اسم الموظف</th>

                                            <th>قيمة السلفية</th>
                                            <th>تاريخ الطلب</th>
                                            <th>حاله الطلب</th>



                                        </tr>
                                    </thead>
                                    <!--Table head-->

                                    <!--Table body-->
                                    <tbody class=" text-center">
                                        <?php
                                        $i = 0;
                                        $show_advance_salary = mysqli_query($conn, "SELECT * FROM `advance_salary`");
                                        while ($r = mysqli_fetch_array($show_advance_salary)) {
                                            $i++;
                                            $emp_id = $r['employee_id'];
                                            $query = "SELECT * FROM users WHERE id=$emp_id";
                                            $res = $conn->query($query);
                                            $full_name = $res->fetch_assoc();
                                        ?>
                                            <tr>
                                                
                                                <td class="border-1"><?= $full_name['full_name'] ?></td>
                                                <td class="border-1"><?= $r['amount'] ?></td>
                                                <td class="border-1"><?= $r['created_at'] ?></td>

                                                <td class="border-1">
                                                    <?php if ($r['status'] == 'Approved') {
                                                        echo '<span class="badge badge-sm bg-gradient-success">Approved</span>';
                                                    } elseif ($r['status'] == 'Pending') {
                                                        echo '<span class="badge badge-sm bg-gradient-warning">Pending</span>';
                                                    } else {
                                                        echo '<span class="badge badge-sm bg-gradient-danger">Declined</span>';
                                                    } ?>

                                                    

                                                </td>

                                            </tr>

                                        <?php } ?>
                                    </tbody>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--Table -->

        </div>
        <?php } ?>


    </main>




    <!--   Core JS Files   -->
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
    <script>
        $(document).ready(function() {
            $('#example').dataTable();
        });
    </script>
    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="../assets/js/soft-ui-dashboard.min.js?v=1.0.3"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // Function to fetch notifications from the server
        function fetchNotifications() {
            // Make an AJAX request to the server to fetch notifications
            $.ajax({
                url: 'scripts/notifications/fetch_notification.php', // Replace with the actual URL
                method: 'GET',
                dataType: 'json',
                success: function(data) {
                    // Process the notifications data and update the notification UI
                    updateNotificationUI(data);

                },
                error: function(error) {
                    console.error('Error fetching notifications:', error);
                },
            });
        }

        // Function to update the notification UI with new data
        function updateNotificationUI(data) {
            $('#notifications-container').empty();
            let unreadCount = 0;
            console.log(data);
            // Clear the existing notifications
            $('#notifications-container').empty();

            // Loop through the received notifications and add them to the UI
            data.forEach(function(notification) {
                const notificationItem = $('<li>').addClass('mb-2');
                const notificationLink = $('<a>').addClass('dropdown-item border-radius-md').attr('href', 'javascript:;');
                notificationLink.html('<h6>' + notification.title + '</h6><p>' + notification.message + '</p>');
                if (notification.read_at !== null) {
                    notificationLink.addClass('read-notification');
                } else {
                    unreadCount++;
                }
                const markAsReadButton = $('<button>').text('Mark as Read').addClass('btn btn-sm btn-primary');
                markAsReadButton.on('click', function() {
                    markNotificationAsRead(notification.id); // Mark notification as read when clicked
                });

                notificationItem.append(notificationLink);
                notificationItem.append(markAsReadButton);
                $('#notifications-container').append(notificationItem);

                console.log(notification);
            });
            $('#notification-count').text(unreadCount); // Update the notification count
        }

        function markNotificationAsRead(notificationId) {
            $.ajax({
                url: 'scripts/notifications/mark_notification_as_read.php', // Replace with the actual URL
                method: 'POST',
                data: {
                    notification_id: notificationId
                },
                dataType: 'json',
                success: function(response) {
                    // Handle the response (e.g., display a success message)
                    console.log(response.message);



                    // Refresh the notifications to reflect the updated status
                    fetchNotifications();
                },
                error: function(error) {
                    console.error('Error marking notification as read:', error);
                },
            });
        }

        // Fetch notifications initially
        fetchNotifications();

        // Poll for new notifications every 5 minutes (adjust the interval as needed)
        setInterval(fetchNotifications, 10000); // 5 minutes = 300,000 milliseconds
    </script>
    <script src="darkmode.js"></script>
</body>

</html>