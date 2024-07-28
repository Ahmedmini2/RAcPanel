<?php
include('../cookies/session2.php');
$_SESSION['sidebar'] = "Factory";
if (isset($_GET['project_id'])) {
    $id = $_GET['project_id'];

    if(isset($_POST['submit'])) {
      
        $name = $_POST['name'];
        $bill_date = $_POST['bill_date'];
        $price = $_POST['price'];
        $added_by = $_POST['added_by'];
       
        $target_dir = "../Signed-Docs/Project-Bills/".$id."/";
        if(!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }else{

        }
        $target_file = $target_dir . basename($_FILES["bill_img"]["name"]);
        $filename = basename($_FILES["bill_img"]["name"]);
        $uploadOk = 1;
        move_uploaded_file($_FILES["bill_img"]["tmp_name"], $target_file);

        $insert_bill= "INSERT INTO `projects_bills` (`id`, `project_id`, `name`, `added_by`,`price`,`bill_date`,`bill_img`, `created_at`) 
        VALUES (NULL, '$id', '$name', '$added_by','$price','$bill_date','$filename', NOW())";
        $res = $conn->query($insert_bill);
        if ($res) {
            $_SESSION['notification'] = "تم اضافة الفاتورة بنجاح";
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
        فواتير المشروع
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

<body class="g-sidenav-show rtl darkmode">

    <!-- Side Bar -->
    <?php require_once('../components/sidebar.php'); ?>
    <!-- End Of side Bar -->

    <main class="main-content position-relative lg:max-height-vh-100 lg:h-100 mt-1 border-radius-lg overflow-hidden">
        <!-- Navbar -->
        <?php
        $titleNav = 'تقرير المشروع';
        require_once('../components/navbar.php');
        ?>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="row">
                <div class="block block-themed">
                    <div class="block-header bg-warning col-lg-3 col-md-4 col-sm-6 col-xs-6 rounded">
                        <?php require_once('../components/notification.php'); ?>
                    </div>
                    <div class="block-header bg-gradient-dark col-md-3 col-sm-6 col-xs-6  rounded-pill">
                        <h6 class="block-title text-center text-white py-2 px-4 ">رفع فاتورة</h6>
                    </div>
                    <form method="post" action="" enctype="multipart/form-data">

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label> اسم الفاتورة</label>
                                    <input type="text" placeholder="الرجاء كتابة اسم الفاتورة    " class="form-control" name="name" value="">

                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <div class="col-lg-8 col-sm-6">
                                        <label for="startDate">تاريخ الفاتورة</label>
                                        <input id="startDate" class="form-control" name="bill_date" type="date" />
                                        <script>
                                        let startDate = document.getElementById('startDate')


                                        startDate.addEventListener('change', (e) => {
                                            let startDateVal = e.target.value
                                            document.getElementById('startDateSelected').innerText = startDateVal
                                        })
                                    </script>
                                    </div>

                                </div>
                            </div>



                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label> مقدم الفاتورة </label>
                                    <input type="text" placeholder="الرجاء كتابة مقدم الفاتورة    " class="form-control" name="added_by" value="">

                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label> تكلفة الفاتورة </label>
                                    <input type="text" placeholder="الرجاء كتابة تكلفة الفاتورة    " class="form-control" name="price" value="">

                                </div>
                            </div>
                        </div>
                        <div class="row">

                            <div class="col">
                                <div class="form-group">
                                    <label for="formFileLg" class="form-label">صورة الفاتورة</label>
                                    <input class="form-control form-control-lg" id="bill_img" name="bill_img" type="file" />
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