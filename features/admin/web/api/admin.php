<?php 
    session_start(); 

    if (!isset($_SESSION['email']) || $_SESSION['role'] !== 'admin') {
        header("Location: ../../../users/web/api/login.php");
        exit(); 
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../../css/index.css">
</head>

<body>
    <!--Navigation Links-->
    <div class="navbar flex-column bg-white shadow-sm p-3 collapse d-md-flex" id="navbar">
        <div class="navbar-links">
            <a class="navbar-brand d-none d-md-block logo-container" href="#">
                <img src="../../../../assets/img/logo.png" alt="Logo">
            </a>
            <a href="#dashboard" class="navbar-highlight">
                <i class="fa-solid fa-gauge"></i>
                <span>Dashboard</span>
            </a>
            <a href="app-req.php">
                <i class="fa-regular fa-calendar-check"></i>
                <span>Appointment Request</span>
            </a>
            <a href="app-records.php">
                <i class="fa-regular fa-calendar-check"></i>
                <span>Patients Records</span>
            </a>
            <a href="app-records-list.php">
                <i class="fa-regular fa-calendar-check"></i>
                <span>Record Lists</span>
            </a>
            <a href="pos.php">
                <i class="fas fa-cash-register"></i>
                <span>Point of Sales</span>
            </a>
            <a href="transaction.php">
                <i class="fas fa-exchange-alt"></i>
                <span>Transaction</span>
            </a>
           
            <div class="maintenance">
                <p class="maintenance-text">Maintenance</p>
                <a href="category-list.php">
                    <i class="fa-solid fa-list"></i>
                    <span>Category List</span>
                </a>
                <a href="service-list.php">
                    <i class="fa-solid fa-layer-group"></i>
                    <span>Service List</span>
                </a>
                <a href="admin-user.php">
                    <i class="fa-solid fa-user-tie"></i>
                    <span>Admin User List</span>
                </a>
                <a href="settings.php">
                    <i class="fas fa-cog"></i>
                    <span>Settings</span>
                </a>
            </div>
        </div>
    </div>
    <!--Navigation Links End-->
    <div class="content flex-grow-1">
        <div class="header">
            <button class="navbar-toggler d-block d-md-none" type="button" onclick="toggleMenu()">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                    style="stroke: black; fill: none;">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7">
                    </path>
                </svg>
            </button>
            <div class="col-8 col-md-6 col-lg-3">
                <div class="search-bar">
                    <i class="fa fa-magnifying-glass"></i>
                    <input type="text" class="form-control" placeholder="Search...">
                </div>
            </div>
            <!--Notification and Profile Admin-->
            <div class="profile-admin">
                    <div class="dropdown">
                        <button class="" type="button" id="notificationDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-bell"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="notificationDropdown">
                            <li class="dropdown-header">
                                <h5 class=" mb-0">Notification</h5>
                            </li>
                            <li class="dropdown-item">
                                <div class="alert alert-primary mb-0">
                                    <strong>Successfully Booked!</strong>
                                    <p>Rachel booked an appointment! <a href="#" class="alert-link">Check it now!</a></p>                               
                                </div>
                            </li>
                            <li class="dropdown-item">
                                <div class="alert alert-danger mb-0">
                                    <strong>Decline</strong>
                                    <p>Admin Kim declined Jana's appointment.<a href="#" class="alert-link">See here.</a></p> 
                                </div>
                            </li>
                            <li class="dropdown-item">
                                <div class="alert alert-success mb-0">
                                    <strong>Paid!</strong>
                                    <p>James paid the bill.</p> 
                                </div>
                            </li>
                            <li class="dropdown-item">
                                <div class="alert alert-primary mb-0">
                                    <strong>Successfully Booked!</strong>
                                    <p>Rachel booked an appointment! <a href="#" class="alert-link">Check it now!</a></p>                               
                                </div>
                            </li>
                           
                        </ul>
                    </div>
                <div class="dropdown">
                    <button class="" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="../../../../assets/img/vet logo.jpg" style="width: 40px; height: 40px; object-fit: cover;">
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="../../../users/web/api/logout.php">Logout</a></li>
                    </ul>
                </div>
            </div>
        </div>
         <!--Notification and Profile Admin End-->

        <!--Pos Card with graphs-->
        <div class="dashboard">
            <h3>Dashboard</h3>
            <div class="row card-box">
                <div class="col-12 col-md-6 col-lg-3 cc">
                    <div class="card">
                        <div class="cards">
                            <div class="card-text">
                                <p>Total Users</p>
                                <h5>125</h5>
                            </div>
                            <div class="logo">
                                <i class="fa-solid fa-users"></i>
                            </div>
                        </div>
                        <div class="trend card-up"><i class="fa-solid fa-arrow-trend-up"> 8.5 % </i> Up from yesterday
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-3 cc">
                    <div class="card">
                        <div class="cards">
                            <div class="card-text">
                                <p>Total Booked</p>
                                <h5>20</h5>
                            </div>
                            <div class="logo">
                                <i class="fa-solid fa-calendar-check"></i>
                            </div>
                        </div>
                        <div class="trend card-up"><i class="fa-solid fa-arrow-trend-up"> 1.3 % </i> Up from yesterday
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-3 cc">
                    <div class="card">
                        <div class="cards">
                            <div class="card-text">
                                <p>Total Sales</p>
                                <h5>₱40,689</h5>
                            </div>
                            <div class="logo">
                                <i class="fa-solid fa-dollar-sign"></i>
                            </div>
                        </div>
                        <div class="trend card-down"><i class="fa-solid fa-arrow-trend-down"> 4.3 % </i> Down from
                            yesterday</div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-3 cc">
                    <div class="card">
                        <div class="cards">
                            <div class="card-text">
                                <p>Total Pending</p>
                                <h5>10</h5>
                            </div>
                            <div class="logo">
                                <i class="fa-solid fa-clock"></i>
                            </div>
                        </div>
                        <div class="trend card-up"><i class="fa-solid fa-arrow-trend-up"> 8.5 % </i> Up from yesterday
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex-container">
                <div class="chart-container">
                    <canvas id="salesChart"></canvas>
                </div>
                <div class="chart-container">
                    <canvas id="weekSalesChart"></canvas>
                </div>
            </div>
        </div>
        <!--Pos Card with graphs End-->

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="../../function/script/month-chart.js"></script>
        <script src="../../function/script/toggle-menu.js"></script>
        <script src="../../function/script/week-chart.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</body>

</html>