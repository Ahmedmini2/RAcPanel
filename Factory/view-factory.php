<?php
include('../cookies/session2.php');
$_SESSION['sidebar'] = "Factory";

if (isset($_GET['id'])) {
    $project_cost = 0;
    $id = $_GET['id'];

    $query = "SELECT * FROM projects WHERE `id` = $id";
    $res = $conn->query($query);
    $project = $res->fetch_assoc();

    $res2 = mysqli_query($conn, "SELECT * FROM projects_bills WHERE `project_id` = $id");
    while ($r = mysqli_fetch_array($res2)) {
        $total_bills += $r['price'];
    }
    $res3 = mysqli_query($conn, "SELECT * FROM products WHERE `project_id` = $id");
    while ($r2 = mysqli_fetch_array($res3)) {
        $product_id = $r2['id'];

        $res4 = mysqli_query($conn, "SELECT * FROM product_status WHERE `product_id` = $product_id AND `status` ='إنتاج'");
        while ($r3 = mysqli_fetch_array($res4)) {
            $total_bills += $r3['total_price'];
            $kh_used_total += $r3['kharasana_used'];
        }
        $res44 = mysqli_query($conn, "SELECT * FROM kharasana WHERE `product_id` = $product_id ");
        while ($r22 = mysqli_fetch_array($res44)) {
            $kh_quan_tot += $r22['quantity_per_piece'] * $r2['quantity'];
            
            
       
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
    <title>
        المصنع
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
        $titleNav = 'المصنع';
        require_once('../components/navbar.php');
        ?> 
        <!-- End Navbar -->



        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-md-3 col-sm-6 col-xs-6">

                    <?php require_once('../components/notification.php'); ?>
                </div>
                <!--********* -->
                <div class="col-12 mt-4">
                    <div class=" mx-4 p-3">

                        <div class="row ">
                            <div class="text-right col-lg-10 col-sm-6">
                                <a href="project-report.php?project_id=<?=$id?>" 
                                class="btn bg-gradient-dark mb-0">
                                 رفع التقرير عن الانتاج
                                 <i class="fas fa-plus" aria-hidden="true"></i>
                                </a>
                                <a href="receipt-report.php?project_id=<?=$id?>"  
                                class="btn bg-gradient-dark mb-0">
                                 رفع التقرير عن الاستلام
                                 <i class="fas fa-plus" aria-hidden="true"></i>
                                </a>
                                
                            </div>
                            <div class="text-left col-lg-2 col-sm-6">
                            <a href="bills_factory.php?project_id=<?=$id?>" 
                                class="btn bg-gradient-dark mb-0 ">
                                 رفع الفواتير
                                 <i class="fas fa-plus" aria-hidden="true"></i>
                                </a>
                            </div>
                        </div>

                        <script>
                            function printDiv(divName) {

                                document.getElementById('btn1').style.display = "none";
                                document.getElementById('btn2').style.display = "none";
                                document.getElementById('btn3').style.display = "none";
                                window.print();
                                document.getElementById('btn1').style.display = "inline";
                                document.getElementById('btn2').style.display = "inline";
                                document.getElementById('btn3').style.display = "inline";

                            }
                        </script>
                        <!-- Change Status Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">حالة المشروع</h5>
                                        <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close" style="position: relative;left: 0%;right: 80%;">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="post" action="../scripts/update-status/update.php?bank_req=<?= $id ?>">
                                            <?php if ($position == 'Admin' || $position == 'Accounts' && $status == 1) { ?> <button type="submit" name="account" class="btn bg-gradient-dark rounded-pill" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                                    تأكيد المشروع عن طريق المحاسب
                                                </button>
                                            <?php } ?>
                                            <br>
                                            <?php if ($position == 'Admin' || $position == 'Manager' && $status == 2) { ?> <button type="submit" name="manager" class="btn bg-gradient-dark rounded-pill" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                                    تأكيد المشروع عن طريق طريق المدير العام
                                                </button>
                                            <?php } ?>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>

                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>


                </div>
                <div class="col-12 mt-4">
                    <!--********* -->
                    <div class="container-fluid py-4">
                        <div class="row">
                            <div class="<?php if ($position == 'Admin') { echo 'col-xl-6'; } else { echo 'col-xl-12'; } ?>  mb-xl-0 mb-4">
                                <div class="card h-100">
                                    <div class="card-body p-3">

                                        <dl class="dl-horizontal">
                                            <h6>معلومات المشروع</h6>

                                            <dt>الجهة الطالبة المشروع: </dt>
                                            <dd><?= $project['name'] ?></dd>

                                            <dt>تفاصيل المشروع: </dt>
                                            <dd> <?= $project['description'] ?></dd>

                                            <!--  <dt>مدة الموافقة على المشروع: </dt>
                                              <dd>للموافقة قبل:
                                                   <?= $project['valid_till'] ?> 
                                                </dd> 
                                              -->

                                            <dt>مدة تنفيذ المشروع: </dt>
                                            <dd><?= $project['duration'] ?></dd>

                                            <dt>طريقة الدفع: </dt>
                                            <dd><?= $project['payment_type'] ?></dd>

                                        </dl>

                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6" style="display: <?php if ($position == 'Admin') { echo 'flex'; } else { echo 'none'; } ?>;">
                                <div class="row">
                                    <div class="col-md-4 col-sm-2 mb-3">
                                        <div class="card ">
                                            <div class="card-header mx-4 p-3 text-center">
                                                <div class="icon icon-shape icon-lg color-bg-icon shadow text-center border-radius-lg">
                                                    <i class="fas fa-landmark opacity-10"></i>
                                                </div>
                                            </div>
                                            <div class="card-body pt-0 p-3 text-center">
                                                <h6 class="text-center mb-0">تكلفة المشروع</h6>
                                                <hr class="horizontal dark my-3">

                                                <h5 class="mb-0"><?= number_format($project['project_cost']) ?> ريال</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-2 mt-md-0 mt-4">
                                        <div class="card ">
                                            <div class="card-header mx-4 p-3 text-center">
                                                <div class="icon icon-shape icon-lg color-bg-icon shadow text-center border-radius-lg">
                                                    <i class="fas fa-landmark opacity-10"></i>
                                                </div>
                                            </div>
                                            <div class="card-body pt-0 p-3 text-center">
                                                <h6 class="text-center mb-0">متبقي من تكلفة المشروع</h6>

                                                <hr class="horizontal dark my-3">
                                                <h5 class="mb-0"><?=number_format($project['project_cost'] - $total_bills)?> ريال</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-2 mt-md-0 mt-4">
                                        <div class="card ">
                                            <div class="card-header mx-4 p-3 text-center">
                                                <div class="icon icon-shape icon-lg color-bg-icon shadow text-center border-radius-lg">
                                                    <i class="fas fa-landmark opacity-10"></i>
                                                </div>
                                            </div>
                                            <div class="card-body pt-0 p-3 text-center">
                                                <h6 class="text-center mb-0"> ما تم صرفه </h6>

                                                <hr class="horizontal dark my-3">
                                                <h5 class="mb-0"><?=number_format($total_bills)?> ريال</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-2 mb-3">
                                        <div class="card ">
                                            <div class="card-header mx-4 p-3 text-center">
                                                <div class="icon icon-shape icon-lg color-bg-icon shadow text-center border-radius-lg">
                                                    <i class="fas fa-landmark opacity-10"></i>
                                                </div>
                                            </div>
                                            <div class="card-body pt-0 p-3 text-center">
                                                <h6 class="text-center mb-0">الخرسانة الكلية</h6>
                                                <hr class="horizontal dark my-3">

                                                <h5 class="mb-0"><?=$kh_quan_tot?> متر</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-2 mt-md-0 mt-4">
                                        <div class="card ">
                                            <div class="card-header mx-4 p-3 text-center">
                                                <div class="icon icon-shape icon-lg color-bg-icon shadow text-center border-radius-lg">
                                                    <i class="fas fa-landmark opacity-10"></i>
                                                </div>
                                            </div>
                                            <div class="card-body pt-0 p-3 text-center">
                                                <h6 class="text-center mb-0">ما تم صبه</h6>

                                                <hr class="horizontal dark my-3">
                                                <h5 class="mb-0"><?=$kh_used_total?> متر</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-2 mt-md-0 mt-4">
                                        <div class="card ">
                                            <div class="card-header mx-4 p-3 text-center">
                                                <div class="icon icon-shape icon-lg color-bg-icon shadow text-center border-radius-lg">
                                                    <i class="fas fa-landmark opacity-10"></i>
                                                </div>
                                            </div>
                                            <div class="card-body pt-0 p-3 text-center">
                                                <h6 class="text-center mb-0"> متبقي كمية الخرسانة </h6>

                                                <hr class="horizontal dark my-3">
                                                <h5 class="mb-0"><?=$kh_quan_tot - $kh_used_total?> متر</h5>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </div>

                        </div>

                        <!--Table-->
                        <div class="row mt-5" >
                            <div class="col-12">
                                <div class="card mb-4">
                                    <div class="card-header pb-0">
                                        <h6>خرسانة المشروع</h6>
                                    </div>
                                    <div class="card-body px-0 pt-0 pb-2 mx-3">
                                        <div class="table-responsive p-0">
                                            <table class="table table-hover table-bordered table-fixed">

                                                <!--Table head-->
                                                <thead class="bg-dark text-light table-bordered text-center">
                                                    <tr>
                                                        <th>الرقم</th>
                                                        <th>الصنف</th>
                                                        <th>كمية الخرسانة</th>
                                                        <th>سعر الخرسانة</th>
                                                        <th>كمية الخرسانة المستخدمة</th>
                                                        <th>سعر الخرسانة المستخدمة</th>
                                                    </tr>
                                                </thead>
                                                <!--Table head-->

                                                <!--Table body-->
                                                <tbody class="text-center">
                                                    <?php
                                                    $i = 0;
                                                    
                                                    $res3 = mysqli_query($conn, "SELECT * FROM products WHERE `project_id` = $id");
                                                    while ($products = mysqli_fetch_array($res3)) {
                                                        $i++;
                                                        $kh_quan = 0;
                                                    ?>
                                                        <tr>
                                                            <th class="text-secondary" scope="row"><?= $i ?></th>
                                                            <td class="border-1 text-secondary" ><?= $products['product_name'] ?></td>
                                                    <?php
                                                    $kh_id = $products['id'];
                                                     $res4 = mysqli_query($conn, "SELECT * FROM kharasana WHERE `product_id` = $kh_id");
                                                     while ($kh = mysqli_fetch_array($res4)) {
                                                        $kh_quan = $kh['quantity_per_piece'] * $products['quantity'];
                                                        $kh_total = $kh['total_price'];
                                                        
                                                     }
                                                    ?>
                                                            <td class="border-1 text-secondary"><?= $kh_quan ?></td>
                                                            <td class="border-1 text-secondary"><?= number_format($kh_total) ?></td>
                                                    <?php
                                                    $status_id = $products['id'];
                                                    $kh_used = 0;
                                                    $kh_used_price = 0;
                                                        $res5 = mysqli_query($conn, "SELECT * FROM product_status WHERE `product_id` = $status_id AND `status` ='إنتاج'");
                                                        while ($status = mysqli_fetch_array($res5)) {
                                                        $kh_used += $status['kharasana_used'];
                                                        $kh_used_price += $status['total_price'];
                                                        
                                                     }
                                                    ?>
                                                    
                                                            <td class="border-1 text-secondary"><?= number_format($kh_used,2) ?></td>
                                                            <td class="border-1 text-secondary"><?= number_format($kh_used_price) ?></td>

                                                        </tr>
                                                    <?php } ?>

                                                </tbody>
                                                <!--Table body-->

                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12" style="display: <?php if ($position == 'Admin') { echo 'block'; } else { echo 'none'; } ?>;">
                                <div class="card mb-4">
                                    <div class="card-header pb-0">
                                        <h6>اصناف المشروع</h6>
                                    </div>
                                    <div class="card-body px-0 pt-0 pb-2 mx-3">
                                        <div class="table-responsive p-0">
                                            <table class="table table-hover table-bordered table-fixed">

                                                <!--Table head-->
                                                <thead class="bg-dark text-light table-bordered text-center">
                                                    <tr>
                                                        <th>الرقم</th>
                                                        <th>الصنف</th>
                                                        <th>الكمية الكلية للصنف</th>
                                                        <th>موجود في المستودع</th>
                                                        <th>تم انتاج</th>
                                                        <th>تم الاستلام</th>
                                                        <th>المتبقي</th>

                                                    </tr>
                                                </thead>
                                                <!--Table head-->

                                                <!--Table body-->
                                                <tbody class="text-center">
                                                    <?php
                                                    $i = 0;
                                                    $res3 = mysqli_query($conn, "SELECT * FROM products WHERE `project_id` = $id");
                                                    while ($products = mysqli_fetch_array($res3)) {
                                                        $i++;
                                                        $inventory = 0;
                                                        $production = 0;
                                                        $deliverd = 0;
                                                    ?>
                                                        <tr>
                                                            <th class="text-secondary" scope="row"><?= $i ?></th>
                                                            <td class="border-1 text-secondary"><?= $products['product_name'] ?></td>
                                                            <td class="border-1 text-secondary" ><?= $products['quantity'] ?></td>
                                                            <?php 
                                                            $inv_id =  $products['id'];
                                                            $inv_res = mysqli_query($conn, "SELECT * FROM product_status WHERE `product_id` = $inv_id");
                                                            
                                                            while ($inv = mysqli_fetch_array($inv_res)) {
                                                                $inventory += $inv['warehouse'];
                                                                $production += $inv['production'];
                                                            }
                                                            ?>
                                                            <?php 
                                                            $del_id =  $products['id'];
                                                            $del_res = mysqli_query($conn, "SELECT * FROM product_delivery WHERE `product_id` = $del_id");
                                                            
                                                            while ($del = mysqli_fetch_array($del_res)) {
                                                                
                                                                $deliverd += $del['quantity'];
                                                                
                                                            }
                                                            ?>
                                                            <td class="border-1 text-secondary" ><?= number_format($inventory - $deliverd) ?></td>
                                                            <td class="border-1 text-secondary"><?= number_format($production ) ?></td>

                                                            

                                                            <td class="border-1 text-secondary" ><?= number_format($deliverd) ?></td>



                                                            <td class="border-1 text-secondary"><?=$products['quantity']-$production?></td>
                                                        </tr>
                                                    <?php } ?>

                                                </tbody>
                                                <!--Table body-->


                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--Table -->

                        <div class="row">

                            <div class="col-lg-12  mt-4">
                                <div class="card h-100">
                                    <div class="card-header pb-0 p-3">
                                        <div class="row">
                                            <div class="col-12 d-flex align-items-center">
                                                <h6 class="mb-0 text-lg">الفواتير المشروع</h6>
                                            </div>
                                           
                                        </div>
                                    </div>
                                    <div class="card-body p-3 pb-0">
                                        <ul class="list-group">

                                        <?php 
                                          $get_bills = mysqli_query($conn, "SELECT * FROM projects_bills WHERE `project_id` = $id ");
                                          while ($bill = mysqli_fetch_array($get_bills)){

                                        ?>
                                            <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                                                <div class="d-flex flex-column">
                                                    <h6 class="mb-1 text-dark font-weight-bold text-sm"><?=$bill['bill_date']?> <span class="badge text-dark badge-success"> Added by: <?=$bill['added_by']?> </span></h6>
                                                    <span class="text-xs">#<?=$bill['id']?></span>
                                                </div> 
                                                <div class="d-flex align-items-center text-sm">
                                                    ريال <?=$bill['price']?>
                                                    <div class="space"></div>
                                                    <a href="../Signed-Docs/Project-Bills/<?=$bill['project_id']?>/<?=$bill['bill_img']?>" target="_blank" class="btn btn-link text-dark text-sm mb-0 px-3 ms-2 p-2"><i class="fas fa-file-pdf text-lg me-2"></i> PDF</a>
                                                    
                                                </div>
                                            </li>
                                           <?php } ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">

                            <div class="col-lg-12  mt-4">
                                <div class="card h-100">
                                    <div class="card-header pb-0 p-3">
                                        <div class="row">
                                            <div class="col-12 d-flex align-items-center">
                                                <h6 class="mb-0 text-lg">عمليات الإستلام</h6>
                                            </div>
                                           
                                        </div>
                                    </div>
                                    <div class="card-body p-3 pb-0">
                                        <ul class="list-group">

                                        <?php 
                                          $get_delivery = mysqli_query($conn, "SELECT * FROM product_delivery WHERE `project_id` = $id ");
                                          while ($delivery = mysqli_fetch_array($get_delivery)){

                                        ?>
                                            <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                                                <div class="d-flex flex-column">
                                                    <h6 class="mb-1 text-dark font-weight-bold text-sm"><?=$delivery['created_at']?> <span class="badge text-dark badge-success"> تم استلام: <?=$delivery['quantity']?> </span></h6>
                                                    <span class="text-xs">#<?=$delivery['id']?></span>
                                                </div>
                                                <div class="d-flex align-items-center text-sm">
                                                    
                                                    <a href="receipt-bills.php?project_id=<?=$id?>&delivery_id=<?=$delivery['id']?>" target="_blank" class="btn btn-link text-dark text-sm mb-0 px-3 ms-2 p-2"><i class="fas fa-file-pdf text-lg me-2"></i> PDF</a>
                                                </div>
                                            </li>
                                           <?php } ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-6 my-4">
                                <div class="card h-100">
                                    <div class="card-header pb-0">
                                        <h6>نظرة عامة على سير العمل</h6>
                                        <p class="text-sm">

                                            <span class="font-weight-bold"></span> في الأيام الماضية
                                        </p>
                                    </div>
                                    <div class="card-body p-3">
                                        <div class="timeline timeline-one-side">
                                            <?php
                                            $show_products_status = mysqli_query($conn, "SELECT * FROM `product_status` WHERE `project_id` =$id");
                                            while ($r = mysqli_fetch_array($show_products_status)) {
                                                $date = new DateTimeImmutable($r['created_at']);
                                            ?>
                                                <div class="timeline-block mb-3">
                                                    <span class="timeline-step">
                                                        <i class="fa fa-bell text-success text-gradient"></i>
                                                    </span>
                                                    <div class="timeline-content">

                                                        <h6 class="text-dark text-sm font-weight-bold mb-0">تم <?= $r['description'] ?> عدد <?= $r['quantity'] ?> من الصنف <?= $r['name'] ?> وحالته <?= $r['status'] ?></h6>
                                                        <p class="text-secondary font-weight-bold text-xs mt-1 mb-0"><?= $date->format('D jS \o\f F Y h:i:s A') ?></p>
                                                        
                                                    </div>
                                                </div>

                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                

            </div>
            
        </div>
        <?php require_once('../components/footer.php'); ?>
    </main>

    <!--   Core JS Files   -->
    <script src="../assets/js/core/popper.min.js"></script>
    <script src="../assets/js/core/bootstrap.min.js"></script>
    <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
    <script src="../assets/js/plugins/fullcalendar.min.js"></script>
    <script src="../assets/js/plugins/chartjs.min.js"></script>
    
    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="../assets/js/soft-ui-dashboard.min.js?v=1.0.3"></script>
    <script src="../Admin/darkmode.js"></script>
</body>

</html>