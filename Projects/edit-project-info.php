<?php
include('../cookies/session2.php');
$_SESSION['sidebar'] = "Projects";

if(isset($_GET['project_id']) ){
    $project_id = $_GET['project_id'];
    $item_id = $_GET['item_id'];
    $query = "SELECT * FROM projects WHERE `id` = $project_id";
    $res = $conn->query($query);
    $project = $res->fetch_assoc();
    $project_name = $project['name'];
    $project_description = $project['description'];
    $project_image = $project['image'];

    $valid_till = $project['valid_till'];
    $duration = $project['duration'];
    $payment_type = $project['payment_type'];

    $query2 = "SELECT * FROM contact_projects WHERE `project_id` = $project_id";
    $res2 = $conn->query($query2);
    $contact_project = $res2->fetch_assoc();
    $supplier_name = $contact_project['supplier_name'];
    $contact_person = $contact_project['contact_person'];
    $mobile = $contact_project['mobile'];
    $address = $contact_project['address'];
    $email = $contact_project['email'];
    $vat = $contact_project['vat'];
    $company_trade = $contact_project['company_trade'];

   
}

if (isset($_POST['add-project'])) {

 

  $project_name = $_POST['project_name'];
  $project_description = $_POST['project_description'];
  $duration = $_POST['duration'];
  $payment_type = $_POST['payment_type'];
  $valid_till = $_POST['valid_till'];

  $contact_name = $_POST['contact_name'];
  $mobile = $_POST['mobile'];
  $address = $_POST['address'];
  $email = $_POST['email'];
  $vat = $_POST['vat'];
  $trade = $_POST['trade'];

  if(!empty(basename($_FILES["project_image"]["name"]))) {
    $target_dir = "../Projects/Images/".$project_name."/";
    if(!is_dir($target_dir)) {
      mkdir($target_dir, 0777, true);
    }else{

    }
    $target_file = $target_dir . basename($_FILES["project_image"]["name"]);
    $filename = basename($_FILES["project_image"]["name"]);
    $uploadOk = 1;
    move_uploaded_file($_FILES["project_image"]["tmp_name"], $target_file);
  } else {
    $filename = $project_image;
  }
  

    $update_project = "UPDATE projects SET `name` = '$project_name', `description` = '$project_description' , `image` = '$filename' , `valid_till` = '$valid_till' ,
    `duration` = '$duration' , `payment_type` = '$payment_type' WHERE `id` = $project_id";
    $project_res = $conn->query($update_project);
    if ($project_res) {
        
        $update_contact = "UPDATE `contact_projects` SET  `supplier_name` = '$project_name' , `contact_person` = '$contact_name' , `mobile` = '$mobile', `address` = '$address',
        `email` = '$email' , `vat` = '$vat' , `company_trade` = '$trade' WHERE `project_id` = $project_id";
        $contact_res = $conn->query($update_contact);

        if($contact_res){
        $_SESSION['notification'] = "تمت تعديل المشروع بنجاح";
          header('location: view-projects.php?id='.$project_id.'');
          exit();
        }

    }

}

?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

  <title>
    طلب إعتماد مشروع جديد
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

<body class="g-sidenav-show rtl bg-gray-100">

  <!-- Side Bar -->
  <?php require_once('../components/sidebar.php'); ?>
  <!-- End Of side Bar -->
  <main class="main-content position-relative lg:max-height-vh-100 lg:h-100 mt-1 border-radius-lg overflow-hidden">
    <!-- Navbar -->
    <?php
    $titleNav = 'طلب إعتماد مشروع جديد';
    require_once('../components/navbar.php');
    ?>
    <!-- End Navbar -->
    <div class="container-fluid py-4">
      <div class="row">
        <div class="block block-themed">

          <div class="block-header bg-gradient-dark col-lg-3 col-md-2 col-sm-6 col-xs-6  rounded-pill">

            <h5 class="block-title text-white py-2 px-4 ">طلب تعديل مشروع</h5>
          </div>
          <form id="<?php echo $idAttr; ?>" action="#" method="post" enctype="multipart/form-data">
            <h4>بيانات المشروع</h4>
            <div class="row">
              <div class="col-md-6 col-sm-6">
                <div class="form-group">
                  <label>أسم الجهة الطالبة للمشروع</label>
                  <input type="text" placeholder="الرجاء كتابة أسم مشروع" class="form-control" name="project_name" value="<?=$project_name?>">
                </div>
              </div>
              <div class="col-md-6 col-sm-6">
                <div class="form-group">
                  <label>صورة المشروع</label>
                  <input type="file"  class="form-control" name="project_image">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12 col-sm-6">
                <div class="form-group">
                  <label> تفاصيل المشروع</label>
                  <input type="text" placeholder="الرجاء كتابة تفاصيل" class="form-control" name="project_description" value="<?=$project_description?>">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-4 col-sm-6">
                <div class="form-group">
                  <label> مدة تنفيذ المشروع</label>
                  <input type="date" placeholder="" class="form-control" name="duration" value="<?=$duration?>">
                </div>
              </div>
              <div class="col-md-4 col-sm-6">
                <div class="form-group">
                  <label> طريقة الدفع</label>
                  <input type="text" placeholder="40 \ 60" class="form-control" name="payment_type" value="<?=$payment_type?>">
                </div>
              </div>
              <div class="col-md-4 col-sm-6">
                <div class="form-group">
                  <label> فترة صلاحية التسعيرة</label>
                  <input type="date" placeholder="" class="form-control" name="valid_till" value="<?=$valid_till?>">
                </div>
              </div>
              <hr>
            </div>
            
            <!-- Contact Detials -->
            <div class="contact_details">
              <h5>بيانات التواصل</h5>
              <div class="contact">
                <div class="row">
                  <div class="col-md-2 col-sm-6">
                    <div class="form-group">
                      <label for="contact_name">الأسم</label>
                      <input type="text" class="form-control" name='contact_name' id="contact_name" value="<?=$contact_person?>">
                    </div>
                  </div>
                  <div class="col-md-2 col-sm-6 ">
                    <div class="form-group">
                      <label for="mobile">رقم الهاتف</label>
                      <input type="text" class="form-control" name='mobile' id="mobile" value="<?=$mobile?>">
                    </div>
                  </div>
                  <div class="col-md-2 col-sm-6 ">
                    <div class="form-group">
                      <label for="address">العنوان</label>
                      <input type="text" class="form-control" name='address' id="address" value="<?=$address?>">
                    </div>
                  </div>
                  <div class="col-md-2 col-sm-6 ">
                    <div class="form-group">
                      <label for="email">البريد الإلكتروني</label>
                      <input type="text" class="form-control" name='email' id="email" value="<?=$email?>">
                    </div>
                  </div>
                  <div class="col-md-2 col-sm-6 ">
                    <div class="form-group">
                      <label for="vat">الرقم الضريبي</label>
                      <input type="text" class="form-control" name='vat' id="vat" value="<?=$vat?>">
                    </div>
                  </div>
                  <div class="col-md-2 col-sm-6 ">
                    <div class="form-group">
                      <label for="trade">رقم السجل التجاري</label>
                      <input type="text" class="form-control" name='trade' id="trade" value="<?=$company_trade?>">
                    </div>
                  </div>
                </div>
              </div>
              <hr>
            </div>
            
           
                <button type="submit" class="myButton col-md-6 col-sm-6 mt-5 btn btn-secondary rounded-pill" name="add-project">
                      تعديل المشروع
                    </button>
            
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
</body>

</html>