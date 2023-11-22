<?php
include('../cookies/session2.php');
$_SESSION['sidebar'] = "Projects";
$project_id = $_GET['project_id'];
if (!empty($_GET['edit'])) {

  $id = $_GET['edit'];
  $query = "SELECT * FROM project_documents WHERE `id` = $id";
  $res = $conn->query($query);
  $editData = $res->fetch_assoc();
  $name = $editData['name'];

  if(isset($_POST['submit'])){

    $name = $_POST['name'];
    $target_dir = "../Signed-Docs/Project-Doc/".$project_id."/";
    if(!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true);
    }else{
    }
    $target_file = $target_dir . basename($_FILES["doc"]["name"]);
    $filename = basename($_FILES["doc"]["name"]);
    $uploadOk = 1;
    move_uploaded_file($_FILES["doc"]["tmp_name"], $target_file);

    $update = "UPDATE `project_documents` SET `name` = '$name', `image` = '$filename' WHERE `id` = $id";
    $updateResult = $conn->query($update);
    if ($updateResult) {

      $_SESSION['notification'] = "تم تعديل المستند بنجاح";
      header('location: documents.php?project_id='.$project_id.'');
      exit();

      } else {
      $_SESSION['notification'] = "يوجد خلل في النظام";
      header('location: documents.php?project_id='.$project_id.'');
      exit();

      }
  }

} else if (isset($_POST['submit'])) {

    $name = $_POST['name'];

    $target_dir = "../Signed-Docs/Project-Doc/".$project_id."/";
    if(!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true);
    }else{
    }
    $target_file = $target_dir . basename($_FILES["doc"]["name"]);
    $filename = basename($_FILES["doc"]["name"]);
    $uploadOk = 1;
    move_uploaded_file($_FILES["doc"]["tmp_name"], $target_file);
    $insert = "INSERT INTO project_documents (`id`, `project_id`, `name`, `image`, `created_at`) VALUES (NULL, '$project_id', '$name', '$filename' , NOW())";
    $insertResult = $conn->query($insert);
    if ($insertResult) {

        $_SESSION['notification'] = "تم اضافة المستند بنجاح";
        header('location: documents.php?project_id='.$project_id.'');
        exit();

  } else {
    $_SESSION['notification'] = "يوجد خلل في النظام";
    header('location: documents.php?project_id='.$project_id.'');
    exit();

  }
} else {
  $name = "";
  
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
    أضافة مستند
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

<body class="g-sidenav-show rtl">

  <!-- Side Bar -->
  <?php require_once('../components/sidebar.php'); ?>
  <!-- End Of side Bar -->
  <main class="main-content position-relative lg:max-height-vh-100 lg:h-100 mt-1 border-radius-lg overflow-hidden">
    <!-- Navbar -->
    <?php
    $titleNav = 'أضافة مستند';
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
            <h6 class="block-title text-white py-2 px-4 ">إضافة مستند جديد</h6>
          </div>
          <form id="<?php echo $idAttr; ?>" action="" method="post" enctype="multipart/form-data">
            <div class="row">
              <div class="col">
                <div class="form-group">
                  <label>إسم المستند</label>
                  <input type="text" placeholder="ادخل إسم المستند او تفاصيل عنه" class="form-control" name="name" value="<?php echo $name; ?>">
                </div>
              </div>

            </div>
            <div class="row">
              <div class="col">
                <div class="form-group">
                  <label>صورة المستند</label>
                  <input type="file"  class="form-control" name="doc"/>
                </div>
              </div>
            </div>
            



            <div class="row">
              <div class="col">
                <div class="form-group">
                  <button type="submit" name="submit" class="btn btn-secondary">تقديم طلب إضافة مستند</button>
                </div>
              </div>
              <div class="col">

              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </main>
 
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