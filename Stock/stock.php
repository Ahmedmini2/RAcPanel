<?php
include('../cookies/session2.php');
$_SESSION['sidebar'] = "Stock";
$select = mysqli_query($conn, "select * from stock");
// الحصول على القيمة من النموذج
$used_quantity = isset($_POST['num']) ? intval($_POST['num']) : 0;


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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- CSS Files -->
  <link id="pagestyle" href="../assets/css/soft-ui-dashboard.css?v=1.0.3" rel="stylesheet" />
  <!-- Extar js  -->


  <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
  <script src="//cdn.datatables.net/plug-ins/1.10.7/integration/bootstrap/3/dataTables.bootstrap.js"></script>

  <style>
    .modal-contentt {
      position: relative;
      display: flex;
      flex-direction: column;
      width: 100%;
      pointer-events: auto;
      background-color: #2c2c2c;
      background-clip: padding-box;
      border: 1px solid rgba(0, 0, 0, 0.2);
      border-radius: 0.75rem;
      outline: 0;
    }

    @media (max-width: 768px) {
      .table thead {
        display: none;
      }

      .table,
      .table tbody,
      .table tr,
      .table td {
        display: block;
        width: 100%;
      }

      .table tr {
        margin-bottom: 15px;
      }

      .table tbody tr td {
        text-align: right;
        padding-left: 50%;
        position: relative;

      }

      .table td:before {
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
                  <tr class="text-center">
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" width="2%">الرقم</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" width="5%">اسم المنتج</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">الوصف</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">الكمية</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">الكمية المستهلكة</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">الكمية المتبقيه</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">سعر الصنف الواحد</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">الاجمالي</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">صورة الفاتورة</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">صورة الفاتورة المسحوب</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">تاريخ الطلب</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>

                  </tr>
                </thead>
                <tbody>

                  <?php
                  while ($r = mysqli_fetch_array($select)) {
                    // $remaining_quantity = $r['quantity'] - $r['used_quantity'];
                    // $idS =  $r['id'];
                    // $update = "UPDATE `stock` SET `stock` = '$remaining_quantity' WHERE `id` = $idS";
                    // $updateResult = $conn->query($update);
                    // $new_stock = $r['stock'] - $r['used_quantity'];
                    $remaining_quantity = $r['quantity'] - $used_quantity;
                    $idS = $r['id'];
                    
                    // تحديث الكمية في قاعدة البيانات
                    $update = "UPDATE stock SET stock = '$remaining_quantity' WHERE id = $idS";
                    $updateResult = $conn->query($update);
                     

                  ?>

                    <tr class="text-center">

                      <td data-label="الرقم" class="text-xs text-secondary mb-0 border-1 "><?= $r['id'] ?></td>
                      <td data-label="اسم المنج" class="text-xs text-secondary mb-0 border-1"><?= $r['name_stock'] ?></td>
                      <td data-label="الوصف" class="mb-0 text-sm text-secondary border-1"><?= $r['description'] ?></td>
                      <td data-label="الكمية" class="mb-0 text-sm text-secondary border-1"><?= $r['quantity'] ?></td>
                      <!-- <td data-label="الكمية المستهلكة" class="mb-0 text-sm text-secondary border-1"><input type="number" class="used-quantity-input" data-id="<?= $r['id'] ?>" value="<?= $r['used_quantity'] ?>" /></td> -->
                      <td data-label="الكمية المستهلكة" class="mb-0 text-sm text-secondary border-1"><input type="number"   value="num" name="num"num id="" /></td>
                      <td data-label="الكيمة المتبقيه" class="mb-0 text-sm text-secondary border-1"><?= $r['stock'] - $used_quantity ?></td>
                      <td data-label="سعر الصنف الواحد" class="mb-0 text-sm text-secondary border-1"><?= $r['price_per_piece'] ?></td>
                      <td data-label="الاجمالي" class="mb-0 text-sm text-secondary border-1"><?= $r['total_price'] ?></td>
                      <td data-label="صورة الفاتورة" class="mb-0 text-sm text-secondary border-1">
                        <?= ($r['image']) ? '<a href="../Signed-Docs/Stock-Bills/' . $r['id'] . '/' . $r['image'] . '" target="_blank">' . $r['image'] . '</a>' : 'لا يوجد رابط' ?>
                      </td>
                      <?php if ($position == 'Admin') { ?>
                        <td data-label="صورة الفاتورة المسحوبه" class="mb-0 text-sm text-secondary border-1">
                          <?= ($r['use_image']) ? '<a href="../Signed-Docs/Stock-Use-Bills/' . $r['id'] . '/' . $r['use_image'] . '" target="_blank">' . $r['use_image'] . '</a>' : 'لا يوجد رابط' ?>
                        </td>
                      <?php } else { ?>
                        <td data-label="صورة الفاتورة المسحوبه" class="mb-0 text-sm text-secondary border-1">
                          <input type="file" class="use-image-input" data-id="<?= $r['id'] ?>" />
                        </td>
                      <?php } ?>
                      <td data-label="تاريخ الطلب" class="text-xs text-secondary mb-0 border-1"><?= $r['created_at'] ?></td>

                      <td data-label="Action" class="border-1 text-secondary">
                        <?php if ($position == 'Admin') { ?>
                          <a href="add-stock.php?edit=<?= $r['id'] ?>"><i class="fa fa-pencil" aria-hidden="true"></i></a> |

                          <button type="button" class="borderless" data-bs-toggle="modal" data-bs-target="#exampleModal<?= $r['id'] ?>"><i class="fa fa-trash  " aria-hidden="true"></i></button>
                          <div class="modal fade" id="exampleModal<?= $r['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                              <div class="modal-contentt">
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
                          </div>
                        <?php } elseif ($position == 'Worker') { ?>
                          <!-- إذا كان المستخدم Editor، يظهر فقط رابط التعديل بدون زر الحذف -->
                          <a href="add-stock-worker.php?edit=<?= $r['id'] ?>"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                        <?php } else { ?>
                          <!-- إذا لم يكن المستخدم Admin أو Editor، يظهر رسالة توضح أنه ليس لديك الصلاحيات اللازمة -->
                          <p>ليس لديك الصلاحيات اللازمة للوصول إلى هذه الخيارات.</p>
                        <?php } ?>
                      </td>

                      <!-- Modal -->

                    </tr>
                  <?php } ?>

                </tbody>
              </table>

              <script>
                $(document).ready(function() {
                  $('.used-quantity-input').on('keypress', function(e) {
                    if (e.which == 13) { // 13 هو مفتاح Enter
                      var id = $(this).data('id');
                      var newQuantity = $(this).val();
                      var newUsedQuantity = $('.used-quantity-input[data-id="' + id + '"]').val();

                      var formData = new FormData();
                      formData.append('id', id);
                      formData.append('used_quantity', newUsedQuantity);

                      // إضافة الصورة إذا كانت مرفوعة
                      var useImageInput = $('.use-image-input[data-id="' + id + '"]')[0];
                      if (useImageInput.files.length > 0) {
                        formData.append('use_image', useImageInput.files[0]);
                      }

                      $.ajax({
                        url: 'update_stock.php',
                        type: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(response) {
                          alert('تم تحديث البيانات بنجاح');
                        },
                        error: function() {
                          alert('حدث خطأ أثناء تحديث البيانات');
                        }
                      });
                    }
                  });
                });
              </script>





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