<?php
include('cookies/session.php');
$_SESSION['sidebar'] = "Home";

$show_products_status = mysqli_query($conn, "SELECT * FROM `product_status`");
$projects = mysqli_query($conn, "SELECT * FROM projects LIMIT 3");

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
  <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="assets/img/favicon.png">
  <title>
    ركن أميال | Rukn Amial
  </title>
  <!--     Fonts and icons     -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600;700&display=swap" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link href="assets/css/nucleo-svg.css" rel="stylesheet" />
  <link href="assets/css/custom.css" rel="stylesheet" />

  <!-- CSS Files -->
  <link id="pagestyle" href="assets/css/soft-ui-dashboard.css?v=1.0.3" rel="stylesheet" />

</head>
<?php require_once('components/loader.php'); ?>

<body class="g-sidenav-show rtl bg-gray-100">



  <!-- Side Bar -->
  <?php require_once('components/sidebar.php'); ?>
  <!-- End Of side Bar -->
  <main class="main-content position-relative lg:max-height-vh-100 lg:h-100 mt-1 border-radius-lg overflow-hidden" style="-webkit-overflow-scrolling: touch;overflow-y: scroll;">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 ">
            <li class="breadcrumb-item text-sm ps-2"><a class="opacity-5 text-dark" href="javascript:;">لوحات القيادة</a></li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">الرئيسية</li>
          </ol>
          <h6 class="font-weight-bolder mb-0">الرئيسية</h6>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 px-0" id="navbar">
          <div class="ms-md-auto pe-md-3 d-flex align-items-center">
            <div class="input-group">
              <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
              <input type="text" class="form-control" placeholder="أكتب هنا...">
            </div>
          </div>
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
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-lg-3 col-sm-6 mb-lg-0 mb-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-capitalize font-weight-bold">أموال اليوم</p>
                    <h5 class="font-weight-bolder mb-0">
                      $53,000
                      <span class="text-success text-sm font-weight-bolder">+55%</span>
                    </h5>
                  </div>
                </div>
                <div class="col-4 text-start">
                  <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                    <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
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
                    <p class="text-sm mb-0 text-capitalize font-weight-bold">مستخدمو اليوم</p>
                    <h5 class="font-weight-bolder mb-0">
                      2,300
                      <span class="text-success text-sm font-weight-bolder">+33%</span>
                    </h5>
                  </div>
                </div>
                <div class="col-4 text-start">
                  <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                    <i class="ni ni-world text-lg opacity-10" aria-hidden="true"></i>
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
                    <p class="text-sm mb-0 text-capitalize font-weight-bold">عملاء جدد</p>
                    <h5 class="font-weight-bolder mb-0">
                      +3,462
                      <span class="text-danger text-sm font-weight-bolder">-2%</span>
                    </h5>
                  </div>
                </div>
                <div class="col-4 text-start">
                  <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                    <i class="ni ni-paper-diploma text-lg opacity-10" aria-hidden="true"></i>
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
                    <p class="text-sm mb-0 text-capitalize font-weight-bold">مبيعات</p>
                    <h5 class="font-weight-bolder mb-0">
                      $103,430
                      <span class="text-success text-sm font-weight-bolder">+5%</span>
                    </h5>
                  </div>
                </div>
                <div class="col-4 text-start">
                  <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                    <i class="ni ni-cart text-lg opacity-10" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-sm-6">
        <div class="card">
          <div class="card-header p-3 pb-0">
            <h6 class="mb-0">Upcoming events</h6>
            <p class="text-sm mb-0 text-capitalize font-weight-bold">Joined</p>
          </div>
          <div class="card-body border-radius-lg p-3">
            <div class="d-flex">
              <div>
                <div class="icon icon-shape bg-info-soft shadow text-center border-radius-md shadow-none">
                  <i class="ni ni-money-coins text-lg text-info text-gradient opacity-10" aria-hidden="true"></i>
                </div>
              </div>
              <div class="ms-3">
                <div class="numbers">
                  <h6 class="mb-1 text-dark text-sm">Cyber Week</h6>
                  <span class="text-sm">27 March 2020, at 12:30 PM</span>
                </div>
              </div>
            </div>
            <div class="d-flex mt-4">
              <div>
                <div class="icon icon-shape bg-primary-soft shadow text-center border-radius-md shadow-none">
                  <i class="ni ni-bell-55 text-lg text-primary text-gradient opacity-10" aria-hidden="true"></i>
                </div>
              </div>
              <div class="ms-3">
                <div class="numbers">
                  <h6 class="mb-1 text-dark text-sm">Meeting with Marry</h6>
                  <span class="text-sm">24 March 2020, at 10:00 PM</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-12 mt-4">
        <div class="card mb-4">
          <div class="card-header pb-0 p-3">
            <h6 class="mb-1">المشاريع</h6>
            <p class="text-sm">إدارة اخر المشاريع</p>
          </div>
          <div class=" p-3 ">
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
                                      <a href="Projects/view-projects.php?id=' . $r["id"] . '"> 
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

      <div class="row my-4">
        <div class="col-lg-8 col-md-6 mb-md-0 mb-4">
          <div class="card">
            <div class="card-header pb-0">
              <div class="row mb-3">
                <div class="col-6">
                  <h6>المشاريع</h6>
                  <p class="text-sm">
                    <i class="fa fa-check text-info" aria-hidden="true"></i>
                    <span class="font-weight-bold ms-1">30 انتهى</span> هذا الشهر
                  </p>
                </div>
                <div class="col-6 my-auto text-start">
                  <div class="dropdown float-start ps-4">
                    <a class="cursor-pointer" id="dropdownTable" data-bs-toggle="dropdown" aria-expanded="false">
                      <i class="fa fa-ellipsis-v text-secondary"></i>
                    </a>
                    <ul class="dropdown-menu px-2 py-3 me-n4" aria-labelledby="dropdownTable">
                      <li><a class="dropdown-item border-radius-md" href="javascript:;">عمل</a></li>
                      <li><a class="dropdown-item border-radius-md" href="javascript:;">عمل آخر</a></li>
                      <li><a class="dropdown-item border-radius-md" href="javascript:;">شيء آخر هنا</a></li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
            <div class="card-body p-0 pb-2">
              <div class="table-responsive">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">المشروع</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 text-center">قيمة المشروع</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">التكلفة</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">حالة المشروع</th>
                    </tr>
                  </thead>
                  <tbody class="text-center">
                    <?php
                    $show_projects = mysqli_query($conn, "SELECT * FROM `projects`");
                    while ($r = mysqli_fetch_array($show_projects)) {
                    ?>
                      <tr>
                        <td>
                          <div class="d-flex px-2 py-1">

                            <div class="d-flex flex-column justify-content-center">
                              <h6 class="mb-0 text-sm"><?= $r['name'] ?></h6>
                            </div>
                          </div>
                        </td>
                        <td class="align-middle text-center text-sm">
                          <span class="text-xs font-weight-bold"> <?= number_format($r['total_without_tax']) ?> </span>
                        </td>
                        <td class="align-middle text-center text-sm">
                          <span class="text-xs font-weight-bold"> <?= number_format($r['project_cost']) ?> </span>
                        </td>
                        <td class="align-middle">
                          <div class="progress-wrapper w-75 mx-auto">
                            <div class="progress-info">
                              <div class="progress-percentage">
                                <span class="text-xs font-weight-bold"><?= $r['status'] ?></span>
                              </div>
                            </div>
                            <div class="progress">
                              <div class="progress-bar bg-gradient-info w-60" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                          </div>
                        </td>
                      </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-6">
          <div class="card h-100">
            <div class="card-header pb-0">
              <h6>نظرة عامة على سير العمل</h6>
              <p class="text-sm">

                <span class="font-weight-bold"></span> في الأيام الماضية
              </p>
            </div>
            <div class="card-body p-3">
              <div class="timeline timeline-one-side">
                <?php
                while ($r = mysqli_fetch_array($show_products_status)) {
                  $product_id = $r['product_id'];
                  $query = "SELECT * FROM `products` WHERE `id`=$product_id";
                  $res = $conn->query($query);
                  $product = $res->fetch_assoc();

                  $project_id = $product['project_id'];
                  $query = "SELECT * FROM `projects` WHERE `id`=$project_id";
                  $res = $conn->query($query);
                  $project = $res->fetch_assoc();

                  $date = new DateTimeImmutable($r['created_at']);


                ?>
                  <div class="timeline-block mb-3">
                    <span class="timeline-step">
                      <i class="fa fa-bell text-success text-gradient"></i>
                    </span>
                    <div class="timeline-content">

                      <h6 class="text-dark text-sm font-weight-bold mb-0">في مشروع <?= $project['name'] ?> تم <?= $r['description'] ?> وحالته <?= $r['status'] ?></h6>
                      <p class="text-secondary font-weight-bold text-xs mt-1 mb-0"><?= $date->format('D jS \o\f F Y h:i:s A') ?></p>
                    </div>
                  </div>

                <?php } ?>
              </div>
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
  <script src="assets/js/core/popper.min.js"></script>
  <script src="assets/js/core/bootstrap.min.js"></script>
  <script src="assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script src="assets/js/plugins/fullcalendar.min.js"></script>
  <script src="assets/js/plugins/chartjs.min.js"></script>

  <script src="assets/js/plugins/choices.min.js"></script>
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
  <script src="assets/js/soft-ui-dashboard.min.js?v=1.0.3"></script>
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
</body>

</html>