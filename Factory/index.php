<?php
include('../cookies/session2.php');
$_SESSION['sidebar'] = "Factory";

$projects = mysqli_query($conn, "SELECT * FROM projects WHERE status = 'قيد التنفيذ'");



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

<body class="g-sidenav-show rtl ">

    <!-- Side Bar -->
    <?php require_once('../components/sidebar.php'); ?>
    <!-- End Of side Bar -->
    <main class="main-content position-relative lg:max-height-vh-100 lg:h-100 mt-1 border-radius-lg overflow-hidden">
        <!-- Navbar -->
        <?php
        $titleNav = 'المصنع';
        require_once('../components/navbar.php');
        ?>
        <!-- End Navbar -->

        <div class="container-fluid py-4">
            <div class="block-header bg-gradient-dark  col-md-3 col-sm-6 col-xs-6  rounded-pill">

                <?php require_once('../components/notification.php'); ?>
            </div>
            <div class="col-12 mt-4">
                <div class=" mb-4 p-3">
                    <div class="">
                        <h5 class="mb-1">المصنع</h5>
                    </div>




                    <div class="card-body p-3  ">


                        <div class="row">

                            <!-- Card -->

                            <?php
                            while ($r = mysqli_fetch_array($projects)) {

                                echo '<div class="col-xs-12 col-sm-6 col-md-4 pt-2">
                                <div class="card  h-100 shadow-lg">

                         
                                     <div class="view overlay">
                                        <img class="inside-card card-img-top" src="../Projects/Images/' . $r['name'] . '/' . $r['image'] . '" alt="Card image cap">
                               
                                    <div class=" rgba-white-slight"></div>
                                
                                 </div>

                           
                            <div class="card-body">

                                <p class="text-gradient text-dark mb-2 text-sm">المشروع رقم ' . $r["id"] . '</p>

                                <h4 class="card-title"> ' . $r["name"] . '</h4>
                                
                                <p class="card-text">' . $r["description"] . '</p>
                                
                               

                            </div>
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                            <div class="text-center">
                            <a href="view-factory.php?id=' . $r["id"] . '"> 
                            <div class="d-flex align-items-center justify-content-between">
                                <button  type="button" class="btn btn-outline-primary  btn-sm mb-0">عرض التفاصيل</button>
                            </div>
                         </a>
                             </div>
                         </div>
                            </div>
                            </div>';
                            }
                            ?>




                            <!-- <div class="col-xl-3 col-md-6 mb-xl-0 mb-4  ">
                            <div class="card card-blog card-plain py-3">
                                <div class="position-relative">
                                <a class="d-block shadow-xl border-radius-xl">
                                    <img src="../Projects/Images/' . $r['name'] . '/' . $r['image'] . '" alt="img-blur-shadow" class="img-fluid shadow border-radius-xl inside-card">
                                </a>
                                </div>
                                <div class="card-body px-1 pb-0">
                                
                                <a href="">
                                    <h5>
                                    ' . $r["name"] . '
                                    </h5>
                                </a>
                                <p class="mb-4 text-sm">
                                
                                </p>
                                
                                
                                
                                
                                </div>
                            </div>
                            </div> -->
                        </div>
                    </div>
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

    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="../assets/js/soft-ui-dashboard.min.js?v=1.0.3"></script>
    <script src="../Admin/darkmode.js"></script>
</body>

</html>