<?php
include('../../cookies/session3.php');
$_SESSION['sidebar_admin'] = "Advance_Salary";
include('../../cookies/insert-method.php');
if (isset($_POST['submit'])) {
    $employee_id = $_SESSION['id'];
    $target_dir = "../Documents/Advanced-Salary/" . $employee_id . "/";
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true);
    } else {
    }
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    $filename = basename($_FILES["image"]["name"]);
    $uploadOk = 1;
    move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
    extract($_POST);

    $data = [
        'employee_id' => $employee_id,
        'amount' => $amount,
        'payment' => $amount,
        'description' => $description,
        'status' => 'Pending',
        'payment_status' => 'يوجد مستحق',
        'image' => $filename,

    ];
    $tableName = $_POST['table_name'];
    $tableName2 = 'advance_status';

    $last_amount = get_advanced_status($tableName2, $employee_id);

    if ($last_amount == "New" ) {
        
        $advance_status_data = [
            'emp_id' => $employee_id,
            'amount' => $amount,
        ];
        $insertData3 = insert_data($advance_status_data, $tableName2);
        if ($insertData3) {
            $_SESSION['notification'] = "User Profile Added sucessfully";
        } else {

        }
    }else {
        $advance_status_data = [
            'amount' => $amount + $last_amount,
            'modified_at' => 'NOW()'
        ];

        if (!empty($advance_status_data) && !empty($tableName2)) {
            $insertData2 = update_advance_status_data($advance_status_data, $tableName2, $employee_id);
            if ($insertData2) {
                $_SESSION['notification'] = "User Profile Added sucessfully";
            } else {
            }
        }
    }

    if (!empty($data) && !empty($tableName)) {
        $insertData = insert_data($data, $tableName);
        if ($insertData) {
            $_SESSION['notification'] = "تم إضافة طلب السلفية بنجاح";
            header('location: index.php');
            exit();
        } else {
            $_SESSION['notification'] = "Error!.. check your query";
            header('location: index.php');
            exit();
        }
    }
} else {
    $amount = '';
    $description = '';
    $image = '';
}
?>

<html lang="ar" dir="rtl">

<head>
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
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
    <script src="//cdn.datatables.net/plug-ins/1.10.7/integration/bootstrap/3/dataTables.bootstrap.js"></script>
</head>


<body class="g-sidenav-show rtl ">



    <!-- Side Bar -->
    <?php require_once('../../components/sidebar_admin.php'); ?>


    <!-- End Of side Bar -->
    <main class="main-content position-relative lg:max-height-vh-100 lg:h-100 mt-1 border-radius-lg overflow-hidden" style="-webkit-overflow-scrolling: touch;overflow-y: scroll;">
        <!-- Navbar -->
        <?php
        $titleNav = 'اضافه سلفيه';
        require_once('../../components/navbar.php');
        ?>
        <!-- End Navbar -->



        <div class="container-fluid py-4">
            <div class="row">
                <div class="block block-themed">

                    <div class="block-header bg-gradient-dark  col-md-2 col-sm-6 col-xs-6  rounded-pill">

                        <h6 class="block-title text-white py-2 px-4">إضافة سلفه جديد</h6>
                    </div>
                    <form method="POST" action="" enctype="multipart/form-data">
                        <div class="row">

                            <div class="col">
                                <div class="form-group">
                                    <label>قيمة السلفية</label>
                                    <input type="text" placeholder="إكتب قيمة السلفية" class="form-control" name="amount" value="<?= $amount ?>">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>وصف السلفية</label>
                                    <input type="text" placeholder="إكتب وصف السلفية" class="form-control" name="description" value="<?= $description ?>">
                                    <input type="text" name="table_name" value="advance_salary" hidden>

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>مستند السلفية</label>
                                    <input type="file" class="form-control" name="image" value="<?= $image ?>">
                                </div>
                            </div>


                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-check">
                                
                                <label class="custom-control-label" for="customCheck1">أنا <?=$_SESSION['username'] ?>  أتعهد بأن أقوم بسداد قيمة السلفة المذكورة أعلاه وأفهم أنه في حالة تأخري في سداد المبلغ في الموعد المحدد، يحق للشركة خصم مبلغ السلفية من رواتبي او مستحقاتي المالية لتحصيل المبلغ المستحق دون الرجوع الي.</label>
                                <input class="form-check-input" type="checkbox" value="" id="fcustomCheck1"  required>   
                            </div>
                            </div>
                        </div>



                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <button type="submit" name="submit" class="btn btn-secondary">Save</button>
                                </div>
                            </div>
                            <div class="col">

                            </div>
                        </div>
                    </form>
                </div>
            </div>
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
    <script src="../darkmode.js"></script>
</body>

</html>