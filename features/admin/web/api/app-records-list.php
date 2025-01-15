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

    $sql = "SELECT * FROM patients_records";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    
    // Fetching all records as an associative array
    $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
            
           
            <a href="app-records-list.php"  class="navbar-highlight">
                <i class="fa-regular fa-calendar-check"></i>
                <span>Record Lists</span>
            </a>
            <a href="pos.php">
                <i class="fas fa-cash-register"></i>
                <span>Point of Sales</span>
            </a>
<a href="reports.php">
            <i class="fa-solid fa-file-lines"></i>
                <span>Reports</span>
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
    <div class="d-flex justify-content-end w-100">
        <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#addRecordModal">Add Record</button>
    </div>
    <table class="table table-hover table-remove-borders">
    <thead class="thead-light">
            <tr>
                <th>ID</th>
                <th>Owner Name</th>
                <th>Email</th>
                <th>Contact Num</th>
                <th>Pet Name</th>
                <th>Pet type</th>
                <th>Sex</th>
                <th>Breed</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($patients as $patient): ?>
            <tr>
                <td><?php echo htmlspecialchars($patient['id']); ?></td>
                <td><?php echo htmlspecialchars($patient['ownerName']) . ' ' . htmlspecialchars($patient['ownerMiddleName']) . ' ' . htmlspecialchars($patient['ownerLastName']); ?></td>
                <td><?php echo htmlspecialchars($patient['ownerEmail']); ?></td>
                <td><?php echo htmlspecialchars($patient['mobile']); ?></td>
                <td><?php echo htmlspecialchars($patient['petName']); ?></td>
                <td><?php echo htmlspecialchars($patient['petType']); ?></td>
                <td><?php echo htmlspecialchars($patient['sex']); ?></td>
                <td><?php echo htmlspecialchars($patient['breed']); ?></td>
                <td class="d-flex gap-1">
                <button class="btn btn-info btn-sm text-white" data-bs-toggle="modal" data-bs-target="#seeMoreModal<?php echo $patient['id']; ?>">Full details</button>
                <button class="btn btn-success btn-sm text-white" data-bs-toggle="modal" data-bs-target="#updateRecordModal<?php echo $patient['id']; ?>">Edit</button>
               
                </td>
            </tr>

            <!-- Modal -->
            <div class="modal fade" id="seeMoreModal<?php echo $patient['id']; ?>" tabindex="-1" aria-labelledby="seeMoreModalLabel<?php echo $patient['id']; ?>" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="seeMoreModalLabel<?php echo $patient['id']; ?>">Details for <?php echo htmlspecialchars($patient['ownerName']); ?></h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                               <div class="row d-flex justify-content-center">
                                                     
                                    <div class="col-md-10">
                                        
                                    <h5 class="mt-4 text-center d-flex mx-auto justify-content-center">CLIENT INFORMATION</h5>
                                        <div class="owner-info">
                                            <div class="mb-3">
                                                <label for="ownerFirstName-<?php echo $patient['id']; ?>" class="form-label">Name</label>
                                                <input type="text" class="form-control" id="ownerFullName-<?php echo $patient['id']; ?>" value="<?php echo htmlspecialchars($patient['ownerName'] . ' ' . $patient['ownerMiddleName']); ?>" readonly>
                                            </div>
                                            <div class="mb-3">
                                                <label for="ownerFirstName-<?php echo $patient['id']; ?>" class="form-label">Last Name</label>
                                                <input type="text" class="form-control" id="ownerFullName-<?php echo $patient['id']; ?>" value="<?php echo htmlspecialchars($patient['ownerLastName']); ?>" readonly>
                                            </div>
                                            <div class="mb-3">
                                                <label for="address-<?php echo $patient['id']; ?>" class="form-label">Complete Address:</label>
                                                <input type="text" class="form-control" id="address-<?php echo $patient['id']; ?>" value="<?php echo htmlspecialchars($patient['ownerAddress']); ?>" readonly>
                                            </div>
                                            <div class="mb-3">
                                                <label for="contactNumber-<?php echo $patient['id']; ?>" class="form-label">Contact Number:</label>
                                                <input type="text" class="form-control" id="contactNumber-<?php echo $patient['id']; ?>" value="<?php echo htmlspecialchars($patient['mobile']); ?>" readonly>
                                            </div>
                                            <div class="mb-3">
                                                <label for="email-<?php echo $patient['id']; ?>" class="form-label">Email Address:</label>
                                                <input type="email" class="form-control" id="email-<?php echo $patient['id']; ?>" value="<?php echo htmlspecialchars($patient['ownerEmail']); ?>" readonly>
                                            </div> 
                                        </div>


                                        <h5 class="mt-4 text-center d-flex mx-auto justify-content-center">PET INFORMATION</h5>
                                        <div class="owner-info">
                                        <div class="mb-3">
                                            <label for="petName-<?php echo $patient['id']; ?>" class="form-label">Pet's Name:</label>
                                            <input type="text" class="form-control" id="petName-<?php echo $patient['id']; ?>" value="<?php echo htmlspecialchars($patient['petName']); ?>" readonly>
                                        </div>
                                        <div class="mb-3">
                                            <label for="species-<?php echo $patient['id']; ?>" class="form-label">Species:</label>
                                            <input type="text" class="form-control" id="species-<?php echo $patient['id']; ?>" value="<?php echo htmlspecialchars($patient['petType']); ?>" readonly>
                                        </div>
                                        <div class="mb-3">
                                            <label for="sex-<?php echo $patient['id']; ?>" class="form-label">Sex:</label>
                                            <input type="text" class="form-control" id="sex-<?php echo $patient['id']; ?>" value="<?php echo htmlspecialchars($patient['sex']); ?>" readonly>
                                        </div>
                                        <div class="mb-3">
                                            <label for="breed-<?php echo $patient['id']; ?>" class="form-label">Breed:</label>
                                            <input type="text" class="form-control" id="breed-<?php echo $patient['id']; ?>" value="<?php echo htmlspecialchars($patient['breed']); ?>" readonly>
                                        </div>
                                        <div class="mb-3">
                                            <label for="microchipNo-<?php echo $patient['id']; ?>" class="form-label">Microchip No:</label>
                                            <input type="text" class="form-control" id="microchipNo-<?php echo $patient['id']; ?>" value="<?php echo htmlspecialchars($patient['microchipNo']); ?>" readonly>
                                        </div>
                                        <div class="mb-3">
                                            <label for="colorMarkings-<?php echo $patient['id']; ?>" class="form-label">Color and Markings:</label>
                                            <input type="text" class="form-control" id="colorMarkings-<?php echo $patient['id']; ?>" value="<?php echo htmlspecialchars($patient['colorMarkings']); ?>" readonly>
                                        </div>
                                        <div class="mb-3">
                                            <label for="dob-<?php echo $patient['id']; ?>" class="form-label">Date of Birth:</label>
                                            <input type="date" class="form-control" id="dob-<?php echo $patient['id']; ?>" value="<?php echo htmlspecialchars($patient['dob']); ?>" readonly>
                                        </div>
                                        <div class="mb-3">
                                            <label for="age-<?php echo $patient['id']; ?>" class="form-label">Age:</label>
                                            <input type="number" class="form-control" id="age-<?php echo $patient['id']; ?>" value="<?php echo htmlspecialchars($patient['age']); ?>" readonly>
                                        </div> 
                                        </div>                                      
                                    </div>
                                    <div class="col-md-10">                                   
                                        <h5 class="text-center mt-4 d-flex mx-auto justify-content-center">MEDICAL HISTORY</h5>
                                        <div class="owner-info">
                                        <div class="mb-3">
                                            <label for="prevVetClinic-<?php echo $patient['id']; ?>" class="form-label">Previous Veterinarian/Clinic:</label>
                                            <input type="text" class="form-control" id="prevVetClinic-<?php echo $patient['id']; ?>" value="<?php echo htmlspecialchars($patient['previous_veteran']); ?>" readonly>
                                        </div>
                                        <div class="mb-3">
                                            <label for="healthInsurance-<?php echo $patient['id']; ?>" class="form-label">Pet Health Insurance:</label>
                                            <input type="text" class="form-control" id="healthInsurance-<?php echo $patient['id']; ?>" value="<?php echo htmlspecialchars($patient['health_insurance']); ?>" readonly>
                                        </div>
                                        <div class="mb-3">
                                            <label for="drugAllergies-<?php echo $patient['id']; ?>" class="form-label">Any known drug allergies:</label>
                                            <input type="text" class="form-control" id="drugAllergies-<?php echo $patient['id']; ?>" value="<?php echo htmlspecialchars($patient['drug_allergies']); ?>" readonly>
                                        </div>
                                        <div class="mb-3">
                                            <label for="priorIllnessSurgeries-<?php echo $patient['id']; ?>" class="form-label">Prior Illness(es)/Surgery(ies):</label>
                                            <input type="text" class="form-control" id="priorIllnessSurgeries-<?php echo $patient['id']; ?>" value="<?php echo htmlspecialchars($patient['illness_surgeries']); ?>" readonly>
                                        </div>
                                        <div class="mb-3">
                                            <label for="currentMedications-<?php echo $patient['id']; ?>" class="form-label">Current Medications:</label>
                                            <input type="text" class="form-control" id="currentMedications-<?php echo $patient['id']; ?>" value="<?php echo htmlspecialchars($patient['cur_medications']); ?>" readonly>
                                        </div>
                                        <div class="mb-3">
                                            <label for="dietRestrictions-<?php echo $patient['id']; ?>" class="form-label">Diet Restrictions/Supplements:</label>
                                            <input type="text" class="form-control" id="dietRestrictions-<?php echo $patient['id']; ?>" value="<?php echo htmlspecialchars($patient['diet_restrictions']); ?>" readonly>
                                        </div>
                                        <div class="mb-3">
                                            <label for="reasonInitialVisit-<?php echo $patient['id']; ?>" class="form-label">Reason for Initial Visit:</label>
                                            <input type="text" class="form-control" id="reasonInitialVisit-<?php echo $patient['id']; ?>" value="<?php echo htmlspecialchars($patient['initial_visits']); ?>" readonly>
                                        </div>
                                    </div>

                                    </div>
                                    <div class="col-md-10">
                                    <h5 class="text-center mt-4 d-flex mx-auto">OTHER INFORMATION</h5>
                                    <div class="owner-info">
                                        <div class="mb-3">
                                            <label for="dateToday-<?php echo $patient['id']; ?>" class="form-label">Date Today:</label>
                                            <input type="text" class="form-control" id="dateToday-<?php echo $patient['id']; ?>" value="<?php echo htmlspecialchars($patient['date_return']); ?>" readonly>
                                        </div>
                                        <div class="mb-3">
                                            <label for="vetName-<?php echo $patient['id']; ?>" class="form-label">Veterinarian’s Name:</label>
                                            <input type="text" class="form-control" id="vetName-<?php echo $patient['id']; ?>" value="<?php echo htmlspecialchars($patient['vet_name']); ?>" readonly>
                                        </div>
                                        <div class="mb-3">
                                            <label for="authorization-<?php echo $patient['id']; ?>" class="form-label">Authorization for Medical and/or Surgical Treatment (Yes/No):</label>
                                            <input type="text" class="form-control" id="authorization-<?php echo $patient['id']; ?>" value="<?php echo htmlspecialchars($patient['authorization']); ?>" readonly>
                                        </div>
                                        <div class="mb-3">
                                            <label for="vetReport-<?php echo $patient['id']; ?>" class="form-label">Veterinarian’s Report:</label>
                                            <textarea class="form-control" id="vetReport-<?php echo $patient['id']; ?>" rows="3" readonly><?php echo htmlspecialchars($patient['vet_report']); ?></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="historyPhysical<?php echo $patient['id']; ?>" class="form-label">History|Physical Findings|Diagnosis|Treatment|Service:</label>
                                            <textarea class="form-control" id="historyPhysical-<?php echo $patient['id']; ?>" rows="3" readonly><?php echo htmlspecialchars($patient['historyPhysical']); ?></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="returnVisitDate-<?php echo $patient['id']; ?>" class="form-label">Scheduled for a Return Visit on:</label>
                                            <input type="date" class="form-control" id="returnVisitDate-<?php echo $patient['id']; ?>" value="<?php echo htmlspecialchars($patient['date_return']); ?>" readonly>
                                        </div>
                                    </div>
                                        
                                    </div>

                            
                               </div>                            
                            </div>
                               

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Add Record Modal -->
<div class="modal fade" id="addRecordModal" tabindex="-1" aria-labelledby="addRecordModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="../../function/php/add_record.php" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title" id="addRecordModalLabel">Add New Record</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row d-flex justify-content-center">
                        <!-- Client Information -->
                        <div class="col-md-10">
                            <h5 class="text-center d-flex justify-content-center mx-auto">Client Information</h5>
                            <div class="owner-info">
                            <div class="mb-3">
                                <label for="ownerName" class="form-label">First Name*</label>
                                <input type="text" class="form-control" id="ownerName" name="ownerName" required>
                            </div>
                            <div class="mb-3">
                                <label for="ownerMiddleName" class="form-label">Middle Name</label>
                                <input type="text" class="form-control" id="ownerMiddleName" name="ownerMiddleName">
                            </div>
                            <div class="mb-3">
                                <label for="ownerLastName" class="form-label">Last Name*</label>
                                <input type="text" class="form-control" id="ownerLastName" name="ownerLastName" required>
                            </div>
                            <div class="mb-3">
                                <label for="ownerAddress" class="form-label">Address*</label>
                                <input type="text" class="form-control" id="ownerAddress" name="ownerAddress" required>
                            </div>
                            <div class="mb-3">
                                <label for="mobile" class="form-label">Mobile Number*</label>
                                <input type="number" class="form-control" id="mobile" name="mobile" required>
                            </div>
                            <div class="mb-3">
                                <label for="ownerEmail" class="form-label">Email*</label>
                                <input type="email" class="form-control" id="ownerEmail" name="ownerEmail" required>
                            </div>
                        </div>
                    </div>

                        <!-- Pet Information -->
                        <div class="col-md-10">
                            <h5 class="text-center mt-4 d-flex justify-content-center mx-auto">Pet Information</h5>
                            <div class="owner-info">
                            <div class="mb-3">
                                <label for="petName" class="form-label">Pet's Name*</label>
                                <input type="text" class="form-control" id="petName" name="petName" required>
                            </div>
                            <div class="mb-3">
                                <label for="petType" class="form-label">Species*</label>
                                <input type="text" class="form-control" id="petType" name="petType" required>
                            </div>
                            <div class="mb-3">
                                <label for="breed" class="form-label">Breed*</label>
                                <input type="text" class="form-control" id="breed" name="breed" required>
                            </div>
                            <div class="mb-3">
                                <label for="sex" class="form-label">Sex*</label>
                                <select class="form-select" id="sex" name="sex" required>
                                    <option value="" selected disabled>Choose...</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="microchipNo" class="form-label">Microchip No*</label>
                                <input type="number" class="form-control" id="microchipNo" name="microchipNo"  required>
                            </div>
                            <div class="mb-3">
                                <label for="colorMarkings" class="form-label">Color and Markings*</label>
                                <input type="text" class="form-control" id="colorMarkings" name="colorMarkings"  required>
                            </div>
                            <div class="mb-3">
                                <label for="dob" class="form-label">Date of Birth*</label>
                                <input type="date" class="form-control" id="dob" name="dob"  required>
                            </div>
                            <div class="mb-3">
                                <label for="age" class="form-label">Age*</label>
                                <input type="number" class="form-control" id="age" name="age"  required>
                            </div>
                        </div>
                    </div>

                    

                    <!-- Medical History -->
                     <div class="col-md-10">
                    <h5 class="text-center mt-4 d-flex justify-content-center mx-auto">Medical History</h5>
                    <div class="owner-info">
                    <div class="mb-3">
                        <label for="previous_veteran" class="form-label">Previous Veterinarian/Clinic</label>
                        <input type="text" class="form-control" id="previous_veteran" name="previous_veteran" >
                    </div>
                    <div class="mb-3">
                        <label for="health_insurance" class="form-label">Pet Health Insurance</label>
                        <input type="text" class="form-control" id="health_insurance" name="health_insurance">
                    </div>
                    <div class="mb-3">
                        <label for="drug_allergies" class="form-label">Drug Allergies</label>
                        <input type="text" class="form-control" id="drug_allergies" name="drug_allergies">
                    </div>
                    <div class="mb-3">
                        <label for="illness_surgeries" class="form-label">Illnesses/Surgeries</label>
                        <input type="text" class="form-control" id="illness_surgeries" name="illness_surgeries">
                    </div>
                    <div class="mb-3">
                        <label for="cur_medications" class="form-label">Current Medications</label>
                        <input type="text" class="form-control" id="cur_medications" name="cur_medications">
                    </div>
                    <div class="mb-3">
                        <label for="diet_restrictions" class="form-label">Diet Restrictions</label>
                        <input type="text" class="form-control" id="diet_restrictions" name="diet_restrictions">
                    </div>
                    <div class="mb-3">
                        <label for="initial_visits" class="form-label">Reason for Initial Visit</label>
                        <input type="text" class="form-control" id="initial_visits" name="initial_visits">
                    </div>
                </div>
            
                    

                    <!-- Other Information -->
                    <h5 class="text-center mt-4 d-flex justify-content-center mx-auto">Other Information</h5>
                    <div class="owner-info">
                    <div class="mb-3">
                        <label for="vet_name" class="form-label">Veterinarian’s Name*</label>
                        <input type="text" class="form-control" id="vet_name" name="vet_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="authorization" class="form-label">Authorization for Treatment (Yes/No)*</label>
                        <input type="text" class="form-control" id="authorization" name="authorization" required>
                    </div>
                    <div class="mb-3">
                        <label for="vet_report" class="form-label">Veterinarian’s Report*</label>
                        <textarea class="form-control" id="vet_report" name="vet_report" rows="3"  required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="historyPhysical" class="form-label">History|Physical Findings|Diagnosis*</label>
                        <textarea class="form-control" id="historyPhysical" name="historyPhysical" rows="3"  required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="date_return" class="form-label">Scheduled Return Date*</label>
                        <input type="date" class="form-control" id="date_return" name="date_return" required>
                    </div>
                </div>
            </div>
        
                <div class="modal-footer mt-4">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Record</button>
                </div>
            </form>
        </div>
    </div>
</div>


                <!-- Modal -->
                <?php foreach ($records as $record): ?>
                <div class="modal fade" id="updateRecordModal<?php echo $patient['id']; ?>" tabindex="-1" aria-labelledby="updateRecordModalLabel<?php echo $patient['id']; ?>" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <form action="../../function/php/update_record.php" method="POST">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="updateRecordModalLabel">Update Patient Record</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- CLIENT INFORMATION -->
                                        <h5>Client Information</h5>
                                        <div class="row">
                                            <div class="mb-3 col-md-6">
                                                <label for="ownerName" class="form-label">Owner Name</label>
                                                <input type="text" class="form-control" name="ownerName" id="ownerName" value="<?= $record['ownerName'] ?>" required>
                                            </div>

                                            <div class="mb-3 col-md-6">
                                                <label for="ownerMiddleName" class="form-label">Owner Middle Name</label>
                                                <input type="text" class="form-control" name="ownerMiddleName" id="ownerMiddleName" value="<?= $record['ownerMiddleName'] ?>" required>
                                            </div>

                                            <div class="mb-3 col-md-6">
                                                <label for="ownerLastName" class="form-label">Owner Last Name</label>
                                                <input type="text" class="form-control" name="ownerLastName" id="ownerLastName" value="<?= $record['ownerLastName'] ?>" required>
                                            </div>

                                            <div class="mb-3 col-md-6">
                                                <label for="ownerAddress" class="form-label">Complete Address</label>
                                                <input type="text" class="form-control" name="ownerAddress" id="ownerAddress" value="<?= $record['ownerAddress'] ?>" required>
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label for="mobile" class="form-label">Contact Number</label>
                                                <input type="number" class="form-control" name="mobile" id="mobile" value="<?= $record['mobile'] ?>" required>
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label for="ownerEmail" class="form-label">Email Address</label>
                                                <input type="email" class="form-control" name="ownerEmail" id="ownerEmail" value="<?= $record['ownerEmail'] ?>" required>
                                            </div>
                                        </div>

                                        <!-- PET INFORMATION -->
                                        <h5>Pet Information</h5>
                                        <div class="row">
                                            <div class="mb-3 col-md-6">
                                                <label for="petName" class="form-label">Pet's Name</label>
                                                <input type="text" class="form-control" name="petName" id="petName" value="<?= $record['petName'] ?>" required>
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label for="petType" class="form-label">Species</label>
                                                <input type="text" class="form-control" name="petType" id="petType" value="<?= $record['petType'] ?>" required>
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label for="breed" class="form-label">Breed</label>
                                                <input type="text" class="form-control" name="breed" id="breed" value="<?= $record['breed'] ?>">
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label for="sex" class="form-label">Sex</label>
                                                <select class="form-control" name="sex" id="sex" required>
                                                    <option value="Male" <?= $record['sex'] == 'Male' ? 'selected' : '' ?>>Male</option>
                                                    <option value="Female" <?= $record['sex'] == 'Female' ? 'selected' : '' ?>>Female</option>
                                                </select>
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label for="microchipNo" class="form-label">Microchip No</label>
                                                <input type="text" class="form-control" name="microchipNo" id="microchipNo" value="<?= $record['microchipNo'] ?>">
                                            </div>

                                            <div class="mb-3 col-md-6">
                                                <label for="colorMarkings" class="form-label">Color and Markings</label>
                                                <input type="text" class="form-control" name="colorMarkings" id="colorMarkings" value="<?= $record['colorMarkings'] ?>">
                                            </div>

                                            <div class="mb-3 col-md-6">
                                                <label for="dob" class="form-label">Date of Birth</label>
                                                <input type="date" class="form-control" name="dob" id="dob" value="<?= $record['dob'] ?>">
                                            </div>

                                            <div class="mb-3 col-md-6">
                                                <label for="age" class="form-label">Age</label>
                                                <input type="number" class="form-control" name="age" id="age" value="<?= $record['age'] ?>">
                                            </div>
                                        </div>

                                        <!-- MEDICAL HISTORY -->
                                        <h5>Medical History</h5>
                                        <div class="row">
                                            <div class="mb-3 col-md-6">
                                                <label for="previous_veteran" class="form-label">Previous Veterinarian/Clinic</label>
                                                <input type="text" class="form-control" name="previous_veteran" id="previous_veteran" value="<?= $record['previous_veteran'] ?>">
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label for="health_insurance" class="form-label">Pet Health Insurance</label>
                                                <input type="text" class="form-control" name="health_insurance" id="health_insurance" value="<?= $record['health_insurance'] ?>">
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label for="drug_allergies" class="form-label">Any Known Drug Allergies</label>
                                                <input type="text" class="form-control" name="drug_allergies" id="drug_allergies" value="<?= $record['drug_allergies'] ?>">
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label for="illness_surgeries" class="form-label">Prior Illness(es)/Surgery(ies)</label>
                                                <textarea class="form-control" name="illness_surgeries" id="illness_surgeries" rows="2"><?= $record['illness_surgeries'] ?></textarea>
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label for="cur_medications" class="form-label">Current Medications</label>
                                                <input type="text" class="form-control" name="cur_medications" id="cur_medications" value="<?= $record['cur_medications'] ?>">
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label for="diet_restrictions" class="form-label">Diet Restrictions/Supplements</label>
                                                <textarea class="form-control" name="diet_restrictions" id="diet_restrictions" rows="2"><?= $record['diet_restrictions'] ?></textarea>
                                            </div>

                                            <div class="mb-3 col-md-6">
                                                <label for="initial_visits" class="form-label">Reason for Initial Visit</label>
                                                <textarea class="form-control" name="initial_visits" id="initial_visits" rows="2"><?= $record['initial_visits'] ?></textarea>
                                            </div>
                                        </div>

                                        <!-- OTHER INFORMATION -->
                                        <h5>Other Information</h5>
                                        <div class="row">
                                            <div class="mb-3 col-md-6">
                                                <label for="vet_name" class="form-label">Veterinarian's Name</label>
                                                <input type="text" class="form-control" name="vet_name" id="vet_name" value="<?= $record['vet_name'] ?>">
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label for="authorization" class="form-label">Authorization for Treatment (Yes/No)</label>
                                                <select class="form-control" name="authorization" id="authorization" required>
                                                    <option value="Yes" <?= $record['authorization'] == 'Yes' ? 'selected' : '' ?>>Yes</option>
                                                    <option value="No" <?= $record['authorization'] == 'No' ? 'selected' : '' ?>>No</option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="vet_report" class="form-label">Veterinarian’s Report</label>
                                                <textarea class="form-control" name="vet_report" id="vet_report" rows="3"><?= $record['vet_report'] ?></textarea>
                                            </div>
                                            <div class="mb-3">
                                                <label for="historyPhysical" class="form-label">History|Physical Findings|Diagnosis|Treatment|Service:</label>
                                                <textarea class="form-control" name="historyPhysical" id="historyPhysical" rows="3"><?= $record['historyPhysical'] ?></textarea>
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label for="date_return" class="form-label">Scheduled for a Return Visit on</label>
                                                <input type="date" class="form-control" name="date_return" id="date_return" value="<?= $record['date_return'] ?>" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-success">Update Record</button>
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <?php endforeach; ?>


          

            
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