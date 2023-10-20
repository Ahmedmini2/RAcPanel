<!DOCTYPE html>
<html lang="ar" >

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
            <li class="active"><a href="#"><i class='bx bx-analyse'></i>Department Section</a></li>
            <li><a href="#"><i class='bx bx-message-square-dots'></i>الاجازات</a></li>
            <li><a href="#"><i class='bx bx-group'></i>Manage Leave</a></li>
            <li><a href="#"><i class='bx bx-cog'></i>Manage Admin</a></li>
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
        

        <div class="bottom-data">
                <div class="orders">
                    <div class="header">
                        <i class='bx bx-receipt'></i>
                        <h3>Recent Orders</h3>
                        <i class='bx bx-filter'></i>
                        <i class='bx bx-search'></i>
                    </div>
                    <table>
                        <thead>
                            <tr>
                                <th>User</th>
                                <th>Order Date</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <img src="images/profile-1.jpg">
                                    <p>John Doe</p>
                                </td>
                                <td>14-08-2023</td>
                                <td><span class="status completed">Completed</span></td>
                            </tr>
                            <tr>
                                <td>
                                    <img src="images/profile-1.jpg">
                                    <p>John Doe</p>
                                </td>
                                <td>14-08-2023</td>
                                <td><span class="status pending">Pending</span></td>
                            </tr>
                            <tr>
                                <td>
                                    <img src="images/profile-1.jpg">
                                    <p>John Doe</p>
                                </td>
                                <td>14-08-2023</td>
                                <td><span class="status process">Processing</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Reminders -->
                <div class="reminders">
                    <div class="header">
                        <i class='bx bx-note'></i>
                        <h3>Remiders</h3>
                        <i class='bx bx-filter'></i>
                        <i class='bx bx-plus'></i>
                    </div>
                    <ul class="task-list">
                        <li class="completed">
                            <div class="task-title">
                                <i class='bx bx-check-circle'></i>
                                <p>Start Our Meeting</p>
                            </div>
                            <i class='bx bx-dots-vertical-rounded'></i>
                        </li>
                        <li class="completed">
                            <div class="task-title">
                                <i class='bx bx-check-circle'></i>
                                <p>Analyse Our Site</p>
                            </div>
                            <i class='bx bx-dots-vertical-rounded'></i>
                        </li>
                        <li class="not-completed">
                            <div class="task-title">
                                <i class='bx bx-x-circle'></i>
                                <p>Play Footbal</p>
                            </div>
                            <i class='bx bx-dots-vertical-rounded'></i>
                        </li>
                    </ul>
                </div>

                <!-- End of Reminders-->

            </div>

        </main>

    </div>

    <script src="index.js"></script>
</body>

</html>