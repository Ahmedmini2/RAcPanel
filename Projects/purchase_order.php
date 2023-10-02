<?php
include('../cookies/session2.php');
$_SESSION['sidebar'] = "Accounts";
if (isset($_GET['bank_req'])) {

    $id = $_GET['bank_req'];
    $query = "SELECT * FROM bank_request WHERE id=$id";
    $res = $conn->query($query);
    $editData = $res->fetch_assoc();
    $name = $editData['name'];
    $description = $editData['description'];
    $amount_text = $editData['amount_text'];
    $amount_number = $editData['amount_number'];
    $our_bank_name = $editData['our_bank_name'];
    $to_account_type = $editData['to_account_type'];
    $transfer_to = $editData['transfer_to'];
    $status = $editData['status'];
    $created_at = $editData['created_at'];
    $updated_at = $editData['updated_at'];
    $accepted_at = $editData['accepted_at'];
    $doc = $editData['doc'];

    if ($to_account_type != '0') {
        $benf_info = "SELECT * FROM beneficiary_info WHERE name = '$transfer_to'";
        $res2 = $conn->query($benf_info);
        $editData2 = $res2->fetch_assoc();

        $beneficiary_bank = $editData2['beneficiary_bank'];
        $account_number = $editData2['account_number'];
        $iban = $editData2['iban'];
    }
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
        .invoice-box {
            max-width: 1200px;
            margin: auto;
            padding: 30px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
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

                    document.getElementById('btn1').style.display = "none";
                    document.getElementById('btn2').style.display = "none";
                    document.getElementById('btn3').style.display = "none";
                    window.print();
                    document.getElementById('btn1').style.display = "inline";
                    document.getElementById('btn2').style.display = "inline";
                    document.getElementById('btn3').style.display = "inline";

                }
            </script>

            <!-- Change Status Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">حالة الطلب</h5>
                            <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close" style="position: relative;left: 0%;right: 80%;">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="post" action="../scripts/update-status/update.php?bank_req=<?= $id ?>">
                                <?php if ($position == 'Admin' || $position == 'Accounts' && $status == 1) { ?> <button type="submit" name="account" class="btn bg-gradient-dark rounded-pill" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                        تأكيد التعميد عن طريق المحاسب
                                    </button>
                                <?php } ?>
                                <br>
                                <?php if ($position == 'Admin' || $position == 'Manager' && $status == 2) { ?> <button type="submit" name="manager" class="btn bg-gradient-dark rounded-pill" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                        تأكيد التعميد عن طريق طريق المدير العام
                                    </button>
                                <?php } ?>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>

                        </div>
                    </div>
                </div>
            </div>

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


            <div class="invoice-box">
                <table cellpadding="0" cellspacing="0">

                    <tbody>
                        <tr class="top">
                            <td colspan="2">
                                <table>

                                    <tbody>
                                        <tr>
                                            <td class="row1">
                                                شركة ركن اميال للمقاولات<br>
                                                شارع الرياض <br>
                                                السعودية-الرياض<br>
                                                الهاتف :055628295<br>
                                            </td>
                                            <td class="title">
                                                <img src="../assets/img/logos/logo-gold.png" style="width: 100%; max-width: 200px">
                                            </td>


                                        </tr>
                                    </tbody>

                                </table>
                            </td>
                        </tr>

                        <tr class="information">
                            <td colspan="2">
                                <table class="table table-bordered">
                                    <thead class="thead" style="background:#3A416F">
                                        <tr>
                                            <th scope="col" style="color: white;">VENDOR</th>
                                            <th scope="col" style="color: white;" a>SHIP TO</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td style="width:50%">
                                                اسم الشركة<br>
                                                الاتصال أو القسم <br>
                                                شارع الرياض <br>
                                                السعودية-الرياض<br>
                                                الهاتف :055628295<br>

                                            </td>

                                            <td class="row2" style="width:50%">
                                                اسم <br>
                                                اسم الشركة<br>
                                                الاتصال أو القسم <br>
                                                شارع الرياض <br>
                                                السعودية-الرياض<br>
                                                الهاتف :055628295<br>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                            </td>
                        </tr>

                        <tr class="heading">
                            <table class="table table-bordered">
                                <thead style="background:#3A416F">
                                    <tr>
                                        <th style="color: white;" scope="col">REQUISITIONER</th>
                                        <th style="color: white;" scope="col">SHIP VIA</th>
                                        <th style="color: white;" scope="col">F.O.B</th>
                                        <th style="color: white;" Ascope="col">SHIPPING TERMS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">1</th>
                                        <td>Mark</td>
                                        <td>Otto</td>
                                        <td>@mdo</td>
                                    </tr>
                                </tbody>
                            </table>
                        </tr>

                        <div class="row mt-5">
                            <div class="col-12">
                                <div class="card mb-4">
                                    <div class="card-header pb-0">
                                        <h6>الاصناف</h6>
                                    </div>
                                    <div class="card-body px-0 pt-0 pb-2 mx-3">
                                        <div class="table-responsive p-0">
                                            <table class="table table-hover table-fixed">

                                                <!--Table head-->
                                                <thead class="bg-dark text-light">
                                                    <tr>
                                                        <th>الرقم</th>
                                                        <th>الاسم</th>
                                                        <th>الابعاد</th>
                                                        <th>التوصيل</th>
                                                        <th>التكلفة</th>
                                                        <th>صافي الربح</th>
                                                        <th>الكمية</th>
                                                        <th>تم الانتاج</th>
                                                    </tr>
                                                </thead>
                                                <!--Table head-->

                                                <!--Table body-->
                                                <tbody>
                                                    <tr>
                                                        <th scope="row">1</th>
                                                        <td>خرسانه</td>
                                                        <td>6*6</td>
                                                        <td>200</td>
                                                        <td>3460</td>
                                                        <td>6000</td>
                                                        <td>12</td>
                                                        <td>اليوم</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">2</th>
                                                        <td>خرسانه</td>
                                                        <td>4*4</td>
                                                        <td>800</td>
                                                        <td>4675</td>
                                                        <td>8000</td>
                                                        <td>5</td>
                                                        <td>اليوم</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">3</th>
                                                        <td>Gary</td>
                                                        <td>Winogrand</td>
                                                        <td>Germany</td>
                                                        <td>Berlin</td>
                                                        <td>Photographer</td>
                                                        <td>37</td>
                                                        <td>41</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">4</th>
                                                        <td>Angie</td>
                                                        <td>Smith</td>
                                                        <td>USA</td>
                                                        <td>San Francisco</td>
                                                        <td>Teacher</td>
                                                        <td>52</td>
                                                        <td>41</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">5</th>
                                                        <td>John</td>
                                                        <td>Mattis</td>
                                                        <td>France</td>
                                                        <td>Paris</td>
                                                        <td>Actor</td>
                                                        <td>28</td>
                                                        <td>41</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">6</th>
                                                        <td>Otto</td>
                                                        <td>Morris</td>
                                                        <td>Germany</td>
                                                        <td>Munich</td>
                                                        <td>Singer</td>
                                                        <td>35</td>
                                                        <td>41</td>
                                                    </tr>
                                                </tbody>
                                                <!--Table body-->

                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <tr class="col col-md-2 col-sm-6 col-xs-6">
                        <div class="row my-2 mx-1 justify-content-center">
                            <table class="table table-striped table-borderless">
                                <thead style="background-color:#84B0CA ;" class="text-white">
                                    <tr>
                                        <th style="color: white;" scope="col">TOTAL</th>
                                        <th style="color: white;" scope="col">UNIT PRICE</th>
                                        <th style="color: white;" scope="col">QTY</th>
                                        <th style="color: white;" scope="col">DESCRIPTION</th>
                                        <th style="color: white;" scope="col">ITEM#</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>2.250.00</td>
                                        <td>150.00</td>
                                        <td>15</td>
                                        <td>Product AAA</td>
                                        <td>[561382]</td>
                                    </tr>
                                    <tr>
                                    <td>75.00</td>
                                        <td>75.00</td>
                                        <td>1</td>
                                        <td>Product zzz</td>
                                        <td>[6564213]</td>
                                    </tr>
                                    <tr>
                                        <td>2.250.00</td>
                                        <td>150.00</td>
                                        <td>15</td>
                                        <td>Product AAA</td>
                                        <td>[561382]</td>
                                    </tr>
                                </tbody>

                            </table>
                        </div>
                        <div class="row">
                        <div class="col-xl-7">
                                <ul class="list-unstyled">
                                    <li class="text-muted ms-3"><span class="text-black me-4">SubTotal</span>$1110</li>
                                    <li class="text-muted ms-3 mt-2"><span class="text-black me-4">Tax(15%)</span>$111</li>
                                </ul>
                                <p class="text-black float-end"><span class="text-black me-3"> Total Amount</span><span style="font-size: 25px;">$1221</span></p>
                            </div>
                            <div class="col-xl-5">
                                <p class="ms-3">Add additional notes and payment information</p>

                            </div>
                            
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-xl-10">
                                <p>Thank you for your purchase</p>
                            </div>
                        </div>
                        </tr>

                        

                        

                        




                    </tbody>
                </table>

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
                <table>

                </table>

            </div>



        </div>


        </div>
    </main>
    <div class="fixed-plugin">
        <a class="fixed-plugin-button text-dark position-fixed px-3 py-2">
            <i class="fa fa-cog py-2"> </i>
        </a>
        <div class="card shadow-lg ">
            <div class="card-header pb-0 pt-3 ">
                <div class="float-end">
                    <h5 class="mt-3 mb-0">Soft UI Configurator</h5>
                    <p>See our dashboard options.</p>
                </div>
                <div class="float-start mt-4">
                    <button class="btn btn-link text-dark p-0 fixed-plugin-close-button">
                        <i class="fa fa-close"></i>
                    </button>
                </div>
                <!-- End Toggle Button -->
            </div>
            <hr class="horizontal dark my-1">
            <div class="card-body pt-sm-3 pt-0">
                <!-- Sidebar Backgrounds -->
                <div>
                    <h6 class="mb-0">Sidebar Colors</h6>
                </div>
                <a href="javascript:void(0)" class="switch-trigger background-color">
                    <div class="badge-colors my-2 text-end">
                        <span class="badge filter bg-gradient-primary active" data-color="primary" onclick="sidebarColor(this)"></span>
                        <span class="badge filter bg-gradient-dark" data-color="dark" onclick="sidebarColor(this)"></span>
                        <span class="badge filter bg-gradient-info" data-color="info" onclick="sidebarColor(this)"></span>
                        <span class="badge filter bg-gradient-success" data-color="success" onclick="sidebarColor(this)"></span>
                        <span class="badge filter bg-gradient-warning" data-color="warning" onclick="sidebarColor(this)"></span>
                        <span class="badge filter bg-gradient-danger" data-color="danger" onclick="sidebarColor(this)"></span>
                    </div>
                </a>
                <!-- Sidenav Type -->
                <div class="mt-3">
                    <h6 class="mb-0">Sidenav Type</h6>
                    <p class="text-sm">Choose between 2 different sidenav types.</p>
                </div>
                <div class="d-flex">
                    <button class="btn bg-gradient-primary w-100 px-3 mb-2 active" data-class="bg-transparent" onclick="sidebarType(this)">Transparent</button>
                    <button class="btn bg-gradient-primary w-100 px-3 mb-2 me-2" data-class="bg-white" onclick="sidebarType(this)">White</button>
                </div>
                <p class="text-sm d-xl-none d-block mt-2">You can change the sidenav type just on desktop view.</p>
                <!-- Navbar Fixed -->
                <div class="mt-3">
                    <h6 class="mb-0">Navbar Fixed</h6>
                </div>
                <div class="form-check form-switch ps-0">
                    <input class="form-check-input mt-1 float-end me-auto" type="checkbox" id="navbarFixed" onclick="navbarFixed(this)">
                </div>
                <hr class="horizontal dark my-sm-4">
                <a class="btn bg-gradient-dark w-100" href="https://www.creative-tim.com/product/soft-ui-dashboard-pro">Free Download</a>
                <a class="btn btn-outline-dark w-100" href="https://www.creative-tim.com/learning-lab/bootstrap/license/soft-ui-dashboard">View documentation</a>
                <div class="w-100 text-center">
                    <a class="github-button" href="https://github.com/creativetimofficial/soft-ui-dashboard" data-icon="octicon-star" data-size="large" data-show-count="true" aria-label="Star creativetimofficial/soft-ui-dashboard on GitHub">Star</a>
                    <h6 class="mt-3">Thank you for sharing!</h6>
                    <a href="https://twitter.com/intent/tweet?text=Check%20Soft%20UI%20Dashboard%20made%20by%20%40CreativeTim%20%23webdesign%20%23dashboard%20%23bootstrap5&amp;url=https%3A%2F%2Fwww.creative-tim.com%2Fproduct%2Fsoft-ui-dashboard" class="btn btn-dark mb-0 me-2" target="_blank">
                        <i class="fab fa-twitter me-1" aria-hidden="true"></i> Tweet
                    </a>
                    <a href="https://www.facebook.com/sharer/sharer.php?u=https://www.creative-tim.com/product/soft-ui-dashboard" class="btn btn-dark mb-0 me-2" target="_blank">
                        <i class="fab fa-facebook-square me-1" aria-hidden="true"></i> Share
                    </a>
                </div>
            </div>
        </div>
    </div>
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