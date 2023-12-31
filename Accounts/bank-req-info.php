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
    عرض التعميد
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
      padding-top: 40px !important;
      position: relative;
      font-size :small;
      text-align: right !important;
    }

    .row2 {
      position: relative;
      left: 5%;
      text-align: right !important;
      padding-top: 40px !important;
      font-size :small;
    }

    .invoice-box table {
      width: 100%;
      line-height: inherit;

    }

    .invoice-box table td {
      padding: 5px;
      vertical-align: top;
      font-size :small;
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

    .printing {
      position: absolute;
      left: 10px;
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

      <button type="button" id="btn1" class=" btn bg-gradient-dark rounded-pill " data-bs-toggle="modal" data-bs-target="#exampleModal">
        تغير حالة الطلب
      </button>
      <button type="button" id="btn2" class=" printing btn bg-gradient-dark rounded-pill  " onclick="printDiv('printableArea')">
        طباعة الطلب
        <i class="mr-1 fa fa-print text-primary-m1 text-120 w-2"></i>

      </button>
      <button type="button" id="btn3" class="printing printing2 btn bg-gradient-dark rounded-pill  " data-bs-toggle="modal" data-bs-target="#exampleModal2">
        إرفاق \ عرض الملف
      </button>






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
                <?php if ($position == 'Admin' || $position == 'Accounts' || $position == 'Manager' && $status == 2) { ?> <button type="submit" name="manager" class="btn bg-gradient-dark rounded-pill" data-bs-toggle="modal" data-bs-target="#exampleModal">
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
        <div class="row">
          <div class="col-12">
            <div class="text-center text-150">

              <img src="../assets/img/logos/logo-gold.png" style="width: 100%; max-width: 200px" />
            </div>
          </div>
        </div>

        <hr class="row brc-default-l1 mx-n1 mb-4" />

        <table cellpadding="0" cellspacing="0">

          <tr class="top">
            <td colspan="2">
              <table>
                <tr>
                  <td class="row1">
                    فاتورة رقم :#<?= $id ?><br />
                    بتاريخ : <?= $created_at ?><br />
                    تم التحديث بتاريخ : <?= $updated_at ?><br />
                    حالة الطلب : <?php if ($status == 1) {
                                    echo "<span class='badge badge-sm bg-gradient-success'>طلب تعميد جديد</span>";
                                  } elseif ($status == 2) {
                                    echo "<span class='badge badge-sm bg-gradient-success'>تم تأكيد الطلب عن طريق المحاسب</span>";
                                  } else {
                                    echo "<span class='badge badge-sm bg-gradient-success'>تم التأكيد </span>";
                                  } ?><br />
                  </td>
                  <td class="row2" style="width:30%">

                    <?php if ($to_account_type != '0') {
                      echo "الى المستفيد : " . $transfer_to; ?><br />
                      <?php echo "أسم الحساب: " . $beneficiary_bank; ?><br />
                      <?php echo "رقم الحساب : " . $account_number; ?><br />
                    <?php echo "رقم الأيبان : " . $iban;
                    } ?>
                  </td>
                </tr>
              </table>
            </td>
          </tr>

          <tr class="information">
            <td colspan="2">
              <table>
                <tr>



                  <td style="width:65%">
                    نوع الطلب : <?php if ($name == '1') {
                                  echo "طلب تحويل";
                                } elseif ($name == 2) {
                                  echo "طلب سحب مبلغ";
                                } elseif ($name == 3) {
                                  echo "طلب شيك بنكي";
                                } elseif ($name == 4) {
                                  echo "تسديد فاتورة إلكترونية";
                                } ?><br />
                    <p class="pt-2">ملاحظات الطلب : <?= $description ?> </p>
                  </td>


                </tr>
              </table>

            </td>
          </tr>

          <tr class="heading">
            <td>المبلغ كتابة</td>

            <td class="row2"></td>
          </tr>

          <tr class="details">
            <td><?= $amount_text ?></td>

            <td class="row2"></td>
          </tr>

          <tr class="heading">
            <td>المبلغ بالأرقام</td>

            <td class="row2"></td>
          </tr>

          <tr class="item">
            <td><?= $amount_number ?></td>

            <td class="row2"></td>
          </tr>




        </table>

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