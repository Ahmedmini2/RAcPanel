<?php
include('../cookies/session2.php');
$_SESSION['sidebar'] = "Factory";
if (isset($_GET['project_id'])) {

    $id = $_GET['project_id'];
    $query = "SELECT * FROM product_delivery WHERE project_id=$id";
    $res = $conn->query($query);
    $editData = $res->fetch_assoc();
    $del_id = $editData['id'];
    $product_id = $editData['product_id'];
    $quantity = $editData['quantity'];
    $deliverd_by = $editData['deliverd_by'];
    $on_date = $editData['on_date'];
    $phone = $editData['phone'];
    $truck_no = $editData['truck_no'];
    $approved_by = $editData['approved_by'];

    $query22 = "SELECT * FROM products WHERE id = $product_id";
    $res22 = $conn->query($query22);
    $editData22 = $res22->fetch_assoc();
    $product_name = $editData22['product_name'];


    $query3 = "SELECT * FROM contact_projects WHERE project_id=$id";
    $res3 = $conn->query($query3);
    $editData3 = $res3->fetch_assoc();
    $supplier_name = $editData3['supplier_name'];
    $contact_person = $editData3['contact_person'];
    $mobile = $editData3['mobile'];
    $address = $editData3['address'];
    $email = $editData3['email'];
    $vat = $editData3['vat'];
    $company_trade = $editData3['company_trade'];
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
        إذن تسليم
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

<body class="g-sidenav-show rtl ">

    <script src="../assets/js/numtowords/numtowords.js"></script>

    <!-- Side Bar -->
    <?php require_once('../components/sidebar.php'); ?>
    <!-- End Of side Bar -->

    <main class="main-content position-relative lg:max-height-vh-100 lg:h-100 mt-1 border-radius-lg overflow-hidden">
     
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="block-header bg-warning rounded col-md-3 col-sm-6 col-xs-6">

                <?php require_once('../components/notification.php'); ?>
            </div>
            <!-- Button trigger modal -->

            <div class=" justify-content-md-end">

                <button type="button" id="btn2" class=" printing btn bg-gradient-dark rounded-pill col-md-2 col-sm-6 col-xs-5 me-md-2 " onclick="printDiv('printableArea')">
                    طباعة الطلب
                    <i class="mr-1 fa fa-print text-primary-m1 text-120 w-2"></i>

                </button>
                <button type="button" id="btn3" class="printing printing2 btn bg-gradient-dark rounded-pill col-md-2 col-sm-6 col-xs-5  " data-bs-toggle="modal" data-bs-target="#exampleModal2">
                    إرفاق \ عرض الملف
                </button>
            </div>

            <script>
                function printDiv(divName) {
                    document.getElementById('btn2').style.display = "none";
                    document.getElementById('btn3').style.display = "none";

                    window.print();
                    document.getElementById('btn2').style.display = "inline";
                    document.getElementById('btn3').style.display = "inline";


                }
            </script>


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
                            <form method="post" action="../scripts/factory/update-del.php?del_id=<?=$del_id?>" enctype="multipart/form-data">
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


            <div class="invoice-box mt-8" dir="ltr">

                <div class="text-center">
                    
                    <div class="card-body">
                        <h5 class="card-title">إذن تسليم</h5>
                        <p class="card-text">DELEVARY NOTE</p>
                       
                    </div>
                    
                </div>

                <!-- here to change -->
                <div class="row ">
                    <div class="col-6">
                        <div>

                            <div>

                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-4">
                                            <p class="card-text custom-font-small">
                                                COMPANY NAME: <br>
                                                ADDRESS: <br>
                                                TEL & FAX NO: <br>
                                                P.O.REF NO: <br>

                                            </p>
                                        </div>
                                        <div class="col-8">
                                            <p class="card-text custom-font-small">
                                                <?= $supplier_name ?><br>
                                                <?= $address ?><br>
                                                <?= $mobile ?><br>
                                                PO-<?= $id ?> <br>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- == -->

                <div class="row justify-content-center">
                    <div class="col-12">
                        <div class="table-responsive p-0">
                            <table class="table table-hover table-bordered  table-fixed text-center border-dark">

                                <!--Table head-->
                                <thead class="text-light header-color custom-font-m table-bordered">
                                    <tr>
                                        <th style="color: white;">S.No.</th>
                                        <th style="color: white;">ITEM DESCRIPTION</th>
                                        <th style="color: white;">UNIT</th>
                                        <th style="color: white;">UNIT</th>

                                    </tr>
                                </thead>
                                <!--Table head-->

                                <!--Table body-->
                                <tbody>

                                    <?php
                                    $i = 0;
                                    $items = mysqli_query($conn, "SELECT * FROM products WHERE `project_id` = $id ");
                                    while ($item = mysqli_fetch_array($items)) {
                                        $i++;
                                    ?>

                                        <tr>
                                            <th class="text-center " scope="row"><?= $i ?></th>
                                            <td class="custom-font-m text-center border-1"><?= $product_name ?></td>
                                            <td class="custom-font-m border-1">Ea</td>
                                            <td class="custom-font-m border-1"><?=$quantity?></td>


                                        </tr>

                                    <?php } ?>

                                </tbody>
                                <!--Table body-->

                            </table>
                        </div>
                    </div>
                </div>

                <div class="row ">
                    <div class="col">
                        <div>

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-4">
                                        <p class="card-text custom-font-small">
                                            ISSUED BY: <br>
                                            NAME: <br>
                                            DATE: <br>
                                            SIGN: <br>
                                        </p>
                                    </div>
                                    <div class="col-8">
                                        <p class="card-text custom-font-small">
                                            <br>
                                            <?= $approved_by ?> <br>
                                            <?= $on_date ?> <br>
                                            __________________ <br>
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
                                                RECEIVED BY: <br>
                                                NAME: <br>
                                                MOBILE: <br>
                                                DATE: <br>
                                                SIGN: <br>
                                                TRUCK NO: <br>

                                            </p>
                                        </div>
                                        <div class="col-8">
                                            <p class="card-text custom-font-small">
                                                <br>
                                                <?= $deliverd_by ?> <br>
                                                <?= $phone ?><br>
                                                <?= $on_date ?> <br>
                                                __________<br>
                                                <?=$truck_no?> <br>



                                            </p>
                                        </div>
                                    </div>



                                </div>
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