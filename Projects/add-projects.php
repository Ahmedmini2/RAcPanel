<?php
include('../cookies/session2.php');
$_SESSION['sidebar'] = "Projects";
$coco = 1;
$numberofrows = 1;

$iron_raws = 1;
$accessory_raws = 1;
$band_raws = 1;
if(isset($_POST['add-project'])){

  $iron1 = 1;
  $accessory1 = 1;
  $band1 = 1;

  $project_name = $_POST['project_name'];
  $project_description = $_POST['project_description'];

  $insert_project = "INSERT INTO projects ('id', 'name', 'description','created_at') VALUES(NULL, '$project_name', '$project_description , NOW())";
  $project_res= $conn->query($insert_project);
  if($project_res){
    $_SESSION['notification'] = "تم اضافة المستفيد بنجاح";
    header('location: index.php');
    exit();
    
  }else{
    $_SESSION['notification'] = "يوجد خلل في النظام";
    header('location: index.php');
  }
  

  $product_name = $_POST['product_name'];
  $dimensions = $_POST['dimensions'];
  $quantity = $_POST['quantity'];

  $kharasana = $_POST['kharasana'];
  $kh_price = $_POST['kh_price'];
  $kh_per = $_POST['kh_per'];
  $kh_peice = $_POST['kh_peice'];
  $kh_tot = $_POST['kh_tot'];

  while ($iron1 <= $iron_raws){
    $iron_[$iron1] = $_POST['iron_'.$iron1];
    $iron_price_[$iron1] = $_POST['iron_price_'.$iron1];
    $iron_quantity_[$iron1] = $_POST['iron_quantity_'.$iron1];
    $iron_long_[$iron1] = $_POST['iron_long_'.$iron1];
    $iron_tn_[$iron1] = $_POST['iron_tn_'.$iron1];
    $iron_tot_[$iron1] = $_POST['iron_tot_'.$iron1];
    $iron1++;
  }

  while ($accessory1 <= $accessory_raws){
    $accessory_[$accessory1] = $_POST['accessory_'.$accessory1];
    $acc_quantity_[$accessory1] = $_POST['acc_quantity_'.$accessory1];
    $acc_price_[$accessory1] = $_POST['acc_price_'.$accessory1];
    $acc_tot_[$accessory1] = $_POST['acc_tot_'.$accessory1];
    $accessory1++;
  }

  $cover_type = $_POST['cover_type'];
  $cover_price = $_POST['cover_price'];
  $cover_tot = $_POST['cover_tot'];


  while ($band1 <= $band_raws){
    $band_[$band1] = $_POST['band_'.$band1];
    $band_price_[$band1] = $_POST['band_price_'.$band1];
    $band_tot_[$band1] = $_POST['band_tot_'.$band1];
    $band1++;
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
                          <label for="kh_tot">السعر للمنتج الفردي</label>
                          <input type="text" class="form-control" name='kh_peice' id="kh_peice" disabled>
                        </div>
                      </div>
                      <div class="col-md-2 col-sm-6 ">
                        <div class="form-group">
                          <label for="kh_tot">السعر الكلي</label>
                          <input type="text" class="form-control" name='kh_tot' id="kh_tot" disabled>
                        </div>
                      </div>
                    </div>
                    <script>
                      $("input").on("change", function() {
                        var peice = (parseFloat($("#kh_price").val()) * parseFloat($("#kh_per").val() || '0'))
                        var ret = (parseFloat($("#kh_price").val()) * parseFloat($("#kh_per").val() || '0')) * parseFloat($("#quantity").val())
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
                          <input type="text" class="form-control" name='iron_tn_<?=$coco?>' id="iron_tn_<?=$coco?>" disabled>
                        </div>
                      </div>
                      <div class="col-md-2 col-sm-6">
                        <div class="form-group">
                          <label for="iron_tot">السعر الكلي</label>
                          <input type="text" class="form-control" name='iron_tot_<?=$coco?>' id="iron_tot_<?=$coco?>" disabled>
                          <input type="hidden" value="<?php echo $numberofrows; ?>" id="rowcount" disabled>
                        </div>
                      </div>
                    </div>
                    <hr class="new2">
                  </div>
                </div>
                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                <script>
                      var i = 1;
                      $(document).on('change', 'select', function() {
                        for (var z = 1; z <= i ; z++) {
                          var iron = $("#iron_"+z).val();
                          var kg = (parseFloat($("#iron_quantity_"+z).val()) * parseFloat($("#iron_long_"+z).val() || '0') * iron)
                          var tn = kg / 1000;
                          var total = tn * parseFloat($("#iron_price_"+z).val())
                          $("#iron_tn_"+z).val(tn);
                          $("#iron_tot_"+z).val(total);
                        
                        }
                      });
                      
                      
                      $(document).on('change', 'input', function() {
                        for (var z = 1; z <= i ; z++) {
                        var iron = $("#iron_"+z).val();
                        var kg = (parseFloat($("#iron_quantity_"+z).val()) * parseFloat($("#iron_long_"+z).val() || '0') * iron)
                        var tn = kg / 1000;
                        var total = tn * parseFloat($("#iron_price_"+z).val())
                        $("#iron_tn_"+z).val(tn);
                        $("#iron_tot_"+z).val(total);
                        }
                      });

                      document.addEventListener("DOMContentLoaded", function () {
                        const productDetails = document.querySelector("#product_details");
                        productDetails.addEventListener("click", function (e) {
                          if (e.target.classList.contains("add_iron")) {
            
                            i++;
                            <?php $noraws++; ?>
                          }
                        });
                      });
                    
                    </script>

                <button type="button" class="btn btn-secondary rounded-pill add_iron">أضافة بند حديد</button>
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
                          <label for="acc_tot">السعر الكلي</label>
                          <input type="text" class="form-control" name='acc_tot_<?=$coco?>' id="acc_tot_<?=$coco?>" disabled>
                          <input type="hidden" value="<?php echo $numberofrows; ?>" id="rowcount_ac" disabled>
                        </div>
                      </div>
                    </div>
                    <hr class="new2">
                    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                    <script>
                      var a = 1;
                      
                       $(document).on('change', 'input', function() {
                          for (var z = 1; z <= a ; z++) {
                            
                            var peice = (parseFloat($("#acc_quantity_"+z).val()) * parseFloat($("#acc_price_"+z).val() || '0'))
                            $("#acc_tot_"+z).val(peice);
                          }
                        })

                      document.addEventListener("DOMContentLoaded", function () {
                        const productDetails = document.querySelector("#product_details");
                        productDetails.addEventListener("click", function (e) {
                          if (e.target.classList.contains("add_accessory")) {
            
                            a++;
                            
                          }
                        });
                      });
                    </script>

                  </div>



                </div>
                <button type="button" class="btn btn-secondary rounded-pill add_accessory">أضافة بند اكسسوار</button>
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
                          <input type="text" class="form-control" name='cover_tot' id="cover_tot" disabled>
                        </div>
                      </div>
                    </div>
                    <script>
                      $("input").on("change", function() {
                        var peice = (parseFloat($("#cover_price").val()) * parseFloat($("#quantity").val() || '0'))
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
                          <label for="band_tot">السعر الكلي</label>
                          <input type="text" class="form-control" name="band_tot_<?=$coco?>" id="band_tot_<?=$coco?>" disabled>
                          <input type="hidden" value="<?php echo $numberofrows; ?>" id="rowcount_band" disabled>
                        </div>
                      </div>
                    </div>
                    <hr class="new2">
                    <script>
                      b = 1; 
                      $(document).on('change', 'input', function() {
                          for (var z = 1; z <= b ; z++) {
                        var peice = (parseFloat($("#band_price_"+z).val()) * parseFloat($("#quantity").val() || '0'))
                        $("#band_tot_"+z).val(peice);
                          }
                      })

                      document.addEventListener("DOMContentLoaded", function () {
                        const productDetails = document.querySelector("#product_details");
                        productDetails.addEventListener("click", function (e) {
                          if (e.target.classList.contains("add_band")) {
            
                            b++;
                            
                          }
                        });
                      });
                    </script>

                  </div>

                </div>
                <button type="button" name="add-project" class="btn btn-secondary rounded-pill add_band">أضافة بند</button>
                
                <hr>
                <!-- Item End -->




              </div>
              <!-- Product End -->

              
              <br><br>

              <div class="row">
                <div class="col">
                  <div class="form-group">
                    <button type="submit" name="submit" class="btn btn-secondary rounded-pill"> حفظ </button>
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