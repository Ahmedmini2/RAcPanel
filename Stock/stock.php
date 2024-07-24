<?php
include('../cookies/session2.php');
$_SESSION['sidebar'] = "stock";
$select = mysqli_query($conn, "select * from stock");

?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <title>
    المخزن
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
  <!-- Extar js  -->


  <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
  <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
  <script src="//cdn.datatables.net/plug-ins/1.10.7/integration/bootstrap/3/dataTables.bootstrap.js"></script>
</head>

<body class="g-sidenav-show rtl ">

  <!-- Side Bar -->
  <?php require_once('../components/sidebar.php'); ?>
  <!-- End Of side Bar -->
  <main class="main-content position-relative lg:max-height-vh-100 lg:h-100 mt-1 border-radius-lg overflow-hidden">
    <!-- Navbar -->
    <?php 
     $titleNav = 'المخزن'; 
     require_once('../components/navbar.php');
     ?>
    <!-- End Navbar -->
    <div class="container-fluid py-4">
      <div class="row">

        <a href="add-stock.php" class="btn bg-gradient-dark mb-0 col-md-2 col-sm-6 col-xs-6"> أضافة منتج جديد&nbsp;&nbsp; <i class="fas fa-plus"></i></a>
       
        <div class="block-content " style="padding:15px;overflow-x: auto;white-space: nowrap;">
          <div class="content">
            <div class="block-header col-md-3 col-sm-6 col-xs-6  rounded">

              <?php require_once('../components/notification.php'); ?>
            </div>

            <div class="block">
              <table class="table table-hover table-bordered align-items-center mb-0" id="example">
                <thead>
                  <tr  class="text-center">
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" width="2%">الرقم</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" width="5%">اسم المنتج</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">الوصف</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">الكمية</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">الكمية المستهلكة</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">الكمية المتبقيه</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">سعر الصنف الواحد</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">الاجمالي</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">صورة الفاتورة</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">تاريخ الطلب</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>

                  </tr>
                </thead>
                <tbody>
                 
                <?php 
                  while ($r = mysqli_fetch_array($select)) {
                    $remaining_quantity = $r['quantity'] - $r['used_quantity'];
                     ?>

                    <tr class="text-center">

                      <td class="text-xs text-secondary mb-0 border-1 "><?=$r['id']?></td>
                      <td class="text-xs text-secondary mb-0 border-1"><?=$r['name_stock']?></td>
                      <td class="mb-0 text-sm text-secondary border-1"><?=$r['description']?></td>
                      <td class="mb-0 text-sm text-secondary border-1"><?=$r['quantity']?></td>
                      <td class="mb-0 text-sm text-secondary border-1"><?=$r['used_quantity']?></td>
                      <td class="mb-0 text-sm text-secondary border-1"><?= $remaining_quantity?></td>
                      <td class="mb-0 text-sm text-secondary border-1"><?=$r['price_per_peice']?></td>
                      <td class="mb-0 text-sm text-secondary border-1"><?=$r['total_price']?></td>
                      <td class="mb-0 text-sm text-secondary border-1"><a href="../Signed-Docs/Stock-Bills/<?=$r['id']?>/<?=$r['image']?>" target="_blank"><?=$r['image']?></a></td>
                      <td class="text-xs text-secondary mb-0 border-1"><?=$r['created_at']?></td>

                      <td class="border-1 text-secondary"><?php if ($position == 'Admin') { ?> 
                          <a href="add-stock.php?edit=<?=$r['id']?>"><i class="fa fa-pencil" aria-hidden="true"></i></a> |


                          <button type="button" class="borderless" data-bs-toggle="modal" data-bs-target="#exampleModal<?= $r['id'] ?>"><i class="fa fa-trash  " aria-hidden="true"></i></button>
                          <div class="modal fade" id="exampleModal<?= $r['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">حذف المنتج</h5>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <!-- background-image: linear-gradient(310deg, #6c6879 0%, #fbcf33 100%) !important; -->
                                <div class="modal-body">
                                  الرجاء ادخال كلمة المرور للتأكيد
                                  <form action="../scripts/Stock/delete.php?id=<?php echo $r['id']; ?>" method="post">
                                    <input type="password" name="pas" class="form-control">

                                </div>
                                <div class="modal-footer">

                                  <button type="submit" name="del" class="myButton col-md-6 col-sm-6 mt-5 btn btn-secondary rounded-pill">تأكيد الحذف</button>
                                  </form>
                                </div>
                              </div>
                            </div>
                          </div> <?php } ?>
                      </td>
                      <!-- Modal -->

                    </tr>
                        <?php } ?>
                 
                </tbody>
              </table>



            </div>
          </div>
        </div>
      </div>

      <?php require_once('../components/footer.php'); ?>
    </div>
  </main>

  <!--   Core JS Files   -->
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script src="../assets/js/plugins/fullcalendar.min.js"></script>
  <script src="../assets/js/plugins/chartjs.min.js"></script>
  <script>
    $(document).ready(function() {
      $('#example').dataTable();
      
    });

    
  </script>
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