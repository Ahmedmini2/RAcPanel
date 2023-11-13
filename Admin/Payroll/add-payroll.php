<?php
include('../../cookies/session3.php');
$_SESSION['sidebar_admin'] = "payroll";
include('../../cookies/insert-method.php');
if (isset($_POST['submit'])) {
    $dateNew = new DateTimeImmutable($_POST['month']);
    $date = date_format($dateNew, 'F');
    $year = date_format($dateNew, 'Y');
    $names = $_POST['name'];
    $emp_ids = $_POST['emp_id'];
    $salaries = $_POST['salary'];
    $extras = $_POST['extra'];
    $total_salaries = $_POST['total_salary'];
    $fees = $_POST['fee'];
    $absends = $_POST['absend'];
    $lates = $_POST['latee'];
    $advanceds = $_POST['advancedd'];
    $deductions_totals = $_POST['deductions_total'];
    $net_salaries = $_POST['net_salary'];
    $work_days = $_POST['work_days'];

    for ($i = 0; $i < count($names); $i++) {
        $data = [
            'emp_name' => $names[$i],
            'salary' => $salaries[$i],
            'extra' => $extras[$i],
            'total_salary' => $total_salaries[$i],
            'fees' => $fees[$i],
            'absend' => $absends[$i],
            'late' => $lates[$i],
            'advanced' => $advanceds[$i],
            'deductions_total' => $deductions_totals[$i],
            'net_salary' => $net_salaries[$i],
            'work_days' => $work_days[$i],
            'month' => $date,
            'year' => $year,
        ];
        $tableName = 'payroll_process';

        $tableName2 = 'advance_status';

        $last_amount = get_advanced_status($tableName2, $emp_ids[$i]);

        $advance_status_data = [
            'amount' => $last_amount - $advanceds[$i],
            'modified_at' => 'NOW()'
        ];

        if (!empty($advance_status_data) && !empty($tableName2)) {
            $insertData2 = update_advance_status_data($advance_status_data, $tableName2, $emp_ids[$i]);
            if ($insertData2) {
                $_SESSION['notification'] = "User Profile Added sucessfully";
            } else {
                $_SESSION['notification'] = "Error!.. check your query";
            }
        }

        if (!empty($data) && !empty($tableName)) {
            $insertData = insert_data($data, $tableName);
            if ($insertData) {
                $_SESSION['notification'] = "تم إضافة مسير الرواتب بنجاح";
            } else {
                $_SESSION['notification'] = "خطأ في النظام";
            }
        }
    }
    header('location: index.php');
    exit();
}
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
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
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
        $titleNav = 'اضافه مسير رواتب';
        require_once('../../components/navbar.php');
        ?>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="row">
                <div class="block block-themed">

                    <div class="block-header bg-gradient-dark  col-md-2 col-sm-6 col-xs-6  rounded-pill">

                        <h6 class="block-title text-white py-2 px-4">إضافة مسير رواتب جديد</h6>
                    </div>
                    <form method="POST" action="">
                        <div class="row">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label>الرجاء ادخال تاريخ مسير الرواتب حسب الشهر</label>
                                        <input type="date" class="form-control" name="month">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label>الرجاء اختيار القسم</label>
                                        <div id="filters">
                                            <select dir="ltr" class="form-select" name="fetchval" id="fetchval">
                                                <option value="" disabled="" selected="">select</option>
                                                <option value="General Administration">General Administration</option>
                                                <option value="Rental labors">Rental labors</option>
                                                <option value="Factory Department">Factory Department</option>
                                                <option value="IT">IT</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>



                        </div>
                        <div class="row">
                            <div class="card-body px-0 pt-0 pb-2 mx-3">
                                <div class="table-responsive p-0">

                                </div>
                            </div>

                        </div>
                        <button type="submit" name="submit" class="btn btn-secondary">اضافة مسيرة رواتب</button>
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
    <script type="text/javascript">
        $("#fetchval").on('change', function() {
            var value = $(this).val();
            $.ajax({
                url: "fetch.php",
                type: "POST",
                data: 'request=' + value,
                beforeSend: function() {
                    $(".table-responsive").append(<div class="loaderSelect"><span>Loading...</span></div>);
                },
                success: function(data) {
                    $(".table-responsive").html(data);
                }
            })
        })
    </script>

    <script src="../darkmode.js"></script>
</body>

</html>