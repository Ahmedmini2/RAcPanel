<?php
include('../cookies/session2.php');
$_SESSION['sidebar'] = "Projects";
$coco = 1;
$numberofrows = 1;

$iron_raws = $_POST['iron-rr'];
$accessory_raws = $_POST['ac-rr'];
$band_raws = $_POST['band-rr'];
if(isset($_POST['add-project'])){

  $iron1 = 1;
  $accessory1 = 1;
  $band1 = 1;

  $project_name = $_POST['project_name'];
  $project_description = $_POST['project_description'];

  $insert_project = "INSERT INTO projects (`id`, `name`, `description`,`created_at`) VALUES(NULL, '$project_name', '$project_description' ,NOW())";
  $project_res = $conn->query($insert_project);
  if($project_res){
    
    $project_id = $conn->insert_id;
    
    $product_name = $_POST['product_name'];
    $dimensions = $_POST['dimensions'];
    $quantity = $_POST['quantity'];
    
    $insert_product = "INSERT INTO products (`id`, `project_id`, `product_name`, `quantity`, `dimensions` , `created_at` ) VALUES(NULL, '$project_id', '$product_name' , '$quantity' , '$dimensions' , NOW())";
    $product_res = $conn->query($insert_product);

    if($product_res){
      $product_id = $conn->insert_id;
      
      $kharasana = $_POST['kharasana'];
      $kh_price = $_POST['kh_price'];
      $kh_per = $_POST['kh_per'];
      $kh_peice = $_POST['kh_peice'];
      $kh_tot = $_POST['kh_tot'];

      $insert_kh = "INSERT INTO kharasana (`id`, `product_id`, `type`, `price`, `quantity_per_piece`, `price_per_piece` , `total_price`, `created_at`) 
      VALUES(NULL, $product_id, '$kharasana', '$kh_price', '$kh_per', '$kh_peice' , '$kh_tot' , NOW())";
      $kh_res = $conn->query($insert_kh);
      if($kh_res){

        $iron_raws = $_POST['iron-rr'];
        if ($iron_raws == ""){$iron_raws = 1;}
        while ($iron1 <= $iron_raws){
          $iron = $_POST['iron_'.$iron1];
          $iron_price = $_POST['iron_price_'.$iron1];
          $iron_quantity = $_POST['iron_quantity_'.$iron1];
          $iron_long = $_POST['iron_long_'.$iron1];
          $iron_tn = $_POST['iron_tn_'.$iron1];
          $iron_tot = $_POST['iron_tot_'.$iron1];

          $sizeText = [
            "0.395" => "8مم",
            "0.617" => "10مم",
            "0.888" => "12مم",
            "1.21" => "14مم",
            "1.58" => "16مم",
            "2" => "18مم",
            "2.47" => "20مم",
            "2.984" => "22مم",
            "3.85" => "25مم",
            "6.41" => "32مم",
          ];

          $selectedSizeText = $sizeText[$iron];

          $insert_iron = "INSERT INTO iron_band (`id`, `product_id`, `size`, `price_today`, `quantity`, `iron_height`, `tn_price`, `total_price`, `created_at`)
          VALUES (NULL, '$product_id' , '$selectedSizeText' , '$iron_price' , '$iron_quantity' , '$iron_long' , '$iron_tn' ,'$iron_tot', NOW())";
          $iron_res = $conn->query($insert_iron);
          if($iron_res){
            $_SESSION['notification'] = "One Addes";
          }else{
            $_SESSION['notification'] = "One Error";
          }
          $iron1++;
        }
        $accessory_raws = $_POST['ac-rr'];
        if ($accessory_raws == ""){$accessory_raws = 1;}
        while ($accessory1 <= $accessory_raws){
          $accessory = $_POST['accessory_'.$accessory1];
          $acc_quantity = $_POST['acc_quantity_'.$accessory1];
          $acc_price = $_POST['acc_price_'.$accessory1];
          $acc_tot = $_POST['acc_tot_'.$accessory1];

          $insert_accessory = "INSERT INTO `accessory_band` (`id`, `product_id`, `name`, `quantity`, `price_per_piece`, `total_price`, `created_at`) 
          VALUES (NULL, '$product_id' , '$accessory' , '$acc_quantity' , '$acc_price' , '$acc_tot' , NOW())";
          $accessory_res = $conn->query($insert_accessory);
          if($accessory_res){
            $_SESSION['notification'] = "One Addes";
          }else{
            $_SESSION['notification'] = "One Error";
          }
          $accessory1++;
        }

        $cover_type = $_POST['cover_type'];
        $cover_price = $_POST['cover_price'];
        $cover_tot = $_POST['cover_tot'];

        $insert_cover = "INSERT INTO `covers_band` (`id`, `product_id`, `type`, `price_per_piece`, `total_price`, `created_at`) 
        VALUES (NULL , '$product_id' , '$cover_type' , '$cover_price' , '$cover_tot' , NOW())";
        $cover_res = $conn->query($insert_cover);
        if($cover_res){
          
          $band_raws = $_POST['band-rr'];
          if ($band_raws == ""){$band_raws = 1;}
          while ($band1 <= $band_raws){
            $band = $_POST['band_'.$band1];
            $band_price = $_POST['band_price_'.$band1];
            $band_tot = $_POST['band_tot_'.$band1];

            $insert_band = "INSERT INTO `extra_band` (`id`, `product_id`, `name`, `price_per_piece`, `total_price`, `created_at`) 
            VALUES (NULL , '$product_id' , '$band' , '$band_price' , '$band_tot' , NOW())";
            $band_res = $conn->query($insert_band);
            if($band_res){
              
            }else{
              $_SESSION['notification'] = "يوجد خلل في ادخال البنود الاضافية";
              header('location: index.php');
            }
            $band1++;
          }
          $_SESSION['notification'] = "تمت اضافة المشروع بنجاح";
          unset($_SESSION['last_insert_project']);
          header('location: index.php');
          exit();

        }else{
          $_SESSION['notification'] = "يوجد خلل في ادخال الاغطية";
          header('location: index.php');
        }
        

      }else{
        $_SESSION['notification'] = "يوجد خلل في ادخال الخرسانة";
        header('location: index.php');
      }

    }else{
      $_SESSION['notification'] = "يوجد خلل في ادخال الصنف";
      header('location: index.php');
    }

  }else{
    $_SESSION['notification'] = "يوجد خلل في ادخال المشروع";
    header('location: index.php');
  }
  
  
  
  
  }else if(isset($_POST['add-project2'])) {
      $iron1 = 1;
      $accessory1 = 1;
      $band1 = 1;
    
      $project_name = $_POST['project_name'];
      $project_description = $_POST['project_description'];
    
      $insert_project = "INSERT INTO projects (`id`, `name`, `description`,`created_at`) VALUES(NULL, '$project_name', '$project_description' ,NOW())";
      $project_res = $conn->query($insert_project);
      if($project_res){
        
        $project_id = $conn->insert_id;
        $_SESSION['last_insert_project'] = $project_id;
        
        $product_name = $_POST['product_name'];
        $dimensions = $_POST['dimensions'];
        $quantity = $_POST['quantity'];
        
        $insert_product = "INSERT INTO products (`id`, `project_id`, `product_name`, `quantity`, `dimensions` , `created_at` ) VALUES(NULL, '$project_id', '$product_name' , '$quantity' , '$dimensions' , NOW())";
        $product_res = $conn->query($insert_product);
    
        if($product_res){
          $product_id = $conn->insert_id;
          
          $kharasana = $_POST['kharasana'];
          $kh_price = $_POST['kh_price'];
          $kh_per = $_POST['kh_per'];
          $kh_peice = $_POST['kh_peice'];
          $kh_tot = $_POST['kh_tot'];
    
          $insert_kh = "INSERT INTO kharasana (`id`, `product_id`, `type`, `price`, `quantity_per_piece`, `price_per_piece` , `total_price`, `created_at`) 
          VALUES(NULL, $product_id, '$kharasana', '$kh_price', '$kh_per', '$kh_peice' , '$kh_tot' , NOW())";
          $kh_res = $conn->query($insert_kh);
          if($kh_res){
    
            $iron_raws = $_POST['iron-rr'];
            if ($iron_raws == ""){$iron_raws = 1;}
            while ($iron1 <= $iron_raws){
              $iron = $_POST['iron_'.$iron1];
              $iron_price = $_POST['iron_price_'.$iron1];
              $iron_quantity = $_POST['iron_quantity_'.$iron1];
              $iron_long = $_POST['iron_long_'.$iron1];
              $iron_tn = $_POST['iron_tn_'.$iron1];
              $iron_tot = $_POST['iron_tot_'.$iron1];
    
              $sizeText = [
                "0.395" => "8مم",
                "0.617" => "10مم",
                "0.888" => "12مم",
                "1.21" => "14مم",
                "1.58" => "16مم",
                "2" => "18مم",
                "2.47" => "20مم",
                "2.984" => "22مم",
                "3.85" => "25مم",
                "6.41" => "32مم",
              ];
    
              $selectedSizeText = $sizeText[$iron];
    
              $insert_iron = "INSERT INTO iron_band (`id`, `product_id`, `size`, `price_today`, `quantity`, `iron_height`, `tn_price`, `total_price`, `created_at`)
              VALUES (NULL, '$product_id' , '$selectedSizeText' , '$iron_price' , '$iron_quantity' , '$iron_long' , '$iron_tn' ,'$iron_tot', NOW())";
              $iron_res = $conn->query($insert_iron);
              if($iron_res){
                $_SESSION['notification'] = "One Addes";
              }else{
                $_SESSION['notification'] = "One Error";
              }
              $iron1++;
            }
            $accessory_raws = $_POST['ac-rr'];
            if ($accessory_raws == ""){$accessory_raws = 1;}
            while ($accessory1 <= $accessory_raws){
              $accessory = $_POST['accessory_'.$accessory1];
              $acc_quantity = $_POST['acc_quantity_'.$accessory1];
              $acc_price = $_POST['acc_price_'.$accessory1];
              $acc_tot = $_POST['acc_tot_'.$accessory1];
    
              $insert_accessory = "INSERT INTO `accessory_band` (`id`, `product_id`, `name`, `quantity`, `price_per_piece`, `total_price`, `created_at`) 
              VALUES (NULL, '$product_id' , '$accessory' , '$acc_quantity' , '$acc_price' , '$acc_tot' , NOW())";
              $accessory_res = $conn->query($insert_accessory);
              if($accessory_res){
                $_SESSION['notification'] = "One Addes";
              }else{
                $_SESSION['notification'] = "One Error";
              }
              $accessory1++;
            }
    
            $cover_type = $_POST['cover_type'];
            $cover_price = $_POST['cover_price'];
            $cover_tot = $_POST['cover_tot'];
    
            $insert_cover = "INSERT INTO `covers_band` (`id`, `product_id`, `type`, `price_per_piece`, `total_price`, `created_at`) 
            VALUES (NULL , '$product_id' , '$cover_type' , '$cover_price' , '$cover_tot' , NOW())";
            $cover_res = $conn->query($insert_cover);
            if($cover_res){
              
              $band_raws = $_POST['band-rr'];
              if ($band_raws == ""){$band_raws = 1;}
              while ($band1 <= $band_raws){
                $band = $_POST['band_'.$band1];
                $band_price = $_POST['band_price_'.$band1];
                $band_tot = $_POST['band_tot_'.$band1];
    
                $insert_band = "INSERT INTO `extra_band` (`id`, `product_id`, `name`, `price_per_piece`, `total_price`, `created_at`) 
                VALUES (NULL , '$product_id' , '$band' , '$band_price' , '$band_tot' , NOW())";
                $band_res = $conn->query($insert_band);
                if($band_res){
                  
                }else{
                  $_SESSION['notification'] = "يوجد خلل في ادخال البنود الاضافية";
                  header('location: index.php');
                }
                $band1++;
              }
              $_SESSION['notification'] = "الصنف بنجاح";
              header('location: add-more-projects.php');
              exit();
    
            }else{
              $_SESSION['notification'] = "يوجد خلل في ادخال الاغطية";
              header('location: index.php');
            }
            
    
          }else{
            $_SESSION['notification'] = "يوجد خلل في ادخال الخرسانة";
            header('location: index.php');
          }
    
        }else{
          $_SESSION['notification'] = "يوجد خلل في ادخال الصنف";
          header('location: index.php');
        }
    
      }else{
        $_SESSION['notification'] = "يوجد خلل في ادخال المشروع";
        header('location: index.php');
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
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
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
    </nav>
    <!-- End Navbar -->
    <div class="container-fluid py-4">
      <div class="row">
        <div class="block block-themed">

          <div class="block-header bg-gradient-dark col-lg-3 col-md-2 col-sm-6 col-xs-6  rounded-pill">

            <h5 class="block-title text-white py-2 px-4 ">طلب إعتماد مشروع جديد</h5>
          </div>
          <form id="<?php echo $idAttr; ?>" action="#" method="post">
            <div class="row">
              <div class="col-md-8 col-sm-6">
                <div class="form-group">
                  <label>أسم الجهة الطالبة للمشروع</label>
                  <input type="text" placeholder="الرجاء كتابة أسم مشروع" class="form-control" name="project_name" value="<?php echo $name; ?>">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-8 col-sm-6">
                <div class="form-group">
                  <label> تفاصيل المشروع</label>
                  <input type="text" placeholder="الرجاء كتابة تفاصيل" class="form-control" name="project_description" value="<?php echo $beneficiary_bank; ?>">
                </div>
              </div>
            </div>

            <!-- Product Details -->
            <div id="product_details">
              <div class="product">
                <h4>الأصناف</h4>
                <div class="row">
                  <div class="col-md-8 col-sm-6">
                    <div class="form-group">
                      <label for="product_name">أسم الصنف</label>
                      <input class="form-control" type="text" name="product_name">
                      <!-- Add more fields for product details here -->
                    </div>
                  </div>
                  <div class="col-md-8 col-sm-6">
                    <div class="form-group">
                      <label for="dimensions">المقاسات</label>
                      <input class="form-control" type="text" name="dimensions">
                      <!-- Add more fields for product details here -->
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-8 col-sm-6">
                    <div class="form-group">
                      <label for="quantity">كمية الصنف</label>
                      <input class="form-control" type="text" name='quantity' id="quantity">
                      <!-- Add more fields for product details here -->
                    </div>
                  </div>
                </div>

                <!-- Item Details -->
                <div class="kh_details">
                  <h5>بند الخرسانة</h5>
                  <div class="item">
                    <div class="row">
                      <div class="col-md-2 col-sm-6">
                        <div class="form-group">
                          <label for="kharasana">نوع الخرسانة</label>
                          <select class="form-control" name="kharasana">
                            <option value="خرسانة شركة">خرسانة شركة</option>
                            <option value="خرسانة رجيع">خرسانة رجيع</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-2 col-sm-6 ">
                        <div class="form-group">
                          <label for="kh_price">سعر الخرسانة</label>
                          <input type="text" class="form-control" name='kh_price' id="kh_price">
                        </div>
                      </div>
                      <div class="col-md-2 col-sm-6 ">
                        <div class="form-group">
                          <label for="kh_per">كمية الخرسانة للصنف الواحد</label>
                          <input type="text" class="form-control" name='kh_per' id="kh_per">
                        </div>
                      </div>
                      <div class="col-md-2 col-sm-6 ">
                        <div class="form-group">
                          <label for="kh_peice">السعر للمنتج الفردي</label>
                          <input type="text" class="form-control" name='kh_peice' id="kh_peice" readonly>
                        </div>
                      </div>
                      <div class="col-md-2 col-sm-6 ">
                        <div class="form-group">
                          <label for="kh_tot">السعر الكلي</label>
                          <input type="text" class="form-control" name='kh_tot' id="kh_tot" readonly>
                        </div>
                      </div>
                    </div>
                    <script>
                      $("input").on("change", function() {
                        var peice = (parseFloat($("#kh_price").val()) * parseFloat($("#kh_per").val() || '0'))
                        var ret = (parseFloat($("#kh_price").val()) * parseFloat($("#kh_per").val() || '0')) * parseFloat($("#quantity").val())
                        var qunt = parseFloat($("#quantity").val());
                        ret = ret.toLocaleString("en-US");
                        peice = peice.toLocaleString("en-US");
                        $("#kh_tot").val(ret);
                        $("#kh_peice").val(peice);
                      })
                    </script>

                  </div>
                </div>
                <div class="iron_details">
                  <hr>
                  <h5>بند الحديد</h5>
                  <div class="iron" id="main-iron">
                    <div class="row" id="row<?=$coco?>">
                      <div class="col-md-2 col-sm-6">
                        <div class="form-group">
                          <label for="iron">مقاس الحديد</label>
                          <select class="form-control" name="iron_<?=$coco?>" id="iron_<?=$coco?>">
                            <option value="0.395">8مم</option>
                            <option value="0.617">10مم</option>
                            <option value="0.888">12مم</option>
                            <option value="1.21">14مم</option>
                            <option value="1.58">16مم</option>
                            <option value="2">18مم</option>
                            <option value="2.47">20مم</option>
                            <option value="2.984">22مم</option>
                            <option value="3.85">25مم</option>
                            <option value="6.41">32مم</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-2 col-sm-6">
                        <div class="form-group">
                          <label for="iron_price">سعر طن الحديد لليوم</label>
                          <input type="text" class="form-control" name='iron_price_<?=$coco?>' id="iron_price_<?=$coco?>">
                        </div>
                      </div>
                      <div class="col-md-2 col-sm-6">
                        <div class="form-group">
                          <label for="iron_quantity">كمية الحديد</label>
                          <input type="text" class="form-control" name='iron_quantity_<?=$coco?>' id="iron_quantity_<?=$coco?>">
                        </div>
                      </div>
                      <div class="col-md-2 col-sm-6">
                        <div class="form-group">
                          <label for="iron_long">طول الحديد</label>
                          <input type="text" class="form-control" name='iron_long_<?=$coco?>' id="iron_long_<?=$coco?>">
                        </div>
                      </div>
                      <div class="col-md-2 col-sm-6">
                        <div class="form-group">
                          <label for="iron_tn">السعر الطن</label>
                          <input type="text" class="form-control" name='iron_tn_<?=$coco?>' id="iron_tn_<?=$coco?>" readonly>
                        </div>
                      </div>
                      <div class="col-md-2 col-sm-6">
                        <div class="form-group">
                          <label for="iron_tot">السعر</label>
                          <input type="text" class="form-control" name='iron_tot_<?=$coco?>' id="iron_tot_<?=$coco?>" readonly>
                          <input type="hidden" value="<?php echo $numberofrows; ?>" id="rowcount" disabled>
                          <input type="hidden" name="iron-rr" id="iron-rr" readonly>
                        </div>
                      </div>
                    </div>
                    <hr class="new2">
                  </div>
                </div>
                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                <script>
                      var i = 1;
                     
                     
                      
                      
                      $(document).on('change', 'input , select', function() {
                        var total_iron = 0;
                        window.grand_tot = 0;
                        for (var z = 1; z <= i ; z++) {
                        var iron = $("#iron_"+z).val();
                        var kg = (parseFloat($("#iron_quantity_"+z).val()) * parseFloat($("#iron_long_"+z).val() || '0') * iron)
                        var tn = kg / 1000;
                        var total = tn * parseFloat($("#iron_price_"+z).val())
                        total_iron += total;
                        tn = tn.toLocaleString("en-US");
                        total = total.toLocaleString("en-US");
                        $("#iron_tn_"+z).val(tn);
                        $("#iron_tot_"+z).val(total);
                        
                        }
                        window.grand_tot += total_iron;
                        total_iron = total_iron.toLocaleString("en-US");
                        
                        $("#total-iron").val(total_iron);
                      });

                     
                      

                      document.addEventListener("DOMContentLoaded", function () {
                        const productDetails = document.querySelector("#product_details");
                        productDetails.addEventListener("click", function (e) {
                          if (e.target.classList.contains("add_iron")) {
            
                            i++;
                            $("#iron-rr").val(i);
                          }
                        });
                      });
                    
                    </script>
                
                <button type="button" class="btn btn-secondary rounded-pill add_iron">أضافة بند حديد</button> 
                <div class="row">
                    السعر الكلي للحديد
                  <input type="text" class="form-control" placeholder="Total" name="total-iron" id="total-iron" readonly>
                </div>
                <hr>
                <div class="accessory_details">
                  <h5>بند الاكسسوارات</h5>
                  <div class="accessory" id="main-accessory">
                    <div class="row ">
                      <div class="col-md-2 col-sm-6 ">
                        <div class="form-group">
                          <label for="accessory">أسم الاكسسوار</label>
                          <input type="text" class="form-control" name='accessory_<?=$coco?>' id="accessory_<?=$coco?>">
                        </div>
                      </div>
                      <div class="col-md-2 col-sm-6">
                        <div class="form-group">
                          <label for="acc_quantity">كمية الاكسسوار</label>
                          <input type="text" class="form-control" name='acc_quantity_<?=$coco?>' id="acc_quantity_<?=$coco?>">
                        </div>
                      </div>
                      <div class="col-md-2 col-sm-6 ">
                        <div class="form-group">
                          <label for="acc_price">سعر الاكسسوار الفردي</label>
                          <input type="text" class="form-control" name='acc_price_<?=$coco?>' id="acc_price_<?=$coco?>">
                        </div>
                      </div>
                      <div class="col-md-2 col-sm-6 ">
                        <div class="form-group">
                          <label for="acc_tot">السعر</label>
                          <input type="text" class="form-control" name='acc_tot_<?=$coco?>' id="acc_tot_<?=$coco?>" readonly>
                          <input type="hidden" name="rowcount_ac" value="<?php echo $numberofrows; ?>" id="rowcount_ac" readonly>
                          <input type="hidden" name="ac-rr" id="ac-rr" readonly>
                        </div>
                      </div>
                    </div>
                    <hr class="new2">
                    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                    <script>
                      var a = 1;
                      
                       $(document).on('change', 'input', function() {
                        var total_accessory = 0;
                          for (var z = 1; z <= a ; z++) {
                            
                            var peice = (parseFloat($("#acc_quantity_"+z).val()) * parseFloat($("#acc_price_"+z).val() || '0'));
                            total_accessory += peice
                            peice = peice.toLocaleString("en-US");
                            $("#acc_tot_"+z).val(peice);
                          }
                          window.grand_tot += total_accessory;
                          total_accessory = total_accessory.toLocaleString("en-US");
                        $("#accessory-iron").val(total_accessory);
                        })
                        console.log("Before Accessory Rows : <?=$accessory_raws?>");
                      document.addEventListener("DOMContentLoaded", function () {
                        const productDetails = document.querySelector("#product_details");
                        productDetails.addEventListener("click", function (e) {
                          
                          if (e.target.classList.contains("add_accessory")) {
            
                            a++;
                            $("#ac-rr").val(a);
                            
                          }
                        });
                      });
                    </script>

                  </div>



                </div>
                <button type="button" class="btn btn-secondary rounded-pill add_accessory">أضافة بند اكسسوار</button>
                <div class="row">
                    السعر الكلي للحديد
                  <input type="text" class="form-control" placeholder="Total" name="accessory-iron" id="accessory-iron" readonly>
                </div>
                <hr>

                <div class="accessory_details">
                  <h5>بند الاغطية</h5>
                  <div class="covers">
                    <div class="row">
                      <div class="col-md-2 col-sm-6 ">
                        <div class="form-group">
                          <label for="cover_type">نوع الغطاء</label>
                          <select class="form-control" name="cover_type" id="cover_type">
                            <option value="بدون اغطية">بدون اغطية</option>
                            <option value="غطاء واحد">غطاء واحد</option>
                            <option value="غطائين">غطائين</option>
                            <option value="غطاء دائري">غطاء دائري</option>
                          </select>
                        </div>
                      </div>

                      <div class="col-md-2 col-sm-6 ">
                        <div class="form-group">
                          <label for="cover_price">سعر الغطاء الفردي</label>
                          <input type="text" class="form-control" name='cover_price' id="cover_price">
                        </div>
                      </div>
                      <div class="col-md-2 col-sm-6 ">
                        <div class="form-group">
                          <label for="cover_tot">السعر الكلي</label>
                          <input type="text" class="form-control" name='cover_tot' id="cover_tot" readonly>
                        </div>
                      </div>
                    </div>
                    <script>
                      $("input").on("change", function() {
                        var peice = (parseFloat($("#cover_price").val()) * parseFloat($("#quantity").val() || '0'))
                        window.grand_tot += peice;
                        peice = peice.toLocaleString("en-US");
                        $("#cover_tot").val(peice);
                      })
                    </script>

                  </div>
                </div>
                <hr>

                <div class="band_details">
                  <h5>بنود اخرى</h5>
                  <div class="band" id="main-band">
                    <div class="row">
                      <div class="col-md-2 col-sm-6">
                        <div class="form-group">
                          <label for="band">أسم البند</label>
                          <input type="text" class="form-control" name="band_<?=$coco?>" id="band_<?=$coco?>">
                        </div>
                      </div>
                      <div class="col-md-2 col-sm-6">
                        <div class="form-group">
                          <label for="band_price">سعر البند</label>
                          <input type="text" class="form-control" name="band_price_<?=$coco?>" id="band_price_<?=$coco?>">
                        </div>
                      </div>
                      <div class="col-md-2 col-sm-6">
                        <div class="form-group">
                          <label for="band_tot">السعر </label>
                          <input type="text" class="form-control" name="band_tot_<?=$coco?>" id="band_tot_<?=$coco?>" readonly>
                          <input type="hidden" value="<?php echo $numberofrows; ?>" id="rowcount_band" disabled>
                          <input type="hidden" name="band-rr" id="band-rr" readonly>
                        </div>
                      </div>
                    </div>
                    <hr class="new2">
                    <script>
                      b = 1; 
                      $(document).on('change', 'input', function() {
                        var total_bands = 0;
                          for (var z = 1; z <= b ; z++) {
                        var peice = (parseFloat($("#band_price_"+z).val()) * parseFloat($("#quantity").val() || '0'))
                        total_bands += peice
                        peice = peice.toLocaleString("en-US");
                        $("#band_tot_"+z).val(peice);
                          }
                          total_bands = total_bands.toLocaleString("en-US");
                          $("#accessory_band").val(total_bands);
                      })

                      document.addEventListener("DOMContentLoaded", function () {
                        const productDetails = document.querySelector("#product_details");
                        productDetails.addEventListener("click", function (e) {
                          if (e.target.classList.contains("add_band")) {
            
                            b++;
                            $("#band-rr").val(b);
                            
                          }
                        });
                      });
                    </script>

                  </div>

                </div>
                <button type="button"  class="btn btn-secondary rounded-pill add_band">أضافة بند</button>
                <div class="row">
                    السعر الكلي للبنود الاضافية
                  <input type="text" class="form-control" placeholder="Total" name="accessory_band" id="accessory_band" readonly>
                </div>
                <hr>
                <!-- Item End -->
                
                <div class="Final_details">
                  <h5>الحساب النهائي</h5>
                  <div class="final">
                    <div class="row">
                      

                      <div class="col-md-2 col-sm-6 ">
                        <div class="form-group">
                          <label for="cover_price">سعر الصنف الواحد </label>
                          <input type="text" class="form-control" name='prod_peice' id="prod_peice" readonly>
                        </div>
                      </div>
                      <div class="col-md-2 col-sm-6 ">
                        <div class="form-group">
                          <label for="cover_tot">السعر البيع</label>
                          <input type="text" class="form-control" name='sell_price' id="sell_price" readonly>
                        </div>
                      </div>
                      <div class="col-md-2 col-sm-6 ">
                        <div class="form-group">
                          <label for="cover_tot">نسبة الربح للصنف الواحد</label>
                          <input type="text" class="form-control" name='net_peice' id="net_peice" readonly>
                        </div>
                      </div>
                      <div class="col-md-2 col-sm-6 ">
                        <div class="form-group">
                          <label for="cover_tot">إجمالي الربح</label>
                          <input type="text" class="form-control" name='net-toti' id="net-toti" readonly>
                        </div>
                      </div>
                    </div>
                    <script>
                      $("input").on("change", function() {
                        var kh = parseFloat($("#kh_tot").val());
                        var iro = parseFloat($("#total-iron").val()) ;
                        var acce = parseFloat($("#accessory-iron").val());
                        var cov = parseFloat($("#cover_tot").val());
                        var exband = parseFloat($("#accessory_band").val());
                        
                        var grand_tot = kh + iro + acce + cov + exband ;
                        $("#prod_peice").val(grand_tot);
                        
                      })
                    </script>

                  </div>
                </div>



              </div>
              <!-- Product End -->

              
              <br><br>

              <div class="row">
                <div class="col">
                  <div class="form-group">
                  <style>
                      .myButton{
                        border: none;
                       cursor: pointer;
                        background: #8392AB;
                         color: #fff;
                          border-radius: 20px;   
                          transition: 0.5s; 
                      }
                      .myButton:hover{
                         background: #344767;
                         letter-spacing: 1px;
                        }
                    </style>
                    <button type="button" class="myButton col-md-6 col-sm-6 mt-5 btn btn-secondary rounded-pill" data-bs-toggle="modal" data-bs-target="#exampleModal">
                      إستمرار
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">إضافة صنف جديد</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                            هل لديك المزيد من الاصناف تود اضافتها ؟
                          </div>
                          <div class="modal-footer">
                            <button type="button" name="add-project" class="myButton col-md-6 col-sm-6 mt-5 btn btn-secondary rounded-pill" >لا</button>
                            <button type="submit" name="add-project2" class="myButton col-md-6 col-sm-6 mt-5 btn btn-secondary rounded-pill">نعم اريد اضافة صنف جديد لنفس المشروع</button>
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