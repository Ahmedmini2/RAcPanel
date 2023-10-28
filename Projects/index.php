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
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 ">
            <li class="breadcrumb-item text-sm ps-2"><a class="opacity-5 text-dark" href="javascript:;">المشاريع</a></li>

          </ol>

        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 px-0" id="navbar">
          
          <ul class="navbar-nav me-auto ms-0 justify-content-end">
          <li class="nav-item px-3 d-flex align-items-center">
                    <label class="ui-switch">
                        <input type="checkbox" onclick="setDarkMode()">
                        <div class="slider">
                            <div class="circle"></div>
                        </div>
                    </label>
                    </li>
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

        <i class="bi bi-arrow-left"></i>


      </div>
    </nav>
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

                  <!-- New Card-->
                  <article class="card__article swiper-slide col-xs-12 col-sm-6 col-md-4 pt-2">
                     <div class="card__image">
                        <img src="../Projects/Images/<?= $r['name'] ?>/<?= $r['image'] ?>" alt="Card image cap" class="card__img">
                        <div class="card__shadow"></div>
                     </div>
      
                     <div class="card__data">
                       <p class="text-gradient text-dark mb-2 text-sm">المشروع رقم <?= $r["id"] ?></p>
                        <h3 class="card__name"><?= $r["name"] ?></h3>
                        <p class="card__description">
                         <?= $r["description"] ?>
                        </p>
      
                        <a href="#" class="card__button">View More</a>
                     </div>
                  </article>
                  <!-- New Card-->

                

                <div class=" col-xs-12 col-sm-6 col-md-4 pt-2">
                  

                  <div class="card h-100 shadow-lg  ">


                    <div class="view overlay">
                      <img class="inside-card card-img-top" src="../Projects/Images/<?= $r['name'] ?>/<?= $r['image'] ?>" alt="Card image cap">
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
                     
                        <span class="ribbon-pop"  <?php  if ($timeDiff > 0 && $timeDiff <= 3 * 24 * 60 * 60) { echo $color ;}?> dir="ltr">ينتهي <?= $ribbonText ?></span>
                      
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
      <footer class="footer pt-3  ">
        <div class="container-fluid">
          <div class="row align-items-center justify-content-lg-between">
            <div class="col-lg-6 mb-lg-0 mb-4">
              <div class="copyright text-center text-sm text-muted text-lg-end">
                © <script>
                  document.write(new Date().getFullYear())
                </script>,
                by
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