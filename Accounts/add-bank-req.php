<?php
include('../cookies/session2.php');
$_SESSION['sidebar']="Accounts";
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
  $description = $_POST['description'];
  $amount_text = $_POST['amount_text'];
  $amount_number = $_POST['amount_number'];
  $our_bank_name = $_POST['our_bank_name'];
  $to_account_type = $_POST['to_account_type'];
  $transfer_to = $_POST['transfer_to'];

  $to_name = $_POST['to_name'];
  $to_bank_name = $_POST['to_bank_name'];
  $to_bank_number = $_POST['to_bank_number'];
  $to_bank_iban = $_POST['to_bank_iban'];

  if ($transfer_to == "") {
    $transfer_to = $to_name;
  }


  $insert = "INSERT INTO `bank_request` (`id`, `name`, `description`, `amount_text`, `amount_number`, `our_bank_name`, `to_account_type`, `transfer_to`,
     `status`, `created_at`, `updated_at`, `accepted_at`) VALUES (NULL, '$name','$description','$amount_text','$amount_number','$our_bank_name','$to_account_type','$transfer_to',
     '1',NOW(),'0000-00-00 00:00','0000-00-00 00:00')";

  if ($to_name != "") {
    $insert2 = "INSERT INTO `beneficiary_info` (`id`, `name`, `beneficiary_bank`, `branch`, `account_number`, `iban`, `swift`, `created_at`) VALUES (NULL, '$to_name','$to_bank_name','','$to_bank_number','$to_bank_iban','', NOW())";
    $insertResult2 = $conn->query($insert2);
  }
  $insertResult = $conn->query($insert);
  if ($insertResult) {
    $notificationMessage = "New bank request created by " . $_SESSION['username'];
    $showToAccounts = "Accounts"; // Use the text "Accounts" to indicate the target audience.
    $created_by = $_SESSION['id'];

    // Insert the notification into the database.
    $insertNotification = "INSERT INTO notifications (user_id, message, created_at, show_to) VALUES ('$created_by', '$notificationMessage', NOW(), '$showToAccounts')";
    $insertResultNotification = $conn->query($insertNotification);

    if ($insertResultNotification) {
      $_SESSION['notification'] = "تم اضافة التعميد بنجاح";
      header('location: accounts.php');
      exit();
    }
    $_SESSION['notification'] = "تم اضافة التعميد بنجاح";
    header('location: accounts.php');
    exit();
  } else {
    $_SESSION['notification'] = "يوجد خلل في النظام";
    header('location: accounts.php');
  }
} else {
  $name = "";
  $description = "";
  $amount_text = "";
  $our_bank_name = "";
  $to_account_type = "";
  $transfer_to = "";
  $status = "";
  $created_at = "";
  $updated_at = "";
  $accepted_at = "";
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
    أضافة طلب تعميد
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

<body class="g-sidenav-show rtl ">

   <!-- Side Bar -->
   <?php require_once('../components/sidebar.php'); ?>
      <!-- End Of side Bar -->
  <main class="main-content position-relative lg:max-height-vh-100 lg:h-100 mt-1 border-radius-lg overflow-hidden">
    <!-- Navbar --> 
    <?php
        $titleNav = 'أضافة طلب تعميد';
        require_once('../components/navbar.php');
        ?>
    <!-- End Navbar -->
    <div class="container-fluid py-4">
      <div class="row">
        <div class="block block-themed">
          <div class="block-header bg-warning col-md-3 col-sm-6 col-xs-6 rounded">
            <?php require_once('../components/notification.php'); ?>
          </div>
          <div class="block-header bg-gradient-dark col-md-2 col-sm-6 col-xs-6  rounded-pill">
            <h6 class="block-title text-white py-2 px-4 ">إضافة طلب تعميد جديد</h6>
          </div>
          <form id="<?php echo $idAttr; ?>" action="" method="post">
            <div class="row">
              <div class="col">
                <div class="form-group">
                  <label>نوع التعميد</label>
                  <select name="name" id="name" class="form-control" placeholder="نوع التعميد" onchange="showDiv(this)">
                    <option value="0"></option>
                    <option value="1">طلب تحويل بنكي</option>
                    <option value="2">طلب سحب مبلغ مالي</option>
                    <option value="3">طلب اصدار شيك بنكي</option>
                    <option value="4">تسديد فاتورة إلكترونية</option>
                  </select>

                  <script type="text/javascript">
                    function showDiv(select) {
                      if (select.value == 1) {
                        document.getElementById('hidden_div').style.display = "block";
                      } else {
                        document.getElementById('hidden_div').style.display = "none";
                        document.getElementById('hidden_div2').style.display = "none";
                        document.getElementById('hidden_div3').style.display = "none";
                      }
                    }
                  </script>

                </div>
              </div>

            </div>
            <div class="row">
              <div class="col">
                <div class="form-group">
                  <label>التفاصيل و الملاحظات</label>
                  <textarea placeholder="التفاصيل" class="form-control" name="description" value="<?php echo $description; ?>"></textarea>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-8">
                <div class="form-group">
                  <label>المبلغ المالي كتابة</label>
                  <input type="text" placeholder="الرجاء كتابة المبلغ المالي نصا" class="form-control" name="amount_text" value="<?php echo $amount_text; ?>">
                </div>
              </div>
              <div class="col">
                <div class="form-group">
                  <label>المبلغ المالي ارقام</label>
                  <input type="number" placeholder="ادخل المبلغ المالي عن طريق الارقام مثل 10,000" class="form-control" name="amount_number" value="<?php echo $amount_number; ?>">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col">
                <div class="form-group">
                  <label>من حساب الشركة بنك</label>
                  <select name="our_bank_name" id="our_bank_name" class="form-control" placeholder="نوع التعميد">
                    <?php
                    $select = mysqli_query($conn, "select * from bank_info");
                    while ($r = mysqli_fetch_array($select)) {

                      echo '<option value="' . $r['name'] . '">' . $r['name'] . '</option>';
                    }
                    ?>

                  </select>
                </div>
              </div>
              <div class="col" id="hidden_div" style="display:none">
                <div class="form-group">
                  <label>نوع الحساب</label>
                  <select name="to_account_type" id="to_account_type" class="form-control" placeholder="نوع التعميد" onchange="showDiv2(this)">
                    <option value="0"></option>
                    <option value="حساب مسجل">حساب مسجل</option>
                    <option value="حساب جديد">حساب جديد</option>
                  </select>
                  <script type="text/javascript">
                    function showDiv2(select) {
                      if (select.value == "حساب جديد") {
                        document.getElementById('hidden_div2').style.display = "block";
                        document.getElementById('hidden_div3').style.display = "none";
                      } else {
                        document.getElementById('hidden_div2').style.display = "none";
                        document.getElementById('hidden_div3').style.display = "block";
                      }
                    }
                  </script>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col" id="hidden_div3" style="display:none">
                <div class="form-group">
                  <label>الى حساب شركة</label>
                  <select name="transfer_to" id="transfer_to" class="form-control" placeholder="نوع التعميد">
                    <option value=""></option>
                    <?php
                    $select = mysqli_query($conn, "select * from beneficiary_info");
                    while ($r = mysqli_fetch_array($select)) {

                      echo '<option value="' . $r['name'] . '">' . $r['name'] . ' ( ' . $r['beneficiary_bank'] . ' )</option>';
                    }
                    ?>

                  </select>
                </div>
              </div>
            </div>

            <div class="row" id="hidden_div2" style="display:none">
              <div class="col">
                <div class="form-group">
                  <label>أسم الجهة</label>
                  <input type="text" placeholder="الرجاء كتابة أسم الجهة" class="form-control" name="to_name">
                </div>
              </div>
              <div class="col">
                <div class="form-group">
                  <label>أسم البنك</label>
                  <input type="text" placeholder="الرجاء كتابة أسم البنك المحول له" class="form-control" name="to_bank_name">
                </div>
              </div>
              <div class="col">
                <div class="form-group">
                  <label>رقم الحساب</label>
                  <input type="text" placeholder="الرجاء كتابة أسم رقم حساب البنك المحول له" class="form-control" name="to_bank_number">
                </div>
              </div>
              <div class="col">
                <div class="form-group">
                  <label>رقم الأيبان</label>
                  <input type="text" placeholder="الرجاء كتابة أسم رقم حساب البنك المحول له" class="form-control" name="to_bank_iban">
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col">
                <div class="form-group">
                  <button type="submit" name="submit" class="btn btn-secondary">تقديم طلب التعميد</button>
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
  <!--<div class="fixed-plugin">
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
         End Toggle Button 
      </div>
      <hr class="horizontal dark my-1">
      <div class="card-body pt-sm-3 pt-0">
         Sidebar Backgrounds
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
        Sidenav Type
        <div class="mt-3">
          <h6 class="mb-0">Sidenav Type</h6>
          <p class="text-sm">Choose between 2 different sidenav types.</p>
        </div>
        <div class="d-flex">
          <button class="btn bg-gradient-primary w-100 px-3 mb-2 active" data-class="bg-transparent" onclick="sidebarType(this)">Transparent</button>
          <button class="btn bg-gradient-primary w-100 px-3 mb-2 me-2" data-class="bg-white" onclick="sidebarType(this)">White</button>
        </div>
        <p class="text-sm d-xl-none d-block mt-2">You can change the sidenav type just on desktop view.</p>
        Navbar Fixed
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
   Core JS Files   -->
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