
<?php
    require '../../../../db.php'; 
    include '../../function/php/app-req.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment Request | Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../css/app-req.css">
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
            <a href="#appointment" class="navbar-highlight">
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
                    <ul class="dropdown-menu" style="background-color: transparent;">
                        <li><a class="dropdown-item" href="../../../users/web/api/login.html">Logout</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <!--Notification and Profile Admin-->
        <div class="app-req">
            <h3>Appointment Request</h3>
            <div class="walk-in px-lg-5">
                <div class="mb-3 x d-flex">
                    <div class="search">
                        <div class="search-bars">
                            <i class="fa fa-magnifying-glass"></i>
                            <input type="text" id="search-input" class="form-control" placeholder="Search..." />
                        </div>
                    </div>
                  
                </div>
            </div>
            <script>
                    $(document).ready(function() {
                        // Trigger AJAX request on input
                        $('#search-input').on('input', function() {
                            let searchTerm = $(this).val();
                            
                            // Send AJAX request to the server
                            $.ajax({
                                url: '../../function/php/search/search_appointments.php',
                                type: 'GET',
                                data: { search: searchTerm },
                                success: function(response) {
                                    // Update the table body with the response
                                    $('#tableBody').html(response);
                                }
                            });
                        });
                    });
                </script>
            <!--Appointment Request Table-->
            <div class="table-wrapper px-lg-5">
            <table class="table table-hover table-remove-borders">
                <thead class="thead-light">
                    <tr>
                        <th>#</th>
                        <th>Date Created</th>
                        <th>Code</th>
                        <th>Name</th>
                        <th>Contact</th>
                        <th>Email</th>
                        <th>Pet Type</th>
                        <th>Breed</th>
                        <th>Age</th>
                        <th>Service Category</th>
                        <th>Service</th>
                        <th>Appointment Date</th>
                        <th>Appointment Time</th>
                        <th>Total Payment</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="tableBody">
                        <?php foreach ($appointments as $index => $appointment): ?>
                        <tr class="test-hover">
                            <td><?= $index + 1 ?></td>
                            <td><?= $appointment['created_at'] ?></td>
                            <td id="code-<?= $appointment['id'] ?>"><?= $appointment['code'] ?? 'Pending' ?></td> <!-- Add id to the code column -->
                            <td><?= $appointment['owner_name'] ?></td>
                            <td><?= $appointment['contact_number'] ?></td>
                            <td><?= $appointment['email'] ?></td>
                            <td><?= $appointment['pet_type'] ?></td>
                            <td><?= $appointment['breed'] ?></td>
                            <td><?= $appointment['age'] ?> Yr Old</td>
                            <td><?= $appointment['service_category'] ?></td>
                            <td><?= $appointment['service_type'] ?></td>
                            <td><?= $appointment['appointment_date'] ?></td>
                            <td><?= $appointment['appointment_time'] ?></td>
                            <td><?= number_format($appointment['total_payment'], 2) ?> PHP</td>
                            <td>
                                <span id="status-badge-<?= $appointment['id'] ?>" class="badge bg-<?= $appointment['status'] == 'confirm' ? 'success' : ($appointment['status'] == 'complete' ? 'info' : ($appointment['status'] == 'decline' ? 'danger' : 'primary')) ?>">
                                    <?= ucfirst($appointment['status']) ?>
                                </span>
                            </td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton<?= $index ?>" data-bs-toggle="dropdown" aria-expanded="false">
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton<?= $index ?>">
                                        <li><a class="dropdown-item" href="#" onclick="updateStatus(<?= $appointment['id'] ?>, 'confirm')">Confirm</a></li>
                                        <li><a class="dropdown-item" href="#" onclick="updateStatus(<?= $appointment['id'] ?>, 'complete')">Complete</a></li>
                                        <li><a class="dropdown-item" href="#" onclick="updateStatus(<?= $appointment['id'] ?>, 'decline')">Decline</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
            </table>
                
            </div>
            <ul class="pagination justify-content-end mt-3 px-lg-5" id="paginationControls">
                <li class="page-item">
                    <a class="page-link" href="#" data-page="prev"><</a>
                </li>
                <li class="page-item" id="pageNumbers"></li>
                <li class="page-item">
                    <a class="page-link" href="#" data-page="next">></a>
                </li>
            </ul>
        </div>
             </div>
</body>

<script type="text/javascript">
        function updateStatus(appointmentId, newStatus) {
    $.ajax({
        url: '../../function/php/update_status.php', 
        type: 'POST',
        data: {
            id: appointmentId,
            status: newStatus
        },
        success: function(response) {
            const result = JSON.parse(response);
            if (result.success) {
                const badge = $('#status-badge-' + appointmentId);
                badge.removeClass('bg-primary bg-success bg-info bg-danger');
                if (newStatus === 'confirm') {
                    badge.addClass('bg-success');
                    badge.text('Confirmed');

                    if (result.code) {
                        $('#code-' + appointmentId).text(result.code);
                    }

                } else if (newStatus === 'complete') {
                    badge.addClass('bg-info');
                    badge.text('Completed');
                } else if (newStatus === 'decline') {
                    badge.addClass('bg-danger');
                    badge.text('Declined');
                }
            } else {
                alert(result.message || 'Failed to update status');
            }
        }
    });
}


</script>
       
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>
<script src="../../function/script/toggle-menu.js"></script>
<script src="../../function/script/pagination.js"></script>
<script src="../../function/script/drop-down.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</html>