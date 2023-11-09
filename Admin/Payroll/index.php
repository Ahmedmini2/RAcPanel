<?php
include('../../cookies/session3.php');

$_SESSION['sidebar_admin'] = "payroll";
$select = mysqli_query($conn, "SELECT DISTINCT `month`,`year` FROM `payroll_process` ORDER by `year` DESC");
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
        ركن أميال | Rukn Amial
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
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
    <script src="//cdn.datatables.net/plug-ins/1.10.7/integration/bootstrap/3/dataTables.bootstrap.js"></script>
    <script>
        src = "table2excel.js"
    </script>
</head>
<style>
    @media print {
        body *:not(#contentPDF):not(#contentPDF *) {
            visibility: hidden;
        }

        #contentPDF {
            position: absolute;
            top: 0;
            left: 0;
        }
    }
</style>

<body class="g-sidenav-show rtl .bg-gray-100 ">



    <!-- Side Bar -->
    <?php require_once('../../components/sidebar_admin.php'); ?>


    <!-- End Of side Bar -->
    <main class="main-content position-relative lg:max-height-vh-100 lg:h-100 mt-1 border-radius-lg overflow-hidden" style="-webkit-overflow-scrolling: touch;overflow-y: scroll;">
        <!-- Navbar -->
        <?php
        $titleNav = 'مسير الرواتب';
        require_once('../../components/navbar.php');
        ?>
        <!-- End Navbar -->



        <div class="container-fluid py-4">
            <div class=" mb-4 p-3">
                <div class="">
                    <h5 class="mb-1"> مسير الرواتب </h5>
                </div>

                <a href="add-payroll.php" class="btn bg-gradient-dark mb-0 col-md-2 col-sm-6 col-xs-6">إضافة مسير رواتب جديد&nbsp;&nbsp;
                    <i class="fas fa-plus">
                    </i>
                </a>
            </div>
            <div id="filters">
                                <select name="fetchval" id="fetchval">
                                    <option value="" disabled="" selected="">select</option>
                                    <option value="تقنية المعلومات">تقنية المعلومات</option>
                                    <option value="محاسبه">محاسبه</option>
                                </select>
                            </div>
            <!--Table     -->
            <?php
            while ($r = mysqli_fetch_array($select)) {
                $month = $r['month'];
                $year = $r['year'];
                $nmonth = date("m", strtotime($month));
                $select2 = mysqli_query($conn, "select * FROM payroll_process WHERE month = '$month' AND year = '$year'");


            ?>
                <div class="row">
                    <div class="col-12">
                        <div class="card mb-4 mt-3">
                            <div class="card-header text-center">
                                <div class="row align-items-center">
                                    <div class="col-md-11">
                                        <h5>مسير رواتب مدد لشهر <?= $r['month'] ?> (<?= $nmonth ?>) -السنة الميلادية (<?= $year ?>)</h5>
                                    </div>
                                    <a href="print.php?month=<?= $month ?>&year=<?= $year ?>" class="printer">
                                        <div class="paper">
                                            <svg viewBox="0 0 8 8" class="svg">
                                                <path fill="#0077FF" d="M6.28951 1.3867C6.91292 0.809799 7.00842 0 7.00842 0C7.00842 0 6.45246 0.602112 5.54326 0.602112C4.82505 0.602112 4.27655 0.596787 4.07703 0.595012L3.99644 0.594302C1.94904 0.594302 0.290039 2.25224 0.290039 4.29715C0.290039 6.34206 1.94975 8 3.99644 8C6.04312 8 7.70284 6.34206 7.70284 4.29715C7.70347 3.73662 7.57647 3.18331 7.33147 2.67916C7.08647 2.17502 6.7299 1.73327 6.2888 1.38741L6.28951 1.3867ZM3.99679 6.532C2.76133 6.532 1.75875 5.53084 1.75875 4.29609C1.75875 3.06133 2.76097 2.06018 3.99679 2.06018C4.06423 2.06014 4.13163 2.06311 4.1988 2.06905L4.2414 2.07367C4.25028 2.07438 4.26057 2.0758 4.27406 2.07651C4.81533 2.1436 5.31342 2.40616 5.67465 2.81479C6.03589 3.22342 6.23536 3.74997 6.23554 4.29538C6.23554 5.53084 5.23439 6.532 3.9975 6.532H3.99679Z"></path>
                                                <path fill="#0055BB" d="M6.756 1.82386C6.19293 2.09 5.58359 2.24445 4.96173 2.27864C4.74513 2.17453 4.51296 2.10653 4.27441 2.07734C4.4718 2.09225 5.16906 2.07947 5.90892 1.66374C6.04642 1.58672 6.1743 1.49364 6.28986 1.38647C6.45751 1.51849 6.61346 1.6647 6.756 1.8235V1.82386Z"></path>
                                            </svg>
                                        </div>
                                        <div class="dot"></div>
                                        <div class="output">
                                            <div class="paper-out"></div>
                                        </div>
                                    </a>
                                </div>
                            </div>

                           

                            <div class="card-body px-0 pt-0 pb-2 mx-3">
                                <div class="table-responsive p-0">
                                    <table class="table table-hover table-bordered table-fixed" id="table">

                                        <!--Table head-->
                                        <thead class="bg-dark text-light text-center">
                                            <tr>
                                                <th rowspan="2">الرقم</th>
                                                <th rowspan="2">اسم الموظف</th>
                                                <th rowspan="2">الراتب الاساسي</th>
                                                <th rowspan="2">اضافات</th>
                                                <th rowspan="2">اجمالي الراتب</th>
                                                <th colspan="4">الاقتطاعات </th>
                                                <th rowspan="2">مجموع الاقتطاعات</th>
                                                <th rowspan="2">صافي الراتب المستحق</th>
                                                <th rowspan="2">عدد الايام</th>
                                            </tr>
                                            <tr>
                                                <th>مخالفات</th>
                                                <th>غيابات</th>
                                                <th>تاخير</th>
                                                <th>سلف و اخرى</th>
                                            </tr>
                                        </thead>
                                        <!--Table head-->
                                        <!--Table body-->
                                        <?php
                                        while ($rr = mysqli_fetch_array($select2)) {
                                        ?>
                                            <tbody class=" text-center">

                                                <tr>
                                                    <th scope="row"><?= $rr['id'] ?></th>
                                                    <td class="border-1"><?= $rr['emp_name'] ?></td>
                                                    <td class="border-1"><?= $rr['salary'] ?></td>
                                                    <td class="border-1"><?= $rr['extra'] ?></td>
                                                    <td class="border-1"><?= $rr['total_salary'] ?></td>
                                                    <td class="border-1"><?= $rr['fees'] ?></td>
                                                    <td class="border-1"><?= $rr['absend'] ?></td>
                                                    <td class="border-1"><?= $rr['late'] ?></td>
                                                    <td class="border-1"><?= $rr['advanced'] ?></td>
                                                    <td class="border-1"><?= $rr['deductions_total'] ?></td>
                                                    <td class="border-1"><?= $rr['net_salary'] ?></td>
                                                    <td class="border-1"><?= $rr['work_days'] ?></td>


                                                </tr>


                                            </tbody>
                                        <?php } ?>
                                        <!--Table body-->

                                    </table>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <!--Table -->
            <?php } ?>
        </div>







        <?php require_once('../../components/footer.php'); ?>
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
    <!-- AJAX Filter  -->
    <script type="text/javascript">
        $(document).ready(function() {
            $("fetchval").on('change', function() {
                var value = $(this).val();
                $.ajax({
                    url: "fetch.php",
                    type: "POST",
                    data: 'request=' + value,
                    beforeSend: function() {
                        $(".card-body").html("<span>Working....</span>");
                    },
                    success: function(data) {
                        $(".card-body").html(data);
                    }
                })
            })
        })
    </script>
    <script src="../darkmode.js"></script>


</body>

</html>