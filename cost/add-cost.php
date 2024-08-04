<?php
include('../cookies/session2.php');
$_SESSION['sidebar'] = "cost";
if (!empty($_GET['edit'])) {

  $id = $_GET['edit'];
  $query = "SELECT * FROM cost_center WHERE id=$id";
  $res = $conn->query($query);
  $editData = $res->fetch_assoc();
  $type = $editData['type'];
  $description = $editData['description'];
  $price = $editData['price'];
  $c_date = $editData['c_date'];

  if(isset($_POST['submit'])){

    $type = $_POST['type'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $c_date = $_POST['c_date'];

    $target_dir = "../Signed-Docs/Cost-Bills/".$id."/";
        if(!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }else{

        }
        $target_file = $target_dir . basename($_FILES["bill"]["name"]);
        $filename = basename($_FILES["bill"]["name"]);
        $uploadOk = 1;
        move_uploaded_file($_FILES["bill"]["tmp_name"], $target_file);

    $update = "UPDATE `cost_center` SET `type` = '$type', `description` = '$description', `price` = '$price' , `image` = '$filename' , `cost_date` = '$c_date' WHERE `id` = $id";
    $updateResult = $conn->query($update);
    if ($updateResult) {

      $_SESSION['notification'] = "تم تعديل التكلفة بنجاح";
      header('location: cost.php');
      exit();

      } else {
      $_SESSION['notification'] = "يوجد خلل في النظام";
      header('location: cost.php');
      exit();

      }
  }

} else if (isset($_POST['submit'])) {

  $type = $_POST['type'];
  $description = $_POST['description'];
  $price = $_POST['price'];
  $c_date = $_POST['c_date'];

  
  $filename = basename($_FILES["bill"]["name"]);
  $uploadOk = 1;
  

  $insert = "INSERT INTO cost_center (`id`, `type`, `description`, `price` , `image` , `cost_date` , `created_at`) VALUES (NULL, '$type', '$description', '$price','$filename','$c_date', NOW())";
  $insertResult = $conn->query($insert);
  if ($insertResult) {
      $id = $conn->insert_id;
      $target_dir = "../Signed-Docs/Cost-Bills/".$id."/";
      if(!is_dir($target_dir)) {
          mkdir($target_dir, 0777, true);
      }else{
    
      }
      $target_file = $target_dir . basename($_FILES["bill"]["name"]);
      move_uploaded_file($_FILES["bill"]["tmp_name"], $target_file);

      $_SESSION['notification'] = "تم اضافة التكلفة بنجاح";
      header('location: cost.php');
      exit();

  } else {
    $_SESSION['notification'] = "يوجد خلل في النظام";
    header('location: cost.php');
    exit();

  }
} else {
  $type = "";
  $description = "";
  $price = "";
  
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
    أضافة تكلفة
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

<body class="g-sidenav-show rtl ">

  <!-- Side Bar -->
  <?php require_once('../components/sidebar.php'); ?>
  <!-- End Of side Bar -->
  <main class="main-content position-relative lg:max-height-vh-100 lg:h-100 mt-1 border-radius-lg overflow-hidden">
    <!-- Navbar -->
    <?php 
     $titleNav = 'أضافة تكلفة'; 
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
            <h6 class="block-title text-white py-2 px-4 ">إضافة تكلفة جديد</h6>
          </div>
          <form id="<?php echo $idAttr; ?>" action="" method="post" enctype="multipart/form-data">
            <div class="row">
              <div class="col">
                <div class="form-group">
                  <label>نوع التكلفة</label>
                  <select name="type" id="type" class="form-control" placeholder="نوع التكلفة">
                    <option value="<?php echo $type; ?>"><?php echo $type; ?></option>
                    <?php 
                    $select = mysqli_query($conn, "select * from cost_type");
                    while ($r = mysqli_fetch_array($select)) {

                      echo '<option value="' . $r['name'] . '">' . $r['name'] . '</option>';
                    }
                    ?>
                  </select>
                </div>
              </div>

            </div>
            <div class="row">
              <div class="col">
                <div class="form-group">
                  <label>التفاصيل و الملاحظات</label>
                  <textarea placeholder="التفاصيل" class="form-control" name="description"><?php echo $description; ?></textarea>
                </div>
              </div>
            </div>
            <div class="row">

              <div class="col">
                <div class="form-group">
                  <label>سعر التكلفة</label>
                  <input type="text" placeholder="ادخل المبلغ المالي عن طريق الارقام مثل 10,000" class="form-control" name="price" value="<?php echo $price; ?>">
                </div>
              </div>

              <div class="col">
                <div class="form-group">
                  <label>تاريخ الفاتورة</label>
                  <input type="date" placeholder="" class="form-control" name="c_date" value="<?php echo $c_date; ?>">
                </div>
              </div>

              <div class="col">
                <div class="form-group">
                  <label>صورة الفاتورة</label>
                  <input type="file" placeholder="" class="form-control" name="bill" value="">
                </div>
              </div>
            </div>




            <div class="row">
              <div class="col">
                <div class="form-group">
                  <button type="submit" name="submit" class="btn btn-secondary">تقديم طلب التكلفة</button>
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