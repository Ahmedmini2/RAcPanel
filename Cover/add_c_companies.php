<?php
include('../cookies/session2.php');
$_SESSION['sidebar'] = "Cover";
if (!empty($_GET['edit'])) {

    $id = $_GET['edit'];
    $query = "SELECT * FROM contact_covers WHERE id=$id";
    $res = $conn->query($query);
    $editData = $res->fetch_assoc();
    $name = $editData['name'];
    $seller = $editData['seller'];
    $phone = $editData['phone'];
    $email = $editData['email'];
    $address = $editData['address'];



    if (isset($_POST['submit'])) {

        $name = $_POST['name'];
        $seller = $_POST['seller'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $address = $_POST['address'];



        $update = "UPDATE `contact_covers` SET `name` = '$name', `seller` = '$seller', `address` = '$address', `phone` = '$phone', `email` = '$email' WHERE `contact_covers`.`id` = $id";
        $updateResult = $conn->query($update);
        if ($updateResult) {

            $_SESSION['notification'] = "تم تعديل الشركة بنجاح";
            header('location: covering_companies.php');
            exit();
        } else {
            $_SESSION['notification'] = "يوجد خلل في النظام";
            header('location: covering_companies.php');
            exit();
        }
    }
} else if (isset($_POST['submit'])) {

    $name = $_POST['name'];
    $seller = $_POST['seller'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $address = $_POST['address'];



    $insert = "INSERT INTO `contact_covers` (`id`, `name`, `seller`, `address`, `phone`, `email`, `created_at`)
   VALUES (NULL, '$name', '$seller', '$address', '$phone', '$email', NOW())";
    $insertResult = $conn->query($insert);
    if ($insertResult) {

        $_SESSION['notification'] = "تم اضافة الشركة بنجاح";
        header('location: covering_companies.php');
        exit();
    } else {
        $_SESSION['notification'] = "يوجد خلل في النظام";
        header('location: covering_companies.php');
        exit();
    }
} else {
    $name = "";
    $seller = "";
    $address = "";
    $email = "";
    $phone = "";
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
        اضافة شركة جديد
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
     $titleNav = 'شراء اغطية'; 
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
                        <h6 class="block-title text-white py-2 px-4 ">اضافة شركة جديد</h6>
                    </div>
                    <form id="<?php echo $idAttr; ?>" action="" method="post">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>اسم الشركة</label>
                                    <input type="text" placeholder="ادخل اسم الشركة" class="form-control" name="name" value="<?php echo $name; ?>">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>اسم البائع</label>
                                    <input type="text" placeholder="ادخل اسم البائع" class="form-control" name="seller" value="<?php echo $seller; ?>">
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>رقم الهاتف</label>
                                    <input type="text" placeholder="ادخل رقم الهاتف" class="form-control" name="phone" value="<?php echo $phone; ?>">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>البريد الالكتروني</label>
                                    <input type="text" placeholder="ادخل البريد الالكتروني" class="form-control" name="email" value="<?php echo $email; ?>">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>العنوان</label>
                                    <input type="text" placeholder="ادخل عنوان البائع" class="form-control" name="address" value="<?php echo $address; ?>">
                                </div>
                            </div>
                        </div>


           

                       
                        <div class="row">

                            <div class="col">
                                <div class="form-group">
                                    <button type="submit" name="submit" class="btn btn-secondary">اضافة شركة</button>
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
    <!--<div class="fixed-plugin">
    <a class="fixed-plugin-button text-dark position-fixed px-3 py-2">
      <i class="fa fa-cog py-2"> </i>
    </a>
    <div class="card shadow-lg ">
      <div class="card-header pb-0 pt-3 ">
        <div class="float-end">
          <h5 class="mt-3 mb-0">Soft UI Configurator</h5>
          <p>See our dashboard options.</p>
        </div>
        <div class="float-start mt-4">
          <button class="btn btn-link text-dark p-0 fixed-plugin-close-button">
            <i class="fa fa-close"></i>
          </button>
        </div>
         End Toggle Button 
      </div>
      <hr class="horizontal dark my-1">
      <div class="card-body pt-sm-3 pt-0">
         Sidebar Backgrounds
        <div>
          <h6 class="mb-0">Sidebar Colors</h6>
        </div>
        <a href="javascript:void(0)" class="switch-trigger background-color">
          <div class="badge-colors my-2 text-end">
            <span class="badge filter bg-gradient-primary active" data-color="primary" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-dark" data-color="dark" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-info" data-color="info" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-success" data-color="success" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-warning" data-color="warning" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-danger" data-color="danger" onclick="sidebarColor(this)"></span>
          </div>
        </a>
        Sidenav Type
        <div class="mt-3">
          <h6 class="mb-0">Sidenav Type</h6>
          <p class="text-sm">Choose between 2 different sidenav types.</p>
        </div>
        <div class="d-flex">
          <button class="btn bg-gradient-primary w-100 px-3 mb-2 active" data-class="bg-transparent" onclick="sidebarType(this)">Transparent</button>
          <button class="btn bg-gradient-primary w-100 px-3 mb-2 me-2" data-class="bg-white" onclick="sidebarType(this)">White</button>
        </div>
        <p class="text-sm d-xl-none d-block mt-2">You can change the sidenav type just on desktop view.</p>
        Navbar Fixed
        <div class="mt-3">
          <h6 class="mb-0">Navbar Fixed</h6>
        </div>
        <div class="form-check form-switch ps-0">
          <input class="form-check-input mt-1 float-end me-auto" type="checkbox" id="navbarFixed" onclick="navbarFixed(this)">
        </div>
        <hr class="horizontal dark my-sm-4">
        <a class="btn bg-gradient-dark w-100" href="https://www.creative-tim.com/product/soft-ui-dashboard-pro">Free Download</a>
        <a class="btn btn-outline-dark w-100" href="https://www.creative-tim.com/learning-lab/bootstrap/license/soft-ui-dashboard">View documentation</a>
        <div class="w-100 text-center">
          <a class="github-button" href="https://github.com/creativetimofficial/soft-ui-dashboard" data-icon="octicon-star" data-size="large" data-show-count="true" aria-label="Star creativetimofficial/soft-ui-dashboard on GitHub">Star</a>
          <h6 class="mt-3">Thank you for sharing!</h6>
          <a href="https://twitter.com/intent/tweet?text=Check%20Soft%20UI%20Dashboard%20made%20by%20%40CreativeTim%20%23webdesign%20%23dashboard%20%23bootstrap5&amp;url=https%3A%2F%2Fwww.creative-tim.com%2Fproduct%2Fsoft-ui-dashboard" class="btn btn-dark mb-0 me-2" target="_blank">
            <i class="fab fa-twitter me-1" aria-hidden="true"></i> Tweet
          </a>
          <a href="https://www.facebook.com/sharer/sharer.php?u=https://www.creative-tim.com/product/soft-ui-dashboard" class="btn btn-dark mb-0 me-2" target="_blank">
            <i class="fab fa-facebook-square me-1" aria-hidden="true"></i> Share
          </a>
        </div>
      </div>
    </div>
  </div>
   Core JS Files   -->
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