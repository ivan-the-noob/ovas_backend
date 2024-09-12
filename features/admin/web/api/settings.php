
<?php 
    session_start(); 
    include '../../function/php/settings.php';   

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
    <title>Settings | Admin </title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../css/settings.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

</head>

<body>
        <!--Navigation Links-->
    <div class="navbar flex-column bg-white shadow-sm p-3 collapse d-md-flex" id="navbar">
        <div class="navbar-links">
            <a class="navbar-brand d-none d-md-block logo-container" href="#">
                <img src="../../../../assets/img/logo.png">
            </a>
            <a href="admin.php">
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
                <a href="settings.php" class="navbar-highlight">
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
                <div class="dropdow" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="../../../../assets/img/vet logo.jpg" style="width: 40px; height: 40px; object-fit: cover;">
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="../../../users/web/api/login.html">Logout</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <!--Notification and Profile Admin End-->

        <!--System Information Section-->
        <form method="POST" action="../../function/php/update_settings.php" enctype="multipart/form-data">
    <div class="app-req">
        <h3>System Information</h3> 
        <div class="contents container mt-5">
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="system-logo" class="form-label">System Logo</label>
                    <input type="file" class="form-control" id="system-logo" name="system-logo">
                    <img src="../../../../assets/img/<?php echo $system_logo; ?>" alt="System Logo"> 
                </div>
                <div class="col-md-6">
                    <label for="cover" class="form-label">Cover</label>
                    <input type="file" class="form-control" id="cover" name="cover">
                    <img src="../../../../assets/img/<?php echo $cover; ?>" alt="Cover Image"> 
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="system-name" class="form-label">System Name</label>
                    <input type="text" class="form-control" id="system-name" name="system-name" value="<?php echo $system_name; ?>">
                </div>
                <div class="col-md-6">
                    <label for="system-short-name" class="form-label">System Short Name</label>
                    <input type="text" class="form-control" id="system-short-name" name="system-short-name" value="<?php echo $system_short_name; ?>">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="welcome-content" class="form-label">Welcome Content</label>
                    <textarea class="form-control" id="welcome-content" name="welcome-content" rows="4" cols="50"><?php echo $welcome_content; ?></textarea>
                </div>
                <div class="col-md-6">
                    <label for="welcome-image" class="form-label">Welcome Content Image</label>
                    <input type="file" class="form-control" id="welcome-image" name="welcome-image">
                    <img src="../../../../assets/img/<?php echo $welcome_image; ?>" alt="Welcome Image"> <!-- Display existing welcome image -->
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="about-us" class="form-label">About Us</label>
                    <textarea class="form-control" id="about-us" name="about-us" rows="4" cols="50"><?php echo $about_us; ?></textarea>
                </div>
                <div class="col-md-6">
                    <label for="about-us-image" class="form-label">About Us Image</label>
                    <input type="file" class="form-control" id="about-us-image" name="about-us-image">
                    <img src="../../../../assets/img/<?php echo $about_us_image; ?>" alt="About Us Image"> <!-- Display existing About Us image -->
                </div>
            </div>
        </div>  
        <h3>Other Information</h3> 
        <div class="contents">
            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?php echo $email; ?>">
                </div>
                <div class="col-md-4">
                    <label for="contact-num" class="form-label">Contact #</label>
                    <input type="text" class="form-control" id="contact-num" name="contact-num" value="<?php echo $contact_num; ?>">
                </div>
                <div class="col-md-4">
                    <label for="location" class="form-label">Location</label>
                    <textarea class="form-control" id="location" name="location" rows="4" cols="50"><?php echo $location; ?></textarea>
                </div>
            </div>
            <div class="update">
                <button type="submit">Update</button>
            </div>
        </div>
    </div>
</form>
        <!--System Information Section End-->

                   
</body>

       
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" crossorigin="anonymous">
</script>
<script src="../../function/script/toggle-menu.js"></script>
<script src="../../function/script/pagination.js"></script>
<script src="../../function/script/drop-down.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</html>