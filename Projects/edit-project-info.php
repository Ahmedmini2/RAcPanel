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
          header('location: view-projects.php?id='.$product_id.'');
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
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
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
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 ">
            <li class="breadcrumb-item text-sm ps-2"><a class="opacity-5 text-dark" href="javascript:;"> طلب إعتماد مشروع جديد</a></li>

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
               
                <i class="fa fa-arrow-left me-sm-1 cursor-pointer"  onclick="history.back()" ></i>
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
    </nav>
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