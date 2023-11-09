<?php
include('../cookies/session2.php');
$_SESSION['sidebar'] = "Accounts";
$select = mysqli_query($conn, "select * from bank_request ORDER BY id DESC");

?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <title>
    الحسابات
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
     $titleNav = 'الحسابات'; 
     require_once('../components/navbar.php');
     ?>
    <!-- End Navbar -->
    <div class="container-fluid py-4">
      <div class="row">

        <?php if ($position == 'Admin') { ?> <a href="add-bank-req.php" class="btn bg-gradient-dark mb-0 col-md-2 col-sm-6 col-xs-6"> أضافة طلب تعميد جديد&nbsp;&nbsp; <i class="fas fa-plus"></i></a>
        <?php } ?>
        <div class="block-content " style="padding:15px;overflow-x: auto;white-space: nowrap;">
          <div class="content">
            <div class="block-header col-md-3 col-sm-6 col-xs-6  rounded">

              <?php require_once('../components/notification.php'); ?>
            </div>

            <div class="block">
              <?php if (!empty($_GET['bank_req'])) {
                $id = $_GET['bank_req'];
                $del = mysqli_query($conn, "delete from bank_request where id = '$id'");
                if ($del) {
                  echo '<div class="alert alert-success"> تم حذف التعميد </div>';
                } 
              }
              ?>
              <table class="table align-items-center table-bordered mb-0" id="example">
                <thead>
                  <tr>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" width="2%">الرقم</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" width="5%">نوع الطلب</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">الوصف</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">القيمة المطلوبة</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">المسار</th>
                    <!-- <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">الى الجهة</th> -->
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">تاريخ الطلب</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">حالة الطلب</th>

                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>

                  </tr>
                </thead>
                <tbody>
                  <?php $i = 0;
                  while ($r = mysqli_fetch_array($select)) {
                    $i++; ?>


                    <tr>

                      <td class="text-xs text-secondary mb-0 border-1"><?php echo $custem =  $r['id']; ?></td>
                      <td class="text-xs text-secondary mb-0 border-1">
                        <?php if ($r['name'] == 1) {
                          echo "طلب تحويل";
                        } elseif ($r['name'] == 2) {
                          echo "طلب سحب مبلغ";
                        } elseif ($r['name'] == 3) {
                          echo "طلب شيك بنكي";
                        } elseif ($r['name'] == 4) {
                          echo "تسديد فاتورة إلكترونية";
                        } ?></td>
                      <td class="mb-0 text-sm text-secondary border-1"><?php echo $r['description']; ?></td>
                      <td class="mb-0 text-sm text-secondary border-1"><?php echo number_format($r['amount_number']); ?></td>
                      <td class="text-xs text-secondary mb-0 border-1">
                        <?php echo 'من حساب : ' . $r['our_bank_name'] . '<br><br>';
                        echo 'الى المستفيد : ' . $r['transfer_to']; ?></td>
                      <!-- <td class="text-xs text-secondary mb-0"><?php echo $r['transfer_to']; ?></td> -->
                      <td class="text-xs text-secondary mb-0 border-1"><?php echo $r['created_at']; ?></td>
                      <td ><?php if ($r['status'] == 1) {
                            echo '<span class="badge badge-sm bg-gradient-success">طلب تعميد جديد</span>';
                          } elseif ($r['status'] == 2) {
                            echo '<span class="badge badge-sm bg-gradient-warning">تم التعميد من قبل المحاسب في انتظار التأكيد</span>';
                          } else {
                            echo '<span class="badge badge-sm bg-gradient-primary">تم التأكيد</span>';
                          } ?></td>

                      <td class="text-secondary border-1 "><a href="bank-req-info.php?bank_req=<?php echo $r['id']; ?>"><i class="fa fa-eye" aria-hidden="true"></i></a> <?php if ($position == 'Admin') { ?> |
                          <a href="edit-bank-req.php?req_id=<?php echo $r['id']; ?>"><i class="fa fa-pencil" aria-hidden="true"></i></a> |


                          <button type="button" class="borderless" data-bs-toggle="modal" data-bs-target="#exampleModal<?= $r['id'] ?>"><i class="fa fa-trash  " aria-hidden="true"></i></button>
                          <div class="modal fade" id="exampleModal<?= $r['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">حذف التعميد</h5>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                  الرجاء ادخال كلمة المرور للتأكيد
                                  <form action="../scripts/accounts/delete.php?bank_req=<?php echo $r['id']; ?>" method="post">
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
      $('#example').dataTable({
      "order": [ 0, 'desc' ]
      } );
    });

    var ctx = document.getElementById("chart-bars").getContext("2d");

    new Chart(ctx, {
      type: "bar",
      data: {
        labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
        datasets: [{
          label: "Sales",
          tension: 0.4,
          borderWidth: 0,
          borderRadius: 4,
          borderSkipped: false,
          backgroundColor: "#fff",
          data: [450, 200, 100, 220, 500, 100, 400, 230, 500],
          maxBarThickness: 6
        }, ],
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            display: false,
          }
        },
        interaction: {
          intersect: false,
          mode: 'index',
        },
        scales: {
          y: {
            grid: {
              drawBorder: false,
              display: false,
              drawOnChartArea: false,
              drawTicks: false,
            },
            ticks: {
              suggestedMin: 0,
              suggestedMax: 500,
              beginAtZero: true,
              padding: 15,
              font: {
                size: 14,
                family: "Open Sans",
                style: 'normal',
                lineHeight: 2
              },
              color: "#fff"
            },
          },
          x: {
            grid: {
              drawBorder: false,
              display: false,
              drawOnChartArea: false,
              drawTicks: false
            },
            ticks: {
              display: false
            },
          },
        },
      },
    });


    var ctx2 = document.getElementById("chart-line").getContext("2d");

    var gradientStroke1 = ctx2.createLinearGradient(0, 230, 0, 50);

    gradientStroke1.addColorStop(1, 'rgba(203,12,159,0.2)');
    gradientStroke1.addColorStop(0.2, 'rgba(72,72,176,0.0)');
    gradientStroke1.addColorStop(0, 'rgba(203,12,159,0)'); //purple colors

    var gradientStroke2 = ctx2.createLinearGradient(0, 230, 0, 50);

    gradientStroke2.addColorStop(1, 'rgba(20,23,39,0.2)');
    gradientStroke2.addColorStop(0.2, 'rgba(72,72,176,0.0)');
    gradientStroke2.addColorStop(0, 'rgba(20,23,39,0)'); //purple colors

    new Chart(ctx2, {
      type: "line",
      data: {
        labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
        datasets: [{
            label: "Mobile apps",
            tension: 0.4,
            borderWidth: 0,
            pointRadius: 0,
            borderColor: "#cb0c9f",
            borderWidth: 3,
            backgroundColor: gradientStroke1,
            fill: true,
            data: [50, 40, 300, 220, 500, 250, 400, 230, 500],
            maxBarThickness: 6

          },
          {
            label: "Websites",
            tension: 0.4,
            borderWidth: 0,
            pointRadius: 0,
            borderColor: "#3A416F",
            borderWidth: 3,
            backgroundColor: gradientStroke2,
            fill: true,
            data: [30, 90, 40, 140, 290, 290, 340, 230, 400],
            maxBarThickness: 6
          },
        ],
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            display: false,
          }
        },
        interaction: {
          intersect: false,
          mode: 'index',
        },
        scales: {
          y: {
            grid: {
              drawBorder: false,
              display: true,
              drawOnChartArea: true,
              drawTicks: false,
              borderDash: [5, 5]
            },
            ticks: {
              display: true,
              padding: 10,
              color: '#b2b9bf',
              font: {
                size: 11,
                family: "Open Sans",
                style: 'normal',
                lineHeight: 2
              },
            }
          },
          x: {
            grid: {
              drawBorder: false,
              display: false,
              drawOnChartArea: false,
              drawTicks: false,
              borderDash: [5, 5]
            },
            ticks: {
              display: true,
              color: '#b2b9bf',
              padding: 20,
              font: {
                size: 11,
                family: "Open Sans",
                style: 'normal',
                lineHeight: 2
              },
            }
          },
        },
      },
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