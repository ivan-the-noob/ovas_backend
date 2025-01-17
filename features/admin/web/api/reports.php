
<?php
    require '../../../../db.php'; 



    $stmt = $conn->prepare("SELECT * FROM appointments");
    $stmt->execute();
    $appointments = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $stmt = $conn->prepare("SELECT * FROM pos_records");
    $stmt->execute();
    $records = $stmt->fetchAll(PDO::FETCH_ASSOC);


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
    <title>Reports | Admin</title>
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
            <a href="app-req.php">
                <i class="fa-regular fa-calendar-check"></i>
                <span>Appointment Request</span>
            </a>
           
           
            <a href="app-records-list.php">
                <i class="fa-regular fa-calendar-check"></i>
                <span>Record List</span>
            </a>
            <a href="pos.php">
                <i class="fas fa-cash-register"></i>
                <span>Point of Sales</span>
            </a>
            <a href="#" class="navbar-highlight">
            <i class="fa-solid fa-file-lines"></i>
                <span>Reports</span>
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

                <a href="faqs.php">
                    <i class="fa-solid fa-layer-group"></i>
                    <span>FAQS</span>
                </a>
                <a href="unavailable.php">
                    <i class="fa-solid fa-list"></i>
                    <span>Unavailable Date</span>
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
            <h3>Reports</h3>
            <div class="walk-in">
                <div class="col-md-12 mb-3 x d-flex justify-content-between">
                    <div class="search d-flex gap-2 col-md-6">
                        <div class="search-bars">
                            <i class="fa fa-magnifying-glass"></i>
                            <input type="text" id="search-input" style="border-radius: 0;" class="form-control" placeholder="Search..." />
                        </div>
                        <button id="search-button text-white" style="background-color: #74C2CD; border: none;">Search</button>
                    </div>
                    <div class="d-flex col-md-5 gap-2">
                    <select name="month" id="month-filter" class="w-100"  style="background-color: #74C2CD;>
                        <option value="">Month</option>
                        <option value="1">January</option>
                        <option value="2">February</option>
                        <option value="3">March</option>
                        <option value="4">April</option>
                        <option value="5">May</option>
                        <option value="6">June</option>
                        <option value="7">July</option>
                        <option value="8">August</option>
                        <option value="9">September</option>
                        <option value="10">October</option>
                        <option value="11">November</option>
                        <option value="12">December</option>
                    </select>
                    <select name="year" id="year-filter" class="w-100"  style="background-color: #74C2CD;">
                        <option value="">Year</option>
                        <option value="2023">2023</option>
                        <option value="2024">2024</option>
                        <option value="2025">2025</option>
                    </select>
                    <button class="w-50" id="filter-button" style="background-color: #D1CFBE;">Filter</button>

                    </div>
           
                </div>
                <div class="d-flex col-md-12">                          
                    <div class="d-flex col-md-6">
                        <select name="" id="select-option" class="w-100 p-3 mb-2" style="margin-left: 10px; background-color: #EBBF86;">
                            <option value="">Select Table</option>
                            <option value="appointment">Appointment History</option>
                            <option value="transaction">Transaction</option>
                        </select>
                    </div>
                        <select name="status-filter" id="status-filter" class="w-100 p-3 mb-2" style="margin-left: 10px; background-color: #EBBF86;">
                            <option value="">Filter By Status</option>
                            <option value="pending">Pending</option>
                            <option value="confirm">Confirm</option>
                            <option value="decline">Declined</option>
                        </select>
                    </div>
                </div> 
           
            </div>
            

            <div class="container">
            <table class="table table-hover table-remove-borders appointment" style="display: none;">
            <thead class="thead-light">
            <tr>
                <th>#</th>
                <th>Owner Name</th>
                <th>Date</th>
                <th>Service Category</th>
                <th>Service</th>
                <th>Code</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($appointments as $index => $appointment): ?>
            <tr data-name="<?= strtolower($appointment['owner_name']) ?>" data-service-category="<?= strtolower($appointment['service_category']) ?>" data-status="<?= strtolower($appointment['status']) ?>">
                <td><?= $index + 1 ?></td>
                <td><?= htmlspecialchars($appointment['owner_name']) ?></td>
                <td><?= htmlspecialchars(date('M j, Y', strtotime($appointment['created_at']))) ?></td>
                <td><?= $appointment['service_category'] === 'medical' ? 'Medical' : ($appointment['service_category'] === 'nonMedical' ? 'Non-Medical' : 'N/A') ?></td>
                <td><?= htmlspecialchars($appointment['service_type']) ?></td>
                <td><?= $appointment['code'] ?? 'Pending' ?></td>
                <td>
                    <span class="badge bg-<?= $appointment['status'] == 'confirm' ? 'primary' : ($appointment['status'] == 'complete' ? 'success' : ($appointment['status'] == 'decline' ? 'danger' : 'warning')) ?>">
                        <?= ucfirst($appointment['status']) ?>
                    </span>
                </td>
                <td>
                    <div class="d-flex gap-2">
                        <!-- View Details Button -->
                        <button type="button" class="btn btn-info btn-sm text-white fw-bold" data-bs-toggle="modal" data-bs-target="#appointmentModal<?= $appointment['id'] ?>">
                            View Details
                        </button>

                    </div>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="container w-100">
            <div class="table-responsive" style="max-width: 100%; overflow-x: auto;">
            <table class="table table-hover table-remove-borders pos"  style="display: none;">
            <thead class="thead-light">
                    <tr>
                        <th>ID</th>
                        <th>Owner Name</th>
                        <th>Date</th>
                        <th>Services</th>
                        <th>Medication/Supplies</th>
                        <th>Total</th>
                        <th>Cash Tendered</th>
                        <th>Change</th>
                        <th>Actions</th>
                        <!-- <th>Actions</th> -->
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($records as $record): 
                        $id = json_decode($record['id'], true);
                        $services = json_decode($record['services'], true);
                        $costs = json_decode($record['cost'], true); 
                        $medications = json_decode($record['medication'], true);
                        $supplies = json_decode($record['supplies'], true);
                        $total = !empty($record['total']) && is_numeric($record['total']) ? number_format($record['total'], 2) : '0.00';
                        $cash_tendered = !empty($record['cash_tendered']) && is_numeric($record['cash_tendered']) ? number_format($record['cash_tendered'], 2) : '0.00'; 
                        $changee = !empty($record['changee']) && is_numeric($record['changee']) ? number_format($record['changee'], 2) : '0.00'; 
                    ?>
                    <tr>
                    <td><?php echo htmlspecialchars($record['id']); ?></td>
                        <td><?php echo htmlspecialchars($record['owner_name']); ?></td>
                        <td><?= htmlspecialchars(date('M j, Y', strtotime($record['timestamp']))) ?></td>
                        
                        <td>
                            <?php if (is_array($services) && is_array($costs)): ?>
                                <ul class="list-unstyled">
                                    <?php foreach ($services as $index => $service): ?>
                                        <li>
                                            <?php echo htmlspecialchars($service); ?> - ₱ <?php echo isset($costs[$index]) ? number_format((float)$costs[$index], 2) : '0.00'; ?>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if (!empty($medications) || !empty($supplies)): ?>
                                <ul class="list-unstyled">
                                    <?php if (!empty($medications)): ?>
                                        <?php foreach ($medications as $medication): ?>
                                            <li>
                                                <?php echo htmlspecialchars($medication); ?> - ₱ 25.00
                                            </li>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                    <?php if (!empty($supplies)): ?>
                                        <?php foreach ($supplies as $supply): ?>
                                            <li>
                                                <?php echo htmlspecialchars($supply); ?> - ₱ 299.00
                                            </li>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </ul>
                            <?php endif; ?>
                        </td>
                        <td>₱ <?php echo $total; ?></td>
                        <td>₱ <?php echo $cash_tendered; ?></td>
                        <td>₱ <?php echo $changee; ?></td>
                        <td>
                            <button class="btn btn-primary btn-sm" onclick="printCard(this)">Print</button>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            </div>
            
                                    <div class="action-buttons">
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
                                         </div>                                      
                                        </div>

                                        </div>
                                    </div>
                            </div>
                        </div>
    <!-- Modal -->

    <div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmationModalLabel">Are you sure?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to change the status to <span id="status-text"></span>?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="confirmActionButton">Yes, Confirm</button>
                </div>
            </div>
        </div>
    </div>
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
                

           
        </div>
    </div>

                                       
</body>

<script type="text/javascript">
  function updateStatus(appointmentId, newStatus) {
    currentAppointmentId = appointmentId;
    currentStatus = newStatus;

    if (newStatus === 'decline') {
        $('#appointmentId').val(appointmentId);  
        $('#declineModal').modal('show');  
        return; 
    }

    let statusText = "";
    if (newStatus === 'confirm') {
        statusText = "Confirm";
    } else if (newStatus === 'complete') {
        statusText = "Complete";
    }

    document.getElementById('status-text').textContent = statusText;
    $('#confirmationModal').modal('show');

    document.getElementById('confirmActionButton').onclick = function() {
        $('#confirmationModal').modal('hide');
        executeStatusChange(currentAppointmentId, currentStatus);
    };
}

function executeStatusChange(appointmentId, newStatus) {
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

document.getElementById('declineReasonForm').onsubmit = function(event) {
    event.preventDefault();
    let form = this;

    if (form.checkValidity()) {
        executeStatusChange(currentAppointmentId, 'decline');
        form.submit();  
    } else {
        alert('Please provide a reason for cancellation.');
    }
};


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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
 $(document).ready(function() {
    $('#status-filter').change(function() {
        var selectedStatus = $(this).val();
        
        if (selectedStatus === "") {
            $('.appointment tbody tr').show();
        } else {
            $('.appointment tbody tr').each(function() {
                var rowStatus = $(this).data('status');
                if (rowStatus === selectedStatus) {
                    $(this).show(); 
                } else {
                    $(this).hide(); 
                }
            });
        }
    });

    $('#select-option').change(function() {
        var selectedOption = $(this).val();
        
        $('.appointment').hide();
        $('.pos').hide();
        
        if (selectedOption === 'appointment') {
            $('.appointment').show();
        } else if (selectedOption === 'transaction') {
            $('.pos').show();
        }
    });

    $('#filter-button').click(function() {
        var selectedMonth = $('#month-filter').val();
        var selectedYear = $('#year-filter').val();

        $('.appointment tbody tr').each(function() {
            var rowDate = $(this).find('td').eq(2).text();  

            if (rowDate) {
                var dateParts = rowDate.split(' '); 
                var rowMonth = dateParts[0];
                var rowDay = dateParts[1];
                var rowYear = dateParts[2];

                var monthMatch = !selectedMonth || rowMonth.toLowerCase() === getMonthName(selectedMonth).toLowerCase();
                var yearMatch = !selectedYear || rowYear === selectedYear;

                if (monthMatch && yearMatch) {
                    $(this).show();  
                } else {
                    $(this).hide(); 
                }
            } else {
                $(this).hide();
            }
        });
    });

    $('#search-button').click(function() {
        var searchTerm = $('#search-input').val().toLowerCase().trim(); 
        
        $('.appointment tbody tr').each(function() {
            var ownerName = $(this).find('td').eq(1).text().toLowerCase();  
            
            if (ownerName.includes(searchTerm)) {
                $(this).show(); 
                $(this).addClass('highlight'); 
            } else {
                $(this).hide(); 
                $(this).removeClass('highlight');  
            }
        });
    });

    function getMonthName(monthNumber) {
        var months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
        return months[monthNumber - 1];
    }
});


</script>


</html>