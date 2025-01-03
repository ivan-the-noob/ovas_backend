<?php 
    session_start();  

    if (!isset($_SESSION['email']) || $_SESSION['role'] !== 'admin') {
        header("Location: ../../../users/web/api/login.php");
        exit(); 
    }

    include '../../function/php/view_record.php';
    require '../../../../db.php';

    $limit = 8;
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $offset = ($page - 1) * $limit;

    try {
        $stmt = $conn->prepare("SELECT * FROM patients_records LIMIT :limit OFFSET :offset");
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        $patients = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $countStmt = $conn->query("SELECT COUNT(*) as total FROM patients_records");
        $totalRow = $countStmt->fetch(PDO::FETCH_ASSOC);
        $totalPatients = $totalRow['total'];
        $totalPages = ceil($totalPatients / $limit);

    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    try {
        $sql = "SELECT message FROM app_req_notif";
        $stmt = $conn->query($sql);
        $notifications = $stmt->fetchAll(PDO::FETCH_ASSOC);
      } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
      }
      
      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['markAsRead']) && $_POST['markAsRead'] === 'true') {
            try {
                $sql = "UPDATE app_req_notif SET is_read = 1 WHERE is_read = 0";
                $stmt = $conn->prepare($sql);
                $stmt->execute();
      
                echo "Notifications marked as read.";
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        }
      }
      
      try {
        $stmt = $conn->prepare("SELECT COUNT(*) as unread_count FROM app_req_notif WHERE is_read = FALSE");
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $unread_count = $row['unread_count'];
      } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
      }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Record Lists | Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../../css/app-records-list.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


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
                <a href="review.php">
                    <i class="fa-solid fa-list"></i>
                    <span>User Reviews</span>
                </a>
                <a href="category-list.php">
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
            <div class="profile-admin">
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
    <table class="table table-hover table-remove-borders">
    <thead class="thead-light">
            <tr>
                <th>Owner Name</th>
                <th>Owner Address</th>
                <th>Home</th>
                <th>Work</th>
                <th>Owner Email</th>
                <th>Preferred Contact</th>
                <th>Pet Name</th>
                <th>Pet Type</th>
                <th>Sex</th>
                <th>Breed</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($patients as $patient): ?>
            <tr>
                <td><?php echo htmlspecialchars($patient['ownerName']); ?></td>
                <td><?php echo htmlspecialchars($patient['ownerAddress']); ?></td>
                <td><?php echo htmlspecialchars($patient['home']); ?></td>
                <td><?php echo htmlspecialchars($patient['work']); ?></td>
                <td><?php echo htmlspecialchars($patient['ownerEmail']); ?></td>
                <td><?php echo htmlspecialchars($patient['preferredContact']); ?></td>
                <td><?php echo htmlspecialchars($patient['petName']); ?></td>
                <td><?php echo htmlspecialchars($patient['petType']); ?></td>
                <td><?php echo htmlspecialchars($patient['sex']); ?></td>
                <td><?php echo htmlspecialchars($patient['breed']); ?></td>
                <td class="d-flex gap-1">
                <button class="btn btn-info btn-sm text-white" data-bs-toggle="modal" data-bs-target="#seeMoreModal<?php echo $patient['id']; ?>">See More</button>
                <button class="btn btn-info btn-sm text-white" data-bs-toggle="modal" data-bs-target="#editModal<?php echo $patient['id']; ?>">Edit</button>
                <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal<?php echo $patient['id']; ?>">Delete</button>
                </td>
            </tr>

            <!-- Modal -->
            <div class="modal fade" id="seeMoreModal<?php echo $patient['id']; ?>" tabindex="-1" aria-labelledby="seeMoreModalLabel<?php echo $patient['id']; ?>" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-sm">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="seeMoreModalLabel<?php echo $patient['id']; ?>">Details for <?php echo htmlspecialchars($patient['ownerName']); ?></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- Modal Content -->
                            <div class="mb-3">
                                <label for="colorMarkings-input-<?php echo $patient['id']; ?>" class="form-label">Colors:</label>
                                <input type="text" class="form-control" id="colorMarkings-input-<?php echo $patient['id']; ?>" value="<?php echo htmlspecialchars($patient['colorMarkings']); ?>" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="microchipNo-input-<?php echo $patient['id']; ?>" class="form-label">Microchip No:</label>
                                <input type="text" class="form-control" id="microchipNo-input-<?php echo $patient['id']; ?>" value="<?php echo htmlspecialchars($patient['microchipNo']); ?>" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="dob-input-<?php echo $patient['id']; ?>" class="form-label">Birth Date:</label>
                                <input type="date" class="form-control" id="dob-input-<?php echo $patient['id']; ?>" value="<?php echo htmlspecialchars($patient['dob']); ?>" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="age-input-<?php echo $patient['id']; ?>" class="form-label">Age:</label>
                                <input type="number" class="form-control" id="age-input-<?php echo $patient['id']; ?>" value="<?php echo htmlspecialchars($patient['age']); ?>" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="serviceCategory-input-<?php echo $patient['id']; ?>" class="form-label">Category:</label>
                                <input type="text" class="form-control" id="serviceCategory-input-<?php echo $patient['id']; ?>" value="<?php echo htmlspecialchars($patient['serviceCategory']); ?>" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="service-input-<?php echo $patient['id']; ?>" class="form-label">Services:</label>
                                <input type="text" class="form-control" id="service-input-<?php echo $patient['id']; ?>" value="<?php echo htmlspecialchars($patient['service']); ?>" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="totalPayment-input-<?php echo $patient['id']; ?>" class="form-label">Total Payment:</label>
                                <input type="text" class="form-control" id="totalPayment-input-<?php echo $patient['id']; ?>" value="₱<?php echo htmlspecialchars($patient['totalPayment']); ?>" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="date-input-<?php echo $patient['id']; ?>" class="form-label">Date:</label>
                                <input type="text" class="form-control" id="date-input-<?php echo $patient['id']; ?>" value="<?php echo htmlspecialchars($patient['date']); ?>" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="authorization-input-<?php echo $patient['id']; ?>" class="form-label">Authorization for Treatment:</label>
                                <input type="text" class="form-control" id="authorization-input-<?php echo $patient['id']; ?>" value="<?php echo htmlspecialchars($patient['authorization']); ?>" readonly>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="editModal<?php echo $patient['id']; ?>" tabindex="-1" aria-labelledby="editModalLabel<?php echo $patient['id']; ?>" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <form action="../../function/php/update_patient.php" method="POST">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editModalLabel<?php echo $patient['id']; ?>">Edit Details for <?php echo htmlspecialchars($patient['ownerName']); ?></h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" name="id" value="<?php echo $patient['id']; ?>">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Owner Name:</label>
                                            <input type="text" class="form-control" name="ownerName" value="<?php echo htmlspecialchars($patient['ownerName']); ?>" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Owner Address:</label>
                                            <input type="text" class="form-control" name="ownerAddress" value="<?php echo htmlspecialchars($patient['ownerAddress']); ?>" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Home Phone:</label>
                                            <input type="text" class="form-control" name="home" value="<?php echo htmlspecialchars($patient['home']); ?>" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Work Phone:</label>
                                            <input type="text" class="form-control" name="work" value="<?php echo htmlspecialchars($patient['work']); ?>" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Email:</label>
                                            <input type="email" class="form-control" name="ownerEmail" value="<?php echo htmlspecialchars($patient['ownerEmail']); ?>" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Preferred Contact:</label>
                                            <input type="text" class="form-control" name="preferredContact" value="<?php echo htmlspecialchars($patient['preferredContact']); ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Pet Name:</label>
                                            <input type="text" class="form-control" name="petName" value="<?php echo htmlspecialchars($patient['petName']); ?>" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Pet Type:</label>
                                            <input type="text" class="form-control" name="petType" value="<?php echo htmlspecialchars($patient['petType']); ?>" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Sex:</label>
                                            <input type="text" class="form-control" name="sex" value="<?php echo htmlspecialchars($patient['sex']); ?>" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Breed:</label>
                                            <input type="text" class="form-control" name="breed" value="<?php echo htmlspecialchars($patient['breed']); ?>" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Colors:</label>
                                            <input type="text" class="form-control" name="colorMarkings" value="<?php echo htmlspecialchars($patient['colorMarkings']); ?>" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Microchip No:</label>
                                            <input type="text" class="form-control" name="microchipNo" value="<?php echo htmlspecialchars($patient['microchipNo']); ?>">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Birth Date:</label>
                                            <input type="date" class="form-control" name="dob" value="<?php echo htmlspecialchars($patient['dob']); ?>" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Age:</label>
                                            <input type="number" class="form-control" name="age" value="<?php echo htmlspecialchars($patient['age']); ?>" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Category:</label>
                                            <input type="text" class="form-control" name="serviceCategory" value="<?php echo htmlspecialchars($patient['serviceCategory']); ?>">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Services:</label>
                                            <input type="text" class="form-control" name="service" value="<?php echo htmlspecialchars($patient['service']); ?>">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Total Payment:</label>
                                            <input type="text" class="form-control" name="totalPayment" value="₱<?php echo htmlspecialchars($patient['totalPayment']); ?>">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Date:</label>
                                            <input type="date" class="form-control" name="date" value="<?php echo htmlspecialchars($patient['date']); ?>">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Authorization for Treatment:</label>
                                            <input type="text" class="form-control" name="authorization" value="<?php echo htmlspecialchars($patient['authorization']); ?>">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Entering Complaint:</label>
                                            <textarea class="form-control" name="enteringComplaint"><?php echo htmlspecialchars($patient['enteringComplaint']); ?></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">History of Physical:</label>
                                            <textarea class="form-control" name="historyPhysical"><?php echo htmlspecialchars($patient['historyPhysical']); ?></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save Changes</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="modal fade" id="deleteModal<?php echo $patient['id']; ?>" tabindex="-1" aria-labelledby="deleteModalLabel<?php echo $patient['id']; ?>" aria-hidden="true">
                <div class="modal-dialog modal-sm modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteModalLabel<?php echo $patient['id']; ?>">Delete Patient Record</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Are you sure you want to delete this patient record? This action cannot be undone.
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <form method="POST" action="../../function/php/delete_patient.php">
                                <input type="hidden" name="id" value="<?php echo $patient['id']; ?>">
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
            </div>

            


   
             <!--Page number-->
             <ul class="pagination justify-content-end mt-3 px-lg-5">
                <li class="page-item <?php if($page <= 1){ echo 'disabled'; } ?>">
                    <a class="page-link" href="?page=<?php echo $page-1; ?>"><</a>
                </li>
                
                <?php for($i = 1; $i <= $totalPages; $i++): ?>
                    <li class="page-item <?php if($i == $page){ echo 'active'; } ?>">
                        <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                    </li>
                <?php endfor; ?>
                
                <li class="page-item <?php if($page >= $totalPages){ echo 'disabled'; } ?>">
                    <a class="page-link" href="?page=<?php echo $page+1; ?>">></a>
                </li>
            </ul>
              <!--Page number End-->
            
             </div>
</body>

       
<script>
   $(document).ready(function() {
    // Handle search input
    $('#search-input').on('input', function() {
        let searchTerm = $(this).val();
        
        $.ajax({
            url: '../../function/php/search/search_patients.php', 
            type: 'GET',
            data: { search: searchTerm }, 
            success: function(response) {
                $('#patient-container').empty();
                $('#patient-container').html(response);

                initModals();
            },
            error: function(xhr, status, error) {
                console.log("Error: " + error);
            }
        });
    });

    function initModals() {
        $('#patient-container').on('click', '.view', function() {
            var patientId = $(this).data('bs-target');
            console.log('Opening modal for patient:', patientId);
            $(patientId).modal('show');
        });
    }

    initModals();
});


   
</script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" crossorigin="anonymous"> </script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="../../function/script/toggle-menu.js"></script>
<script src="../../function/script/drop-down.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</html>