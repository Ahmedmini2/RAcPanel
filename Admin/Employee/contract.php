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
            padding-top: 100px;
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
        .fontT{
            font-family: 'Courier New', Courier, monospace;
        }
        .fontTi{
            font-weight: 600 !important;
            color: black;
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

                <!-- <div class="row">
                    <div class="col-12">
                        <div class="text-center text-150">
                            <h2 class="font-weight-bold">عقد عمل</h2>
                        </div>
                    </div>
                </div> -->
                <table>
                    <tr class="heading">
                        <td colspan="2">
                            <h2 class="fontTi text-center">عقد عمل</h2>
                        </td>
                    </tr>
                </table>

                <hr class="row brc-default-l1 mx-n1 mb-4" />

                <!-- here to change -->
                <div class="row ">
                    <table>
                        <tr class="heading fontT">
                            <td colspan="2">
                                <p>ابرم هذا العقد في تاريخ : <?= $user['start_date'] ?>م</p>
                                <p>بين كل من: </p>
                                <p>1- <strong>شركة سكايب للمقاولات</strong> وهي مؤسسة سعودية برقم سجل تجاري (1010967570) بتاريخ 1400/1/1هـ, ويمثله في هذا العقد السيد / <?= $_SESSION['full_name'] ?>، بصفته المدير العام للمؤسسة ويشار إليه فيما بعد بالطرف الأول .</p>
                                <p>2- <strong><?= $user['name_ar'] ?></strong> ، الجنسية <?= $user['nationality'] ?> ، <?php if ($user['nationality'] == 'سعودي') echo 'بسجل مدني رقم';
                                    else {
                                        echo 'بإقامة رقم';
                                    } ?> (<?= $user['id_number'] ?>)  ومصدره <?= $user['id_source'] ?>, والمقيم سكناً في مدينة <?= $user['address'] ?>, ويشار إليه فيما بعد بالطرف الثاني . </p>
                                <p>حيث تم الإتفاق والتراضي بين الطرفين أعلاه وهما بأتم الأوصاف المعتبرة على الإلتزام بالعقد التالي: </p>
                                <p><strong>تعتبر هذه المقدمة جزء لا يتجزأ من هذا العقد.</strong></p>
                            </td>
                        </tr>
                    </table>
                    <!-- <p>ابرم هذا العقد في تاريخ : <?= $user['start_date'] ?>م</p>
                    <p>بين كل من: </p>
                    <p>1- <strong>شركة سكايب للمقاولات</strong> وهي مؤسسة سعودية برقم سجل تجاري (1010967570) بتاريخ 1400/1/1هـ, ويمثله في هذا العقد السيد / <?= $_SESSION['full_name'] ?>، بصفته المدير العام للمؤسسة ويشار إليه فيما بعد بالطرف الأول .</p>
                    <p>2- <strong><?= $user['name_ar'] ?></strong> ، الجنسية <?= $user['nationality'] ?> ، <?php if ($user['nationality'] == 'سعودي') echo 'بسجل مدني رقم';
                                                                                                            else {
                                                                                                                echo 'بإقامة رقم';
                                                                                                            } ?> (<?= $user['id_number'] ?>) تاريخ الإصدار <?= $user['id_issue_date'] ?> ومصدره <?= $user['id_source'] ?>, والمقيم سكناً في مدينة <?= $user['address'] ?>, ويشار إليه فيما بعد بالطرف الثاني . </p>
                    <p>حيث تم الإتفاق والتراضي بين الطرفين أعلاه وهما بأتم الأوصاف المعتبرة على الإلتزام بالعقد التالي: </p>
                    <p><strong>تعتبر هذه المقدمة جزء لا يتجزأ من هذا العقد.</strong></p> -->
                    <hr class="row brc-default-l1 mx-n1 mb-4" />
                    <table>
                        <tr class="heading">
                            <td colspan="2">
                                <h4 class="fontTi text-center">المهنة ومكان العمل + الأجر والمزايا المالية</h4>
                            </td>
                        </tr>
                    </table>
                    <hr class="row brc-default-l1 mx-n1 mb-4" />
                    <!-- <h4>المهنة ومكان العمل + الأجر والمزايا المالية</h4> -->

                    <table>
                    <tr class="heading fontT">
                            <td colspan="2">
                                <p>قبل الطرف الثاني بالعمل لدى الطرف الأول بوظيفة ( <?= $user['position'] ?> ) , وراتب أساسي شهري قدره ( <?= $user['salary'] ?> ريال ) , يدفع في نهاية كل شهر ميلادي
                                    <?php if ($user['car_insurance'] == 'يوجد') echo ' + تأمين سيارة '; ?>
                                    <?php if ($user['gas_insurance'] == 'يوجد') echo ' + تأمين المحروقات للعمل '; ?>
                                    <?php if ($user['medical_insurance'] == 'تأمين شخصي') echo ' + تأمين شخصي فقط ';
                                    else if ($user['medical_insurance'] == 'تأمين طبى له ولأفراد العائلة') echo '+ تأمين طبى له ولأفراد العائلة'; ?>
                                    <?php if ($user['phone_and_sim'] == 'يوجد') echo ' + تأمين جوال وشريحة إتصال '; ?>
                                    <?php if ($user['house_insurance'] == 'يوجد') echo ' + تأمين بدل سكن '; ?>
                                    <?php if ($user['tickets'] == 'لا يوجد') echo '';
                                    else {
                                        echo ' + تأمين قيمة تذاكر السفر ' . $user['tickets'] . ' ';
                                    } ?>
                                    <?php if ($user['extra_perc'] == 'لا يوجد') echo '';
                                    else {
                                        echo ' + حوافز سنوية حسب اللوائح المعتمدة داخل المؤسسة نسبة  ' . $user['extra_perc'] . ' من قيمة اي مشروع يجلبه الطرف الثاني للمؤسسة ';
                                    } ?>

                                    ، حيث يلتزم الطرف الثاني بأي عمل يسند إليه من قبل الطرف الأول في أي مكان داخل المملكة العربية السعودية أو خارجها . </p>
                            </td>
                        </tr>
                    </table>
                    

                    <!-- <h4>مدة العقد</h4> -->
                    <hr class="row brc-default-l1 mx-n1 mb-4" />
                    <table>
                        <tr class="heading">
                            <td colspan="2">
                                <h4 class="fontTi text-center">مدة العقد</h4>
                            </td>
                        </tr>
                    </table>
                    <hr class="row brc-default-l1 mx-n1 mb-4" />
                    <table>
                    <tr class="heading fontT">
                            <td colspan="2">
                                <p>مدة هذا العقد <?= $user['contract_period'] ?>،
                                    تبدأ من تاريخ <?= $user['start_date'] ?>م ،
                                    <?php if ($user['auto_renew'] == 'لا') echo 'ويتم تجديد هذا العقد بإنتهاء فترة العقد';
                                    else {
                                        echo 'ويجدد هذا العقد تلقائياً';
                                    } ?>

                                    ما لم يخطر أحد الطرفين الآخر كتابة برغبته في إنهاء العمل وذلك في مدة لا تقل عن شهر, ويستحق الموظف مكافأة نهاية الخدمة بحسب ماورد في نظام العمل السعودي . </p>


                            </td>
                        </tr>
                    </table>
 <hr class="row brc-default-l1 mx-n1 mb-4" />
                    <table>
                        <tr class="heading">
                            <td colspan="2">
                                <h4 class="fontTi text-center">فترة التجربة</h4>
                            </td>
                        </tr>
                    </table>
                    <hr class="row brc-default-l1 mx-n1 mb-4" />
                    <table>
                    <tr class="heading fontT">
                            <td colspan="2">
                                <p>يخضع الطرف الثاني لفترة تجريبية مدتها <?= $user['trial_period'] ?> يكون خلالها تحت الاختبار حيث يحق للطرفان انهاء العقد دون أي التزامات مالية تترتب
                                    على ذلك . </p>
                            </td>
                        </tr>
                    </table>

                    <hr class="row brc-default-l1 mx-n1 mb-4" />

                    <table>
                        <tr class="heading">
                            <td colspan="2">
                                <h4 class="fontTi text-center">الاجازات</h4>
                            </td>
                        </tr>
                    </table>
                    <hr class="row brc-default-l1 mx-n1 mb-4" />
                    <!-- <h4>الاجازات</h4> -->
                    <table>
                    <tr class="heading fontT">
                            <td colspan="2">
                                <p>يتمتع الطرف الثاني بإجازة <?= $user['vication_year'] ?> مدتها ثلاثون يوماً
                                    مدفوعة الاجر ويجب ان يتمتع بها الطرف الثاني لحظة استحقاقها ولا يجوز له المطالبة بالتعويض عنها مالياً في حالة عدم رغبته في استحقاقها مالم يطلب منه الطرف الأول تأجيلها كتابة وذلك لحوجة العمل كما يلتزم الطرف الأول بدفع قيمة تذاكر السفر جوا مع بدل الانتقال والسكن والاعاشة اذا تم تكليف الموظف بأعمال لصالح المؤسسة في غير مقر العمل سواء اكان ذلك داخل المملكة العربية السعودية أو خارجها ما لم يتم تأمينها من قبل المؤسسة ويكون ذلك وفقا للائحة تنظيم العمل داخل المؤسسة . </p>


                            </td>
                        </tr>
                    </table>
                    <hr class="row brc-default-l1 mx-n1 mb-4" />

                    <table>
                        <tr class="heading">
                            <td colspan="2">
                                <h4 class="fontTi text-center">ساعات العمل</h4>
                            </td>
                        </tr>
                    </table>
                    <hr class="row brc-default-l1 mx-n1 mb-4" />
                    <table>
                    <tr class="heading fontT">
                            <td colspan="2">
                                <p>يعمل الطرف الثاني لدى الطرف الأول لمدة <?= $user['working_days'] ?> أيام عمل في الأسبوع
                                    بواقع <?= $user['working_hours'] ?> عمل يوميا
                                    <?php if ($user['contract_type'] == 'دوام عن بعد') echo 'بدوام عن بعد و أن يحضر لمقر المؤسسة حسب مقتضيات العمل وحاجته،';
                                    else {
                                        echo 'بدوام ' . $user['contract_type'] . ' و أن يحضر لمقر المؤسسة حسب مقتضيات العمل وحاجته ';
                                    }  ?>
                                    يتم تحديد بدايتها ونهايتها من قبل الطرف الأول، كما يحق للطرف الأول تغيير مواعيد بداية العمل ونهايته حسب الحوجة لذلك، ويحق للطرف الأول الزيادة في ساعات العمل عند الحوجة بشرط تعويض الطرف الثاني عن هذه الزيادة. </p>



                            </td>
                        </tr>
                    </table>
                    <hr class="row brc-default-l1 mx-n1 mb-4" />

                    <table>
                        <tr class="heading">
                            <td colspan="2">
                                <h4 class="fontTi text-center"> الجزاءات و الغرامات والعلاوات</h4>
                            </td>
                        </tr>
                    </table>
                    <hr class="row brc-default-l1 mx-n1 mb-4" />
                    <table>
                    <tr class="heading fontT">
                            <td colspan="2">
                                <p>يلتزم الطرف الثاني بالحفاظ على ممتلكات وعهد المؤسسة المسلمه له وفي حالة الاضرار بأي من هذه الممتلكات او العهد يتم مطالبة الطرف الثاني بالتعويض المالي جراء هذا الضرر او الإهمال وفي حالة عدم التزام الطرف الثاني بدفع هذا التعويض يحق للطرف الأول خصم قيمة هذه الاضرار من مستحقات الطرف الثاني المالية دون الرجوع اليه, كما يحق للطرف الأول إيقاع الجزاءات والعقوبات المالية المناسبة في حالة سوء السلوك وفي حال تكرار المخالفة وبعد انزار الطرف الثاني لمرتان متتاليتان يحق للطرف الأول إيقاف <br> الطرف الثاني دون تعويضه عن مكافاة نهاية الخدمة, كما يلتزم الطرف الثاني بتسليم العهد الخاصة بالطرف الأول في حالة انهاء التعاقد ويحق للطرف الأول خصم هذه العهد من مستحقاته المالية في حالة عدم تسليمها, وللطرف الأول أن يقوم بترقية الموظف أو أن تمنحه علاوة سنوية وفقاً للتقدير المطلق للطرف الأول, ولا يعد ذلك حقاً للموظف إلا بعد صدور موافقة صاحب الصلاحية للطرف الأول.</p>
                            </td>
                        </tr>
                    </table>
                    <hr class="row brc-default-l1 mx-n1 mb-4" />

                    <table>
                        <tr class="heading">
                            <td colspan="2">
                                <h4 class="fontTi text-center">عناوين التخاطب الرسمي</h4>
                            </td>
                        </tr>
                    </table>
                    <hr class="row brc-default-l1 mx-n1 mb-4" />
                    <!-- <h4>عناوين التخاطب الرسمي</h4> -->
                    <div class="row text-center">
                        <div class="col">
                            <div>

                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-6">
                                            <p class="fontTi">1-<strong>الطرف الأول</strong> </p>
                                            <p>Email: info@skypecontracting.com</p>
                                            <p>Phone: (+966 55 654 0707)</p>
                                        </div>
                                        <div class="col-6">

                                            <p class="fontTi">2-<strong>الطرف التاني</strong> </p>
                                            <p>Email: <?= $user['email'] ?></p>
                                            <p>Phone: <?= $user['phone'] ?></p>
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
                            <h4 class="fontTi">مؤسسة ركن اميال للمقاولات</h4>
                            <h4 class="fontTi">المدير العام/<?= $_SESSION['full_name'] ?></h4>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="row">
                            <h6 class="fontTi">الطرف التاني</h6>

                            <h4 class="fontTi"><?= $user['name_ar'] ?></h4>
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