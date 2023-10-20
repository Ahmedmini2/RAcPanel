<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="style.css">
    <title>ruknamial</title>
</head>

<body>

    <!-- Sidebar -->
    <div class="sidebar">
    <a class="navbar-brand m-0" href="https://test.app.ruknamial.com/index.php">
      <img src="../assets/img/logos/logo-gold.png" class="navbar-brand-img " alt="main_logo" style="height: 200px;">

    </a>
        <ul class="side-menu">
            <li><a href="#"><i class='bx bxs-dashboard'></i>Dashboard</a></li>
            <li><a href="#"><i class='bx bx-store-alt'></i>Employee Section</a></li>
            <li class="active"><a href=""><i class='bx bx-analyse'></i>Department Section</a></li>
            <li><a href="#"><i class='bx bx-message-square-dots'></i>الاجازات</a></li>
            <li><a href="#"><i class='bx bx-group'></i>Manage Leave</a></li>
            <li><a href="page1.php"><i class='bx bx-cog'></i>Manage Admin</a></li>
        </ul>
        <ul class="side-menu">
            <li>
                <a href="#" class="logout">
                    <i class='bx bx-log-out-circle'></i>
                    Logout
                </a>
            </li>
        </ul>
    </div>
    <!-- End of Sidebar -->

    <!-- Main Content -->
    <div class="content">
        <!-- Navbar -->
        <nav>
            <i class='bx bx-menu'></i>
            <form action="#">
                <div class="form-input">
                    <input type="search" placeholder="Search...">
                    <button class="search-btn" type="submit"><i class='bx bx-search'></i></button>
                </div>
            </form>
            <input type="checkbox" id="theme-toggle" hidden>
            <label for="theme-toggle" class="theme-toggle"></label>
            <a href="#" class="notif">
                <i class='bx bx-bell'></i>
                <span class="count">12</span>
            </a>
            <a href="#" class="profile">
                <img src="images/logo.png">
            </a>
        </nav>

        <!-- End of Navbar -->

        <main>
            <div class="header">
                <div class="left">
                    <h1>Dashboard</h1>
                    <ul class="breadcrumb">
                        <li><a href="#">
                                Dashboard
                            </a></li>
                        /
                        <li><a href="#" class="active">Dashboard</a></li>
                    </ul>
                </div>
                
            </div>

            <!-- Insights -->
            <ul class="insights">
                <li><i class='bx bx-dollar-circle'></i>
                    <span class="info">
                        <h3>
                            12
                        </h3>
                        <p>Available Leave Type</p>
                    </span>
                </li>
                <li>
                    <i class='bx bx-calendar-check'></i>
                    <span class="info">
                        <h3>
                            4
                        </h3>
                        <p>Pening Application</p>
                    </span>
                </li>
                <li><i class='bx bx-show-alt'></i>
                    <span class="info">
                        <h3>
                            2
                        </h3>
                        <p>Declined Application</p>
                    </span>
                </li>
                <li><i class='bx bx-line-chart'></i>
                    <span class="info">
                        <h3>
                            6
                        </h3>
                        <p>Approved Application</p>
                    </span>
                </li>
                
            </ul>
            <!-- End of Insights -->
        

            <div class="block-content " style="padding:15px;overflow-x: auto;white-space: nowrap;">
            <div class="content">
                    
                
                <div class="block">
                    
                    <table class="table align-items-center mb-0" id="myTable">
                    <thead>
                    <tr>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" width="2%">Sr.#</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" width="5%">EmployeeID</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" width="5%">Full Name</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" width="5%">Leave Type</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" width="5%">Created at</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" width="2%">Status</th>
                    

                    </tr>
                    </thead>
                    <tbody>
                    


                    <tr>
                    <td class="text-center">1</td>
                    <td class="text-xs text-secondary mb-0">0000R4</td>
                    <td class="mb-0 text-sm">MOhammed</td>
                    <td class="mb-0 text-sm">Midical Leave</td>
                    <td class="text-xs text-secondary mb-0">2023/10/20</td>
                    <td class="text-secondary mb-0">Pending</td>
                    

                    </tr>

                   
                    </tbody>
                    </table>

                </div>
            </div>    
        </div>

        </main>

    </div>

    <script src="index.js"></script>
</body>

</html>