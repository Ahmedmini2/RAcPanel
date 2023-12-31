<?php
include('../cookies/session2.php');
$_SESSION['sidebar'] = "WebManagment";
if (!empty($_GET['edit'])) {

    $id = $_GET['edit'];
    $query = "SELECT * FROM cost_center WHERE id=$id";
    $res = $conn->query($query);
    $editData = $res->fetch_assoc();
    $type = $editData['type'];
    $description = $editData['description'];
    $price = $editData['price'];
    $c_date = $editData['c_date'];

    if (isset($_POST['submit'])) {

        $type = $_POST['type'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $c_date = $_POST['c_date'];

        $target_dir = "../Signed-Docs/Cost-Bills/" . $id . "/";
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        } else {
        }
        $target_file = $target_dir . basename($_FILES["bill"]["name"]);
        $filename = basename($_FILES["bill"]["name"]);
        $uploadOk = 1;
        move_uploaded_file($_FILES["bill"]["tmp_name"], $target_file);

        $update = "UPDATE `cost_center` SET `type` = '$type', `description` = '$description', `price` = '$price' , `image` = '$filename' , `cost_date` = '$c_date' WHERE `id` = $id";
        $updateResult = $conn->query($update);
        if ($updateResult) {

            $_SESSION['notification'] = "تم تعديل التكلفة بنجاح";
            header('location: cost.php');
            exit();
        } else {
            $_SESSION['notification'] = "يوجد خلل في النظام";
            header('location: cost.php');
            exit();
        }
    }
} else if (isset($_POST['submit'])) {

    $type = $_POST['type'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $c_date = $_POST['c_date'];


    $filename = basename($_FILES["bill"]["name"]);
    $uploadOk = 1;


    $insert = "INSERT INTO cost_center (`id`, `type`, `description`, `price` , `image` , `cost_date` , `created_at`) VALUES (NULL, '$type', '$description', '$price','$filename','$c_date', NOW())";
    $insertResult = $conn->query($insert);
    if ($insertResult) {
        $id = $conn->insert_id;
        $target_dir = "../Signed-Docs/Cost-Bills/" . $id . "/";
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        } else {
        }
        $target_file = $target_dir . basename($_FILES["bill"]["name"]);
        move_uploaded_file($_FILES["bill"]["tmp_name"], $target_file);

        $_SESSION['notification'] = "تم اضافة التكلفة بنجاح";
        header('location: cost.php');
        exit();
    } else {
        $_SESSION['notification'] = "يوجد خلل في النظام";
        header('location: cost.php');
        exit();
    }
} else {
    $type = "";
    $description = "";
    $price = "";
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
        أضافة مدونة
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
        <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
            <div class="container-fluid py-1 px-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 ">
                        <li class="breadcrumb-item text-sm ps-2"><a class="opacity-5 text-dark" href="javascript:;">أضافة مدونة</a></li>

                    </ol>

                </nav>
                <div class="collapse navbar-collapse mt-sm-0 mt-2 px-0" id="navbar">

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
                <div class="block block-themed">
                    <div class="block-header bg-warning col-md-3 col-sm-6 col-xs-6 rounded">
                        <?php require_once('../components/notification.php'); ?>
                    </div>
                    <div class="block-header bg-gradient-dark col-md-2 col-sm-6 col-xs-6  rounded-pill">
                        <h6 class="block-title text-white py-2 px-4 ">إضافة مدونة جديد</h6>
                    </div>
                    <form id="<?php echo $idAttr; ?>" action="" method="post" enctype="multipart/form-data">
                        
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>عنوان المدونة</label>
                                    <input type="text" placeholder="الرجاء كتابة عنوان المدونة" class="form-control" name="name" value="">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>شرح مختصر للمدونة</label>
                                    <input type="text" placeholder=" الرجاءكتابة شرح مختصر عن المدونة " class="form-control" name="describe" value="">
                                </div>
                            </div>
                        </div>
                        <div class="row">

                            <div class="col">
                                <div class="form-group">
                                    <label>نص المقالة</label>
                                    <textarea placeholder="نص المقالة" class="form-control" name="description"></textarea>
                                </div>
                            </div>

                            

                            <div class="col">
                                <div class="form-group">
                                    <label>صورة المدونة 1</label>
                                    <input type="file" placeholder="" class="form-control" name="bill" value="">
                                </div>
                                
                            </div>
                        </div>
                        <div class="row">

                            <div class="col">
                            <div class="form-group">
                                    <label>صورة المدونة 2</label>
                                    <input type="file" placeholder="" class="form-control" name="bill" value="">
                                </div>
                                <div class="form-group">
                                    <label>صورة المدونة 3</label>
                                    <input type="file" placeholder="" class="form-control" name="bill" value="">
                                </div>
                            </div>

                        </div>




                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <button type="submit" name="submit" class="btn btn-secondary">اضافه المدونة</button>
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