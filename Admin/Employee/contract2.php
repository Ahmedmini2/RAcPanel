<?php
include('../../cookies/session3.php');
$_SESSION['sidebar_admin'] = "employee";
if (isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];
} else {
    $user_id = $_SESSION['id'];
}
$query = "SELECT * FROM employee WHERE user_id = $user_id";

$res = $conn->query($query);
$user = $res->fetch_assoc();
$text_salary = $user['salary'];
$query2 = "SELECT * FROM users WHERE id = $user_id";
$res2 = $conn->query($query2);
$user2 = $res2->fetch_assoc();



?>
<!DOCTYPE html>
<html lang="en" dir="rtl">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="../../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../../assets/img/favicon.png">
    <title>
        عقد عمل
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
    <!-- CSS Files -->
    <link id="pagestyle" href="../../assets/css/soft-ui-dashboard.css?v=1.0.3" rel="stylesheet" />
    <style>
        .invoice-box {
            max-width: 1200px;
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

<body class="g-sidenav-show rtl bg-gray-100">

    <script src="../../assets/js/numtowords/numtowords.js"></script>

    <!-- Side Bar -->
    <?php require_once('../../components/sidebar_admin.php'); ?>
    <!-- End Of side Bar -->

    <main class="main-content position-relative lg:max-height-vh-100 lg:h-100 mt-1 border-radius-lg overflow-hidden">

        <div class="container-fluid py-4">
            <div class="block-header bg-warning rounded col-md-3 col-sm-6 col-xs-6">

                <?php require_once('../../components/notification.php'); ?>
            </div>
            <!-- Button trigger modal -->

            <div class=" justify-content-md-end">

                <button type="button" id="btn2" class=" printing btn bg-gradient-dark rounded-pill col-md-2 col-sm-6 col-xs-5 me-md-2 " onclick="printDiv('printableArea')">
                    طباعة العقد
                    <i class="mr-1 fa fa-print text-primary-m1 text-120 w-2"></i>

                </button>

            </div>

            <script>
                function printDiv(divName) {
                    document.getElementById('btn2').style.display = "none";


                   // document.getElementById('signture2').style.backgroundColor = "#ffffff00";
                    window.print();
                    document.getElementById('btn2').style.display = "inline";


                  //  document.getElementById('signture2').style.backgroundColor = "white";

                }
            </script>

            <div class="invoice-box ">
                
            <table>
            <tr class="heading">
                <td colspan="2">
                    <h2 class="font-weight-bold text-center">عقد عمل</h2>
                </td>
            </tr>
            <tr class="details">
                <td colspan="2">
                    <p>ابرم هذا العقد في تاريخ: <?=$user['start_date']?></p>
                    <p>بين كل من:</p>
                    <p>1- <strong>شركة سكايب للمقاولات</strong> وهي مؤسسة سعودية برقم سجل تجاري (1010967570) بتاريخ 1400/1/1هـ، ويمثله في هذا العقد السيد / <?=$_SESSION['full_name']?>، بصفته المدير العام للمؤسسة ويشار إليه فيما بعد بالطرف الأول.</p>
                    <p>2- <strong><?=$user['name_ar']?></strong>، الجنسية <?=$user['nationality']?>، <?php if($user['nationality'] == 'سعودي') echo 'بسجل مدني رقم'; else { echo 'بإقامة رقم'; } ?> (<?=$user['id_number']?>) تاريخ الإصدار <?=$user['id_issue_date']?> ومصدره <?=$user['id_source']?>، والمقيم سكناً في مدينة <?=$user['address']?>، ويشار إليه فيما بعد بالطرف الثاني.</p>
                    <p>حيث تم الإتفاق والتراضي بين الطرفين أعلاه وهما بأتم الأوصاف المعتبرة على الإلتزام بالعقد التالي:</p>
                    <p><strong>تعتبر هذه المقدمة جزء لا يتجزأ من هذا العقد.</strong></p>
                </td>
            </tr>
            <tr class="details">
                <td colspan="2">
                    <h4>المهنة ومكان العمل + الأجر والمزايا المالية</h4>
                    <p>حيث يلتزم الطرف الثاني بأي عمل يسند إليه من قبل الطرف الأول في أي مكان داخل المملكة العربية السعودية أو خارجها.</p>
                </td>
            </tr>
            <tr class="details">
                <td colspan="2">
                    <h4>مدة العقد</h4>
                    <p>مدة هذا العقد <?=$user['contract_period']?>، تبدأ من تاريخ <?=$user['start_date']?>، <?php if($user['auto_renew'] == 'لا') echo 'ويتم تجديد هذا العقد بإنتهاء فترة العقد'; else { echo 'ويجدد هذا العقد تلقائياً'; } ?> ما لم يخطر أحد الطرفين الآخر كتابة برغبته في إنهاء العمل وذلك في مدة لا تقل عن شهر، ويستحق الموظف مكافأة نهاية الخدمة بحسب ماورد في نظام العمل السعودي.</p>
                </td>
            </tr>
            <!-- يمكنك إضافة المزيد من الأقسام حسب احتياجاتك -->
            <!-- على سبيل المثال، فترة التجربة، الاجازات، ساعات العمل، الجزاءات والغرامات، وغيرها -->
        </table>
    
    </div>
                <!-- == -->


                <!--<input type="text" class="signture" id="signture2" />== -->


                <div class="row text-center">
                    <div class="col-6">
                        <div class="row">
                            <h6>الطرف الأول</h6>
                            <h4>مؤسسة ركن اميال للمقاولات</h4>
                            <h4>المدير العام/<?=$_SESSION['full_name']?></h4>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="row">
                            <h6>الطرف التاني</h6>
                            
                            <h4><?=$user['name_ar']?></h4>
                        </div>
                    </div>
                    
                </div>
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
</body>

</html>