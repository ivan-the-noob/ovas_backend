<?php
session_start();
require '../../../../db.php';
$profilePicture = isset($_SESSION['profile_picture']) ? $_SESSION['profile_picture'] : 'assets/img/customer.jfif';

$user_email = $_SESSION['email'] ?? '';
$name = $_SESSION['name'] ?? '';
$address = $_SESSION['address'] ?? '';
$contactnum = $_SESSION['contact_num'] ?? '';


$stmt = $conn->prepare("SELECT COUNT(*) AS unread_count FROM notifications WHERE email = :email AND is_read = 0");
$stmt->bindParam(':email', $user_email);
$stmt->execute();
$unread_notification = $stmt->fetch(PDO::FETCH_ASSOC);

$stmt2 = $conn->prepare("SELECT * FROM notifications WHERE email = :email ORDER BY created_at DESC");
$stmt2->bindParam(':email', $user_email);
$stmt2->execute();
$notifications = $stmt2->fetchAll(PDO::FETCH_ASSOC);

try {
  $sql = "SELECT category_name FROM categories";
  $stmt = $conn->query($sql);

  $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
  echo "Error: " . $e->getMessage();
}
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
  <link rel="stylesheet" href="../../css/appointment.css">
  <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css" rel="stylesheet">



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
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7">
          </path>
        </svg>

      </button>

      <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="../../../../index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Appointment</a>
          </li>
        </ul>

        <div class="d-flex ml-auto align-items-center">
          <?php if (isset($_SESSION['email'])): ?>
            <div class="dropdown first-dropdown">
              <button type="button" id="dropdownMenuButton1" data-toggle="dropdown" aria-haspopup="true"
                aria-expanded="false">
                <i class="fas fa-bell"></i>
              </button>
              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                <h5 class="notification-title">Notification</h5>
                <div class="notification-content alert alert-success">
                  <strong>Appointment Confirmed!</strong>
                  <p class="notification-text">Your appointment has been confirmed!</p>
                  <p class="code">Code: OVAS-01234</p>
                  <a href="/features/users/web/api/appointment.html"
                    onclick="localStorage.setItem('showBookedHistory', 'true');">View Details</a>
                </div>
                <div class="notification-content alert-primary">
                  <strong>Successfully Booked!</strong>
                  <p class="notification-text">You successfully booked!</p>
                </div>
                <div class="notification-content alert-danger">
                  <strong>Rejected</strong>
                  <p class="notification-text">Your appointment has been rejected.</p>
                </div>
              </div>
            </div>


            <div class="dropdown second-dropdown">
              <button class="dropdown-toggle" type="button" id="dropdownMenuButton2" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <img src="../../../../assets/img/profile/<?php echo $profilePicture; ?>" alt="Profile"
                  class="profile">
              </button>
              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                <a class="dropdown-item" href="dashboard.php">Profile</a>
                <a class="dropdown-item" href="logout.php">Logout</a>
              </div>
            </div>
          <?php else: ?>

            <div class="d-flex ml-auto">
              <a href="../../../../features/users/web/api/login.php" class="btn-theme" type="button">Login</a>
            </div>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </nav>

  <div class="modal fade" id="appointmentModal" tabindex="-1" aria-labelledby="appointmentModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header d-flex justify-content-between guidelines">
                    <h5 class="modal-title" id="appointmentModalLabel">Appointment Guidelines</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body guidelines">
                    <p>Dear Valued Clients,</p>
                    <p>Please be informed of the following guidelines when booking an appointment for your pet:</p>
                    <ol>
                        <li class="mt-4">
                            <strong>Booking Period:</strong>
                            <ul>
                                <li>You can only book an appointment for today or within the next 14 days (2 weeks) from the current date.</li>
                            </ul>
                        </li>
                        <li class="mt-4">
                            <strong>Downpayment Requirement:</strong>
                            <ul>
                                <li>A ₱250.00 downpayment is required to confirm your booking. This amount will be deducted from your total bill during your visit to the clinic.</li>
                            </ul>
                        </li>
                    </ol>
                    <p>We appreciate your understanding and cooperation to help us serve you and your pets better. Thank you!</p>
                    <div class="end-letter mt-4">
                      <div class="div">
                        <p class="mb-0 mt-0 d-flex">Sincerely,</p>
                      </div>
                      <div class="div">
                        <p class="mt-0 d-flex mt-0 mb-0">Bark Yard Pet Wellness Center</p>
                      </div>
                    </div>
                </div>
              
            </div>
        </div>
    </div>

    


  <section class="appointment">
    <div class="content py-5 date">

      <div class="col-md-10 app">
        <div class="appoints">
          <button>Appointment Availability</button>
          <button class="appoint" id="toggleViewBtn">My Appointment</button>
        </div>
        <form method="POST" action="../../function/php/appointment.php" enctype="multipart/form-data">
      
          <div class="card card-outline card-primary rounded-0 shadow" id="appointmentSection">
            <div class="card-body">
              <div class="row">
                <div class="col-md-3 mt-2 p_date pt-lg-100">
                  <p class="mb-0"><?php echo date('l'); ?></p>
                  <p><?php echo date('F j'); ?></p>
                  <div class="card legend">
                    <div class="card-body">
                      <div class=" d-flex gap-1 available">
                        <div class="available-color"></div>
                        <span class="p-avail">Available</span>
                      </div>
                      <div class=" d-flex gap-1 unavailable">
                        <div class="unavailable-color"></div>
                        <span class="p-avail">Fully Booked</span>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-9">
                  <div class="calendar-container">
                    <div id="appointmentCalendar">
                    </div>
                  </div>
                </div>

              </div>
            </div>
          </div>
      </div>
    </div>
    </div>
    </div>

    <div class="modal fade" id="dayModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel"
      aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-xl custom-modal" id="info" role="document">
        <div class="modal-content guidelines">
        <div class="modal-header d-flex justify-content-between align-items-center">
    <h5 class="modal-title" id="modalLabel">Book Your Desired Schedule</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="w-50 desired-time">
    <label for="Time" class="form-label">Choose Desired Time</label>
    <div class="choose-time-div">
        <button type="button" class="choose-time" onclick="selectTime(this, '09:00')">9 AM</button>
        <button type="button" class="choose-time" onclick="selectTime(this, '10:00')">10 AM</button>
        <button type="button" class="choose-time" onclick="selectTime(this, '11:00')">11 AM</button>
        <button type="button" class="choose-time" onclick="selectTime(this, '12:00')">12 PM</button>
        <button type="button" class="choose-time" onclick="selectTime(this, '13:00')">1 PM</button>
        <button type="button" class="choose-time" onclick="selectTime(this, '14:00')">2 PM</button>
        <button type="button" class="choose-time" onclick="selectTime(this, '15:00')">3 PM</button>
        <button type="button" class="choose-time" onclick="selectTime(this, '16:00')">4 PM</button>
        <button type="button" class="choose-time" onclick="selectTime(this, '17:00')">5 PM</button>
    </div>
    <input type="hidden" id="selectedTime" name="appointmentTime">
    <input type="hidden" id="appointmentDate" name="appointmentDate">
</div>

          <div class="modal-body">
            <div class="sched row">
              <div class="col-md-6">
              <label for="Appointment Schedule" class="form-label">Appointment Schedule</label>
                <div id="modalContent" class="col-6"></div>
                <input type="hidden" id="appointmentDateModal" name="appointment_date">
              </div>

              <div class="line w-100"></div>
            </div>

            <!-- Start of form -->

            <div class="container">
              <div class="row" style="padding: 20px;">
                <div class="col-md-6">
                  <h6 class="d-flex mx-auto">Owner Information</h6>
                  <div class="owner-info">
                    <div class="mb-3 position-relative">
                      <div class="position-relative">
                        <span class="input-label">Name: </span>
                        <input type="text" class="form-control" id="ownerName" name="ownerName"
                          style="padding-left: 60px;" value="<?php echo htmlspecialchars($name);?>"readonly>
                      </div>
                    </div>

                    <div class="mb-3 position-relative">
                      <div class="position-relative">
                        <span class="input-label">Contact: </span>
                        <input type="text" class="form-control" id="contactNum"
                          name="contactNum" style="padding-left: 80px;" value="<?php echo htmlspecialchars($contactnum);?>" readonly>
                      </div>
                    </div>
                    

                    <div class="mb-3 position-relative">
                      <div class="position-relative">
                        <span class="input-label">Email: </span>
                        <input type="email" class="form-control" id="ownerEmail" name="ownerEmail" 
                        value="<?php echo htmlspecialchars($user_email); ?>" 
                        style="padding-left: 60px;"  readonly>
                      </div>
                    </div>

                    <div class="mb-3 position-relative">
                      <div class="position-relative">
                        <span class="input-label">Address: </span>
                        <input class="form-control" id="ownerAddress" name="ownerAddress"
                          style="padding-left: 80px;" value="<?php echo htmlspecialchars($address);?>"readonly>
                      </div>
                    </div>
                  </div>
                  <h6 class="mt-4 d-flex mx-auto">Pet Information</h6>
                  <div class="owner-info">
                    <div class="mb-3 position-relative">
                      <div class="position-relative">
                        <span class="input-label">Pet Type:</span>
                        <select class="form-control" id="petType" name="petType"
                          style="padding-left: 80px;">
                          <?php if (!empty($categories)): ?>
                            <?php foreach ($categories as $category): ?>
                              <option
                                value="<?php echo htmlspecialchars($category['category_name']); ?>">
                                <?php echo htmlspecialchars($category['category_name']); ?>
                              </option>
                            <?php endforeach; ?>
                          <?php else: ?>
                            <option value="">No categories available</option>
                          <?php endif; ?>
                        </select>
                      </div>
                    </div>

                    <div class="mb-3 position-relative">
                      <div class="position-relative">
                        <span class="input-label">Breed:</span>
                        <input type="text" class="form-control" id="breed" name="breed"
                          style="padding-left: 60px;" required>
                      </div>
                    </div>
                    <div class="mb-3 position-relative">
                      <div class="position-relative">
                        <span class="input-label">Age:</span>
                        <input type="number" class="form-control" id="age" name="age"
                          style="padding-left: 60px;" required>
                      </div>
                    </div>
                  </div>

                </div>

                <!-- Pet Information -->

                <!-- Services -->
                <div class="col-md-6">
                  <h6 class="d-flex mx-auto">Services</h6>
                  <div class="owner-info">
                    <div class="mb-3">
                      <label for="serviceCategory" class="form-label">Service Category</label>
                      <div class="dropdowns">
                        <button class="dropdown-toggle" type="button"
                          id="serviceCategoryDropdown" data-toggle="dropdown"
                          aria-haspopup="true" aria-expanded="false">
                          Select Category
                        </button>
                        <div class="dropdown-menu" aria-labelledby="serviceCategoryDropdown">
                          <a class="dropdown-item" href="#" data-value="medical">Medical</a>
                          <a class="dropdown-item" href="#"
                            data-value="nonMedical">Non-Medical</a>
                        </div>
                      </div>
                      <input type="hidden" name="serviceCategory" id="selectedServiceCategory">
                    </div>

                    <div class="mb-3">
                      <label for="service" class="form-label">Service</label>
                      <div class="dropdowns">
                        <button class="dropdown-toggle" type="button" id="serviceDropdown"
                          data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          Select Service
                        </button>
                        <div class="dropdown-menu" aria-labelledby="serviceDropdown">
                          <!-- Medical Services -->
                          <div class="medical-services">
                            <a class="dropdown-item" href="#" data-value="1200.00"
                              data-service="Diagnostic and Therapeutic">Diagnostic and
                              Therapeutic - ₱1200.00</a>
                            <a class="dropdown-item" href="#" data-value="850.00"
                              data-service="Preventive Health Care">Preventive Health
                              Care - ₱850.00</a>
                          </div>
                          <!-- Non-Medical Services -->
                          <div class="nonMedical-services">
                            <a class="dropdown-item" href="#" data-value="999.00"
                              data-service="Grooming">Grooming - ₱999.00</a>
                            <a class="dropdown-item" href="#" data-value="700.00"
                              data-service="Boarding">Boarding - ₱700.00</a>
                          </div>
                        </div>
                      </div>
                      <input type="hidden" name="selectedService" id="selectedService">
                      <input type="hidden" name="servicePrice" id="servicePrice">
                    </div>

                    <div class="mt-3">
                      <label for="totalPayment" class="form-label">Total Payment</label>
                      <p id="totalPayment">₱0.00</p>
                    </div>

                    <!-- Time Selection -->
                   

                    <div class="mt-3">
                      <label for="pay-via" class="form-label">Pay Via</label>
                      <div class="d-flex justify-content-start pay-btn">
                        <button id="gcash-btn" class="btn" type="button"
                          onclick="selectPayment('gcash', this)">Gcash</button>
                       
                      </div>
                    </div>
                    <input type="hidden" id="payment_method" name="payment_method" value="" required>
                   

                    <div id="gcash-details" class="mt-3" style="display: none;">
                      <div class="gcash">
                        <img src="../../../../assets/img/gcash/gcash.jpg">
                      </div>
                      <label for="gcash-screenshot" class="form-label">Upload
                        screenshot</label>
                      <input type="file" id="gcash-screenshot" name="gcash-ss" accept="image/*"
                        class="form-control" required>
                      <div class="position-relative mt-2">
                        <span class="input-label">Ref #:</span>
                        <input type="number" name="reference" class="form-control"
                          style="padding-left: 80px;">
                      </div>
                    </div>
                  </div>
                  <div class="mt-3">
                    <button type="submit" class="book-save">Book Appointment</button>
                  </div>
                </div>
              </div>
            </div>
          </div>


        </div>
      </div>
    </div>
    </div>
  </section>
  </form>

  <!--Appointment Section End-->

  <!--Book-History Section-->
  <section class="booked-history py-5" id="bookedHistorySection" style="display: none;">
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
                                            <p class="mb-1 status ' . htmlspecialchars($statusClass) . '">' . htmlspecialchars($status) . '</p>
                                            <p class="mb-1">Service: ' . htmlspecialchars($serviceType) . '</p>
                                            <p class="mb-1">Pet: ' . htmlspecialchars($petType) . ', ' . htmlspecialchars($age) . ' Yr(s) Old</p>
                                            <p>Owner: ' . htmlspecialchars($ownerName) . '</p>
                                          </div>
                                          <div class="mt-3 mt-md-0 text-md-right">
                                            <p class="mb-1">Code: ' . htmlspecialchars($code) . '</p>
                                            <p class="mb-1">Date: ' . htmlspecialchars($appointmentDate) . '</p>
                                            <p class="mb-1">Time: ' . htmlspecialchars($appointmentTime) . '</p>  
                                            <button class="btn btn-primary" data-toggle="modal" data-target="#modal' . $appointmentId . '">View Info</button>
                                            <button class="btn btn-danger" data-toggle="modal" data-target="#deleteModal' . $appointmentId . '">Cancel</button>
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
                          echo "No appointments found for this user or with the selected status.";
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
                                            <p class="mb-1">Time: ' . htmlspecialchars($appointmentTime) . '</p>
                                            <button class="btn btn-primary" data-toggle="modal" data-target="#modal' . $appointmentId . '">View Info</button>
                                           
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
              <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center mt-3" id="paginationControls">
                  <li class="page-item"><a class="page-link" href="#" data-page="1">1</a></li>
                  <li class="page-item"><a class="page-link" href="#" data-page="2">2</a></li>
                </ul>
              </nav>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--Book-History Section End-->

  <!--Chat Bot-->
  <button id="chat-bot-button" onclick="toggleChat()">
    <i class="fa-solid fa-headset"></i>
  </button>

  <div id="chat-interface" class="hidden">
    <div id="chat-header">
      <p>Amazing Day! How may I help you?</p>
      <button onclick="toggleChat()">X</button>
    </div>
    <div id="chat-body">
      <div class="button-bot">
        <?php
        include '../../../../db.php';

        try {
          $sql = "SELECT question FROM chat_messages";
          $stmt = $conn->prepare($sql);
          $stmt->execute();

          if ($stmt->rowCount() > 0) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
              $question = htmlspecialchars($row['question'], ENT_QUOTES, 'UTF-8');
              echo "<button onclick=\"sendResponse('$question')\">$question</button>";
            }
          } else {
            echo "<p>No questions available.</p>";
          }
        } catch (PDOException $e) {
          echo "Error: " . $e->getMessage();
        }
        ?>

      </div>
      <div class="line"></div>

      <div class="admin mt-3">
        <div class="admin-chat">
          <img src="../../../../assets/img/logo.png" alt="Admin">
          <p>Admin</p>
        </div>
        <p class="text" id="typing-text">Hello, I am Chat Bot. Please ask me a question by pressing the question
          buttons.</p>
      </div>

    </div>
  </div>
</body>

<script>
  document.getElementById('dropdownMenuButton1').addEventListener('click', function() {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "../../function/php/appointment-notif.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send();

    var notificationBadge = document.querySelector('.badge-danger');
    if (notificationBadge) {
      notificationBadge.textContent = '';
      notificationBadge.style.display = 'none';
    }
  });
</script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var appointmentModal = new bootstrap.Modal(document.getElementById('appointmentModal'));
            appointmentModal.show();
        });
    </script>



<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>

<script src="../../function/script/pagination-history.js"></script>
<script src="../../function/script/chat-bot-app.js"></script>
<script src="../../function/script/calendar.js"></script>
<script src="../../function/script/toggle-appointment.js"></script>
<script src="../../function/script/tab-bar.js"></script>
<script src="../../function/script/payment.js"></script>
<script src="../../function/script/service-dropdown1.js"></script>
<script src="../../function/script/service-dropdown.js"></script>
<script src="../../function/script/chatbot-toggle.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>


</html>