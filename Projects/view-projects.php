<?php
include('../cookies/session2.php');
$_SESSION['sidebar'] = "Projects";

if (isset($_GET['id'])) {
    $project_cost = 0;
    $id = $_GET['id'];

    $query = "SELECT * FROM projects WHERE `id` = $id";
    $res = $conn->query($query);
    $project = $res->fetch_assoc();

    $res2 = mysqli_query($conn, "SELECT * FROM products WHERE `project_id` = $id");
    while ($r = mysqli_fetch_array($res2)) {
        $sell_price += $r['sell_price'] * $r['quantity'];
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
        المشاريع
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

    <!-- Style table -->
    <style>
        @media (max-width: 768px) {
       .table thead{
        display: none;
       } 
       .table, .table tbody,.table tr,.table td{
        display: block;
        width: 100%;
       }
       .table tr{
        margin-bottom: 15px;
       }
       .table tbody tr td{
        text-align: right;
        padding-left: 50%;
        position: relative;

       }
       .table td:before{
        content: attr(data-label);
        position: absolute;
        left: 0;
        width: 50%;
        padding-left: 15px;
        font-weight: 600;
        font-size: 14px;
        text-align: left;
        
       }
      }
    </style>
</head>

<body class="g-sidenav-show rtl">

    <!-- Side Bar -->
    <?php require_once('../components/sidebar.php'); ?>
    <!-- End Of side Bar -->
    <main class="main-content position-relative lg:max-height-vh-100 lg:h-100 mt-1 border-radius-lg overflow-hidden">
        <!-- Navbar -->
        <?php
        $titleNav = 'المشاريع';
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
                    <div class="mx-4">

                        <!-- Card Header  -->

                        <div class="row ">
                            <div class="text-right col-lg-7 col-sm-6">
                                <a href="purchase_order.php?project_id=<?= $id ?>" id="btn1" class="btn bg-gradient-dark mb-0">
                                    طباعة التسعيرة

                                </a>
                                <a href="sales_quatation.php?project_id=<?= $id ?>" id="btn2" class="btn bg-gradient-dark mb-0">
                                    Proforma Invoice
                                </a>
                                <a href="documents.php?project_id=<?=$id?>" id="btn3" class="btn bg-gradient-dark mb-0">
                                    مستندات المشروع
                                </a>
                                <a href="edit-project-info.php?project_id=<?=$project['id']?>" id="btn4" class="btn bg-gradient-dark mb-0">
                                    تعديل بيانات المشروع
                                </a>
                            </div>
                            <div class="text-left col-lg-5 col-sm-6">
                                <button type="button" id="btn7" class=" btn bg-gradient-dark rounded-pill" data-bs-toggle="modal" data-bs-target="#exampleModa2">
                                 تعديل بيانات الاصناف 
                                </button>
                                <button type="button" id="btn5" class=" btn bg-gradient-dark rounded-pill" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    تغير حالة المشروع
                                </button>
                                <button type="button" id="btn6" class=" printing btn bg-gradient-dark rounded-pill" onclick="printDiv('printableArea')">
                                    طباعة البنود
                                    <i class="mr-1 fa fa-print text-primary-m1 text-120 w-2"></i>

                                </button>
                            </div>
                        </div>
                        <script>
                            function printDiv(divName) {

                                document.getElementById('btn1').style.display = "none";
                                document.getElementById('btn2').style.display = "none";
                                document.getElementById('btn3').style.display = "none";
                                document.getElementById('btn4').style.display = "none";
                                document.getElementById('btn5').style.display = "none";
                                document.getElementById('btn6').style.display = "none";
                                document.getElementById('btn7').style.display = "none";
                                document.getElementById('information').style.display = "none";
                                document.getElementById('navbarBlur').style.display = "none";

                                window.print();
                                document.getElementById('btn1').style.display = "inline";
                                document.getElementById('btn2').style.display = "inline";
                                document.getElementById('btn3').style.display = "inline";
                                document.getElementById('btn4').style.display = "inline";
                                document.getElementById('btn5').style.display = "inline";
                                document.getElementById('btn6').style.display = "inline";
                                document.getElementById('information').style.display = "flex";
                                document.getElementById('navbarBlur').style.display = "flex";

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
                                        <form method="post" action="../scripts/projects/update-status.php?id=<?= $id ?>">
                                            <?php if ($position == 'Admin') { ?> <button type="submit" name="confirm" class="btn bg-gradient-dark rounded-pill" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                                    تأكيد المشروع
                                                </button>
                                            <?php } ?>
                                            <br>
                                            <?php if ($position == 'Admin') { ?> <button type="submit" name="progress" class="btn bg-gradient-dark rounded-pill" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                                    قيد التنفيذ
                                                </button>
                                            <?php } ?>
                                            <?php if ($position == 'Admin') { ?> <button type="submit" name="done" class="btn bg-gradient-dark rounded-pill" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                                    تم الإنتهاء
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
                        <!-- Change Edit Modal -->
                        <div class="modal fade" id="exampleModa2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabe2" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabe2">تعديل الاصناف المشروع</h5>
                                        <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close" style="position: relative;left: 0%;right: 80%;">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        
                                            <?php
                                            $res2 = mysqli_query($conn, "SELECT * FROM products WHERE `project_id` = $id");
                                            while ($rr = mysqli_fetch_array($res2)) {
                                                
                                            
                                            ?>
                                            <form method="post" action="edit-project.php?project_id=<?=$id?>&item_id=<?=$rr['id']?>">
                                            <?php if ($position == 'Admin') { ?> <button type="submit" name="confirm" class="btn bg-gradient-dark rounded-pill" data-bs-toggle="modal" data-bs-target="#exampleModa2">
                                                    <?= $rr['product_name'] ?>
                                                </button>
                                            <?php } ?>
                                            <br>
                                            </form>
                                            <?php } ?>
                                        
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 mt-2">
                    <!--********* -->
                    <div class="container-fluid py-4">
                        <div class="row" id="information">
                            <div class="col-xl-6 mb-xl-0 mb-4">
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
                            <div class="col-xl-6">
                                <div class="row">
                                    <div class="col-md-4 col-sm-4 mb-3">
                                        <div class="card ">
                                            <div class="card-header mx-4 p-3 text-center">
                                                <div class="icon icon-shape icon-lg color-bg-icon shadow text-center border-radius-lg">
                                                    <i class="fas fa-landmark opacity-10"></i>
                                                </div>
                                            </div>
                                            <div class="card-body pt-0 p-3 text-center">
                                                <h6 class="text-center mb-0">القيمة الاجمالية للمشروع</h6>
                                                <hr class="horizontal dark my-3">

                                                <h5 class="mb-0"><?= number_format($project['total_without_tax'],2,'.',',') ?> ريال</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-4 mt-md-0 mt-4">
                                        <div class="card ">
                                            <div class="card-header mx-4 p-3 text-center">
                                                <div class="icon icon-shape icon-lg color-bg-icon shadow text-center border-radius-lg">
                                                    <i class="fas fa-landmark opacity-10"></i>
                                                </div>
                                            </div>
                                            <div class="card-body pt-0 p-3 text-center">
                                                <h6 class="text-center mb-0">القيمة المضافة</h6>

                                                <hr class="horizontal dark my-3">
                                                <h5 class="mb-0"><?= number_format($project['total_with_tax']) ?> ريال</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-4 mt-md-0 mt-4">
                                        <div class="card ">
                                            <div class="card-header mx-4 p-3 text-center">
                                                <div class="icon icon-shape icon-lg color-bg-icon shadow text-center border-radius-lg">
                                                    <i class="fas fa-landmark opacity-10"></i>
                                                </div>
                                            </div>
                                            <div class="card-body pt-0 p-3 text-center">
                                                <h6 class="text-center mb-0">تكلفة المشروع </h6>

                                                <hr class="horizontal dark my-3">
                                                <h5 class="mb-0"><?= number_format($project['project_cost']) ?> ريال</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-4 mt-md-0 mt-4">
                                        <div class="card ">
                                            <div class="card-header mx-4 p-3 text-center">
                                                <div class="icon icon-shape icon-lg color-bg-icon shadow text-center border-radius-lg">
                                                    <i class="fas fa-landmark opacity-10"></i>
                                                </div>
                                            </div>
                                            <div class="card-body pt-0 p-3 text-center">
                                                <h6 class="text-center mb-0">صافي الربح</h6>

                                                <hr class="horizontal dark my-3">
                                                <h5 class="mb-0"><?= number_format($project['net_total']) ?> ريال</h5>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4 col-sm-4 mt-md-0 mt-4">
                                        <div class="card ">
                                            <div class="card-header mx-4 p-3 text-center">
                                                <div class="icon icon-shape icon-lg color-bg-icon shadow text-center border-radius-lg">
                                                    <i class="fas fa-landmark opacity-10"></i>
                                                </div>
                                            </div>
                                            <div class="card-body pt-0 p-3 text-center">
                                                <h6 class="text-center mb-0">نسبة الربح</h6>

                                                <hr class="horizontal dark my-3">
                                                <h5 class="mb-0"><?php echo number_format((($project['total_without_tax'] - $project['project_cost']) / $project['project_cost']) * 100, 2);  ?> %</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-4 mt-md-0 mt-4">
                                        <div class="card ">
                                            <div class="card-header mx-4 p-3 text-center">
                                                <div class="icon icon-shape icon-lg color-bg-icon shadow text-center border-radius-lg">
                                                    <i class="fas fa-landmark opacity-10"></i>
                                                </div>
                                            </div>
                                            <div class="card-body pt-0 p-3 text-center">
                                                <h6 class="text-center mb-0">حاله المشروع</h6>

                                                <td class="align-middle">
                                                    <?php if ($project['total_without_tax'] == "قيد التنفيذ") { ?>
                                                        <div class="progress-wrapper w-75 mx-auto">

                                                            <div class="progress-info">
                                                                <div class="progress-percentage">
                                                                    <span class="text-xs font-weight-bold">60%</span>
                                                                </div>
                                                            </div>

                                                            <div class="progress">
                                                                <div class="progress-bar bg-gradient-info w-60" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                                                            </div>

                                                        </div>
                                                    <?php } ?>
                                                </td>
                                                <hr class="horizontal dark my-3">
                                                <h5 class="mb-0"><?= $project['status'] ?></h5>
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
                                                        <th>الخرسانة للصنف الواحد</th>
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
                                                            <td data-label="الصنف" class="border-1 text-secondary" ><?= $products['product_name'] ?></td>
                                                    <?php
                                                    $kh_id = $products['id'];
                                                     $res4 = mysqli_query($conn, "SELECT * FROM kharasana WHERE `product_id` = $kh_id");
                                                     while ($kh = mysqli_fetch_array($res4)) {
                                                        $kh_quan = $kh['quantity_per_piece'] * $products['quantity'];
                                                        $kh_total = $kh['total_price'];
                                                        $kh_peice = $kh['quantity_per_piece'];

                                                        
                                                     }
                                                    ?>
                                                            <td data-label="كمية الخرسانة" class="border-1 text-secondary"><?= $kh_quan ?></td>

                                                            <td data-label="الخرسانة للصنف الواحد" class="border-1 text-secondary"><?= $kh_peice ?></td>

                                                            
                                                            <td data-label="سعر الخرسانة" class="border-1 text-secondary"><?= number_format($kh_total) ?></td>
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
                                                    
                                                            <td data-label="كمية الخرسانة المستخدمة" class="border-1 text-secondary"><?= number_format($kh_used,2) ?></td>
                                                            <td data-label="سعر الخرسانة المستخدمة" class="border-1 text-secondary"><?= number_format($kh_used_price) ?></td>

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

                        

                       
                        <!--Table البنود -->
                        <div class="col mt-4">
                            <div class="card">
                                <div class="card-header pb-0 px-3">
                                    <h6 class="mb-0 text-lg">البنود</h6>
                                </div>
                                <div class="card-body pt-4 p-3">
                                    <ul class="list-group">
                                        <?php
                                        $get_products = mysqli_query($conn, "SELECT * FROM products WHERE `project_id` = $id ");
                                        while ($prod = mysqli_fetch_array($get_products)) {
                                        ?>
                                            <li class="list-group-item border-0 p-4 mb-2 mt-2 border-radius-lg shadow-lg">
                                                <div class="d-flex flex-column">
                                                    <h6 class="mb-3 text-lg">الصنف: <?= $prod['product_name'] ?> </h6>
                                                    <span class="mb-2 text-lg">الحديد</span>
                                                    <div class="table-responsive p-0 mb-3">
                                                        <table class="table table-hover table-bordered table-fixed">

                                                            <!--Table head-->
                                                            <thead class="bg-dark text-light table-bordered text-center">
                                                                <tr>
                                                                    <th>الرقم</th>
                                                                    <th >الحجم</th>
                                                                    <th >سعر اليوم</th>
                                                                    <th >الكمية</th>
                                                                    <th >طول الحديد</th>
                                                                    <th >سعر الطن</th>
                                                                    <th>السعر الكلي</th>


                                                                </tr>
                                                            </thead>
                                                            <!--Table head-->

                                                            <!--Table body-->
                                                            <tbody class=" text-center">
                                                                <?php
                                                                $i = 0;
                                                                $iron_total = 0;
                                                                $prod_id = $prod['id'];
                                                                $res5 = mysqli_query($conn, "SELECT * FROM iron_band WHERE `product_id` = $prod_id");
                                                                while ($iron = mysqli_fetch_array($res5)) {
                                                                    $i++;
                                                                    $iron_total += $iron['total_price'];
                                                                ?>
                                                                    <tr>
                                                                        <th data-label="الرقم" class="text-secondary " scope="row"><?= $i ?></th>
                                                                    
                                                                        <td data-label="الحجم" class="border-1 text-secondary"><?= $iron['size'] ?></td>
                                                                        <td data-label="سعر اليوم" class="border-1 text-secondary"><?= number_format($iron['price_today'],2,'.',',')?></td>
                                                                        <td data-label="الكمية" class="border-1 text-secondary" ><?= $iron['quantity'] ?></td>
                                                                        <td data-label="طول الحديد" class="border-1 text-secondary" ><?= $iron['iron_height'] ?></td>
                                                                        <td data-label="سعر الطن" class="border-1 text-secondary"><?= $iron['tn_price'] ?></td>
                                                                        <td  data-label="السعر الكلي" class="border-1 text-secondary"><?= $iron['total_price'] ?></td>
                                                                        
                                                                    </tr>
                                                                    
                                                                <?php } ?>
                                                                <tr class="table-secondary">
                                                                        <td class="border-1" colspan="6">المجموع</td>
                                                                        <td class="border-1"><?=number_format($iron_total,2,'.',',')?></td>
                                                                    </tr>

                                                            </tbody>
                                                            <!--Table body-->

                                                        </table>
                                                    </div>


                                                    <span class="mb-2 text-lg">الإكسسوارات</span>
                                                    <div class="table-responsive p-0 mb-3">
                                                        <table class="table table-hover table-bordered table-fixed">

                                                            <!--Table head-->
                                                            <thead class="bg-dark text-light table-bordered text-center">
                                                                <tr>
                                                                    <th>الرقم</th>
                                                                    <th>إسم الاكسسوار</th>
                                                                    <th>الكمية</th>
                                                                    <th>سعر الحبه</th>
                                                                    <th>السعر الكلي</th>

                                                                </tr>
                                                            </thead>
                                                            <!--Table head-->

                                                            <!--Table body-->
                                                            <tbody class=" text-center">
                                                                <?php
                                                                $i = 0;
                                                                $accessory_total = 0;
                                                                $prod_id = $prod['id'];
                                                                $res6 = mysqli_query($conn, "SELECT * FROM accessory_band WHERE `product_id` = $prod_id");
                                                                while ($accessory = mysqli_fetch_array($res6)) {
                                                                    $i++;
                                                                    $accessory_total += $accessory['total_price'];
                                                                ?>
                                                                    <tr>
                                                                        <th  data-label="الرقم" class="text-secondary" scope="row"><?= $i ?></th>
                                                                        <td  data-label="إسم الاكسسوار" class="border-1 text-secondary"><?= $accessory['name'] ?></td>
                                                                        <td  data-label="الكمية" class="border-1 text-secondary"><?= $accessory['quantity'] ?></td>
                                                                        <td  data-label="سعر الحبه" class="border-1 text-secondary"><?= $accessory['price_per_piece'] ?></td>
                                                                        <td  data-label="السعر الكلي" class="border-1 text-secondary"><?= $accessory['total_price'] ?></td>
                                                                    </tr>
                                                                    
                                                                <?php } ?>
                                                                <tr class="table-secondary">
                                                                        <td class="border-1"  colspan="4">المجموع</td>
                                                                        <td class="border-1" ><?=number_format($accessory_total,2,'.',',')?></td>
                                                                    </tr>


                                                            </tbody>
                                                            <!--Table body-->
                                                        </table>
                                                    </div>


                                                    <span class="mb-2 text-lg">الاغطية</span>
                                                    <div class="table-responsive p-0 mb-3">
                                                        <table class="table table-hover table-bordered table-fixed">

                                                            <!--Table head-->
                                                            <thead class="bg-dark text-light table-bordered text-center">
                                                                <tr>
                                                                    <th>الرقم</th>
                                                                    <th>نوع الغطاء</th>
                                                                    <th>الكمية</th>
                                                                    <th>سعر الحبه</th>
                                                                    <th>السعر الكلي</th>

                                                                </tr>
                                                            </thead>
                                                            <!--Table head-->

                                                            <!--Table body-->
                                                            <tbody class=" text-center">
                                                                <?php
                                                                $i = 0;
                                                                $prod_id = $prod['id'];
                                                                $res7 = mysqli_query($conn, "SELECT * FROM covers_band WHERE `product_id` = $prod_id");
                                                                while ($cover = mysqli_fetch_array($res7)) {
                                                                    $i++;
                                                                ?>
                                                                    <tr>
                                                                        <th class="text-secondary" scope="row"><?= $i ?></th>
                                                                        <td data-label="نوع الغطاء"  class="border-1 text-secondary"><?= $cover['type'] ?></td>
                                                                        <td data-label="الكمية" class="border-1 text-secondary"><?= $prod['quantity'] ?></td>
                                                                        <td data-label="سعر الحبه" class="border-1 text-secondary"><?= $cover['price_per_piece'] ?></td>
                                                                        <td data-label="السعر الكلي" class="border-1 text-secondary"><?= $cover['total_price'] ?></td>
                                                                    </tr>
                                                                <?php } ?>

                                                            </tbody>
                                                            <!--Table body-->
                                                        </table>
                                                    </div>

                                                    <span class="mb-2 text-lg">بنود إضافية</span>
                                                    <div class="table-responsive p-0 mb-3">
                                                        <table class="table table-hover table-bordered table-fixed">

                                                            <!--Table head-->
                                                            <thead class="bg-dark text-light table-bordered text-center">
                                                                <tr>
                                                                    <th>الرقم</th>
                                                                    <th>إسم البند</th>
                                                                    <th>سعر الفرد</th>
                                                                    <th>السعر الكلي</th>

                                                                </tr>
                                                            </thead>
                                                            <!--Table head-->

                                                            <!--Table body-->
                                                            <tbody class=" text-center">
                                                                <?php
                                                                $i = 0;
                                                                $extra_total = 0;
                                                                $prod_id = $prod['id'];
                                                                $res8 = mysqli_query($conn, "SELECT * FROM extra_band WHERE `product_id` = $prod_id");
                                                                while ($extra = mysqli_fetch_array($res8)) {
                                                                    $i++;
                                                                    $extra_total += $extra['total_price'];
                                                                ?>
                                                                    <tr>
                                                                        <th class="text-secondary" scope="row"><?= $i ?></th>
                                                                        <td data-label="إسم البند"  class="border-1 text-secondary"><?= $extra['name'] ?></td>
                                                                        <td data-label="سعر الفرد"  class="border-1 text-secondary "><?= $extra['price_per_piece'] ?></td>
                                                                        <td data-label="السعر الكلي"  class="border-1 text-secondary" ><?= $extra['total_price'] ?></td>
                                                                    </tr>
                                                                    
                                                                <?php } ?>
                                                                <tr class="table-secondary">
                                                                        <td class="border-1 " colspan="3">المجموع</td>
                                                                        <td class="border-1"><?=number_format($extra_total,2,'.',',')?></td>
                                                                    </tr>

                                                            </tbody>
                                                            <!--Table body-->
                                                        </table>
                                                    </div>


                                                </div>
                                            <?php } ?>
                                            </li>


                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!--Table المجموع الكلي لجميع الاصناف -->
                         <div class="row">
                            <div class="col-12">
                                <div class="card mb-4 mt-3">
                                    <div class="card-header pb-0 ">
                                        <h6>المجموع الكلي لجميع الاصناف</h6>
                                    </div>
                                    <div class="card-body px-0 pt-0 pb-2 mx-3">
                                        <div class="table-responsive p-0">
                                            <table class="table table-hover table-bordered table-fixed">

                                                <!--Table head-->
                                                <thead class="bg-dark text-light table-bordered text-center">
                                                    <tr>
                                                        <th>الرقم</th> 
                                                        <th >اسم الصنف</th>
                                                        <th  >تكلفه الصنف</th>
                                                        <th  >سعر البيع</th>
                                                        <th  >صافي الربح</th>
                                                        <th  >مجموع صافي الربح</th>
                                                        <th  >نسبه الربح</th>
                                                       
                                                        

                                                    </tr>
                                                </thead>
                                                <!--Table head-->

                                                <!--Table body-->
                                                <tbody class=" text-center">
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
                                                            <td data-label="اسم الصنف"  class="border-1 text-secondary"><?= $products['product_name'] ?></td>
                                                            <td data-label="تكلفه الصنف" class="border-1 text-secondary"><?= number_format($products['cost_price'],2,'.',',')?></td>
                                                            <td  data-label="سعر البيع" class="border-1 text-secondary"><?= number_format($products['sell_price'],2,'.',',')?></td>
                                                            <td data-label="صافي الربح" class="border-1 text-secondary"><?= number_format($products['net_profit'],2,'.',',')?></td>
                                                            <td data-label="مجموع صافي الربح" class="border-1 text-secondary"><?= number_format($products['net_profit']*$products['quantity'],2,'.',',')?></td>
                                                            <td data-label="نسبه الربح" class="border-1 text-secondary"><?=$products['net_perc']?></td>   
                                            
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
                            <div class="col-12">
                                <div class="card mb-4 mt-3">
                                    <div class="card-header pb-0 ">
                                        <h6>التوصيل</h6>
                                    </div>
                                    <div class="card-body px-0 pt-0 pb-2 mx-3">
                                        <div class="table-responsive p-0">
                                            <table class="table table-hover table-bordered table-fixed">

                                                <!--Table head-->
                                                <thead class="bg-dark text-light table-bordered text-center">
                                                    <tr>
                                                        <th>الرقم</th>
                                                        <th>الصنف</th>
                                                        <th>عدد القطع للتريلة</th>
                                                        <th>عدد التريلات</th>
                                                        <th>سعر توصيل القطعه</th>
                                                        <th>سعر التوصيل التريلة</th>
                                                        <th>سعر التوصيل الكلي</th>
                                                        <th>توصيل الى</th>

                                                    </tr>
                                                </thead>
                                                <!--Table head-->

                                                <!--Table body-->
                                                <tbody class=" text-center">
                                                    <?php
                                                    $i = 0;
                                                    $res3 = mysqli_query($conn, "SELECT * FROM products WHERE `project_id` = $id");
                                                    while ($products = mysqli_fetch_array($res3)) {
                                                        $product_id = $products['id'];
                                                        $deleivery_query  = $conn->query("SELECT * FROM delivery WHERE `product_id` = $product_id");
                                                        $delevery = $deleivery_query->fetch_assoc();
                                                        
                                                       
                                                        $del_status = $delevery['deliverable'];
                                                        $peice_per_track = $delevery['peice_per_track'];
                                                        $quantity_of_track = $delevery['quantity_of_track'];
                                                        $piece_price = $delevery['piece_price'];
                                                        $track_price = $delevery['track_price'];
                                                        $del_total_price = $delevery['total_price'];
                                                        $delivery_to = $delevery['delivery_to'];
                                                       
                                                        $i++;
                                                        $extra_del_total_price += $del_total_price;
                                                    ?>
                                                        <?php if ($del_status == 1) { ?>
                                                        <tr>
                                                            <th class="text-secondarys" scope="row"><?= $i ?></th>
                                                            <td data-label="الصنف" class="border-1 text-secondary"><?= $products['product_name'] ?></td>
                                                            <td data-label="عدد القطع للتريلة" class="border-1 text-secondary"><?= $peice_per_track ?></td>                                                
                                                            <td data-label="عدد التريلات" class="border-1 text-secondary"><?= $quantity_of_track ?></td>
                                                            <td data-label="سعر توصيل القطعه" class="border-1 text-secondary" ><?= number_format( $piece_price ,2,'.',',') ?></td>
                                                            <td data-label="سعر التوصيل التريلة" class="border-1 text-secondary"><?= number_format($track_price,2,'.',',') ?></td>
                                                            <td data-label="سعر التوصيل الكلي" class="border-1 text-secondary"><?= $delivery_to  ?></td>
                                                            <td data-label="توصيل الى" class="border-1 text-secondary"><?= number_format($del_total_price,2,'.',',') ?></td>

                                                            
                                                        </tr>
                                                       <?php } ?>
                                                    <?php } ?>
                                                         <tr class="table-secondary">
                                                            <td class="border-1 " colspan="7">المجموع</td>
                                                            <td class="border-1"><?=number_format($extra_del_total_price,2,'.',',')?></td>
                                                         </tr>

                                                </tbody>
                                                <!--Table body-->

                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>     
                        
                         
                        <!--Table -->
                        <div class="col mt-4">
                            <div class="card h-100">
                                <div class="card-header pb-0 p-3">
                                    <div class="row">
                                        <div class="col-6 d-flex align-items-center">
                                            <h6 class="mb-0 text-lg">الفواتير</h6>
                                        </div>

                                    </div>
                                </div>
                                <div class="card-body p-3 pb-0">
                                    <ul class="list-group">
                                        <?php
                                        $get_bills = mysqli_query($conn, "SELECT * FROM projects_bills WHERE `project_id` = $id ");
                                        while ($bill = mysqli_fetch_array($get_bills)) {

                                        ?>
                                            <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                                                <div class="d-flex flex-column">
                                                    <h6 class="mb-1 text-dark font-weight-bold text-sm"><?= $bill['bill_date'] ?> <span class="badge text-dark badge-success"> فاتورة بأسم <?= $bill['added_by'] ?> </span></h6>
                                                    <span class="text-xs">#رقم<?= $bill['id'] ?></span>
                                                </div>
                                                <div class="d-flex align-items-center text-sm">
                                                    ريال <?= $bill['price'] ?>
                                                    <div class="space"></div>
                                                    <a href="../Signed-Docs/Project-Bills/<?= $bill['project_id'] ?>/<?= $bill['bill_img'] ?>" target="_blank" class="btn btn-link text-dark text-sm mb-0 px-3 ms-2 p-2"><i class="fas fa-file-pdf  me-2"></i> PDF</a>
                                                    <button type="button" class="btn btn-link text-dark text-sm mb-0 px-3 ms-2 p-2" data-bs-toggle="modal" data-bs-target="#exampleModalBill"><i class="fas fa-trash  me-2"></i> Delete</button>
                                                    <div class="modal fade" id="exampleModalBill" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">حذف الفاتورة</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                            الرجاء ادخال كلمة المرور للتأكيد
                                                            <form action="../scripts/projects/delete-bill.php?id=<?php echo $bill['id']; ?>" method="post">
                                                                <input type="password" name="pas" class="form-control">

                                                            </div>
                                                            <div class="modal-footer">

                                                            <button type="submit" name="del" class="myButton col-md-6 col-sm-6 mt-5 btn btn-secondary rounded-pill">تأكيد الحذف</button>
                                                            </form>
                                                            </div>
                                                        </div>
                                                        </div>
                                                    </div> 
                                                </div>
                                            </li>
                                        <?php } ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!--Table -->
                        <div class="row">
                            <div class="col-lg-6  mt-4">
                                <div class="card h-100">
                                    <div class="card-header pb-0 p-3">
                                        <div class="row">
                                            <div class="col-12 d-flex align-items-center">
                                                <h6 class="mb-0 text-lg">عمليات التسليم</h6>
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
                                                <div class="align-items-center text-sm">
                                                    
                                                    <a href="../Factory/receipt-bills.php?project_id=<?=$id?>&delivery_id=<?=$delivery['id']?>" target="_blank" class="btn btn-link text-dark text-sm mb-0 px-3 ms-2 p-2"><i class="fas fa-file-pdf  me-2"></i> PDF</a>
                                                    <a class="btn btn-link text-dark px-3 mb-0 ms-2 p-2" href="../Factory/receipt-report.php?project_id=<?=$id?>&edit=<?=$delivery['id']?>"><i class="fas fa-pencil-alt text-dark me-2" aria-hidden="true"></i>Edit</a>
                                                    <button type="button" class="btn btn-link text-dark text-sm mb-0 px-3  p-2" data-bs-toggle="modal" data-bs-target="#exampleModalReceive"><i class="fas fa-trash  me-2"></i> Delete</button>
                                                    <div class="modal fade" id="exampleModalReceive" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">حذف التسليم</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                            الرجاء ادخال كلمة المرور للتأكيد
                                                            <form action="../scripts/projects/delete-receive.php?id=<?php echo $delivery['id']; ?>" method="post">
                                                                <input type="password" name="pas" class="form-control">

                                                            </div>
                                                            <div class="modal-footer">

                                                            <button type="submit" name="del" class="myButton col-md-6 col-sm-6 mt-5 btn btn-secondary rounded-pill">تأكيد الحذف</button>
                                                            </form>
                                                            </div>
                                                        </div>
                                                        </div>
                                                    </div> 
                                                </div>
                                            </li>
                                           <?php } ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        
                            <div class="col-lg-6 col-md-6 my-4">
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
                                                        <a class="btn btn-link text-dark px-3 mb-0 ms-2 p-2" href="../Factory/project-report.php?project_id=<?=$id?>&edit=<?=$r['id']?>"><i class="fas fa-pencil-alt text-dark me-2" aria-hidden="true"></i>Edit</a>
                                                        <button type="button" class="btn btn-link text-dark text-sm mb-0 px-3 ms-2 p-2" data-bs-toggle="modal" data-bs-target="#exampleModalReport"><i class="fas fa-trash me-2"></i> Delete</button>
                                                            <div class="modal fade" id="exampleModalReport" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">حذف تقرير الإستلام</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                    الرجاء ادخال كلمة المرور للتأكيد
                                                                    <form action="../scripts/projects/delete-report.php?id=<?php echo $r['id']; ?>" method="post">
                                                                        <input type="password" name="pas" class="form-control">

                                                                    </div>
                                                                    <div class="modal-footer">

                                                                    <button type="submit" name="del" class="myButton col-md-6 col-sm-6 mt-5 btn btn-secondary rounded-pill">تأكيد الحذف</button>
                                                                    </form>
                                                                    </div>
                                                                </div>
                                                                </div>
                                                            </div> 
                                                    </div>
                                                </div>

                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                       

                                                

                                                

                                        
                        
                            <!--Table خط سير تنفيد المشروع -->
                            <div class="row">
                                <div class="col-12">
                                    <div class="card mb-4 mt-3">
                                        <div class="card-header pb-0 ">
                                            <h6>خط سير تنفيد المشروع</h6>
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
                                                    <tbody class=" text-center">
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
                                                                <td data-label="الصنف" class="border-1 text-secondary"><?= $products['product_name'] ?></td>
                                                                <td data-label="الكمية الكلية للصنف" class="border-1 v"><?= $products['quantity'] ?></td>
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
                                                                <td data-label="موجود في المستودع" class="border-1 text-secondary" ><?= number_format($inventory - $deliverd) ?></td>
                                                                <td data-label="تم انتاج" class="border-1 text-secondary"><?= number_format($production) ?></td>



                                                                <td data-label="تم الاستلام" class="border-1 text-secondary"><?= number_format($deliverd) ?></td>

                                                                <td data-label="المتبقي" class="border-1 text-secondary"><?= $products['quantity'] - $production ?></td>
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

                    </div>
                </div>
            </div>
            <button type="button" class=" btn bg-gradient-dark rounded-pill col-md-2 col-sm-6 col-xs-6 mx-4 " data-bs-toggle="modal" data-bs-target="#exampleModal3">حذف المشروع</button>
                          <div class="modal fade" id="exampleModal3" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">حذف التكلفة</h5>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                  الرجاء ادخال كلمة المرور للتأكيد
                                  <form action="../scripts/projects/delete.php?id=<?php echo $project['id']; ?>" method="post">
                                    <input type="password" name="pas" class="form-control">

                                </div>
                                <div class="modal-footer">

                                  <button type="submit" name="del" class="myButton col-md-6 col-sm-6 mt-5 btn btn-secondary rounded-pill">تأكيد الحذف</button>
                                  </form>
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