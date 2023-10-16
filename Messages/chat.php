<?php
include('../cookies/session2.php');
$_SESSION['sidebar'] = "Messages";

$projects = mysqli_query($conn, "SELECT * FROM projects");



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
  <link href="chat.css" rel="stylesheet" />
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
            <li class="breadcrumb-item text-sm ps-2"><a class="opacity-5 text-dark" href="javascript:;">المشاريع</a></li>

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

                <i class="fa fa-arrow-left me-sm-1 cursor-pointer" onclick="history.back()"></i>
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

        <i class="bi bi-arrow-left"></i>


      </div>
    </nav>
    <!-- End Navbar -->

    <div class="container-fluid py-4">
      <div class="block-header bg-gradient-dark  col-md-3 col-sm-6 col-xs-6  rounded-pill">

        <?php require_once('../components/notification.php'); ?>
      </div>
      <div class="app">
    <div class="header">
      <div class="logo">
        <svg viewBox="0 0 513 513" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
          <path d="M256.025.05C117.67-2.678 3.184 107.038.025 245.383a240.703 240.703 0 0085.333 182.613v73.387c0 5.891 4.776 10.667 10.667 10.667a10.67 10.67 0 005.653-1.621l59.456-37.141a264.142 264.142 0 0094.891 17.429c138.355 2.728 252.841-106.988 256-245.333C508.866 107.038 394.38-2.678 256.025.05z" />
          <path d="M330.518 131.099l-213.825 130.08c-7.387 4.494-5.74 15.711 2.656 17.97l72.009 19.374a9.88 9.88 0 007.703-1.094l32.882-20.003-10.113 37.136a9.88 9.88 0 001.083 7.704l38.561 63.826c4.488 7.427 15.726 5.936 18.003-2.425l65.764-241.49c2.337-8.582-7.092-15.72-14.723-11.078zM266.44 356.177l-24.415-40.411 15.544-57.074c2.336-8.581-7.093-15.719-14.723-11.078l-50.536 30.744-45.592-12.266L319.616 160.91 266.44 356.177z" fill="#fff" />
        </svg>
      </div>
      <div class="search-bar">
        <input type="text" placeholder="Search..." />
      </div>
      <div class="user-settings">
        <div class="dark-light">
          <svg viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" fill="none" stroke-linecap="round" stroke-linejoin="round">
            <path d="M21 12.79A9 9 0 1111.21 3 7 7 0 0021 12.79z" />
          </svg>
        </div>
        <div class="settings">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="12" cy="12" r="3" />
            <path d="M19.4 15a1.65 1.65 0 00.33 1.82l.06.06a2 2 0 010 2.83 2 2 0 01-2.83 0l-.06-.06a1.65 1.65 0 00-1.82-.33 1.65 1.65 0 00-1 1.51V21a2 2 0 01-2 2 2 2 0 01-2-2v-.09A1.65 1.65 0 009 19.4a1.65 1.65 0 00-1.82.33l-.06.06a2 2 0 01-2.83 0 2 2 0 010-2.83l.06-.06a1.65 1.65 0 00.33-1.82 1.65 1.65 0 00-1.51-1H3a2 2 0 01-2-2 2 2 0 012-2h.09A1.65 1.65 0 004.6 9a1.65 1.65 0 00-.33-1.82l-.06-.06a2 2 0 010-2.83 2 2 0 012.83 0l.06.06a1.65 1.65 0 001.82.33H9a1.65 1.65 0 001-1.51V3a2 2 0 012-2 2 2 0 012 2v.09a1.65 1.65 0 001 1.51 1.65 1.65 0 001.82-.33l.06-.06a2 2 0 012.83 0 2 2 0 010 2.83l-.06.06a1.65 1.65 0 00-.33 1.82V9a1.65 1.65 0 001.51 1H21a2 2 0 012 2 2 2 0 01-2 2h-.09a1.65 1.65 0 00-1.51 1z" />
          </svg>
        </div>
        <img class="user-profile" src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3364143/download+%281%29.png" alt="" class="account-profile" alt="">
      </div>
    </div>
    <div class="wrapper">
      <div class="conversation-area">
        <div class="msg online">
          <img class="msg-profile" src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3364143/download+%281%29.png" alt="" />
          <div class="msg-detail">
            <div class="msg-username">Madison Jones</div>
            <div class="msg-content">
              <span class="msg-message">What time was our meet</span>
              <span class="msg-date">20m</span>
            </div>
          </div>
        </div>
        <div class="msg">
          <img class="msg-profile" src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3364143/download+%2812%29.png" alt="" />
          <div class="msg-detail">
            <div class="msg-username">Miguel Cohen</div>
            <div class="msg-content">
              <span class="msg-message">Adaptogen taiyaki austin jean shorts brunch</span>
              <span class="msg-date">20m</span>
            </div>
          </div>
        </div>
        <div class="msg active">
          <div class="msg-profile group">
            <svg viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1">
              <path d="M12 2l10 6.5v7L12 22 2 15.5v-7L12 2zM12 22v-6.5" />
              <path d="M22 8.5l-10 7-10-7" />
              <path d="M2 15.5l10-7 10 7M12 2v6.5" />
            </svg>
          </div>
          <div class="msg-detail">
            <div class="msg-username">CodePen Group</div>
            <div class="msg-content">
              <span class="msg-message">Aysenur: I love CSS</span>
              <span class="msg-date">28m</span>
            </div>
          </div>
        </div>
        <div class="msg online">
          <img class="msg-profile" src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3364143/download+%282%29.png" alt="" />
          <div class="msg-detail">
            <div class="msg-username">Lea Debere</div>
            <div class="msg-content">
              <span class="msg-message">Shoreditch iPhone jianbing</span>
              <span class="msg-date">45m</span>
            </div>
          </div>
        </div>
        <div class="msg online">
          <img class="msg-profile" src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3364143/download+%281%29+%281%29.png" alt="" />
          <div class="msg-detail">
            <div class="msg-username">Jordan Smith</div>
            <div class="msg-content">
              <span class="msg-message">Snackwave craft beer raclette, beard kombucha </span>
              <span class="msg-date">2h</span>
            </div>
          </div>
        </div>
        <div class="msg">
          <img class="msg-profile" src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3364143/download+%284%29+%281%29.png" alt="" />
          <div class="msg-detail">
            <div class="msg-username">Jared Jackson</div>
            <div class="msg-content">
              <span class="msg-message">Tattooed brooklyn typewriter gastropub</span>
              <span class="msg-date">18m</span>
            </div>
          </div>
        </div>
        <div class="msg online">
          <img class="msg-profile" src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3364143/download+%283%29+%281%29.png" alt="">
          <div class="msg-detail">
            <div class="msg-username">Henry Clark</div>
            <div class="msg-content">
              <span class="msg-message">Ethical typewriter williamsburg lo-fi street art</span>
              <span class="msg-date">2h</span>
            </div>
          </div>
        </div>
        <div class="msg">
          <img class="msg-profile" src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3364143/qs6F3dgm.png" alt="" />
          <div class="msg-detail">
            <div class="msg-username">Jason Mraz</div>
            <div class="msg-content">
              <span class="msg-message">I'm lucky I'm in love with my best friend</span>
              <span class="msg-date">4h</span>
            </div>
          </div>
        </div>
        <div class="msg">
          <img class="msg-profile" src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3364143/download+%288%29.png" alt="" />
          <div class="msg-detail">
            <div class="msg-username">Chiwa Lauren</div>
            <div class="msg-content">
              <span class="msg-message">Pabst af 3 wolf moon</span>
              <span class="msg-date">28m</span>
            </div>
          </div>
        </div>
        <div class="msg">
          <img class="msg-profile" src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3364143/download+%289%29.png" alt="" />
          <div class="msg-detail">
            <div class="msg-username">Caroline Orange</div>
            <div class="msg-content">
              <span class="msg-message">Bespoke aesthetic lyft woke cornhole</span>
              <span class="msg-date">35m</span>
            </div>
          </div>
        </div>
        <div class="msg">
          <img class="msg-profile" src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3364143/download+%286%29.png" alt="" />
          <div class="msg-detail">
            <div class="msg-username">Lina Ashma</div>
            <div class="msg-content">
              <span class="msg-message">Migas food truck crucifix vexi</span>
              <span class="msg-date">42m</span>
            </div>
          </div>
        </div>

      </div>
      <div class="chat-area">
        <div class="chat-area-header">
          <div class="chat-area-title">CodePen Group</div>
          <div class="chat-area-group">
            <img class="chat-area-profile" src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3364143/download+%283%29+%281%29.png" alt="" />
            <img class="chat-area-profile" src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3364143/download+%282%29.png" alt="">
            <img class="chat-area-profile" src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3364143/download+%2812%29.png" alt="" />
            <span>+4</span>
          </div>
        </div>
        <div class="chat-area-main">
          <div class="chat-msg">
            <div class="chat-msg-profile">
              <img class="chat-msg-img" src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3364143/download+%283%29+%281%29.png" alt="" />
              <div class="chat-msg-date">Message seen 1.22pm</div>
            </div>
            <div class="chat-msg-content">
              <div class="chat-msg-text">Luctus et ultrices posuere cubilia curae.</div>
              <div class="chat-msg-text">
                <img src="https://media0.giphy.com/media/yYSSBtDgbbRzq/giphy.gif?cid=ecf05e47344fb5d835f832a976d1007c241548cc4eea4e7e&rid=giphy.gif" />
              </div>
              <div class="chat-msg-text">Neque gravida in fermentum et sollicitudin ac orci phasellus egestas. Pretium lectus quam id leo.</div>
            </div>
          </div>
          <div class="chat-msg owner">
            <div class="chat-msg-profile">
              <img class="chat-msg-img" src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3364143/download+%281%29.png" alt="" />
              <div class="chat-msg-date">Message seen 1.22pm</div>
            </div>
            <div class="chat-msg-content">
              <div class="chat-msg-text">Sit amet risus nullam eget felis eget. Dolor sed viverra ipsum😂😂😂</div>
              <div class="chat-msg-text">Cras mollis nec arcu malesuada tincidunt.</div>
            </div>
          </div>
          <div class="chat-msg">
            <div class="chat-msg-profile">
              <img class="chat-msg-img" src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3364143/download+%282%29.png" alt="">
              <div class="chat-msg-date">Message seen 2.45pm</div>
            </div>
            <div class="chat-msg-content">
              <div class="chat-msg-text">Aenean tristique maximus tortor non tincidunt. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae😊</div>
              <div class="chat-msg-text">Ut faucibus pulvinar elementum integer enim neque volutpat.</div>
            </div>
          </div>
          <div class="chat-msg owner">
            <div class="chat-msg-profile">
              <img class="chat-msg-img" src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3364143/download+%281%29.png" alt="" />
              <div class="chat-msg-date">Message seen 2.50pm</div>
            </div>
            <div class="chat-msg-content">
              <div class="chat-msg-text">posuere eget augue sodales, aliquet posuere eros.</div>
              <div class="chat-msg-text">Cras mollis nec arcu malesuada tincidunt.</div>
            </div>
          </div>
          <div class="chat-msg">
            <div class="chat-msg-profile">
              <img class="chat-msg-img" src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3364143/download+%2812%29.png" alt="" />
              <div class="chat-msg-date">Message seen 3.16pm</div>
            </div>
            <div class="chat-msg-content">
              <div class="chat-msg-text">Egestas tellus rutrum tellus pellentesque</div>
            </div>
          </div>
          <div class="chat-msg">
            <div class="chat-msg-profile">
              <img class="chat-msg-img" src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3364143/download+%283%29+%281%29.png" alt="" class="account-profile" alt="">
              <div class="chat-msg-date">Message seen 3.16pm</div>
            </div>
            <div class="chat-msg-content">
              <div class="chat-msg-text">Consectetur adipiscing elit pellentesque habitant morbi tristique senectus et.</div>
            </div>
          </div>
          <div class="chat-msg owner">
            <div class="chat-msg-profile">
              <img class="chat-msg-img" src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3364143/download+%281%29.png" alt="" />
              <div class="chat-msg-date">Message seen 2.50pm</div>
            </div>
            <div class="chat-msg-content">
              <div class="chat-msg-text">Tincidunt arcu non sodales😂</div>
            </div>
          </div>
          <div class="chat-msg">
            <div class="chat-msg-profile">
              <img class="chat-msg-img" src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3364143/download+%282%29.png" alt="">
              <div class="chat-msg-date">Message seen 3.16pm</div>
            </div>
            <div class="chat-msg-content">
              <div class="chat-msg-text">Consectetur adipiscing elit pellentesque habitant morbi tristique senectus et🥰</div>
            </div>
          </div>
        </div>
        <div class="chat-area-footer">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-video">
            <path d="M23 7l-7 5 7 5V7z" />
            <rect x="1" y="5" width="15" height="14" rx="2" ry="2" />
          </svg>
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-image">
            <rect x="3" y="3" width="18" height="18" rx="2" ry="2" />
            <circle cx="8.5" cy="8.5" r="1.5" />
            <path d="M21 15l-5-5L5 21" />
          </svg>
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus-circle">
            <circle cx="12" cy="12" r="10" />
            <path d="M12 8v8M8 12h8" />
          </svg>
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-paperclip">
            <path d="M21.44 11.05l-9.19 9.19a6 6 0 01-8.49-8.49l9.19-9.19a4 4 0 015.66 5.66l-9.2 9.19a2 2 0 01-2.83-2.83l8.49-8.48" />
          </svg>
          <input type="text" placeholder="Type something here..." />
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-smile">
            <circle cx="12" cy="12" r="10" />
            <path d="M8 14s1.5 2 4 2 4-2 4-2M9 9h.01M15 9h.01" />
          </svg>
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-thumbs-up">
            <path d="M14 9V5a3 3 0 00-3-3l-4 9v11h11.28a2 2 0 002-1.7l1.38-9a2 2 0 00-2-2.3zM7 22H4a2 2 0 01-2-2v-7a2 2 0 012-2h3" />
          </svg>
        </div>
      </div>

    </div>
  </div>
  <script src="chat.js">
  </script>
      <footer class="footer pt-3  ">
        <div class="container-fluid">
          <div class="row align-items-center justify-content-lg-between">
            <div class="col-lg-6 mb-lg-0 mb-4">
              <div class="copyright text-center text-sm text-muted text-lg-end">
                © <script>
                  document.write(new Date().getFullYear())
                </script>,
               by
                <a href="" class="font-weight-bold" target="_blank">Rukn Amial</a>

              </div>
            </div>
            <div class="col-lg-6">
              <ul class="nav nav-footer justify-content-center justify-content-lg-end">
                <li class="nav-item">
                  <a href="https://ruknamial.com" class="nav-link text-muted" target="_blank">Rukn Amial</a>
                </li>
                <li class="nav-item">
                  <a href="https://files.ruknamial.com" class="nav-link text-muted" target="_blank">Files</a>
                </li>
                <li class="nav-item">
                  <a href="https://ruknamial.com/blogs" class="nav-link text-muted" target="_blank">Blog</a>
                </li>

              </ul>
            </div>
          </div>
        </div>
      </footer>
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