<?php
include('../../cookies/session3.php');
$_SESSION['sidebar_admin'] = "payroll";
include('../../cookies/insert-method.php');
$year = $_GET['year'];
$month = $_GET['month'];
$nmonth = date("m", strtotime($month));
$select2 = mysqli_query($conn, "select * FROM payroll_process WHERE month = '$month' AND year = '$year'");
?>

<html lang="ar" dir="rtl">

<head>
<style>
    @media print {
  body {
    zoom: 80%;
  }
}
@media print{@page {size: landscape}}
</style>


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

    <style>
        .invoice-box {
            max-width: 1430px;
            margin: auto;
            padding: 30px;
            font-size: 16px;
            line-height: 24px;
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            color: #555;
        }

        .row1 {
            padding-top: 10px !important;
            position: relative;
            font-size: small;
            text-align: right !important;
        }

        .row2 {
            text-align: right !important;
            font-size: small;
        }

        .invoice-box table {
            width: 100%;
            line-height: inherit;

        }


        .invoice-box table td {
            padding: 5px;
            vertical-align: top;
            font-size: small;
        }

        .invoice-box table tr th {
            color: black;
        }

        .invoice-box table tr td:nth-child(2) {
            text-align: right;
        }

        .invoice-box table tr.top table td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.top table td.title {
            font-size: 45px;
            line-height: 45px;
            color: #333;
            text-align: center;
        }

        .invoice-box table tr.information table td {
            padding-bottom: 40px;
        }

        .invoice-box table tr.heading td {
            background: #eee;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
        }

        .invoice-box table tr.details td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.item td {
            border-bottom: 1px solid #eee;
        }

        .invoice-box table tr.item.last td {
            border-bottom: none;
        }

        .invoice-box table tr.total td:nth-child(2) {
            border-top: 2px solid #eee;
            font-weight: bold;
        }




        @media only screen and (max-width: 600px) {
            .invoice-box table tr.top table td {
                width: 100%;
                display: block;
                text-align: center;
            }

            .invoice-box table tr.information table td {
                width: 100%;
                display: block;
                text-align: center;
            }
        }

        @page {
            size: auto;
            margin: 0mm;
        }




        @page {
            size: auto;
            margin: 0mm;
        }

        .printing2 {
            left: 140px;
        }
    </style>
</head>





<body class="g-sidenav-show rtl  bg-gray-100">



    <!-- Side Bar -->
    <?php require_once('../../components/sidebar_admin.php'); ?>


    <!-- End Of side Bar -->
    <main class="main-content position-relative lg:max-height-vh-100 lg:h-100 mt-1 border-radius-lg overflow-hidden" style="-webkit-overflow-scrolling: touch;overflow-y: scroll;">
        <!-- Navbar -->

        <!-- End Navbar -->


        <div class="container-fluid py-4">
            <div class="block-header bg-warning rounded col-md-3 col-sm-6 col-xs-6">

                <?php require_once('../../components/notification.php'); ?>
            </div>
            <!-- Button trigger modal -->

            <div class=" justify-content-md-end">

                <button type="button" id="btn2" class=" printing btn bg-gradient-dark rounded-pill col-md-2 col-sm-6 col-xs-5 me-md-2 " onclick="printDiv('printableArea')">
                    طباعة الطلب
                    <i class="mr-1 fa fa-print text-primary-m1 text-120 w-2"></i>

                </button>

            </div>

            <script>
                function printDiv(divName) {
                    document.getElementById('btn2').style.display = "none";


                  
                    window.print();
                    document.getElementById('btn2').style.display = "inline";


                  

                }
            </script>





            <div class="invoice-box mt-8">



                <!-- here to change -->

                <!-- == -->

                <div class="row justify-content-center">
                    <div class="col-12">
                        <div class=" text-center">
                            <h5>مسير رواتب مدد لشهر <?=$month?> (<?=$nmonth?>) -السنة الميلادية (<?=$year?>)</h5>
                        </div>
                        <div class="table-responsive p-0">
                            <table class="table table-hover table-bordered table-fixed text-center border-dark">

                                <!--Table head-->
                                <thead class="text-light header-color custom-font-m table-bordered">

                                    <tr>
                                        <th style="color: white;" rowspan="2">الرقم</th>
                                        <th style="color: white;" rowspan="2">اسم الموظف</th>
                                        <th style="color: white;" rowspan="2">الراتب الاساسي</th>
                                        <th style="color: white;" rowspan="2">اضافات</th>
                                        <th style="color: white;" rowspan="2">اجمالي الراتب</th>
                                        <th style="color: white;" colspan="4">الاقتطاعات </th>
                                        <th style="color: white;" rowspan="2">مجموع الاقتطاعات</th>
                                        <th style="color: white;" rowspan="2">صافي الراتب المستحق</th>
                                        <th style="color: white;" rowspan="2">عدد الايام</th>
                                    </tr>
                                    <tr>
                                        <th style="color: white;">مخالفات</th>
                                        <th style="color: white;">غيابات</th>
                                        <th style="color: white;">تاخير</th>
                                        <th style="color: white;">سلف و اخرى</th>
                                    </tr>
                                </thead>
                                <!--Table head-->

                                <!--Table body-->
                                <tbody class=" text-center">

                                    <?php 
                                     while($rr = mysqli_fetch_array($select2)){
                                        $t_salary += $rr['salary'];
                                        $t_extra += $rr['extra'];
                                        $t_total_salary += $rr['total_salary'];
                                        $t_fees += $rr['fees'];
                                        $t_absend += $rr['absend'];
                                        $t_late += $rr['salary'];
                                        $t_advanced += $rr['advanced'];
                                        $t_deductions_total += $rr['deductions_total'];
                                        $t_net_salary += $rr['net_salary'];
                                    ?>   
                                        <tr>
                                            <th scope="row"><?=$rr['id']?></th>
                                            <td class="border-1"><?=number_format($rr['emp_name'],2,'.',',')?></td>
                                            <td class="border-1"><?=number_format($rr['salary'],2,'.',',')?></td>
                                            <td class="border-1"><?=number_format($rr['extra'],2,'.',',')?></td>
                                            <td class="border-1"><?=number_format($rr['total_salary'],2,'.',',')?></td>
                                            <td class="border-1"><?=number_format($rr['fees'],2,'.',',')?></td>
                                            <td class="border-1"><?=number_format($rr['absend'],2,'.',',')?></td>
                                            <td class="border-1"><?=number_format($rr['late'],2,'.',',')?></td>
                                            <td class="border-1"><?=number_format($rr['advanced'],2,'.',',')?></td>
                                            <td class="border-1"><?=number_format($rr['deductions_total'],2,'.',',')?></td>
                                            <td class="border-1"><?=number_format($rr['net_salary'],2,'.',',')?></td>
                                            <td class="border-1"><?=$rr['work_days']?></td>


                                        </tr>


                                    <?php } ?>
                                    <tr>
                                        <td class="text-center border-1" colspan="2">المجموع</td>
                                        <td class="text-center border-1"><?=number_format($t_salary,2,'.',',')?></td>
                                        <td class="border-1"><?=number_format($t_extra,2,'.',',')?></td>
                                        <td class="border-1"><?=number_format($t_total_salary,2,'.',',')?></td>
                                        <td class="border-1"><?=number_format($t_fees,2,'.',',')?></td>
                                        <td class="border-1"><?=number_format($t_absend,2,'.',',')?></td>
                                        <td class="border-1"><?=number_format($t_late,2,'.',',')?></td>
                                        <td class="border-1"><?=number_format($t_advanced,2,'.',',')?></td>
                                        <td class="border-1"><?=number_format($t_deductions_total,2,'.',',')?></td>
                                        <td class="border-1"><?=number_format($t_net_salary,2,'.',',')?></td>
                                        <td class="border-1"></td>

                                    </tr>



                                </tbody>
                                <!--Table body-->

                            </table>
                        </div>

                    </div>
                </div>





                <hr>



                <table>
                    <div class="row p-5 text-center">
                        <div class="col-4">
                            <div class="row">
                                <h6>المحاسب</h6>
                                <h5></h5>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="row">
                                <h6>المدير التنفيذي</h6>
                                <h5></h5>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="row">
                                <h6>المدير العام</h6>
                            </div>
                        </div>
                    </div>
                    </table>
                    <table>

                    </table>

            </div>





        </div>





        
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
    <!-- <script>
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
    </script> -->
    <script src="../darkmode.js"></script>
</body>

</html>