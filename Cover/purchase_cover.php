<?php
include('../cookies/session2.php');
$_SESSION['sidebar'] = "Cover";
if (isset($_GET['id'])) {

    $id = $_GET['id'];
    $query = "SELECT * FROM covers_purchase WHERE purchase_id=$id LIMIT 1";
    $res = $conn->query($query);
    $editData = $res->fetch_assoc();
    $type = $editData['type'];
    $dimensions = $editData['dimensions'];
    $purchase_id = $editData['purchase_id'];
    $quantity = $editData['quantity'];
    $price_per_peice = $editData['price_per_piece'];

    $seller = $editData['seller'];
    $query2 = "SELECT * FROM contact_covers WHERE id=$seller";
    $res2 = $conn->query($query2);
    $seller_data = $res2->fetch_assoc();
    $name = $seller_data['name'];
    $seller_name = $seller_data['seller'];
    $address = $seller_data['address'];
    $phone = $seller_data['phone'];
    $email = $seller_data['email'];
    $created_at = $editData['created_at'];
}



?>
<!DOCTYPE html>
<html lang="en" dir="rtl">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../assets/img/favicon.png">
    <title>
        امر الشراء
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
    <style>
        body, html {
            width: 100%;
            height: 100%;
        }

        .print {
            position: fixed;
            overflow: visible !important;
            width: 100%;
            height: 100%;
            z-index: 100000; /* CSS doesn't support infinity */

            /* Any other Print Properties */
        }
        .invoice-box {
            max-width: 1200px;
            margin: auto;


           
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

    <script src="../assets/js/numtowords/numtowords.js"></script>

    <!-- Side Bar -->
    <?php require_once('../components/sidebar.php'); ?>
    <!-- End Of side Bar -->

    <main class="main-content position-relative lg:max-height-vh-100 lg:h-100 mt-1 border-radius-lg overflow-hidden">
        <!-- Navbar -->
        <!-- <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 ">
            <li class="breadcrumb-item text-sm ps-2"><a class="opacity-5 text-dark" href="javascript:;">عرض التعميد</a></li>
            
          </ol>

        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 px-0" id="navbar">
          <div class="ms-md-auto pe-md-3 d-flex align-items-center">
            <div class="input-group">
              <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
              <input type="text" class="form-control" placeholder="أكتب هنا...">
            </div>
          </div>
          <ul class="navbar-nav me-auto ms-0 justify-content-end">
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
                <i class="fa fa-cog fixed-plugin-button-nav cursor-pointer"></i>
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
      </div>
    </nav> -->
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="block-header bg-warning rounded col-md-3 col-sm-6 col-xs-6">

                <?php require_once('../components/notification.php'); ?>
            </div>
            <!-- Button trigger modal -->



            <button type="button" id="btn2" class=" printing btn bg-gradient-dark rounded-pill col-md-2 col-sm-6 col-xs-5 me-md-2 " onclick="printDiv('invoice-box')">
                طباعة الطلب
                <i class="mr-1 fa fa-print text-primary-m1 text-120 w-2"></i>

            </button>
            <button type="button" id="btn3" class="printing printing2 btn bg-gradient-dark rounded-pill col-md-2 col-sm-6 col-xs-5  " data-bs-toggle="modal" data-bs-target="#exampleModal2">
                إرفاق \ عرض الملف
            </button>
            <a href="review_orders.php?cover_id=<?= $id ?>" id="btn4" class="  btn bg-gradient-dark rounded-pill col-md-2 col-sm-6 col-xs-5  ">
                مراجعه الطلبيات
            </a>


            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script>
                function printDiv(divName) {
                    document.getElementById('btn2').style.display = "none";
                    document.getElementById('btn3').style.display = "none";
                    document.getElementById('btn4').style.display = "none";
                    document.getElementById('signture3').style.backgroundColor = "#ffffff00";
                    document.getElementById('signture4').style.backgroundColor = "#ffffff00";
                    
                        var $print = $(divName)
                            .clone()
                            .addClass('print2')
                            .prependTo('body');

                    window.print();

                        $print.remove();
                    document.getElementById('btn2').style.display = "inline";
                    document.getElementById('btn3').style.display = "inline";
                    document.getElementById('btn4').style.display = "inline";
                    document.getElementById('signture3').style.backgroundColor = "white";
                    document.getElementById('signture4').style.backgroundColor = "white";

                }
                
            </script>

            <!-- Change Status Modal -->


            <!-- Doc Modal -->
            <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">أرفاق مستند</h5>
                            <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close" style="position: relative;left: 0%;right: 80%;">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="post" action="../scripts/update-status/update.php?bank_req=<?= $id ?>" enctype="multipart/form-data">
                                <input type="file" name="fileToUpload" id="fileToUpload" class="form-control">
                                <input type="submit" value="Upload Image" name="upload" class="btn bg-gradient-dark m-4 rounded-pill">
                                <?php if ($doc != '') {
                                    echo '<a href="../Signed-Docs/' . $id . '/' . $doc . '" target="_blank"><img src="../Signed-Docs/' . $id . '/' . $doc . '" class="img-fluid rounded-top" alt="' . $doc . '"></a>';
                                } ?>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal2">Close</button>
                            <button type="button" class="btn bg-gradient-dark rounded-pill">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>


            <div class="invoice-box" dir="ltr">


                <!-- == -->
                <div class="row">
                    <div>
                        <div class="card-header text-center text-white header-color" style="margin-top: 120px;">
                            Purchase Order
                        </div>

                    </div>
                </div>

                <div class="row ">
                    <div class="col-6 ">
                        <div>

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-4">
                                        <p class="card-text custom-font-small">
                                            Buyer:<br>
                                            Receiver name:<br>
                                            Tel / mobile:<br>
                                            Address:<br>
                                            E-mail:<br>

                                        </p>
                                    </div>
                                    <div class="col-8">
                                        <p class="card-text custom-font-small">
                                            Rukn Amial Co.Company <br>
                                            Abbas Al Jafari <br>
                                            591022703 <br>
                                            Al Malaz-Jareer Street <br>
                                            info@ruknamyal.com<br>


                                        </p>
                                    </div>
                                </div>



                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div>

                            <div>

                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-4">
                                            <p class="card-text custom-font-small">
                                                Data: <br>
                                                P.O number:<br>
                                                Supplier name:<br>
                                                Email:<br>
                                                Tel / mobile:<br>
                                                Address:<br>
                                            </p>
                                        </div>
                                        <div class="col-8">
                                            <p class="card-text custom-font-small">
                                                <?= $created_at ?><br>
                                                CO-<?= $id ?> <br>
                                                <?= $name ?><br>
                                                <?= $email ?><br>
                                                <?= $phone ?><br>
                                                <?= $address ?><br>


                                            </p>
                                        </div>
                                    </div>



                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- == -->

                <div class="row mt-5 justify-content-center">
                    <div class="col-12">
                        <div class="table-responsive p-0">
                            <table class="table table-hover table-bordered table-fixed text-center border-dark">

                                <!--Table head-->
                                <thead class="text-light header-color custom-font-m">
                                    <tr>
                                        <th style="color: white;">S.No.</th>
                                        <th style="color: white;">TYPE</th>
                                        <th style="color: white;">Dimensions</th>
                                        <th style="color: white;">Quantity</th>
                                        <th style="color: white;">PRICE</th>
                                        <th style="color: white;">Total price</th>
                                    </tr>
                                </thead>
                                <!--Table head-->

                                <!--Table body-->
                                <tbody>

                                    <?php

                                    $covers = mysqli_query($conn, "SELECT * FROM covers_purchase WHERE purchase_id = $purchase_id");
                                    $i = 0;
                                    while ($cover = mysqli_fetch_array($covers)) {
                                        $i++;
                                        $total_price += $cover['total_price'];
                                    ?>

                                        <tr>
                                            <th scope="row" class=" border-1"><?= $i ?></th>
                                            <td class="custom-font-m text-center border-1"><?= $cover['type'] ?></td>
                                            <td class="custom-font-m border-1"><?= $cover['dimensions'] ?></td>
                                            <td class="custom-font-m border-1"><?= $cover['quantity'] ?></td>
                                            <td class="custom-font-m border-1"><?= $cover['price_per_piece'] ?></td>
                                            <td class="custom-font-m borSder-1"><?= $cover['total_price'] ?></td>

                                        </tr>

                                    <?php } ?>
                                    <tr>
                                        <td colspan="5">
                                            <div class="text-center">

                                                <span class="text-black">Total</span>

                                            </div>
                                        </td>
                                        <td>
                                            <div class="text-center text-black">
                                                <span>SAR <?= number_format($total_price) ?></span>
                                            </div>
                                        </td>
                                    </tr>




                                    <tr>
                                        <td colspan="5">
                                            <div class="text-center">

                                                <span class="text-black">VAT %15</span>

                                            </div>
                                        </td>
                                        <td>
                                            <div class="text-center text-black">
                                                <span>SAR <?= number_format(($total_price * 15) / 100) ?></span>
                                            </div>
                                        </td>
                                    </tr>


                                    <tr>
                                        <td colspan="5" class=" border-1">
                                            <div class="text-center">

                                                <span class="text-black">Grand total(SAR)</span>

                                            </div>
                                        </td>
                                        <td class=" border-1">
                                            <div class="text-center">
                                                <span class="font-weight-bold text-success" id="total"><?= number_format($total_price + (($total_price * 15) / 100)) ?></span>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                                <!--Table body-->

                            </table>
                        </div>
                    </div>
                </div>



                <div class="row">
                    <div class="col text-center">
                        <p>The total value is SAR <?= number_format($total_price + (($total_price * 15) / 100)) ?> <span id="con"></span> riyals only.</p>
                    </div>
                </div>
                <script>
                    function changeVal() {

                        value = <?= number_format($total_price + (($total_price * 15) / 100), 0, "", "") ?>;
                        document.getElementById("con").innerText = numToWords(value);
                        console.log(value);

                    }
                    window.onload = changeVal;
                </script>
                <hr>
                <ul class="list-unstyled">
                    <li class="font-weight-bold">Specil terms:
                        <ul>
                            <li>All materials should be as per approved.</li>
                            <li>Advanced Payment 50%</li>

                        </ul>
                    </li>

                </ul>





                <div class="row text-center">

                    <div class="col-6">
                        <div class="row">
                            <h6>Prepared by</h6>
                            
                        </div>
                        <div class="row">
                            <div class="col text-center text-bolder">
                                <p><?= $payment_type ?>.</p>
                                <input type="text" class="signture signture2" id="signture3" />
                            </div>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="row">
                            <h6>Approved by</h6>
                        </div>
                        <div class="row">
                    <div class="col text-center text-bolder">
                        <p><?= $payment_type ?>.</p>
                        <input type="text" class="signture signture2" id="signture4" />
                    </div>
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
</body>

</html>