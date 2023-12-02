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


                    document.getElementById('signture2').style.backgroundColor = "#ffffff00";
                    window.print();
                    document.getElementById('btn2').style.display = "inline";


                    document.getElementById('signture2').style.backgroundColor = "white";

                }
            </script>

            <div class="invoice-box ">
                <div class="row ">
                    <div class="col-3">

                        <div class="card-body">
                            <div class="row text-center">
                                <div>
                                    <p class="card-text">
                                        مؤسسة ركن أميال <br>
                                        <hr style="border-top: 1px solid green;">
                                        للمقاولات
                                    </p>
                                </div>

                            </div>
                        </div>

                    </div>
                    <div class="col-6"></div>
                    <div class="col-3">
                        <div>
                            <div class="card-body">
                                <div class="row text-center">
                                    <div>
                                        <p class="card-text">
                                            Miles Corner Foundation <br>
                                            <hr>
                                            Contracting

                                        </p>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="text-center text-150">
                            <h2 class="font-weight-bold">عقد عمل</h2>
                        </div>
                    </div>
                </div>

                <hr class="row brc-default-l1 mx-n1 mb-4" />

                <!-- here to change -->
                <div class="row ">
                    <p>ابرم هذا العقد في تاريخ : 2022/12/01م</p>
                    <p>بين كل من: </p>
                    <p>1- <strong>مؤسسة ركن أميال للمقاولات</strong> وهي مؤسسة سعودية برقم سجل تجاري (1010897903) بتاريخ 1400/1/1هـ, ويمثله في هذا العقد السيد / عباس الجعفري، بصفته المدير العام للمؤسسة ويشار إليه فيما بعد بالطرف الأول .</p>
                    <p>2- <strong><?= $user['name'] ?></strong> ، الجنسية، بسجل مدني (1050276102) تاريخ الإصدار 1418/12/17 هـ ومصدره الرياض, والمقيم سكناً في مدينة الرياض, ويشار إليه فيما بعد بالطرف الثاني <?= $user['nationality'] ?>. </p>
                    <p>حيث تم الإتفاق والتراضي بين الطرفين أعلاه وهما بأتم الأوصاف المعتبرة على الإلتزام بالعقد التالي: </p>
                    <p><strong>تعتبر هذه المقدمة جزء لا يتجزأ من هذا العقد.</strong></p>
                    <h4>المهنة ومكان العمل + الأجر والمزايا المالية</h4>
                    <p>قبل الطرف الثاني بالعمل لدى الطرف الأول بوظيفة <?= $user['position'] ?> , وراتب أساسي شهري قدره(<?= $user['salary'] ?> ) ,<span id="con"> </span>يدفع في نهاية كل شهر ميلادي + تأمين

                        السيارة و المحروقات للعمل + تامين طبى له ولافراد العائلة + حوافز سنوية حسب اللوائح المعتمدة داخل المؤسسة نسبة 3% من قيمة اي مشروع يجلبه الطرف الثاني للمؤسسة ، حيث يلتزم الطرف الثاني بأي عمل يسند إليه من قبل الطرف الأول في أي مكان داخل المملكة العربية السعودية أو خارجها . </p>
                    <h4>مدة العقد</h4>
                    <p>مدة هذا العقد سنة، تبدأ من تاريخ 2022/12/01م ، ويجدد هذا العقد تلقائياً ما لم يخطر أحد الطرفين الآخر كتابة برغبته في إنهاء العمل وذلك في مدة لا تقل عن شهر, ويستحق الموظف مكافأة نهاية الخدمة بحسب ماورد في نظام العمل السعودي . </p>
                    <h4>فترةالتجربة</h4>
                    <p>يخضع الطرف الثاني لفترة تجريبية مدتها ثلاثة أشهر يكون خلالها تحت الاختبار حيث يحق للطرفان انهاء العقد دون أي التزامات مالية تترتب
                        على ذلك . </p>
                    <h4>الاجازات</h4>
                    <p>يتمتع الطرف الثاني بإجازة سنوية مدتها ثلاثون يوماً مدفوعة الاجر ويجب ان يتمتع بها الطرف الثاني لحظة استحقاقها ولا يجوز له المطالبة بالتعويض عنها مالياً في حالة عدم رغبته في استحقاقها مالم يطلب منه الطرف الأول تأجيلها كتابة وذلك لحوجة العمل كما يلتزم الطرف الأول بدفع قيمة تذاكر السفر جوا مع بدل الانتقال والسكن والاعاشة اذا تم تكليف الموظف بأعمال لصالح المؤسسة في غير مقر العمل سواء اكان ذلك داخل المملكة العربية السعودية أو خارجها ما لم يتم تأمينها من قبل المؤسسة ويكون ذلك وفقا للائحة تنظيم العمل داخل المؤسسة . </p>
                    <h4>ساعات العمل</h4>
                    <p>يعمل الطرف الثاني لدى الطرف الأول لمدة 6 أيام عمل في الأسبوع بواقع <?= $user['working_hours'] ?> عمل يوميا عن بعد و أن يحضر لمقر المؤسسة حسب مقتضيات العمل وحاجته، يتم تحديد بدايتها ونهايتها من قبل الطرف الأول، كما يحق للطرف الأول تغيير مواعيد بداية العمل ونهايته حسب الحوجة لذلك، ويحق للطرف الأول الزيادة في ساعات العمل عند الحوجة بشرط تعويض الطرف الثاني عن هذه الزيادة. </p>
                    <h4>الجزاءات و الغرامات والعلاوات</h4>
                    <p>يلتزم الطرف الثاني بالحفاظ على ممتلكات وعهد المؤسسة المسلمه له وفي حالة الاضرار بأي من هذه الممتلكات او العهد يتم مطالبة الطرف الثاني بالتعويض المالي جراء هذا الضرر او الإهمال وفي حالة عدم التزام الطرف الثاني بدفع هذا التعويض يحق للطرف الأول خصم قيمة هذه الاضرار من مستحقات الطرف الثاني المالية دون الرجوع اليه, كما يحق للطرف الأول إيقاع الجزاءات والعقوبات المالية المناسبة في حالة سوء السلوك وفي حال تكرار المخالفة وبعد انزار الطرف الثاني لمرتان متتاليتان يحق للطرف الأول إيقاف الطرف الثاني دون تعويضه عن مكافاة نهاية الخدمة, كما يلتزم الطرف الثاني بتسليم العهد الخاصة بالطرف الأول في حالة انهاء التعاقد ويحق للطرف الأول خصم هذه العهد من مستحقاته المالية في حالة عدم تسليمها, وللطرف الأول أن يقوم بترقية الموظف أو أن تمنحه علاوة سنوية وفقاً للتقدير المطلق للطرف الأول, ولا يعد ذلك حقاً للموظف إلا بعد صدور موافقة صاحب الصلاحية للطرف الأول.</p>
                    <h4>عناوين التخاطب الرسمي</h4>
                    <div class="row ">
                        <div class="col">
                            <div>

                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-6">
                                            <p>1-<strong>الطرف الأول</strong> </p>
                                            <p>الايميل: <?= $user['email'] ?></p>
                                            <p>جوال: <?= $user['phone'] ?></p>
                                        </div>
                                        <div class="col-6">

                                            <p>2-<strong>الطرف التاني</strong> </p>
                                            <p>الايميل: <?= $user['email'] ?></p>
                                            <p>جوال: <?= $user['phone'] ?></p>
                                        </div>
                                    </div>



                                </div>
                            </div>
                        </div>
                    </div>

                    <script>
                        function changeVal() {

                            value = <?= number_format($text_salary, 0, "", "") ?>;
                            document.getElementById("con").innerText = numToWords(value);
                            console.log(value);

                        }
                        window.onload = changeVal;
                    </script>
                </div>
                <!-- == -->


                <!--<input type="text" class="signture" id="signture2" />== -->


                <div class="row text-center">
                    <div class="col-6">
                        <div class="row">
                            <h6>الطرف الأول</h6>
                            <h4>مؤسسة ركن اميال للمقاولات</h4>
                            <h4>المدير العام/عباس الجعفري</h4>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="row">
                            <h6>الطرف الأول</h6>
                            <h4>مؤسسة ركن اميال للمقاولات</h4>
                            <h4>المدير العام/عباس الجعفري</h4>
                        </div>
                    </div>
                    <input class="signture" id="signture2" />
                </div>
                <table>

                </table>

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
    <script>
        var ctx = document.getElementById("chart-bars").getContext("2d");

        new Chart(ctx, {
            type: "bar",
            data: {
                labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                datasets: [{
                    label: "Sales",
                    tension: 0.4,
                    borderWidth: 0,
                    borderRadius: 4,
                    borderSkipped: false,
                    backgroundColor: "#fff",
                    data: [450, 200, 100, 220, 500, 100, 400, 230, 500],
                    maxBarThickness: 6
                }, ],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false,
                    }
                },
                interaction: {
                    intersect: false,
                    mode: 'index',
                },
                scales: {
                    y: {
                        grid: {
                            drawBorder: false,
                            display: false,
                            drawOnChartArea: false,
                            drawTicks: false,
                        },
                        ticks: {
                            suggestedMin: 0,
                            suggestedMax: 500,
                            beginAtZero: true,
                            padding: 15,
                            font: {
                                size: 14,
                                family: "Open Sans",
                                style: 'normal',
                                lineHeight: 2
                            },
                            color: "#fff"
                        },
                    },
                    x: {
                        grid: {
                            drawBorder: false,
                            display: false,
                            drawOnChartArea: false,
                            drawTicks: false
                        },
                        ticks: {
                            display: false
                        },
                    },
                },
            },
        });


        var ctx2 = document.getElementById("chart-line").getContext("2d");

        var gradientStroke1 = ctx2.createLinearGradient(0, 230, 0, 50);

        gradientStroke1.addColorStop(1, 'rgba(203,12,159,0.2)');
        gradientStroke1.addColorStop(0.2, 'rgba(72,72,176,0.0)');
        gradientStroke1.addColorStop(0, 'rgba(203,12,159,0)'); //purple colors

        var gradientStroke2 = ctx2.createLinearGradient(0, 230, 0, 50);

        gradientStroke2.addColorStop(1, 'rgba(20,23,39,0.2)');
        gradientStroke2.addColorStop(0.2, 'rgba(72,72,176,0.0)');
        gradientStroke2.addColorStop(0, 'rgba(20,23,39,0)'); //purple colors

        new Chart(ctx2, {
            type: "line",
            data: {
                labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                datasets: [{
                        label: "Mobile apps",
                        tension: 0.4,
                        borderWidth: 0,
                        pointRadius: 0,
                        borderColor: "#cb0c9f",
                        borderWidth: 3,
                        backgroundColor: gradientStroke1,
                        fill: true,
                        data: [50, 40, 300, 220, 500, 250, 400, 230, 500],
                        maxBarThickness: 6

                    },
                    {
                        label: "Websites",
                        tension: 0.4,
                        borderWidth: 0,
                        pointRadius: 0,
                        borderColor: "#3A416F",
                        borderWidth: 3,
                        backgroundColor: gradientStroke2,
                        fill: true,
                        data: [30, 90, 40, 140, 290, 290, 340, 230, 400],
                        maxBarThickness: 6
                    },
                ],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false,
                    }
                },
                interaction: {
                    intersect: false,
                    mode: 'index',
                },
                scales: {
                    y: {
                        grid: {
                            drawBorder: false,
                            display: true,
                            drawOnChartArea: true,
                            drawTicks: false,
                            borderDash: [5, 5]
                        },
                        ticks: {
                            display: true,
                            padding: 10,
                            color: '#b2b9bf',
                            font: {
                                size: 11,
                                family: "Open Sans",
                                style: 'normal',
                                lineHeight: 2
                            },
                        }
                    },
                    x: {
                        grid: {
                            drawBorder: false,
                            display: false,
                            drawOnChartArea: false,
                            drawTicks: false,
                            borderDash: [5, 5]
                        },
                        ticks: {
                            display: true,
                            color: '#b2b9bf',
                            padding: 20,
                            font: {
                                size: 11,
                                family: "Open Sans",
                                style: 'normal',
                                lineHeight: 2
                            },
                        }
                    },
                },
            },
        });
    </script>
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