<?php
include('../cookies/session2.php');
$_SESSION['sidebar'] = "Projects";


?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../assets/img/favicon.png">
    <title>
        المشاريع
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
                        <li class="breadcrumb-item text-sm ps-2"><a class="opacity-5 text-dark" href="javascript:;">المشاريع</a></li>

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
                                <i class="fa fa-cog fixed-plugin-button-nav cursor-pointer"></i>
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
        <div class="row">


            <div class="container-fluid py-4">
                <div class="block-header bg-gradient-dark  col-md-3 col-sm-6 col-xs-6  rounded-pill">

                    <?php require_once('../components/notification.php'); ?>
                </div>
                <!--********* -->
                <div class="col-12 mt-4">
                    <div class="card mb-4 p-3">
                        <div class="card-header">
                            <h3 class="mb-1">عرض مشروع</h3>
                        </div>
                        <!-- Card Header  -->

                        <div class="row ">
                            <div class="text-right col-lg-10 col-sm-6">
                                <button type="button" id="btn2" class="btn bg-gradient-dark rounded-pill ">
                                    طباعة امر الشراء
                                </button>

                                <button type="button" id="btn3" class=" btn bg-gradient-dark rounded-pill ">
                                    تعديل بيانات المشروع
                                </button>
                            </div>
                            <div class="text-left col-lg-2 col-sm-6">
                                <button type="button" id="btn1" class=" btn bg-gradient-dark rounded-pill" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    تغير حالة المشروع
                                </button>
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

                                            <dt>اسم المشروع :</dt>
                                            <dd>ركن اميال للمقاولات</dd>

                                            <dt>تفاصيل المشروع:</dt>
                                            <dd> ركن اميال للمقاولات</dd>

                                            <dt>مدة الموافقة على المشروع:</dt>
                                            <dd> 2 ايام</dd>

                                            <dt>مدة تنفيذ المشروع:</dt>
                                            <dd> 7 ايام </dd>

                                            <dt>طريقة الدفع :</dt>
                                            <dd>شيكك</dd>

                                        </dl>

                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="card ">
                                            <div class="card-header mx-4 p-3 text-center">
                                                <div class="icon icon-shape icon-lg bg-gradient-primary shadow text-center border-radius-lg">
                                                    <i class="fas fa-landmark opacity-10"></i>
                                                </div>
                                            </div>
                                            <div class="card-body pt-0 p-3 text-center">
                                                <h6 class="text-center mb-0">تكلفة المشروع</h6>
                                                <span class="text-xs">ركن اميال</span>
                                                <hr class="horizontal dark my-3">
                                                <h5 class="mb-0">+$2000</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mt-md-0 mt-4">
                                        <div class="card ">
                                            <div class="card-header mx-4 p-3 text-center">
                                                <div class="icon icon-shape icon-lg bg-gradient-primary shadow text-center border-radius-lg">
                                                    <i class="fas fa-landmark opacity-10"></i>
                                                </div>
                                            </div>
                                            <div class="card-body pt-0 p-3 text-center">
                                                <h6 class="text-center mb-0">صافي الربح</h6>
                                                <span class="text-xs">ركن اميال</span>
                                                <hr class="horizontal dark my-3">
                                                <h5 class="mb-0">+$2000</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mt-md-0 mt-4">
                                        <div class="card ">
                                            <div class="card-header mx-4 p-3 text-center">
                                                <div class="icon icon-shape icon-lg bg-gradient-primary shadow text-center border-radius-lg">
                                                    <i class="fas fa-landmark opacity-10"></i>
                                                </div>
                                            </div>
                                            <div class="card-body pt-0 p-3 text-center">
                                                <h6 class="text-center mb-0">حاله المشروع</h6>

                                                <td class="align-middle">
                                                    <div class="progress-wrapper w-75 mx-auto">
                                                        <div class="progress-info">
                                                            <div class="progress-percentage">
                                                                <span class="text-xs font-weight-bold">60%</span>
                                                            </div>
                                                        </div>
                                                        <div class="progress">
                                                            <div class="progress-bar bg-gradient-info w-60" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <hr class="horizontal dark my-3">
                                                <h5 class="mb-0">قيد التنفيد</h5>
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
                                        <h6>الاصناف</h6>
                                    </div>
                                    <div class="card-body px-0 pt-0 pb-2 mx-3">
                                        <div class="table-responsive p-0">
                                            <table class="table table-hover table-fixed">

                                                <!--Table head-->
                                                <thead class="bg-dark text-light">
                                                    <tr>
                                                        <th>الرقم</th>
                                                        <th>الاسم</th>
                                                        <th>الابعاد</th>
                                                        <th>التوصيل</th>
                                                        <th>التكلفة</th>
                                                        <th>صافي الربح</th>
                                                        <th>الكمية</th>
                                                        <th>تم الانتاج</th>
                                                    </tr>
                                                </thead>
                                                <!--Table head-->

                                                <!--Table body-->
                                                <tbody>
                                                    <tr>
                                                        <th scope="row">1</th>
                                                        <td>خرسانه</td>
                                                        <td>6*6</td>
                                                        <td>200</td>
                                                        <td>3460</td>
                                                        <td>6000</td>
                                                        <td>12</td>
                                                        <td>اليوم</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">2</th>
                                                        <td>خرسانه</td>
                                                        <td>4*4</td>
                                                        <td>800</td>
                                                        <td>4675</td>
                                                        <td>8000</td>
                                                        <td>5</td>
                                                        <td>اليوم</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">3</th>
                                                        <td>Gary</td>
                                                        <td>Winogrand</td>
                                                        <td>Germany</td>
                                                        <td>Berlin</td>
                                                        <td>Photographer</td>
                                                        <td>37</td>
                                                        <td>41</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">4</th>
                                                        <td>Angie</td>
                                                        <td>Smith</td>
                                                        <td>USA</td>
                                                        <td>San Francisco</td>
                                                        <td>Teacher</td>
                                                        <td>52</td>
                                                        <td>41</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">5</th>
                                                        <td>John</td>
                                                        <td>Mattis</td>
                                                        <td>France</td>
                                                        <td>Paris</td>
                                                        <td>Actor</td>
                                                        <td>28</td>
                                                        <td>41</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">6</th>
                                                        <td>Otto</td>
                                                        <td>Morris</td>
                                                        <td>Germany</td>
                                                        <td>Munich</td>
                                                        <td>Singer</td>
                                                        <td>35</td>
                                                        <td>41</td>
                                                    </tr>
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
                            <div class="col-lg-8 mt-4">
                                <div class="card">
                                    <div class="card-header pb-0 px-3">
                                        <h6 class="mb-0 text-lg">البنود</h6>
                                    </div>
                                    <div class="card-body pt-4 p-3">
                                        <ul class="list-group">
                                            <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                                                <div class="d-flex flex-column">
                                                    <h6 class="mb-3 text-lg">الصنف الاول </h6>
                                                    <span class="mb-2 text-lg">الحديد: <span class="text-dark font-weight-bold ms-sm-2">Viking Burrito</span></span>

                                                </div>

                                            </li>
                                            <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                                                <div class="d-flex flex-column">
                                                    <h6 class="mb-3 text-lg">الصنف التاني </h6>
                                                    <span class="mb-2 text-lg">الاغطية: <span class="text-dark font-weight-bold ms-sm-2">Viking Burrito</span></span>

                                                </div>

                                            </li>
                                            <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                                                <div class="d-flex flex-column">
                                                    <h6 class="mb-3 text-lg">الصنف الثالث </h6>
                                                    <span class="mb-2 text-lg">الاكسسوارات: <span class="text-dark font-weight-bold ms-sm-2">Viking Burrito</span></span>

                                                </div>

                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4  mt-4">
                                <div class="card h-100">
                                    <div class="card-header pb-0 p-3">
                                        <div class="row">
                                            <div class="col-6 d-flex align-items-center">
                                                <h6 class="mb-0 text-lg">الفواتير</h6>
                                            </div>
                                            <div class="col-6 text-end">
                                                <button class="btn btn-outline-primary btn-sm mb-0">View All</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body p-3 pb-0">
                                        <ul class="list-group">
                                            <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                                                <div class="d-flex flex-column">
                                                    <h6 class="mb-1 text-dark font-weight-bold text-sm">March, 01, 2020</h6>
                                                    <span class="text-xs">#MS-415646</span>
                                                </div>
                                                <div class="d-flex align-items-center text-sm">
                                                    $180
                                                    <button class="btn btn-link text-dark text-sm mb-0 px-0 ms-4"><i class="fas fa-file-pdf text-lg me-1"></i> PDF</button>
                                                </div>
                                            </li>
                                            <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                                                <div class="d-flex flex-column">
                                                    <h6 class="text-dark mb-1 font-weight-bold text-sm">February, 10, 2021</h6>
                                                    <span class="text-xs">#RV-126749</span>
                                                </div>
                                                <div class="d-flex align-items-center text-sm">
                                                    $250
                                                    <button class="btn btn-link text-dark text-sm mb-0 px-0 ms-4"><i class="fas fa-file-pdf text-lg me-1"></i> PDF</button>
                                                </div>
                                            </li>
                                            <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                                                <div class="d-flex flex-column">
                                                    <h6 class="text-dark mb-1 font-weight-bold text-sm">April, 05, 2020</h6>
                                                    <span class="text-xs">#FB-212562</span>
                                                </div>
                                                <div class="d-flex align-items-center text-sm">
                                                    $560
                                                    <button class="btn btn-link text-dark text-sm mb-0 px-0 ms-4"><i class="fas fa-file-pdf text-lg me-1"></i> PDF</button>
                                                </div>
                                            </li>
                                            <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                                                <div class="d-flex flex-column">
                                                    <h6 class="text-dark mb-1 font-weight-bold text-sm">June, 25, 2019</h6>
                                                    <span class="text-xs">#QW-103578</span>
                                                </div>
                                                <div class="d-flex align-items-center text-sm">
                                                    $120
                                                    <button class="btn btn-link text-dark text-sm mb-0 px-0 ms-4"><i class="fas fa-file-pdf text-lg me-1"></i> PDF</button>
                                                </div>
                                            </li>
                                            <li class="list-group-item border-0 d-flex justify-content-between ps-0 border-radius-lg">
                                                <div class="d-flex flex-column">
                                                    <h6 class="text-dark mb-1 font-weight-bold text-sm">March, 01, 2019</h6>
                                                    <span class="text-xs">#AR-803481</span>
                                                </div>
                                                <div class="d-flex align-items-center text-sm">
                                                    $300
                                                    <button class="btn btn-link text-dark text-sm mb-0 px-0 ms-4"><i class="fas fa-file-pdf text-lg me-1"></i> PDF</button>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>




                    </div>
                    <button type="button" id="btnD" class=" btn bg-gradient-dark rounded-pill col-md-2 col-sm-6 col-xs-6 mt-4 ">
                        حذف المشروع 
                    </button>
                </div>

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
        </div>

    </main>

    <!--   Core JS Files   -->
    <script src="../assets/js/core/popper.min.js"></script>
    <script src="../assets/js/core/bootstrap.min.js"></script>
    <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
    <script src="../assets/js/plugins/fullcalendar.min.js"></script>
    <script src="../assets/js/plugins/chartjs.min.js"></script>
    <script>
        var ctx = document.getElementById("chart-bars").getContext("2d");

        new Chart(ctx, {
            type: "bar",
            data: {
                labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                datasets: [{
                    label: "Sales",
                    tension: 0.4,
                    borderWidth: 0,
                    borderRadius: 4,
                    borderSkipped: false,
                    backgroundColor: "#fff",
                    data: [450, 200, 100, 220, 500, 100, 400, 230, 500],
                    maxBarThickness: 6
                }, ],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false,
                    }
                },
                interaction: {
                    intersect: false,
                    mode: 'index',
                },
                scales: {
                    y: {
                        grid: {
                            drawBorder: false,
                            display: false,
                            drawOnChartArea: false,
                            drawTicks: false,
                        },
                        ticks: {
                            suggestedMin: 0,
                            suggestedMax: 500,
                            beginAtZero: true,
                            padding: 15,
                            font: {
                                size: 14,
                                family: "Open Sans",
                                style: 'normal',
                                lineHeight: 2
                            },
                            color: "#fff"
                        },
                    },
                    x: {
                        grid: {
                            drawBorder: false,
                            display: false,
                            drawOnChartArea: false,
                            drawTicks: false
                        },
                        ticks: {
                            display: false
                        },
                    },
                },
            },
        });


        var ctx2 = document.getElementById("chart-line").getContext("2d");

        var gradientStroke1 = ctx2.createLinearGradient(0, 230, 0, 50);

        gradientStroke1.addColorStop(1, 'rgba(203,12,159,0.2)');
        gradientStroke1.addColorStop(0.2, 'rgba(72,72,176,0.0)');
        gradientStroke1.addColorStop(0, 'rgba(203,12,159,0)'); //purple colors

        var gradientStroke2 = ctx2.createLinearGradient(0, 230, 0, 50);

        gradientStroke2.addColorStop(1, 'rgba(20,23,39,0.2)');
        gradientStroke2.addColorStop(0.2, 'rgba(72,72,176,0.0)');
        gradientStroke2.addColorStop(0, 'rgba(20,23,39,0)'); //purple colors

        new Chart(ctx2, {
            type: "line",
            data: {
                labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                datasets: [{
                        label: "Mobile apps",
                        tension: 0.4,
                        borderWidth: 0,
                        pointRadius: 0,
                        borderColor: "#cb0c9f",
                        borderWidth: 3,
                        backgroundColor: gradientStroke1,
                        fill: true,
                        data: [50, 40, 300, 220, 500, 250, 400, 230, 500],
                        maxBarThickness: 6

                    },
                    {
                        label: "Websites",
                        tension: 0.4,
                        borderWidth: 0,
                        pointRadius: 0,
                        borderColor: "#3A416F",
                        borderWidth: 3,
                        backgroundColor: gradientStroke2,
                        fill: true,
                        data: [30, 90, 40, 140, 290, 290, 340, 230, 400],
                        maxBarThickness: 6
                    },
                ],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false,
                    }
                },
                interaction: {
                    intersect: false,
                    mode: 'index',
                },
                scales: {
                    y: {
                        grid: {
                            drawBorder: false,
                            display: true,
                            drawOnChartArea: true,
                            drawTicks: false,
                            borderDash: [5, 5]
                        },
                        ticks: {
                            display: true,
                            padding: 10,
                            color: '#b2b9bf',
                            font: {
                                size: 11,
                                family: "Open Sans",
                                style: 'normal',
                                lineHeight: 2
                            },
                        }
                    },
                    x: {
                        grid: {
                            drawBorder: false,
                            display: false,
                            drawOnChartArea: false,
                            drawTicks: false,
                            borderDash: [5, 5]
                        },
                        ticks: {
                            display: true,
                            color: '#b2b9bf',
                            padding: 20,
                            font: {
                                size: 11,
                                family: "Open Sans",
                                style: 'normal',
                                lineHeight: 2
                            },
                        }
                    },
                },
            },
        });
    </script>
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
</body>

</html>