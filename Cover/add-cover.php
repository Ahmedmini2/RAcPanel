<?php
include('../cookies/session2.php');
include('../cookies/insert-method2.php');
$_SESSION['sidebar'] = "Cover";
if (!empty($_GET['edit'])) {

  $id = $_GET['edit'];
  $query = "SELECT * FROM covers_purchase WHERE id=$id";
  $res = $conn->query($query);
  $editData = $res->fetch_assoc();
  $type = $editData['type'];
  $dimensions = $editData['dimensions'];
  $quantity = $editData['quantity'];
  $price_per_peice = $editData['price_per_piece'];
  $description = $editData['description'];
  $total_price = $editData['total_price'];
  $seller = $editData['seller'];



if (isset($_POST['submit'])) {

  $type = $_POST['type'];
  $dimensions = $_POST['dimensions'];
  $quantity = $_POST['quantity'];
  $price_per_peice = $_POST['price_per_peice'];
  $description = $_POST['description'];
  $total_price = str_replace(',','',$_POST['total_price']);
  $seller = $_POST['seller'];



  $update = "UPDATE `covers_purchase` SET `description` = '$description' , `type` = '$type', `dimensions` = '$dimensions', `quantity` = '$quantity', `price_per_piece` = '$price_per_peice', `total_price` = '$total_price',
   `seller` = '$seller' WHERE `covers_purchase`.`id` = $id";
    $updateResult = $conn->query($update);
    if ($updateResult) {

      $_SESSION['notification'] = "تم تعديل طلب شراء الاغطية بنجاح";
      header('location: bills_cover.php');
      exit();

      } else {
      $_SESSION['notification'] = "يوجد خلل في النظام";
      header('location: bills_cover.php');
      exit();

      }
}

 

} else if (isset($_POST['submit'])) {

  $type = $_POST['type'];
  $dimensions = $_POST['dimensions'];
  $quantity = $_POST['quantity'];
  $price_per_peice = $_POST['price_per_peice'];
  $description = $_POST['description'];
  $total_price = str_replace(',','',$_POST['total_price']);
  $seller = $_POST['seller'];

  $select = "SELECT * FROM covers_purchase_id ORDER BY purchase_id DESC LIMIT 1";
  $select_res = $conn->query($select);
  $selectData = $select_res->fetch_assoc();
  $last_purchase_id = $selectData['purchase_id'];
  $last_purchase_id +=1;

  $data= [
    'purchase_id' => $last_purchase_id,
  ];
  $tableName='covers_purchase_id'; 
      if(!empty($data) && !empty($tableName)){
        $insertData=insert_data($data,$tableName);   
     }


  $insert = "INSERT INTO `covers_purchase` (`id`,`purchase_id`,`description`, `type`, `dimensions`, `quantity`, `price_per_piece`, `total_price`, `seller`, `created_at`)
   VALUES (NULL,'$last_purchase_id','$description', '$type', '$dimensions', '$quantity', '$price_per_peice', '$total_price', '$seller', NOW())";
  $insertResult = $conn->query($insert);
  if ($insertResult) {

      $_SESSION['notification'] = "تم اضافة طلب شراء الاغطية بنجاح";
      header('location: bills_cover.php');
      exit();
   
  } else {
    $_SESSION['notification'] = "يوجد خلل في النظام";
    header('location: bills_cover.php');
    exit();
  }




} else if(isset($_POST['submit2'])){

  $type = $_POST['type'];
  $dimensions = $_POST['dimensions'];
  $quantity = $_POST['quantity'];
  $price_per_peice = $_POST['price_per_peice'];
  $description = $_POST['description'];
  $total_price = str_replace(',','',$_POST['total_price']);
  $seller = $_POST['seller'];

  $select = "SELECT * FROM covers_purchase_id ORDER BY purchase_id DESC LIMIT 1";
  $select_res = $conn->query($select);
  $selectData = $select_res->fetch_assoc();
  $last_purchase_id = $selectData['purchase_id'];
  $last_purchase_id +=1;

  $_SESSION['last_purchase_id'] = $last_purchase_id;
  $_SESSION['seller_id'] = $seller;

  $data= [
    'purchase_id' => $last_purchase_id,
  ];
  $tableName='covers_purchase_id'; 
      if(!empty($data) && !empty($tableName)){
        $insertData=insert_data($data,$tableName);   
     }


  $insert = "INSERT INTO `covers_purchase` (`id`,`purchase_id`,`description`, `type`, `dimensions`, `quantity`, `price_per_piece`, `total_price`, `seller`, `created_at`)
   VALUES (NULL,'$last_purchase_id','$description', '$type', '$dimensions', '$quantity', '$price_per_peice', '$total_price', '$seller', NOW())";
  $insertResult = $conn->query($insert);
  if ($insertResult) {

      $_SESSION['notification'] = "تم اضافة طلب شراء الاغطية بنجاح";
      header('location: add-more-covers.php');
      exit();
   
  } else {
    $_SESSION['notification'] = "يوجد خلل في النظام";
    header('location: add-more-covers.php');
    exit();
  }





} else {
  $type = "";
  $dimensions = "";
  $quantity = "";
  $price_per_peice = "";
  $total_price = "";
  $seller = "";
  $address = "";
  $email = "";
  $phone = "";
  $description = "";
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
    شراء اغطية
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
     $titleNav = 'شراء اغطية'; 
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
            <h6 class="block-title text-white py-2 px-4 ">شراء اغطية جديد</h6>
          </div>
          <form id="<?php echo $idAttr; ?>" action="" method="post">
            <div class="row">
              <div class="col">
                <div class="form-group">
                  <label>نوع الاغطية</label>
                  <select name="type" id="type" class="form-control" placeholder="نوع الاغطية">
                    <option value="<?=$type?>"><?=$type?></option>
                    <option value="Square One Cover With Frame">Square One Cover With Frame</option>
                    <option value="Square Two Cover With Frame">Square Two Cover With Frame</option>
                    <option value="Rounded Cover With Frame">Rounded Cover With Frame</option>
                    <option value="Rectangle Cover With Frame">Rectangle Cover With Frame</option>
                    <option value="Square One Cover Without Frame">Square One Cover Without Frame</option>
                    <option value="Square Two Cover Without Frame">Square Two Cover Without Frame</option>
                    <option value="Rounded Cover Without Frame">Rounded Cover Without Frame</option>
                    <option value="Rectangle Cover Without Frame">Rectangle Cover Without Frame</option>
                    

                  </select>
                </div>
              </div>
              <div class="col">
                <div class="form-group">
                  <label>ابعاد الاغطية</label>
                  <input type="text" placeholder="ادخل ابعاد الاغطية" class="form-control" name="dimensions" value="<?php echo $dimensions; ?>">
                </div>
              </div>
             
              

              </div>
            
            <div class="row">
              <div class="col">
                <div class="form-group">
                  <label>كمية الاغطية</label>
                  <input type="number" placeholder="ادخل كمية الاغطية" class="form-control" name="quantity" id="quantity" value="<?php echo $quantity; ?>">
                </div>
              </div>
              
              <div class="col"> 
                <div class="form-group">
                  <label>سعر الغطاء الواحد</label>
                  <input type="number" placeholder="ادخل سعر الغطاء الواحد" class="form-control" name="price_per_peice" id="price_per_peice" value="<?php echo $price_per_peice; ?>">
                </div>
              </div>
              
            </div>
            <div class="row">
              <div class="col">
                <div class="form-group">
                  <label>الوصف</label>
                  <input type="text" placeholder="الرجاء كتابه الوصف" class="form-control" name="description" id="description"  value="<?php echo $description; ?>">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col">
                <div class="form-group">
                  <label>السعر الكلي</label>
                  <input type="number" placeholder="" class="form-control" name="total_price" id="total_price"  value="<?php echo $total_price; ?>" readonly>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col">
                <div class="form-group">
                <label>إسم الشركة</label>
                <select name="seller" id="seller" class="form-control" placeholder="إسم الشركة">
                    <option value="<?=$type?>"><?=$type?></option>
                    <?php 
                    $select = mysqli_query($conn, "select * from contact_covers");
                    while ($r = mysqli_fetch_array($select)) {

                      echo '<option value="' . $r['id'] . '">' . $r['name'] . '</option>';
                    }
                    ?>
                  </select>
                </div>
              </div>
            </div>
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                    <script>
                      var a = 1;

                      $(document).on('change', 'input', function() {
                       
                          var peice = (parseFloat($("#quantity").val()) * parseFloat($("#price_per_peice").val() || '0'));
                          $("#total_price").val(peice);
                      });
                    
                      
                    </script>
            <div class="row">
              <div class="col">
                <div class="form-group">
                <button type="button" class="myButton col-md-6 col-sm-6 mt-5 btn btn-secondary rounded-pill" data-bs-toggle="modal" data-bs-target="#exampleModal">
                      إستمرار
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">إضافة غطاء جديد</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                            هل لديك المزيد من الاغطية تود اضافتها ؟
                          </div>
                          <div class="modal-footer">
                            <button type="submit" name="submit" class="myButton col-md-6 col-sm-6 mt-5 btn btn-secondary rounded-pill">لا</button>
                            <button type="submit" name="submit2" class="myButton col-md-6 col-sm-6 mt-5 btn btn-secondary rounded-pill">نعم اريد اضافة طلب غطاء آخر</button>
                          </div>
                        </div>
                      </div>
                    </div>
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