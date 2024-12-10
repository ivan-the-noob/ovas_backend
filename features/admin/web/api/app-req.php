
<?php
    require '../../../../db.php'; 
    include '../../function/php/app-req.php';

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
                <a href="review.php">
                    <i class="fa-solid fa-list"></i>
                    <span>User Reviews</span>
                </a>
                <a href="category-list.php" >
                    <i class="fa-solid fa-list"></i>
                    <span>Category List</span>
                </a>
                <a href="service-list.php">
                    <i class="fa-solid fa-layer-group"></i>
                    <span>Service List</span>
                </a>
                <a href="unavailable.php">
                    <i class="fa-solid fa-list"></i>
                    <span>Unavailable Date</span>
                </a>
                <a href="max-book.php">
                    <i class="fa-solid fa-layer-group"></i>
                    <span>Max Book</span>
                </a>
                <a href="admin-user.php">
                    <i class="fa-solid fa-user-tie"></i>
                    <span>Admin User List</span>
                </a>

                <a href="chat-bot.php" >
                <i class="fa-solid fa-headset"></i>
                    <span>Chat Bot</span>
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
            <?php 
                require '../../../../db.php'; 
                try {
                    // Fetch notifications and unread count
                    $sql = "SELECT * FROM admin_confirm ORDER BY created_at DESC";
                    $stmt = $conn->prepare($sql);
                    $stmt->execute();
                    $notifications = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    // Fetch only unread notifications
                    $unreadCountSql = "SELECT COUNT(*) FROM admin_confirm WHERE `read` = '0'";
                    $unreadStmt = $conn->prepare($unreadCountSql);
                    $unreadStmt->execute();
                    $unreadCount = $unreadStmt->fetchColumn();
                } catch (PDOException $e) {
                    echo "Query failed: " . $e->getMessage();
                }
            ?>

                <div class="profile-admin">
                    <div class="dropdown">
                        <button class="position-relative" type="button" id="notificationDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-bell"></i>
                            <?php if ($unreadCount > 0): ?>
                                <span id="notification-count" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                    <?php echo $unreadCount; ?>
                                </span>
                            <?php endif; ?>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="notificationDropdown">
                            <li class="dropdown-header">
                                <h5 class="mb-0">Notification</h5>
                            </li>
                            <?php if (!empty($notifications)): ?>
                                <?php foreach ($notifications as $notification): ?>
                                    <li class="dropdown-item">
                                        <?php if ($notification['status'] == 'confirm'): ?>
                                            <div class="alert alert-primary mb-0">
                                                <strong>Appointment Confirmed</strong>
                                                <p><?php echo htmlspecialchars($notification['name']); ?>'s appointment has been confirmed!</p>                               
                                            </div>
                                        <?php elseif ($notification['status'] == 'decline'): ?>
                                            <div class="alert alert-danger mb-0">
                                                <strong>Declined</strong>
                                                <p><?php echo htmlspecialchars($notification['name']); ?>'s appointment has been declined. <a href="#" class="alert-link">See here.</a></p> 
                                            </div>
                                        <?php elseif ($notification['status'] == 'complete'): ?>
                                            <div class="alert alert-success mb-0">
                                                <strong>Completed!</strong>
                                                <p><?php echo htmlspecialchars($notification['name']); ?>'s appointment has been completed.</p>
                                            </div>
                                        <?php endif; ?>
                                    </li>
                                <?php endforeach; ?>
                            <?php endif; ?>                  
                        </ul>
                    </div>
                


                <div class="dropdown">
                    <button class="" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="../../../../assets/img/vet logo.jpg" style="width: 40px; height: 40px; object-fit: cover;">
                    </button>
                    <ul class="dropdown-menu" style="background-color: transparent;">
                    <li><a class="dropdown-item" href="../../../users/web/api/logout.php">Logout</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <!--Notification and Profile Admin-->
        <div class="app-req">
            <h3>Appointment Request</h3>
            <div class="walk-in px-lg-5 d-flex ">
                <div class="col-md-4 mb-3 x d-flex">
                    <div class="search">
                        <div class="search-bars">
                            <i class="fa fa-magnifying-glass"></i>
                            <input type="text" id="search-input" class="form-control" placeholder="Search..." />
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                <div class="sort">
                    <select id="sort-dropdown" class="form-select" aria-label="Sort By">
                        <option value="">Sort By</option>
                        <option value="name">Name</option>
                        <option value="medical">Medical</option>
                        <option value="nonMedical">Non-Medical</option>
                        <option value="pending">Pending</option>
                        <option value="confirm">Confirm</option>
                        <option value="decline">Decline</option>
                    </select>
                </div>
                </div>
            </div>

            <!--Appointment Request Table-->
            <div class="row" id="appointments-container">
                <?php foreach ($appointments as $index => $appointment): ?>
                    <div class="col-md-4 mb-4 appointment-card" data-name="<?= strtolower($appointment['owner_name']) ?>" data-service-category="<?= strtolower($appointment['service_category']) ?>" data-status="<?= strtolower($appointment['status']) ?>">
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title">Appointment <?= $index + 1 ?></h5>
                                <p class="card-text"><strong>Owner Name:</strong> <?= $appointment['owner_name'] ?></p>
                                <p class="card-text"><strong>Service Category:</strong>  <?= $appointment['service_category'] === 'medical' ? 'medical' : ($appointment['service_category'] === 'nonMedical' ? 'nonMedical' : 'N/A') ?></p>
                                <p class="card-text"><strong>Service:</strong> <?= $appointment['service_type'] ?></p>
                                <p class="card-text"><strong>Code: </strong><?= $appointment['code'] ?? 'Pending' ?></p>
                                <p class="card-text"><strong>Status:</strong> 
                                    <span class="badge bg-<?= $appointment['status'] == 'confirm' ? 'primary' : ($appointment['status'] == 'complete' ? 'success' : ($appointment['status'] == 'decline' ? 'danger' : 'warning')) ?>">
                                        <?= ucfirst($appointment['status']) ?>
                                    </span>
                                </p>
                                <?php if ($appointment['status'] == 'decline'): ?>
                                    <p class="card-text"><strong>Reason:</strong> <?= $appointment['decline_reason'] ?></p>
                                <?php endif; ?>
                                 <div class="d-flex gap-3 justify-content-center">
                                    <button type="button" class="d-flex view-details" data-bs-toggle="modal" data-bs-target="#appointmentModal<?= $appointment['id'] ?>">
                                        View Details
                                    </button>
                                    <div class="dropdown">
                                    <?php
                                        $currentStatus = ucfirst($appointment['status']); 
                                        $buttonClass = '';
                                        switch ($appointment['status']) {
                                            case 'pending':
                                                $buttonClass = 'btn-warning'; 
                                                break;
                                            case 'confirm':
                                                $buttonClass = 'btn-primary';
                                                break;
                                            case 'complete':
                                                $buttonClass = 'btn-success';
                                                break;
                                            case 'decline':
                                                $buttonClass = 'btn-danger'; 
                                                break;
                                            default:
                                                $buttonClass = 'btn-secondary'; 
                                        }
                                        ?>

                                        <button class="btn <?= $buttonClass ?> " type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                            <?= $currentStatus ?> 
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <li class="dropdown-item" onclick="updateStatus(<?= $appointment['id'] ?>, 'confirm')">Confirm</li>
                                            <li class="dropdown-item" onclick="updateStatus(<?= $appointment['id'] ?>, 'complete')">Complete</li>
                                            <li class="dropdown-item" onclick="updateStatus(<?= $appointment['id'] ?>, 'decline')">Decline</li>
                                            
                                        </ul>
                                        </div>
                                    </div>
                                        </div>
                                    </div>
                            </div>

    <!-- Modal -->
    <div class="modal fade" id="appointmentModal<?= $appointment['id'] ?>" tabindex="-1" aria-labelledby="modalLabel<?= $appointment['id'] ?>" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel<?= $appointment['id'] ?>">Appointment Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <div class="app-sched d-flex justify-content-between">
                    <div class="col-md-4 gap-2">
                    <h5 class="modal-title">Appointment Schedule</h5>
                        <p class="appointment-date p-2 rounded-pill app-date text-center">
                            <?php 
                                echo date('M j, Y', strtotime($appointment['appointment_date'])); 
                            ?> | <?= date('g A', strtotime($appointment['appointment_time'])) ?>
                        </p>
                    </div>

                   
                </div>
                

                <div class="row">
                    <!-- Appointment Date -->
                  

                    <!-- Owner Information -->
                    <div class="col-md-4">
                        <h6 class="text-muted">Owner Information</h6>
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" class="form-control" value="<?= $appointment['owner_name'] ?>" readonly>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Contact #</label>
                            <input type="text" class="form-control" value="<?= $appointment['contact_number'] ?>" readonly>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" value="<?= $appointment['email'] ?>" readonly>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Address</label>
                            <input type="text" class="form-control" value="<?= $appointment['address'] ?>" readonly>
                        </div>
                    </div>

                    <!-- Pet Information -->
                    <div class="col-md-4">
                        <h6 class="text-muted">Pet Information</h6>
                        <div class="mb-3">
                            <label class="form-label">Pet Type</label>
                            <input type="text" class="form-control" value="<?= $appointment['pet_type'] ?>" readonly>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Breed</label>
                            <input type="text" class="form-control" value="<?= $appointment['breed'] ?>" readonly>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Age</label>
                            <input type="text" class="form-control" value="<?= $appointment['age'] ?> Months" readonly>
                        </div>
                    </div>

                    <!-- Services Information -->
                    <div class="col-md-4">
                        <h6 class="text-muted">Services</h6>
                        <div class="mb-3">
                            <label class="form-label">Service Category</label>
                            <input type="text" class="form-control" value="<?= $appointment['service_category'] ?>" readonly>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Service</label>
                            <input type="text" class="form-control" value="<?= $appointment['service_type'] ?>" readonly>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Total Payment</label>
                            <input type="text" class="form-control" value="<?= number_format($appointment['total_payment'], 2) ?> PHP" readonly>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Pay Via</label>
                            <input type="text" class="form-control" value="<?= htmlspecialchars($appointment['payment_method']) ?>" readonly>
                        </div>

                        <?php if ($appointment['payment_method'] === 'gcash'): ?>
                            <div class="mb-3">
                                <label class="form-label">Reference</label>
                                <input type="text" class="form-control" value="<?= htmlspecialchars($appointment['reference']) ?>" readonly>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Screenshot</label>
                                <img src="../../../../assets/img/gcash/<?= htmlspecialchars($appointment['gcash_screenshot']) ?>" alt="GCash Screenshot" class="img-fluid" />
                            </div>
                        <?php endif; ?>

                    </div>
                </div>
               
                
            </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>

                <div class="modal fade" id="declineModal" tabindex="-1" aria-labelledby="declineModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="declineModalLabel">Reason for Cancellation</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="../../function/php/submit_decline_reason.php" method="POST" id="declineReasonForm">
                                    <input type="hidden" name="id" id="appointmentId" /> <!-- Hidden field to pass the appointment ID -->
                                    <div class="mb-3">
                                        <label for="declineReason" class="form-label">Reason</label>
                                        <textarea class="form-control" id="declineReason" name="declineReason" rows="3" required></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-danger">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
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
            if (response === 'success') {
                const badge = $('#status-badge-' + appointmentId);
                badge.removeClass('bg-primary bg-success bg-info bg-danger'); 

                if (newStatus === 'confirm') {
                    badge.addClass('bg-success');
                    badge.text('Confirmed');
                } else if (newStatus === 'complete') {
                    badge.addClass('bg-info');
                    badge.text('Completed');
                } else if (newStatus === 'decline') {
                    badge.addClass('bg-danger');
                    badge.text('Declined');
                    
                    $('#appointmentId').val(appointmentId);  
                    $('#declineModal').modal('show');  
                } else if (newStatus === 'pending') {
                    badge.addClass('bg-primary');
                    badge.text('Pending');
                }
                if (newStatus !== 'decline') {
                    location.reload(); 
                }
            } else {
                alert('Failed to update status'); 
            }
        },
        error: function() {
            alert('Error occurred while updating status.'); 
        }
    });
}

    document.getElementById('notificationDropdown').addEventListener('show.bs.dropdown', function () {

        var xhr = new XMLHttpRequest();
        xhr.open("POST", "../../function/php/mark_as_read.php", true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.send();

        document.getElementById('notification-count').textContent = '0';
        document.getElementById('notification-count').classList.add('d-none');
    });
</script>

       
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>
<script src="../../function/script/toggle-menu.js"></script>
<script src="../../function/script/appreq_search.js"></script>
<script src="../../function/script/appreq-pagination.js"></script>
<script src="../../function/script/drop-down.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


</html>