<?php
include('../cookies/session2.php');
$_SESSION['sidebar'] = "Accounts";
$select = mysqli_query($conn, "select * from bank_info");

?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <title>
    بنوك الشركة
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
    <!-- Navbar -->حسابات البنك
    <?php 
     $titleNav = 'حسابات البنك'; 
     require_once('../components/navbar.php');
     ?>
    <!-- End Navbar -->
    <div class="container-fluid py-4">
      <div class="row">
        <a href="add-company-bank.php" class="btn bg-gradient-dark col-md-2 col-sm-6 col-xs-6 mb-0">
          أضافة حساب بنك جديد&nbsp;&nbsp;
          <i class="fas fa-plus" aria-hidden="true"></i>
        </a>

        <div class="block-content " style="padding:15px;overflow-x: auto;white-space: nowrap;">
          <div class="content">
            <div class="block-header bg-warning  col-md-3 col-sm-6 col-xs-6  rounded">

              <?php require_once('../components/notification.php'); ?>
            </div>

            <div class="block">

              <table class="table align-items-center table-bordered mb-0" id="myTable">
                <thead>
                  <tr>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">الرقم</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" width="10%">الأسم</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">الفرع</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">رقم الحساب</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">الأيبان</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">السويفت</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">انشاء بتاريخ</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>

                  </tr>
                </thead>
                <tbody>
                  <?php $i = 0;
                  while ($r = mysqli_fetch_array($select)) {
                    $i++; ?>


                    <tr>

                      <td class="text-xs text-secondary mb-0 border-1"><?php echo $custem =  $r['id']; ?></td>
                      <td class="text-xs text-secondary mb-0 border-1"><?php echo $r['name']; ?></td>
                      <td class="mb-0 text-sm text-secondary border-1"><?php echo $r['branch']; ?></td>
                      <td class="mb-0 text-sm text-secondary border-1"><?php echo $r['account_number']; ?></td>
                      <td class="text-xs text-secondary mb-0 border-1"><?php echo $r['iban']; ?></td>
                      <td class="text-xs text-secondary mb-0 border-1"><?php echo $r['swift']; ?></td>
                      <td class="text-xs text-secondary mb-0 border-1"><?php echo $r['created_at']; ?></td>
                      <td class="text-secondary text-center border-1"><a href="edit-company-bank.php?bank_id=<?php echo $r['id']; ?>"><i class="fa fa-pencil" aria-hidden="true"></i></a> | <a href="../scripts/banks/delete.php?bank_id=<?php echo $r['id']; ?>"><i class="fa fa-trash" aria-hidden="true"></i></a></td>

                    </tr>

                  <?php } ?>
                </tbody>
              </table>

              <!-- Modal -->
              <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                      <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      ...
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
                      <button type="button" class="btn bg-gradient-primary">Save changes</button>
                    </div>
                  </div>
                </div>
              </div>

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