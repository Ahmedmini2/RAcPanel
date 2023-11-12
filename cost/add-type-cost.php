<?php
include('../cookies/session2.php');
$_SESSION['sidebar'] = "cost";
if (!empty($_GET['edit'])) {

    $id = $_GET['edit'];
    $query = "SELECT * FROM cost_type WHERE id=$id";
    $res = $conn->query($query);
    $editData = $res->fetch_assoc();
    $name = $editData['name'];
    
  
    if(isset($_POST['submit'])){
  
      $name = $_POST['name'];
      
      $update = "UPDATE `cost_type` SET `name` = '$name' WHERE `id` = $id";
      $updateResult = $conn->query($update);
      if ($updateResult) {
  
        $_SESSION['notification'] = "تم تعديل نوع التكلفة بنجاح";
        header('location: type-cost.php');
        exit();
  
        } else {
        $_SESSION['notification'] = "يوجد خلل في النظام";
        header('location: type-cost.php');
        exit();
  
        }
    }
  
  } else if (isset($_POST['submit'])) {
  
    $name = $_POST['name'];
    
  
    $insert = "INSERT INTO cost_type (`id`, `name`, `created_at`) VALUES (NULL, '$name', NOW())";
    $insertResult = $conn->query($insert);
    if ($insertResult) {
  
        $_SESSION['notification'] = "تم اضافة نوع التكلفة بنجاح";
        header('location: type-cost.php');
        exit();
  
    } else {
      $_SESSION['notification'] = "يوجد خلل في النظام";
      header('location: type-cost.php');
      exit();
  
    }
  } else {
    $name = "";
    
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
        أضافة نوع تكلفة جديد
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
     $titleNav = 'أضافة نوع تكلفة جديد'; 
     require_once('../components/navbar.php');
     ?>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="row">
                <div class="block block-themed">

                    <div class="block-header bg-gradient-dark col-lg-3 col-md-2 col-sm-6 col-xs-6  rounded-pill">

                        <h5 class="block-title text-white py-2 px-4 ">إضافة نوع تكلفة جديد</h5>
                    </div>
                    <form id="<?php echo $idAttr; ?>" action="" method="post">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>نوع التكلفة</label>
                                    <input type="text" placeholder="الرجاء كتابة أسم نوع التكلفة" class="form-control" name="name" value="<?php echo $name; ?>">



                                </div>
                            </div>

                        </div>




                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <button type="submit" name="submit" class="btn btn-secondary rounded-pill">حفظ</button>
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