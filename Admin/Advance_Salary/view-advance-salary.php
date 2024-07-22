<?php
include('../../cookies/session3.php');
$_SESSION['sidebar_admin'] = "Advance_Salary";
$select = mysqli_query($conn, "select * from advance_salary");
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
    <link rel="apple-touch-icon" sizes="76x76" href="../../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../../assets/img/favicon.png">
    <title>
       سكايب  | Skype Contracting
    </title>
    <!--     Fonts and icons     -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600;700&display=swap" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link href="../../assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="../../assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="../../assets/css/nucleo-svg.css" rel="stylesheet" />
    <link href="../../assets/css/custom.css" rel="stylesheet" />

    <!-- CSS Files -->
    <link id="pagestyle" href="../../assets/css/soft-ui-dashboard.css?v=1.0.3" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js" defer></script>
    <link href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" rel="stylesheet" />
</head>


<body class="g-sidenav-show rtl .bg-gray-100 ">



    <!-- Side Bar -->
    <?php require_once('../../components/sidebar_admin.php'); ?>


    <!-- End Of side Bar -->
    <main class="main-content position-relative lg:max-height-vh-100 lg:h-100 mt-1 border-radius-lg overflow-hidden" style="-webkit-overflow-scrolling: touch;overflow-y: scroll;">
        <!-- Navbar -->
        <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
            <div class="container-fluid py-1 px-3">
                <nav aria-label="breadcrumb">

                    <h6 class="font-weight-bolder mb-0">جميع السلفيات</h6>
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



        <div class="container-fluid py-4">
            <div class=" mb-4 p-3">
                <div class="">
                    <h5 class="mb-1">بيانات جميع السلفيات</h5>
                </div>


            </div>

            <!--Table     -->
            <div class="row">
                <div class="col-12">
                    <div class=" mb-4 mt-3">

                        <div class="card-body px-0 pt-0 pb-2 mx-3">
                            <div class="table-responsive p-0">
                                <table class=" display table table-hover table-bordered table-fixed" id="example">

                                    <!--Table head-->
                                    <thead class="bg-dark text-light text-center">
                                        <tr>
                                            <th class=" border-1 text-center">الرقم</th>
                                            <th class=" border-1 text-center">اسم الموظف</th>
                                            <th class="  border-1 text-center">سلفيه الموظف</th>
                                            <th class="  border-1 text-center">المسدد</th>
                                            <th class="  border-1 text-center">المتبقي</th>
                                            <th class=" border-1 text-center">مستند الملف</th>
                                            <th class=" border-1 text-center">ACTION</th>
                                        </tr>
                                    </thead>
                                    <!--Table head-->
                                    <!--Table body-->
                                    <tbody class=" text-center">

                                        <?php
                                        $i = 0;
                                        while ($r = mysqli_fetch_array($select)) {
                                            $i++;
                                            $emp_id = $r['employee_id'];
                                            $query = "SELECT * FROM users WHERE id=$emp_id";
                                            $res = $conn->query($query);
                                            $editData = $res->fetch_assoc();
                                        ?>
                                            <tr>
                                                <th scope="row">RA-EMP-<?= $r['id'] ?></th>
                                                <td class="border-1"><?= $editData['full_name'] ?></td>
                                                <td class="border-1"><?= $r['amount'] ?></td>

                                                <td class="border-1"></td>
                                                <td class="border-1"></td>

                                                <td class="border-1">
                                                   
                                                    <?= $r['image'] ?>
                                                </td>
                                                <td class="border-1">
                                                    <a href="#"><i class="fa fa-eye" aria-hidden="true"></i></a>|
                                                    <a href="#"><i class="fa fa-pencil" aria-hidden="true"></i></a>
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
    <script src="../../assets/js/core/popper.min.js"></script>
    <script src="../../assets/js/core/bootstrap.min.js"></script>
    <script src="../../assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="../../assets/js/plugins/smooth-scrollbar.min.js"></script>
    <script src="../../assets/js/plugins/fullcalendar.min.js"></script>
    <script src="../../assets/js/plugins/chartjs.min.js"></script>

    <script src="../../assets/js/plugins/choices.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#example').dataTable();
        });
    </script>
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
    <script src="../../assets/js/soft-ui-dashboard.min.js?v=1.0.3"></script>
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
    <script src="../darkmode.js"></script>
</body>

</html>