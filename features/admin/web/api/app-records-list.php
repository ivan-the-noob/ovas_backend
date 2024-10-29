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
        // Fetch the unread count
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
                  <button class="" type="button" id="notificationDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                      <i class="fas fa-bell"></i>
                      <?php if ($unread_count > 0): ?>
                          <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"><?php echo $unread_count; ?></span>
                      <?php endif; ?>
                  </button>
                  <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="notificationDropdown">
                      <li class="dropdown-header">
                          <h5 class=" mb-0">Notification</h5>
                      </li>
                      <?php if (!empty($notifications)): ?>
                          <?php foreach ($notifications as $notification): ?>
                              <li class="dropdown-item">
                                  <div class="alert alert-success mb-0">
                                      <strong>Added Successfully</strong>
                                      <p><?php echo htmlspecialchars($notification['message']); ?></p>
                                  </div>
                              </li>
                          <?php endforeach; ?>
                      <?php else: ?>
                          <li class="dropdown-item">
                              <div class="alert alert-info mb-0">
                                  <p>No notifications available.</p>
                              </div>
                          </li>
                      <?php endif; ?>
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
    <div class="row px-lg-5" id="patient-container">
        <?php foreach ($patients as $patient): ?>
        <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title text-center"><?php echo htmlspecialchars($patient['ownerName']); ?></h5>
                    <button type="button" class="btn btn-primary view" data-bs-toggle="modal" data-bs-target="#modal<?php echo $patient['id']; ?>">View</button>
                </div>
            </div>
        </div>

        <!-- Modal for each patient -->
        <div class="modal fade" id="modal<?php echo $patient['id']; ?>" tabindex="-1" aria-labelledby="modalLabel<?php echo $patient['id']; ?>" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header justify-content-between">
                <h5 class="modal-title" id="modalLabel<?php echo $patient['id']; ?>">Details for <?php echo htmlspecialchars($patient['ownerName']); ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="container p-4">
                <div class="row">
                    <!-- First Column -->
                    <div class="col-lg-3 col-md-6 mb-3">
                        <h6>Client Information</h6>
                        <p><strong>Name:</strong> 
                            <span class="text-view" id="ownerName-text-<?php echo $patient['id']; ?>"><?php echo htmlspecialchars($patient['ownerName']); ?></span>
                            <input type="text" class="form-control edit-view" id="ownerName-input-<?php echo $patient['id']; ?>" value="<?php echo htmlspecialchars($patient['ownerName']); ?>" style="display:none;">
                        </p>
                        <p><strong>Address:</strong> 
                            <span class="text-view" id="ownerAddress-text-<?php echo $patient['id']; ?>"><?php echo htmlspecialchars($patient['ownerAddress']); ?></span>
                            <input type="text" class="form-control edit-view" id="ownerAddress-input-<?php echo $patient['id']; ?>" value="<?php echo htmlspecialchars($patient['ownerAddress']); ?>" style="display:none;">
                        </p>
                        <p><strong>Contact:</strong></p>
                        <p><strong>Home:</strong> 
                            <span class="text-view" id="home-text-<?php echo $patient['id']; ?>"><?php echo htmlspecialchars($patient['home']); ?></span>
                            <input type="text" class="form-control edit-view" id="home-input-<?php echo $patient['id']; ?>" value="<?php echo htmlspecialchars($patient['home']); ?>" style="display:none;">
                        </p>
                        <p><strong>Work:</strong> 
                            <span class="text-view" id="work-text-<?php echo $patient['id']; ?>"><?php echo htmlspecialchars($patient['work']); ?></span>
                            <input type="text" class="form-control edit-view" id="work-input-<?php echo $patient['id']; ?>" value="<?php echo htmlspecialchars($patient['work']); ?>" style="display:none;">
                        </p>
                        <p><strong>Email:</strong> 
                            <span class="text-view" id="ownerEmail-text-<?php echo $patient['id']; ?>"><?php echo htmlspecialchars($patient['ownerEmail']); ?></span>
                            <input type="email" class="form-control edit-view" id="ownerEmail-input-<?php echo $patient['id']; ?>" value="<?php echo htmlspecialchars($patient['ownerEmail']); ?>" style="display:none;">
                        </p>
                        <p><strong>Preferred:</strong> 
                            <span class="text-view" id="preferredContact-text-<?php echo $patient['id']; ?>"><?php echo htmlspecialchars($patient['preferredContact']); ?></span>
                            <input type="text" class="form-control edit-view" id="preferredContact-input-<?php echo $patient['id']; ?>" value="<?php echo htmlspecialchars($patient['preferredContact']); ?>" style="display:none;">
                        </p>
                    </div>

                    <!-- Second Column -->
                    <div class="col-lg-3 col-md-6 mb-3">
                        <h6>Pet Information</h6>
                        <p><strong>Pet's Name:</strong> 
                            <span class="text-view" id="petName-text-<?php echo $patient['id']; ?>"><?php echo htmlspecialchars($patient['petName']); ?></span>
                            <input type="text" class="form-control edit-view" id="petName-input-<?php echo $patient['id']; ?>" value="<?php echo htmlspecialchars($patient['petName']); ?>" style="display:none;">
                        </p>
                        <p><strong>Species:</strong> 
                            <span class="text-view" id="petType-text-<?php echo $patient['id']; ?>"><?php echo htmlspecialchars($patient['petType']); ?></span>
                            <input type="text" class="form-control edit-view" id="petType-input-<?php echo $patient['id']; ?>" value="<?php echo htmlspecialchars($patient['petType']); ?>" style="display:none;">
                        </p>
                        <p><strong>Sex:</strong> 
                            <span class="text-view" id="sex-text-<?php echo $patient['id']; ?>"><?php echo htmlspecialchars($patient['sex']); ?></span>
                            <input type="text" class="form-control edit-view" id="sex-input-<?php echo $patient['id']; ?>" value="<?php echo htmlspecialchars($patient['sex']); ?>" style="display:none;">
                        </p>
                        <p><strong>Breed:</strong> 
                            <span class="text-view" id="breed-text-<?php echo $patient['id']; ?>"><?php echo htmlspecialchars($patient['breed']); ?></span>
                            <input type="text" class="form-control edit-view" id="breed-input-<?php echo $patient['id']; ?>" value="<?php echo htmlspecialchars($patient['breed']); ?>" style="display:none;">
                        </p>
                        <p><strong>Colors & Marking:</strong> 
                            <span class="text-view" id="colorMarkings-text-<?php echo $patient['id']; ?>"><?php echo htmlspecialchars($patient['colorMarkings']); ?></span>
                            <input type="text" class="form-control edit-view" id="colorMarkings-input-<?php echo $patient['id']; ?>" value="<?php echo htmlspecialchars($patient['colorMarkings']); ?>" style="display:none;">
                        </p>
                        <p><strong>Microchip No.:</strong> 
                            <span class="text-view" id="microchipNo-text-<?php echo $patient['id']; ?>"><?php echo htmlspecialchars($patient['microchipNo']); ?></span>
                            <input type="text" class="form-control edit-view" id="microchipNo-input-<?php echo $patient['id']; ?>" value="<?php echo htmlspecialchars($patient['microchipNo']); ?>" style="display:none;">
                        </p>
                        <p><strong>Date of Birth:</strong> 
                            <span class="text-view" id="dob-text-<?php echo $patient['id']; ?>"><?php echo htmlspecialchars($patient['dob']); ?></span>
                            <input type="date" class="form-control edit-view" id="dob-input-<?php echo $patient['id']; ?>" value="<?php echo htmlspecialchars($patient['dob']); ?>" style="display:none;">
                        </p>
                        <p><strong>Age:</strong> 
                            <span class="text-view" id="age-text-<?php echo $patient['id']; ?>"><?php echo htmlspecialchars($patient['age']); ?></span>
                            <input type="number" class="form-control edit-view" id="age-input-<?php echo $patient['id']; ?>" value="<?php echo htmlspecialchars($patient['age']); ?>" style="display:none;">
                        </p>
                    </div>

                    <!-- Third Column -->
                    <div class="col-lg-3 col-md-6 mb-3">
                        <h6>Services</h6>
                        <p><strong>Category:</strong> 
                            <span class="text-view" id="serviceCategory-text-<?php echo $patient['id']; ?>"><?php echo htmlspecialchars($patient['serviceCategory']); ?></span>
                            <input type="text" class="form-control edit-view" id="serviceCategory-input-<?php echo $patient['id']; ?>" value="<?php echo htmlspecialchars($patient['serviceCategory']); ?>" style="display:none;">
                        </p>
                        <p><strong>Services:</strong> 
                            <span class="text-view" id="service-text-<?php echo $patient['id']; ?>"><?php echo htmlspecialchars($patient['service']); ?></span>
                            <input type="text" class="form-control edit-view" id="service-input-<?php echo $patient['id']; ?>" value="<?php echo htmlspecialchars($patient['service']); ?>" style="display:none;">
                        </p>
                        <p><strong>Total Payment:</strong> 
                            <span class="text-view" id="totalPayment-text-<?php echo $patient['id']; ?>">₱<?php echo htmlspecialchars($patient['totalPayment']); ?></span>
                            <input type="text" class="form-control edit-view" id="totalPayment-input-<?php echo $patient['id']; ?>" value="<?php echo htmlspecialchars($patient['totalPayment']); ?>" style="display:none;">
                        </p>
                    </div>

                    <!-- Fourth Column -->
                    <div class="col-lg-3 col-md-6 mb-3">
                        <h6>Other Information</h6>
                        <p><strong>Date:</strong> 
                            <span class="text-view" id="date-text-<?php echo $patient['id']; ?>"><?php echo htmlspecialchars($patient['date']); ?></span>
                            <input type="date" class="form-control edit-view" id="date-input-<?php echo $patient['id']; ?>" value="<?php echo htmlspecialchars($patient['date']); ?>" style="display:none;">
                        </p>
                        <p><strong>Authorization for Treatment:</strong> 
                            <span class="text-view" id="authorization-text-<?php echo $patient['id']; ?>"><?php echo htmlspecialchars($patient['authorization']); ?></span>
                            <input type="text" class="form-control edit-view" id="authorization-input-<?php echo $patient['id']; ?>" value="<?php echo htmlspecialchars($patient['authorization']); ?>" style="display:none;">
                        </p>
                        <p><strong>Veterinarian's Report:</strong><br> 
                            <span class="text-view" id="enteringComplaint-text-<?php echo $patient['id']; ?>"><?php echo nl2br(htmlspecialchars($patient['enteringComplaint'])); ?></span>
                            <textarea class="form-control edit-view" id="enteringComplaint-input-<?php echo $patient['id']; ?>" style="display:none;"><?php echo htmlspecialchars($patient['enteringComplaint']); ?></textarea>
                        </p>
                        <p><strong>History • Physical Findings • Diagnosis • Treatment:</strong><br>
                            <span class="text-view" id="historyPhysical-text-<?php echo $patient['id']; ?>"><?php echo nl2br(htmlspecialchars($patient['historyPhysical'])); ?></span>
                            <textarea class="form-control edit-view" id="historyPhysical-input-<?php echo $patient['id']; ?>" style="display:none;"><?php echo htmlspecialchars($patient['historyPhysical']); ?></textarea>
                        </p>
                        <div class="mb-3">
                            <button class="btn toggle-edit-btn " data-patient-id="<?php echo $patient['id']; ?>">Update</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
        <?php endforeach; ?>

        <script>
    $(document).ready(function() {
    $('#patient-container').on('click', '.view', function() {
        var patientId = $(this).data('bs-target');  
        console.log('Opening modal for patient:', patientId);
        $(patientId).modal('show'); 
    });

    // Toggle edit mode logic
    $('#patient-container').on('click', '.toggle-edit-btn', function() {
        var id = $(this).data('patient-id');
        var isEditing = $(this).hasClass('editing');

        if (!isEditing) {
            console.log('CLICK UPDATE BUTTON: Switching to edit mode for patient ID ' + id);
            $('#modal' + id + ' .text-view').hide();
            $('#modal' + id + ' .edit-view').show();
            $(this).text('Save').addClass('editing');
        } else {
            console.log('CLICK SAVE BUTTON: Saving data for patient ID ' + id);

            var updatedData = {
                id: id,
                ownerName: $('#ownerName-input-' + id).val(),
                ownerAddress: $('#ownerAddress-input-' + id).val(),
                home: $('#home-input-' + id).val(),
                work: $('#work-input-' + id).val(),
                ownerEmail: $('#ownerEmail-input-' + id).val(),
                preferredContact: $('#preferredContact-input-' + id).val(),
                petName: $('#petName-input-' + id).val(),
                petType: $('#petType-input-' + id).val(),
                sex: $('#sex-input-' + id).val(),
                breed: $('#breed-input-' + id).val(),
                colorMarkings: $('#colorMarkings-input-' + id).val(),
                microchipNo: $('#microchipNo-input-' + id).val(),
                dob: $('#dob-input-' + id).val(),
                age: $('#age-input-' + id).val(),
                serviceCategory: $('#serviceCategory-input-' + id).val(),
                service: $('#service-input-' + id).val(),
                totalPayment: $('#totalPayment-input-' + id).val(),
                date: $('#date-input-' + id).val(),
                authorization: $('#authorization-input-' + id).val(),
                enteringComplaint: $('#enteringComplaint-input-' + id).val(),
                historyPhysical: $('#historyPhysical-input-' + id).val(),
            };

            console.log('UPDATE DATA:', updatedData);

            $.ajax({
                url: '../../function/php/update_patient.php',
                type: 'POST',
                data: updatedData,
                success: function(response) {
                    console.log('UPDATE TABLE DATA: Response received:', response);

                    $('#ownerName-text-' + id).text(updatedData.ownerName);
                    $('#ownerAddress-text-' + id).text(updatedData.ownerAddress);
                    $('#home-text-' + id).text(updatedData.home);
                    $('#work-text-' + id).text(updatedData.work);
                    $('#ownerEmail-text-' + id).text(updatedData.ownerEmail);
                    $('#preferredContact-text-' + id).text(updatedData.preferredContact);
                    $('#petName-text-' + id).text(updatedData.petName);
                    $('#petType-text-' + id).text(updatedData.petType);
                    $('#sex-text-' + id).text(updatedData.sex);
                    $('#breed-text-' + id).text(updatedData.breed);
                    $('#colorMarkings-text-' + id).text(updatedData.colorMarkings);
                    $('#microchipNo-text-' + id).text(updatedData.microchipNo);
                    $('#dob-text-' + id).text(updatedData.dob);
                    $('#age-text-' + id).text(updatedData.age);
                    $('#serviceCategory-text-' + id).text(updatedData.serviceCategory);
                    $('#service-text-' + id).text(updatedData.service);
                    $('#totalPayment-text-' + id).text(updatedData.totalPayment);
                    $('#date-text-' + id).text(updatedData.date);
                    $('#authorization-text-' + id).text(updatedData.authorization);
                    $('#enteringComplaint-text-' + id).text(updatedData.enteringComplaint);
                    $('#historyPhysical-text-' + id).text(updatedData.historyPhysical);

                    $('#modal' + id + ' .text-view').show();
                    $('#modal' + id + ' .edit-view').hide();
                    $('.toggle-edit-btn[data-patient-id="' + id + '"]').text('Update').removeClass('editing');
                },
                error: function(error) {
                    console.log('Error saving data:', error);
                }
            });
        }
    });
});


</script>


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

                // Reinitialize the modals after AJAX loads the content
                initModals(); // Call the function to initialize modals
            },
            error: function(xhr, status, error) {
                console.log("Error: " + error);
            }
        });
    });

    function initModals() {
        // Attach event handler for modal triggers
        $('#patient-container').on('click', '.view', function() {
            var patientId = $(this).data('bs-target');
            console.log('Opening modal for patient:', patientId);
            $(patientId).modal('show');
        });
    }

    // Initialize modals for the initially loaded content
    initModals();
});


   
</script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" crossorigin="anonymous">
</script>
<script src="../../function/script/toggle-menu.js"></script>
<script src="../../function/script/drop-down.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</html>