<?php 
include ('../cookies/session2.php');
$_SESSION['sidebar']="Accounts";


    $id= $_GET['req_id'];
    $query="SELECT * FROM bank_request WHERE id=$id";
    $res= $conn->query($query);
    $editData=$res->fetch_assoc();
    $name=$editData['name'];
    $description=$editData['description'];
    $amount_text=$editData['amount_text'];
    $amount_number=$_POST['amount_number'];
    $our_bank_name=$editData['our_bank_name'];
    $to_account_type=$editData['to_account_type'];
    $transfer_to=$editData['transfer_to'];
    $status=$editData['status'];
    $created_at=$editData['created_at'];
    $updated_at=$editData['updated_at'];
    $accepted_at=$editData['accepted_at'];

    $to_name=$_POST['to_name'];
    $to_bank_name=$_POST['to_bank_name'];
    $to_bank_number=$_POST['to_bank_number'];
    $to_bank_iban=$_POST['to_bank_iban'];

    if($transfer_to ==""){
      $transfer_to = $to_name;
      }
    if(isset($_POST['edit'])){
        $name=$_POST['name'];
    $description=$_POST['description'];
    $amount_text=$_POST['amount_text'];
    $amount_number=$_POST['amount_number'];
    $our_bank_name=$_POST['our_bank_name'];
    $to_account_type=$_POST['to_account_type'];
    $transfer_to=$_POST['transfer_to'];
    
    $update = "UPDATE `bank_request` SET `name' = '$name' , `description' = '$description' , `amount_text' = '$amount_text', `amount_number`= '$amount_number' , `our_bank_name` = '$our_bank_name'
    ,`to_account_type`='$to_account_type', `transfer_to' = '$transfer_to' WHERE `id` = $id";
    $updateResult=$conn->query($update);
    $idAttr="updateForm";
    if($updateResult){
      $_SESSION['notification'] = "تم تعديل التعميد بنجاح";
    }else{
      $_SESSION['notification'] = "يوجد خلل في النظام";
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
  <title>
  تعديل طلب تعميد
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
  <link href="../assets/css/nucleo-svg.css" rel="stylesheet"/>
  <!-- CSS Files -->
  <link id="pagestyle" href="../assets/css/soft-ui-dashboard.css?v=1.0.3" rel="stylesheet" />
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
            <li class="breadcrumb-item text-sm ps-2"><a class="opacity-5 text-dark" href="javascript:;">تعديل طلب تعميد</a></li>
            
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
          <div class="block-header bg-gradient-dark col-md-3 col-sm-6 col-xs-6  rounded-pill">
                                    
            <?php require_once('../components/notification.php'); ?>
          </div>
                                <div class="block-header bg-gradient-dark  col-md-2 col-sm-6 col-xs-6  rounded-pill">
                                    
                                    <h5 class="block-title text-white py-2 px-4">تعديل طلب تعميد</h5>
                                </div>
                                <form id="<?php echo $idAttr; ?>" action="" method="post">
                                <div class="row">
                                  <div class="col">
                                    <div class="form-group">
                                      <label>نوع التعميد</label>
                                      <select name="name" id="name" class="form-control" placeholder="نوع التعميد" onchange="showDiv(this)">
                                            <option value="0"></option>
                                            <option value="1" <?php if($name==1) echo 'selected="selected"'; ?>>طلب تحويل بنكي</option>
                                            <option value="2" <?php if($name==2) echo 'selected="selected"'; ?>>طلب سحب مبلغ مالي</option>
                                            <option value="3" <?php if($name==3) echo 'selected="selected"'; ?>>طلب اصدار شيك بنكي</option>
                                          </select>
                                          
                                      <script type="text/javascript">
                                      function showDiv(select){
                                        if(select.value==1){
                                          document.getElementById('hidden_div').style.display = "block";
                                        } else{
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
                                      <textarea  placeholder="التفاصيل" class="form-control" name="description" ><?php echo $description; ?></textarea>
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
                                      <input type="text" placeholder="ادخل المبلغ المالي عن طريق الارقام مثل 10,000" class="form-control" name="amount_number" value="<?php echo $amount_number; ?>">
                                    </div>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col">
                                    <div class="form-group">
                                      <label>من حساب الشركة بنك</label>
                                      <select name="our_bank_name" id="our_bank_name" class="form-control" placeholder="نوع التعميد">
                                            <?php
                                            $select =mysqli_query($conn, "select name from bank_info");
                                            $i=0; while($r=mysqli_fetch_array($select)){

                                              echo '<option value="'.$r[$i].'"'; if($our_bank_name==$r[$i]) echo 'selected="selected"'; echo '>'.$r[$i].'</option>';
                                              $i++;
                                            }
                                            ?>
                                            
                                          </select>
                                    </div>
                                  </div>
                                  <div class="col" >
                                    <div class="form-group">
                                      <label>نوع الحساب</label>
                                      <select name="to_account_type" id="to_account_type" class="form-control" placeholder="نوع التعميد" onchange="showDiv2(this)">
                                        <option value="0"></option>
                                        <option value="حساب مسجل" <?php if($to_account_type=='حساب مسجل') echo 'selected="selected"'; ?>>حساب مسجل</option>
                                        <option value="حساب جديد" <?php if($to_account_type=='حساب جديد') echo 'selected="selected"'; ?>>حساب جديد</option>
                                      </select>
                                      
                                    </div>
                                  </div>
                                </div>

                                <div class="row">
                                  <div class="col"  >
                                     <div class="form-group">
                                        <label>الى حساب شركة</label>
                                        <select name="transfer_to" id="transfer_to" class="form-control" placeholder="نوع التعميد">
                                        <option value=""></option>  
                                        <?php
                                            $select =mysqli_query($conn, "select name from beneficiary_info");
                                            $i=0; while($r=mysqli_fetch_array($select)){

                                              echo '<option value="'.$r[$i].'"'; if($transfer_to==$r[$i]) echo 'selected="selected"'; echo ' >'.$r[$i].'</option>';
                                              $i++;
                                            }
                                            ?>
                                                  
                                        </select>
                                      </div>
                                    </div>
                                </div> 
                                
                                
                                
                                <div class="row">
                                  <div class="col">
                                    <div class="form-group">
                                      <button type="submit" name="edit" class="btn btn-secondary">تقديم تعديل التعميد</button>
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