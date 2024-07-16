<?php
include('../cookies/session2.php');
$_SESSION['sidebar'] = "Projects";

$projects = mysqli_query($conn, "SELECT * FROM projects");



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

<body class="g-sidenav-show rtl ">

  <!-- Side Bar -->
  <?php require_once('../components/sidebar.php'); ?>
  <!-- End Of side Bar -->
  <main class="main-content position-relative lg:max-height-vh-100 lg:h-100 mt-1 border-radius-lg overflow-hidden">
    <!-- Navbar -->
    <?php 
     $titleNav = 'المشاريع';
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
            <h5 class="mb-1">المشاريع</h5>
          </div>

          <a href="add-projects.php" class="btn bg-gradient-dark mb-0 col-md-2 col-sm-6 col-xs-6">أضافة مشروع جديد&nbsp;&nbsp;
            <i class="fas fa-plus">
            </i>
          </a>


          <div class="card-body p-3  ">
            <div class="row">



              <?php
              while ($r = mysqli_fetch_array($projects)) {
                $endDate = strtotime($r['duration']);  // Convert the duration to a timestamp
                $currentDate = time();               // Get the current timestamp
                $timeDiff = $endDate - $currentDate; // Calculate the time differenc

              ?>

               



                <div class=" col-xs-12 col-sm-6 col-md-4 pt-2">


                  <div class="card h-100 shadow-lg  ">


                    <div class="view overlay">
                      
                      
                        <?php
                        // التحقق من وجود صورة
                        $imagePath = '../Projects/Images/' . $r['name'] . '/' . $r['image'];
                        if (file_exists($imagePath)) {
                            // إذا وجدت الصورة، عرضها
                            echo '<img class="inside-card card-img-top" src="' . $imagePath . '" alt="Card image cap">';
                        } else {
                            // إذا لم تجد الصورة، يمكنك عرض صورة افتراضية أو رسالة خطأ أو أي شيء آخر
                            echo '<img class="inside-card card-img-top" src="https://app.ruknamial.com/assets/img/logos/3ff.png" alt="Default Image">';
                        }
                        ?>
                      <?php

                      $durationInDays = ceil($timeDiff / (24 * 60 * 60)); // Calculate the number of days left
                      $color = 'style="background:linear-gradient(310deg, #f71717 0%, #78735f 100%)"';
                      if ($durationInDays == 1) {
                        $ribbonText = "غدًا";
                      } else if ($durationInDays == 2) {
                        $ribbonText = "في يومين";
                      } else {
                        $ribbonText = "في " . $durationInDays . " أيام";
                      }
                      ?>

                      <span class="ribbon-pop" <?php if ($timeDiff > 0 && $timeDiff <= 3 * 24 * 60 * 60) {
                                                  echo $color;
                                                } ?> dir="ltr">ينتهي <?= $ribbonText ?></span>

                      <div class=" rgba-white-slight"></div>

                    </div>


                    <div class="card-body">

                      <p class="text-gradient text-dark mb-2 text-sm">المشروع رقم <?= $r["id"] ?></p>

                      <h4 class="card-title"> <?= $r["name"] ?> </h4>

                      <p class="card-text"><?= $r["description"] ?></p>



                    </div>
                    <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                      <div class="text-center">
                        <a href="view-projects.php?id=<?= $r["id"] ?>">
                          <div class="d-flex align-items-center justify-content-between">
                            <button type="button" class="btn btn-outline-primary  btn-sm mb-0">عرض التفاصيل</button>
                          </div>
                        </a>
                      </div>
                    </div>

                  </div>

                </div>
              <?php
              }
              ?>

            </div>
          </div>
        </div>
      </div>
      <?php require_once('../components/footer.php'); ?>
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