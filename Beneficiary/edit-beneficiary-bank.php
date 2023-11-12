<?php
include('../cookies/session2.php');
$_SESSION['sidebar'] = "Accounts";

$id = $_GET['bank_id'];
$query = "SELECT * FROM beneficiary_info WHERE id=$id";
$res = $conn->query($query);
$editData = $res->fetch_assoc();
$name = $editData['name'];
$beneficiary_bank = $editData['beneficiary_bank'];
$branch = $editData['branch'];
$account_number = $editData['account_number'];
$iban = $editData['iban'];
$swift = $editData['swift'];



$idAttr = "updateForm";
if (isset($_POST['edit'])) {
  $name = $_POST['name'];
  $beneficiary_bank = $_POST['beneficiary_bank'];
  $branch = $_POST['branch'];
  $account_number = $_POST['account_number'];
  $iban = $_POST['iban'];
  $swift = $_POST['swift'];

  $update = "UPDATE beneficiary_info SET `name`='$name', `beneficiary_bank`='$beneficiary' , `branch`='$branch' , `account_number`='$account_number' , `iban`='$iban' , `swift`='$swift' WHERE `id`=$id";
  $updateResult = $conn->query($update);
  $idAttr = "updateForm";
  if ($updateResult) {
    $_SESSION['notification'] = "تم تعديل حساب المستفيد بنجاح";
  } else {
    $_SESSION['notification'] = "يوجد خلل في النظام";
  }
}
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


?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <title>
    تعديل حساب مستفيد
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
</head>

<body class="g-sidenav-show rtl bg-gray-100">

  <!-- Side Bar -->
  <?php require_once('../components/sidebar.php'); ?>
  <!-- End Of side Bar -->
  <main class="main-content position-relative lg:max-height-vh-100 lg:h-100 mt-1 border-radius-lg overflow-hidden">
    <!-- Navbar -->
    <?php
    $titleNav = 'تعديل حساب مستفيد';
    require_once('../components/navbar.php');
    ?>
    <!-- End Navbar -->
    <div class="container-fluid py-4">
      <div class="row">
        <div class="block block-themed">
          <div class="block-header bg-gradient-dark  col-md-3 col-sm-6 col-xs-6  rounded-pill">

            <?php require_once('../components/notification.php'); ?>
          </div>
          <div class="block-header bg-gradient-dark  col-md-2 col-sm-6 col-xs-6  rounded-pill">

            <h5 class="block-title text-white py-2 px-3">إضافة حساب مستفيد جديد</h5>
          </div>
          <form id="<?php echo $idAttr; ?>" action="" method="post">
            <div class="row">
              <div class="col">
                <div class="form-group">
                  <label>أسم المستفيد</label>
                  <input type="text" placeholder="الرجاء كتابة أسم البنك" class="form-control" name="name" value="<?php echo $name; ?>">



                </div>
              </div>

            </div>
            <div class="row">
              <div class="col">
                <div class="form-group">
                  <label>أسم البنك</label>
                  <input type="text" placeholder="الرجاء كتابة أسم البنك" class="form-control" name="beneficiary_bank" value="<?php echo $beneficiary_bank; ?>">



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
                  <button type="submit" name="edit" class="btn btn-secondary">تعديل حساب المستفيد</button>
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
</body>

</html>