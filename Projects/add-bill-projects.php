<?php
include('../cookies/session2.php');
$_SESSION['sidebar'] = "Projects";
if (!empty($_GET['edit'])) {

  $id = $_GET['edit'];
  $query = "SELECT * FROM beneficiary_info WHERE id=$id";
  $res = $conn->query($query);
  $editData = $res->fetch_assoc();
  $name = $editData['name'];
  $beneficiary_bank = $editData['beneficiary_bank'];
  $description = $editData['description'];
  $amount_text = $editData['amount_text'];
  $our_bank_name = $editData['our_bank_name'];
  $to_account_type = $editData['to_account_type'];
  $transfer_to = $editData['transfer_to'];


  $idAttr = "updateForm";

  // }else if(isset($_POST['submit'])){
  //   $name=$_POST['full_name'];
  //   $email=$_POST['email'];
  //   $phone=$_POST['phone'];
  //   $role=$_POST['role'];
  //   $password=$_POST['password'];
  //   $cpassword=$_POST['cpassword'];
  //   $username=$_POST['username'];
  //   $position=$_POST['position'];

  //   if($password == $cpassword){
  //     $query="INSERT INTO users ('')";
  //   }
} else if (isset($_POST['submit'])) {

  $name = $_POST['name'];
  $beneficiary_bank = $_POST['beneficiary_bank'];
  $account_number = $_POST['account_number'];
  $branch = $_POST['branch'];
  $iban = $_POST['iban'];
  $swift = $_POST['swift'];

  if (empty($name) || empty($beneficiary_bank) || empty($iban)) {
    $_SESSION['notification'] = "الرجاء ادخال رقم الحساب و الايبان و اسم المستفيد";
    header('location: beneficiary-banks.php');
    exit(); // Stop further execution of the script
  }

  $insert = "INSERT INTO `beneficiary_info` (`id`, `name`,`beneficiary_bank`, `branch`, `account_number`, `iban`, `swift`,`created_at`) VALUES (NULL, '$name','$beneficiary_bank','$branch','$account_number','$iban','$swift',NOW())";
  $insertResult = $conn->query($insert);
  if ($insertResult) {
    $_SESSION['notification'] = "تم اضافة المستفيد بنجاح";
  } else {
    $_SESSION['notification'] = "يوجد خلل في النظام";
  }
  header('location: beneficiary-banks.php');
  exit();
} else {
  $name = "";
  $beneficiary_bank = "";
  $account_number = "";
  $iban = "";
  $swift = "";
  $branch = "";
}

?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

  <title>
    اضافة فاتورة جديد
  </title>
  <!--     Fonts and icons     -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600;700&display=swap" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- CSS Files -->
  <link id="pagestyle" href="../assets/css/soft-ui-dashboard.css?v=1.0.3" rel="stylesheet" />
  <style>
    /* Red border */
    hr.new1 {
      border-top: 1px solid red;
    }

    /* Dashed red border */
    hr.new2 {
      border-top: 3px dashed black;
      background: blanchedalmond;

    }

    /* Dotted red border */
    hr.new3 {
      border-top: 1px dotted red;
    }

    /* Thick red border */
    hr.new4 {
      border: 1px solid red;
    }

    /* Large rounded green border */
    hr.new5 {
      border: 10px solid green;
      border-radius: 5px;
    }
  </style>
</head>

<body class="g-sidenav-show rtl ">

  <!-- Side Bar -->
  <?php require_once('../components/sidebar.php'); ?>
  <!-- End Of side Bar -->
  <main class="main-content position-relative lg:max-height-vh-100 lg:h-100 mt-1 border-radius-lg overflow-hidden">
    <!-- Navbar -->
    <?php
    $titleNav = 'اضافة فاتورة جديد';
    require_once('../components/navbar.php');
    ?>
    <!-- End Navbar -->
    <div class="container-fluid py-4">
      <div class="row">
        <div class="block block-themed">

          <div class="block-header bg-gradient-dark col-lg-3 col-md-5 col-sm-5 col-xs-4  rounded-pill">
            <h5 class="block-title text-white py-2 px-4 ">اضافة فاتورة جديد</h5>
          </div>
          <form id="<?php echo $idAttr; ?>" action="" method="post">
            <div class="row">
              <div class="col-md-6 col-sm-6">
                <div class="form-group">
                  <label>أسم الفاتورة</label>
                  <input type="text" placeholder="الرجاء كتابة أسم فاتورة" class="form-control" name="bill" value="<?php echo $name; ?>">
                </div>
              </div>
              <div class="col-md-6 col-sm-6">
                <div class="form-group">
                  <label> مقدم الفاتورة</label>
                  <input type="text" placeholder="الرجاء كتابة مقدم الفاتورة" class="form-control" name="user_bill" value="<?php echo $beneficiary_bank; ?>">
                </div>
              </div>
              <div class="col-md-6 col-sm-6">
                <div class="form-group">
                  <label> سعر الفاتورة</label>
                  <input type="text" placeholder="الرجاء كتابة سعر الفاتورة" class="form-control" name="price_bill" value="<?php echo $beneficiary_bank; ?>">
                </div>
              </div>
              <div class="col-md-6 col-sm-6">
                <div class="form-group">
                  <label> تاريخ الفاتورة</label>
                  <input type="text" placeholder="الرجاء كتابة تاريخ الفاتورة" class="form-control" name="date_bill" value="<?php echo $beneficiary_bank; ?>">
                </div>
              </div>
              <label> اضافة صورة الفاتورة </label>
              <button type="button" id="btn3" class=" col-md-4 col-sm-6 text-white printing printing2 btn bg-secondary rounded-pill " data-bs-toggle="modal" data-bs-target="#exampleModal2">
                الرجاء اضافة صورة الفاتورة
              </button>
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
            </div>

        </div>
      </div>
    </div>
    </div>
    <!-- Product End -->


    <div class="col text-center">

      <style>
        .myButton {
          border: none;
          cursor: pointer;
          background: #8392AB;
          color: #fff;
          border-radius: 20px;
          transition: 0.5s;
        }

        .myButton:hover {
          background: #344767;
          letter-spacing: 1px;
        }
      </style>
      <button type="submit" name="submit" class="myButton col-md-4 col-sm-9 mt-5 btn btn-secondary rounded-pill"> حفظ </button>

    </div>

    </form>

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
  <script src="script.js"></script>
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
  <script src="../Admin/darkmode.js"></script>
</body>

</html>