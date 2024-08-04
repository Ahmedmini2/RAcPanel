<?php
include('../cookies/session2.php');
$_SESSION['sidebar'] = "Accounts";
if (!empty($_GET['edit'])) {

  $id = $_GET['edit'];
  $query = "SELECT * FROM bank_request WHERE id=$id";
  $res = $conn->query($query);
  $editData = $res->fetch_assoc();
  $name = $editData['name'];
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
  $account_number = $_POST['account_number'];
  $branch = $_POST['branch'];
  $iban = $_POST['iban'];
  $swift = $_POST['swift'];

  if (empty($name) || empty($account_number) || empty($iban)) {
    $_SESSION['notification'] = "الرجاء ادخال رقم الحساب ورقم الايبان واسم البنك";
    header('location: company-banks.php');
    exit(); // Stop further execution of the script
  }

  $insert = "INSERT INTO `bank_info` (`id`, `name`, `branch`, `account_number`, `iban`, `swift`,`created_at`) VALUES (NULL, '$name','$branch','$account_number','$iban','$swift',NOW())";
  $insertResult = $conn->query($insert);
  if ($insertResult) {
    $_SESSION['notification'] = "تم اضافة الحساب بنجاح";
  } else {
    $_SESSION['notification'] = "يوجد خلل في النظام";
  }
  header('location: company-banks.php');
  exit();
} else {
  $name = "";
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
  <title>
    أضافة حساب شركة جديد
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
</head>

<body class="g-sidenav-show rtl">

  <!-- Side Bar -->
  <?php require_once('../components/sidebar.php'); ?>
  <!-- End Of side Bar -->
  <main class="main-content position-relative lg:max-height-vh-100 lg:h-100 mt-1 border-radius-lg overflow-hidden">
    <!-- Navbar -->
    <?php 
     $titleNav = 'أضافة حساب شركة جديد'; 
     require_once('../components/navbar.php');
     ?>
    <!-- End Navbar -->
    <div class="container-fluid py-4">
      <div class="row">
        <div class="block block-themed">

          <div class="block-header bg-gradient-dark  col-md-3 col-sm-6 col-xs-6 rounded-pill">

            <h6 class="block-title text-white  py-2 px-4">إضافة حساب شركة جديد</h6>
          </div>
          <form id="<?php echo $idAttr; ?>" action="" method="post">
            <div class="row">
              <div class="col">
                <div class="form-group">
                  <label>أسم البنك</label>
                  <input type="text" placeholder="الرجاء كتابة أسم البنك" class="form-control" name="name" value="<?php echo $name; ?>">



                </div>
              </div>

            </div>
            <div class="row">
              <div class="col">
                <div class="form-group">
                  <label> أسم الفرع</label>
                  <input type="text" placeholder="الرجاء كتابةأسم الفرع " class="form-control" name="branch" value="<?php echo $branch; ?>">

                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-6">
                <div class="form-group">
                  <label>رقم الحساب</label>
                  <input type="text" placeholder="الرجاء كتابة رقم الحساب" class="form-control" name="account_number" value="<?php echo $account_number; ?>">
                </div>
              </div>
              <div class="col">
                <div class="form-group">
                  <label>الأيبان</label>
                  <input type="text" placeholder="ادخل رقم الايبان" class="form-control" name="iban" value="<?php echo $iban; ?>">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col">
                <div class="form-group">
                  <label>السويفت</label>
                  <input type="text" placeholder="ادخل السويفت كود" class="form-control" name="swift" value="<?php echo $swift; ?>">
                </div>
              </div>

            </div>



            <div class="row">
              <div class="col">
                <div class="form-group">
                  <button type="submit" name="submit" class="btn btn-secondary">تقديم طلب تسجيل حساب بنك</button>
                </div>
              </div>
              <div class="col">

              </div>
            </div>
          </form>
        </div>
      </div>
      <?php require_once('../components/footer.php'); ?>
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
  <script src="../Admin/darkmode.js"></script>
</body>

</html>