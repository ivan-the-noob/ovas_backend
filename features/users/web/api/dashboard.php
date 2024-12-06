<?php 
  session_start();
  if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'user') {
    header('Location: login.php'); 
    exit();
}
  $profilePicture = isset($_SESSION['profile_picture']) ? $_SESSION['profile_picture'] : 'assets/img/customer.jfif';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../../css/dashboard.css">

</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-light">
    <div class="container">
      <a class="navbar-brand d-none d-md-block" href="#">
        <img src="../../../../assets/img/logo.png" alt="Logo" width="30" height="30">
      </a>

      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
          style="stroke: black; fill: none;">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
        </svg>

      </button>

      <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="../../../../index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Profile</a>
          </li>
        </ul>

        <div class="d-flex ml-auto">
          <div class="dropdown">
              <button class=" dropdown-toggle d-flex align-items-center" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <img src="../../../../assets/img/profile/<?php echo htmlspecialchars($profilePicture, ENT_QUOTES, 'UTF-8'); ?>" alt="Profile" class="profile" alt="Profile Picture" id="profileImg">
              </button>
              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                  <a class="dropdown-item" href="#">Profile</a>
                  <a class="dropdown-item" href="logout.php">Logout</a>
              </div>
          </div>
        </div>
      </div>
    </div>
  </nav>
  <!--Dashboard Section-->

  <div class="container">
    <div class="row">   
       <div class="col-md-4">
  <form action="../../function/php/profile_update.php" method="POST" enctype="multipart/form-data">
    <div class="r mt-5">
        <h1 class="text-center mb-4">Profile</h1>
        <div class="row justify-content-center">
            <div class="col-12 col-md-6 text-center mb-4">
                <img src="../../../../assets/img/profile/<?php echo htmlspecialchars($profilePicture, ENT_QUOTES, 'UTF-8'); ?>" alt="Profile" class="rounded-circle" alt="Profile Picture" style="width: 150px; height: 150px; border: 2px solid #7A3015;" id="profileImg">
                <h4 class="mt-3">Racel</h4>
                <div class="mt-3">
                    <input type="file" class="form-control" name="profile_picture" id="changeProfile">
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-12 col-md-6">
                <div class="mb-3">
                    <label for="currentPassword" class="form-label">Current Password</label>
                    <input type="password" class="form-control" name="current_password" id="currentPassword" placeholder="Enter current password">
                </div>
                <div class="mb-4">
                    <label for="newPassword" class="form-label">New Password</label>
                    <input type="password" class="form-control" name="new_password" id="newPassword" placeholder="Enter new password">
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-12 col-md-6">
                <div class="dash-button">
                    <div class="col-12">
                        <button type="submit" class="save">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
</div>
<div class="col-md-8">
<section class="booked-history py-5" id="bookedHistorySection">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-12 col-24">
          <div class="card card-outline card-primary rounded-0 shadow">
            <div class="card-header rounded-0">
              <h4 class="card-title text-center">Booked History</h4>
            </div>
            <div class="tab-bar">
              <button id="currentBtn">Current Appointment</button>
              <button class="none"> |</button>
              <button id="pastBtn">Past Appointment</button>
            </div>
            <div class="card-body">
              <ul class="list-group" id="historyList">
              <?php 
                  try {
                    require '../../../../db.php';
          

                    if (isset($_SESSION['email'])) {
                      $sessionEmail = $_SESSION['email'];
              
                      $sql = "SELECT * FROM appointments WHERE email = :email AND status IN ('pending', 'confirm', 'complete')";
                      $stmt = $conn->prepare($sql);
                      
                      $stmt->bindParam(':email', $sessionEmail, PDO::PARAM_STR);
              
                      $stmt->execute();
              
                      if ($stmt->rowCount() > 0) {
                          while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                              $appointmentId = $row['id'];
                              $ownerName = $row['owner_name'];
                              $status = $row['status'];
                              $code = $row['code'];
                              $contact = $row['contact_number'];
                              $email = $row['email'];
                              $address = $row['address'];
                              $petType = $row['pet_type'];
                              $breed = $row['breed'];
                              $age = $row['age'];
                              $serviceCategory = $row['service_category'];
                              $serviceType = $row['service_type'];
                              $appointmentTime = $row['appointment_time'];
                              $appointmentDate = $row['appointment_date'];
                              $totalPayment = $row['total_payment'];
                              $paymentMethod = $row['payment_method'];
                              $gcashScreenshot = $row['gcash_screenshot'];
                              $reference = $row['reference'];
                              $statusClass = '';
                              if ($status === 'confirm') {
                                  $statusClass = 'bg-success';
                              } elseif ($status === 'complete') {
                                  $statusClass = 'bg-success'; 
                              } elseif ($status === 'pending') {
                                  $statusClass = 'bg-primary text-white'; 
                              }
              
                              echo '<li class="list-group-item current-appointment">
                              <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center">
                                <div>
                                 <p class="mb-1 status ' . htmlspecialchars($statusClass) . '">' . ($status === 'confirm' ? 'Confirmed' : htmlspecialchars($status)) . '</p>
                                  <p class="mb-1">Service: ' . htmlspecialchars($serviceType) . '</p>
                                  <p class="mb-1">Pet: ' . htmlspecialchars($petType) . ', ' . htmlspecialchars($age) . ' Yr(s) Old</p>
                                  <p>Owner: ' . htmlspecialchars($ownerName) . '</p>
                                </div>
                                <div class="mt-3 mt-md-0 text-md-right">
                                  <p class="mb-1">Code: ' . htmlspecialchars($code) . '</p>
                                  <p class="mb-1">Date: ' . htmlspecialchars($appointmentDate) . '</p>
                                  <p class="mb-1">Time: ' . htmlspecialchars($appointmentTime) . '</p>
                                  <div class="d-flex gap-1">
                                  <button class="btn btn-info" data-toggle="modal" data-target="#modal' . $appointmentId . '">View Info</button>';
                    
                                  if ($status === 'pending') {
                                      echo '<button class="btn btn-danger" data-toggle="modal" data-target="#deleteModal' . $appointmentId . '">Cancel</button>';
                                  }
                                  
                                  echo '    </div>
                                            </div>
                                            </div>
                                        </li>';
                    
              
                              echo '<div class="modal fade" id="modal' . $appointmentId . '" tabindex="-1" role="dialog" aria-labelledby="modalLabel' . $appointmentId . '" aria-hidden="true">
                                      <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                          <div class="modal-header d-flex justify-content-between">
                                            <h5 class="modal-title" id="modalLabel' . $appointmentId . '">Appointment Details</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                              <span aria-hidden="true">&times;</span>
                                            </button>
                                          </div>
                                          <div class="modal-body">
                                            <h5>Appointment Details</h5>
                                            <p>Name: ' . htmlspecialchars($ownerName) . '</p>
                                            <p>Contact: ' . htmlspecialchars($contact) . '</p>
                                            <p>Email: ' . htmlspecialchars($email) . '</p>
                                            <p>Address: ' . htmlspecialchars($address) . '</p>
                                            <h5>Pet Information</h5>
                                            <p>Pet Type: ' . htmlspecialchars($petType) . '</p>
                                            <p>Breed: ' . htmlspecialchars($breed) . '</p>
                                            <p>Age: ' . htmlspecialchars($age) . ' months</p>
                                            <h5>Services</h5>
                                            <p>Service Category: ' . htmlspecialchars($serviceCategory) . '</p>
                                            <p>Service: ' . htmlspecialchars($serviceType) . '</p>
                                            <h5>Payment Details</h5>
                                            <p>Total Payment: ₱' . htmlspecialchars($totalPayment) . '</p>
                                            <p>Payment Method: ' . htmlspecialchars($paymentMethod) . '</p>
                                            <p>GCash Screenshot: <a href="' . htmlspecialchars($gcashScreenshot) . '" target="_blank">View Screenshot</a></p>
                                            <p>Reference: ' . htmlspecialchars($reference) . '</p>
                                          </div>
                                          <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                          </div>
                                        </div>
                                      </div>
                                    </div>';
              
                              // Confirmation delete modal
                              echo '<div class="modal fade" id="deleteModal' . $appointmentId . '" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel' . $appointmentId . '" aria-hidden="true">
                                      <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                          <div class="modal-header d-flex justify-content-between">
                                            <h5 class="modal-title" id="deleteModalLabel' . $appointmentId . '">Delete Appointment</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                              <span aria-hidden="true">&times;</span>
                                            </button>
                                          </div>
                                          <div class="modal-body">
                                            <p>Are you sure you want to cancel this appointment?</p>
                                          </div>
                                          <div class="modal-footer">
                                            <!-- Delete button triggers PHP script to delete the appointment -->
                                            <form action="../../function/php/delete_appointment.php" method="POST">
                                            
                                              <input type="hidden" name="id" value="' . $appointmentId . '">
                                              <button type="submit" class="btn btn-danger">Yes, Delete</button>
                                              <button type="button" class="btn btn-secondary" data-dismiss="modal">No, Keep</button>
                                            </form>
                                          </div>
                                        </div>
                                      </div>
                                    </div>';
                          }
                      } else {
                          echo "Empty Appointments.";
                      }
                  } else {
                      echo "No email found in session.";
                  }
              
              } catch (PDOException $e) {
                  echo "Error: " . $e->getMessage();
              }
              
              $conn = null;
                ?>

                
<?php 
                  try {
                    require '../../../../db.php';
          

                    if (isset($_SESSION['email'])) {
                      $sessionEmail = $_SESSION['email'];
              
                      $sql = "SELECT * FROM appointments WHERE email = :email AND status IN ('decline')";
                      $stmt = $conn->prepare($sql);
                      
                      $stmt->bindParam(':email', $sessionEmail, PDO::PARAM_STR);
              
                      $stmt->execute();
              
                      if ($stmt->rowCount() > 0) {
                          while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                              $appointmentId = $row['id'];
                              $ownerName = $row['owner_name'];
                              $status = $row['status'];
                              $code = $row['code'];
                              $contact = $row['contact_number'];
                              $email = $row['email'];
                              $address = $row['address'];
                              $petType = $row['pet_type'];
                              $breed = $row['breed'];
                              $age = $row['age'];
                              $serviceCategory = $row['service_category'];
                              $serviceType = $row['service_type'];
                              $appointmentTime = $row['appointment_time'];
                              $appointmentDate = $row['appointment_date'];
                              $totalPayment = $row['total_payment'];
                              $paymentMethod = $row['payment_method'];
                              $gcashScreenshot = $row['gcash_screenshot'];
                              $reference = $row['reference'];
                              $reason = $row['decline_reason'];
                              $statusClass = '';
                              if ($status === 'confirm') {
                                  $statusClass = 'bg-success';
                              } elseif ($status === 'complete') {
                                  $statusClass = 'bg-success'; 
                              } elseif ($status === 'pending') {
                                  $statusClass = 'bg-primary text-white'; 
                              }elseif($status === 'decline'){
                                  $statusClass = 'bg-danger text-white';
                              }
              
                              echo '<li class="list-group-item past-appointment">
                              <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center">
                                <div>
                                  <p class="mb-1 status ' . htmlspecialchars($statusClass) . '">' . htmlspecialchars($status) . '</p>
                                  <p class="mb-1">Service: ' . htmlspecialchars($serviceType) . '</p>
                                  <p class="mb-1">Pet: ' . htmlspecialchars($petType) . ', ' . htmlspecialchars($age) . ' Yr(s) Old</p>
                                  <p>Owner: ' . htmlspecialchars($ownerName) . '</p>
                                </div>
                                <div class="mt-3 mt-md-0 text-md-right">
                                  <p class="mb-1">Code: ' . htmlspecialchars($code) . '</p>
                                  <p class="mb-1">Date: ' . htmlspecialchars($appointmentDate) . '</p>
                                  <p class="mb-1">Time: ' . htmlspecialchars($appointmentTime) . '</p>';
                      
                      if ($status === 'decline') {
                        echo '<p class="mb-1 reason">Reason: ' . htmlspecialchars($reason) . '</p>';
                      }
                      
                      echo '  <button class="btn btn-primary" data-toggle="modal" data-target="#modal' . $appointmentId . '">View Info</button>
                                </div>
                              </div>
                            </li>';
                      
              
                              echo '<div class="modal fade" id="modal' . $appointmentId . '" tabindex="-1" role="dialog" aria-labelledby="modalLabel' . $appointmentId . '" aria-hidden="true">
                                      <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                          <div class="modal-header d-flex justify-content-between">
                                            <h5 class="modal-title" id="modalLabel' . $appointmentId . '">Appointment Details</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                              <span aria-hidden="true">&times;</span>
                                            </button>
                                          </div>
                                          <div class="modal-body">
                                            <h5>Appointment Details</h5>
                                            <p>Name: ' . htmlspecialchars($ownerName) . '</p>
                                            <p>Contact: ' . htmlspecialchars($contact) . '</p>
                                            <p>Email: ' . htmlspecialchars($email) . '</p>
                                            <p>Address: ' . htmlspecialchars($address) . '</p>
                                            <h5>Pet Information</h5>
                                            <p>Pet Type: ' . htmlspecialchars($petType) . '</p>
                                            <p>Breed: ' . htmlspecialchars($breed) . '</p>
                                            <p>Age: ' . htmlspecialchars($age) . ' months</p>
                                            <h5>Services</h5>
                                            <p>Service Category: ' . htmlspecialchars($serviceCategory) . '</p>
                                            <p>Service: ' . htmlspecialchars($serviceType) . '</p>
                                            <h5>Payment Details</h5>
                                            <p>Total Payment: ₱' . htmlspecialchars($totalPayment) . '</p>
                                            <p>Payment Method: ' . htmlspecialchars($paymentMethod) . '</p>
                                            <p>GCash Screenshot: <a href="' . htmlspecialchars($gcashScreenshot) . '" target="_blank">View Screenshot</a></p>
                                            <p>Reference: ' . htmlspecialchars($reference) . '</p>
                                          </div>
                                          <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                          </div>
                                        </div>
                                      </div>
                                    </div>';         
                          }
                      } else {
                       
                      }
                  } else {
                      echo "No email found in session.";
                  }
              
              } catch (PDOException $e) {
                  echo "Error: " . $e->getMessage();
              }
              
              $conn = null;
                ?>
                
              </ul>
             
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
</div>
</div>

  <!--Dashboard Section End-->
</body>
<script src="../../function/script/chatbot-toggle.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="../../function/script/tab-bar.js"></script>

</html>