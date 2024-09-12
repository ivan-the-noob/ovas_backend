<?php 
    session_start();  

    if (!isset($_SESSION['email']) || $_SESSION['role'] !== 'admin') {
        header("Location: ../../../users/web/api/login.php");
        exit(); 
    }

    include '../../function/php/view_record.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Record Lists | Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../css/app-records-list.css">
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
            <a href="app-records-list.php"  class="navbar-highlight">
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
                        <li><a class="dropdown-item" href="../../../users/web/api/login.html">Logout</a></li>
                    </ul>
                </div>
            </div>
        </div>
         <!--Notification and Profile Admin End-->

         <div class="app-req">
    <h3>Record List</h3>
    <div class="walk-in px-lg-5">
        <div class="mb-3 x d-flex">
            <div class="search">
                <div class="search-bars">
                    <i class="fa fa-magnifying-glass"></i>
                    <input type="text" id="search-input" class="form-control" placeholder="Search by owner name..." />
                </div>
            </div>
        </div>
    </div>
          
            
    
            <div class="container">
    <div class="row px-lg-5">
    <div class="container">
    <div class="row px-lg-5" id="patient-container">
        <?php foreach ($patients as $patient): ?>
        <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title text-center"><?php echo htmlspecialchars($patient['ownerName']); ?></h5>
                    <button type="button" class="view" data-toggle="modal" data-target="#modal<?php echo $patient['id']; ?>">View</button>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>
            <script>
   $(document).ready(function() {
        // Trigger AJAX request on input
        $('#search-input').on('input', function() {
            let searchTerm = $(this).val();
            
            // Send AJAX request to the server
            $.ajax({
                url: '../../function/php/search/search_patients.php', // The PHP file to handle the search
                type: 'GET',
                data: { search: searchTerm }, // Send the search term as GET parameter
                success: function(response) {
                    // Clear the existing patient container content before updating
                    $('#patient-container').empty();
                    
                    // Update the patient container with the new response
                    $('#patient-container').html(response);
                },
                error: function(xhr, status, error) {
                    console.log("Error: " + error);
                }
            });
        });
    });
</script>


<?php foreach ($patients as $patient): ?>
            <!-- Modal for each patient -->
            <div class="modal fade" id="modal<?php echo $patient['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="modalLabel<?php echo $patient['id']; ?>" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header justify-content-between">
                            <h5 class="modal-title" id="modalLabel<?php echo $patient['id']; ?>">Details for <?php echo htmlspecialchars($patient['ownerName']); ?></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="container">
                            <div class="row">
                                <!-- First Column -->
                                <div class="col-md-3">
                                    <h6>Client Information</h6>
                                    <p><strong>Name:</strong> <?php echo htmlspecialchars($patient['ownerName']); ?></p>
                                    <p><strong>Address:</strong> <?php echo htmlspecialchars($patient['ownerAddress']); ?></p>
                                    <p><strong>Contact:</strong> </p>
                                    <p><strong>Home:</strong> <?php echo htmlspecialchars($patient['home']); ?></p>
                                    <p><strong>Work:</strong> <?php echo htmlspecialchars($patient['work']); ?></p>
                                    <p><strong>Email:</strong> <?php echo htmlspecialchars($patient['ownerEmail']); ?></p>
                                    <p><strong>Preferred:</strong> <?php echo htmlspecialchars($patient['preferredContact']); ?></p>
                                </div>

                                <!-- Second Column -->
                                <div class="col-md-3">
                                    <h6>Pet Information</h6>
                                    <p><strong>Pet's Name:</strong> <?php echo htmlspecialchars($patient['petName']); ?></p>
                                    <p><strong>Species:</strong> <?php echo htmlspecialchars($patient['petType']); ?></p>
                                    <p><strong>Sex:</strong> <?php echo htmlspecialchars($patient['sex']); ?></p>
                                    <p><strong>Breed:</strong> <?php echo htmlspecialchars($patient['breed']); ?></p>
                                    <p><strong>Colors & Marking:</strong> <?php echo htmlspecialchars($patient['colorMarkings']); ?></p>
                                    <p><strong>Microchip No.:</strong> <?php echo htmlspecialchars($patient['microchipNo']); ?></p>
                                    <p><strong>Date of Birth:</strong> <?php echo htmlspecialchars($patient['dob']); ?></p>
                                    <p><strong>Age:</strong> <?php echo htmlspecialchars($patient['age']); ?></p>
                                </div>

                                <!-- Third Column -->
                                <div class="col-md-3">
                                    <h6>Services</h6>
                                    <p><strong>Category:</strong> <?php echo htmlspecialchars($patient['serviceCategory']); ?></p>
                                    <p><strong>Services:</strong> <?php echo htmlspecialchars($patient['service']); ?></p>
                                    <p><strong>Total Payment:</strong> ₱<?php echo htmlspecialchars($patient['totalPayment']); ?></p>
                                </div>

                                <!-- Fourth Column -->
                                <div class="col-md-3">
                                    <h6>Other Information</h6>
                                    <p><strong>Date:</strong> <?php echo htmlspecialchars($patient['date']); ?></p>
                                    <p><strong>Authorization for Treatment:</strong> <?php echo htmlspecialchars($patient['authorization']); ?></p>
                                    <p><strong>Veterinarian's Report:</strong><br> 
                                        <?php echo htmlspecialchars($patient['enteringComplaint']); ?>
                                    </p>
                                    <p><strong>History • Physical Findings • Diagnosis • Treatment:</strong><br>
                                        <?php echo htmlspecialchars($patient['historyPhysical']); ?>
                                    </p>
                                    <div class="mb-3">
                                        <button class="save">Update</button>
                                    </div>
                                </div>                                 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <!-- <?php endforeach; ?> -->
    </div>
</div>

                        

             <!--Page number-->
            <ul class="pagination justify-content-end mt-3 px-lg-5" id="paginationControls">
                <li class="page-item">
                    <a class="page-link" href="#" data-page="prev"><</a>
                </li>
                <li class="page-item" id="pageNumbers"></li>
                <li class="page-item">
                    <a class="page-link" href="#" data-page="next">></a>
                </li>
            </ul>
              <!--Page number End-->
            
             </div>
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