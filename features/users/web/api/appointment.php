<?php
session_start();
require '../../../../db.php'; 
$profilePicture = isset($_SESSION['profile_picture']) ? $_SESSION['profile_picture'] : 'assets/img/customer.jfif';

// Assuming you have the user's email stored in the session
$user_email = $_SESSION['email'] ?? '';

// Fetch count of unread notifications for the badge
$stmt = $conn->prepare("SELECT COUNT(*) AS unread_count FROM notifications WHERE email = :email AND is_read = 0");
$stmt->bindParam(':email', $user_email);
$stmt->execute();
$unread_notification = $stmt->fetch(PDO::FETCH_ASSOC);

// Fetch all notifications for the user, ordered by newest first (descending)
$stmt2 = $conn->prepare("SELECT * FROM notifications WHERE email = :email ORDER BY created_at DESC"); 
$stmt2->bindParam(':email', $user_email);
$stmt2->execute();
$notifications = $stmt2->fetchAll(PDO::FETCH_ASSOC);

// For categories example
try {
  // Fetch the categories from the database
  $sql = "SELECT category_name FROM categories";
  $stmt = $conn->query($sql);

  // Fetch all categories
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
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
        </svg>

      </button>

      <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="../../../../../user.html">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Appointment</a>
          </li>
        </ul>
        <!--Header-->
        <div class="d-flex ml-auto align-items-center">
    <div class="dropdown first-dropdown">
        <button class="" type="button" id="dropdownMenuButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-bell"></i>
            <?php if ($unread_notification['unread_count'] > 0): ?>
                <span class="badge badge-danger" style="position: relative; top: -10px; left: -10px;">
                    +<?= $unread_notification['unread_count']; ?>
                </span>
            <?php endif; ?>
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
            <h5 class="notification-title">Notification</h5>
            <?php if (!empty($notifications)): ?>
                <?php foreach ($notifications as $notification): ?>
                    <!-- Show notifications where type is 'Success' -->
                    <?php if ($notification['type'] === 'Success'): ?>
                        <div class="notification-content alert-primary">
                            <strong>Appointment Confirmed!</strong>
                            <p class="notification-text"><?= htmlspecialchars($notification['message']); ?></p>
                        </div>
                    <?php endif; ?>

                    <!-- Show notifications where type is 'confirm' -->
                    <?php if ($notification['type'] === 'confirm'): ?>
                        <div class="notification-content alert-success">
                            <strong>Successfully Booked!</strong>
                            <p class="notification-text"><?= htmlspecialchars($notification['message']); ?></p>
                            <?php if (!empty($notification['code'])): ?>
                                <p class="code">Code: <?= htmlspecialchars($notification['code']); ?></p>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>

                    <!-- Show notifications where type is 'decline' -->
                    <?php if ($notification['type'] === 'decline'): ?>
                        <div class="notification-content alert-danger">
                            <strong>Rejected</strong>
                            <p class="notification-text"><?= htmlspecialchars($notification['message']); ?></p>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="notification-text">No new notifications</p>
            <?php endif; ?>
        </div>
    </div>
</div>

        
          <div class="dropdown">
              <button class="dropdown-toggle profiles" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <img src="../../../../assets/img/profile/<?php echo $profilePicture; ?>" alt="" class="profile">
              </button>
              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                  <a class="dropdown-item" href="../../../users/web/api/dashboard.html">Profile</a>
                  <a class="dropdown-item" href="../../../users/web/api/login.html">Logout</a>
              </div>
      </div>
        </div>
        
      </div>
    </div>
  </nav>
  <form method="POST" action="../../function/php/appointment.php">
  <section class="appointment">
    <div class="content py-5 date">
    <input type="hidden" id="appointmentDate" name="appointmentDate">
        <div class="col-md-8 col-11 app">
            <div class="appoints">
                <button>Appointment Availability</button>
                <button class="appoint" id="toggleViewBtn">My Appointment</button>
            </div>
            <div class="card card-outline card-primary rounded-0 shadow" id="appointmentSection">
                <div class="card-body">
                    <div class="calendar-container">
                        <div id="appointmentCalendar"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="dayModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" id="info" role="document">
            <div class="modal-content">
                <div class="modal-header d-flex justify-content-between">
                    <h5 class="modal-title" id="modalLabel">Book Your Desired Schedule</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="sched row">
                        <div class="col-md-6">
                            <p>Appointment Schedule</p>
                            <div id="modalContent" class="col-6"></div>
                        </div>

                        <div class="line w-100"></div>
                    </div>

                    <!-- Start of form -->

                        <div class="container">
                            <div class="row" style="padding: 20px;">
                                <!-- Client Information -->
                                <div class="col-md-4">
                                    <h6>Owner Information</h6>
                                    <div class="mb-3">
                                        <label for="ownerName" class="form-label"> Name</label>
                                        <input type="text" class="form-control" id="ownerName" name="ownerName" placeholder="Racel Mae Loquellano" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="ContactNum" class="form-label">Contact #</label>
                                        <input type="text" class="form-control" id="contactNum" name="contactNum" placeholder="09123456789" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="ownerEmail" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="ownerEmail" name="ownerEmail" placeholder="bardyardpets@gmail.com" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="ownerAddress" class="form-label">Address</label>
                                        <textarea class="form-control" id="ownerAddress" name="ownerAddress" rows="3" placeholder="2nd Floor A & A Building Magdiwang Highway" required></textarea>
                                    </div>
                                </div>

                                <!-- Pet Information -->
                                <div class="col-md-4">
                                    <h6>Pet Information</h6>
                                    <div class="mb-3">
                                      <label for="petType" class="form-label">Pet Type</label>
                                      <select class="form-control" id="petType" name="petType">
                                          <?php if (!empty($categories)): ?>
                                              <?php foreach ($categories as $category): ?>
                                                  <option value="<?php echo htmlspecialchars($category['category_name']); ?>">
                                                      <?php echo htmlspecialchars($category['category_name']); ?>
                                                  </option>
                                              <?php endforeach; ?>
                                          <?php else: ?>
                                              <option value="">No categories available</option>
                                          <?php endif; ?>
                                      </select>
                                  </div>

                                    <div class="mb-3">
                                        <label for="breed" class="form-label">Breed</label>
                                        <input type="text" class="form-control" id="breed" name="breed" placeholder="Husky" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="age" class="form-label">Age</label>
                                        <input type="number" class="form-control" id="age" name="age" placeholder="Months" required>
                                    </div>
                                </div>

                                <!-- Services -->
                                <div class="col-md-4">
                                    <h6>Services</h6>
                                    <div class="mb-3">
                                        <label for="serviceCategory" class="form-label">Service Category</label>
                                        <div class="dropdowns">
                                            <button class="dropdown-toggle" type="button" id="serviceCategoryDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Select Category
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="serviceCategoryDropdown">
                                                <a class="dropdown-item" href="#" data-value="medical">Medical</a>
                                                <a class="dropdown-item" href="#" data-value="nonMedical">Non-Medical</a>
                                            </div>
                                        </div>
                                        <input type="hidden" name="serviceCategory" id="selectedServiceCategory">
                                    </div>

                                    <div class="mb-3">
                                        <label for="service" class="form-label">Service</label>
                                        <div class="dropdowns">
                                            <button class="dropdown-toggle" type="button" id="serviceDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Select Service
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="serviceDropdown">
                                                <!-- Medical Services -->
                                                <div class="medical-services">
                                                    <a class="dropdown-item" href="#" data-value="1200.00" data-service="Diagnostic and Therapeutic">Diagnostic and Therapeutic - ₱1200.00</a>
                                                    <a class="dropdown-item" href="#" data-value="850.00" data-service="Preventive Health Care">Preventive Health Care - ₱850.00</a>
                                                </div>
                                                <!-- Non-Medical Services -->
                                                <div class="nonMedical-services">
                                                    <a class="dropdown-item" href="#" data-value="999.00" data-service="Grooming">Grooming - ₱999.00</a>
                                                    <a class="dropdown-item" href="#" data-value="700.00" data-service="Boarding">Boarding - ₱700.00</a>
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
                                        <label for="Time" class="form-label">Choose Time</label>
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
                <li class="list-group-item current-appointment">
                  <div
                    class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center">
                    <div>
                      <h5 class="mb-1">Appointment with Dr. John Doe</h5>
                      <p class="mb-1">Service: Grooming</p>
                      <p class="mb-1">Pet: Husky, 1 Yr Old</p>
                      <p>Owner: Racel Mae Loquellano</p>
                    </div>
                    <div class="mt-3 mt-md-0 text-md-right">
                      <p class="mb-1">Date: 2024-07-10</p>
                      <p class="mb-1">Time: 10:00 AM</p>
                      <button class="btn btn-primary" data-toggle="modal" data-target="#modal1">View Info</button>
                      <a href="appointment.html"><button class="btn btn-primary">Cancel</button></a>
                    </div>
                  </div>
                </li>
                <li class="list-group-item past-appointment">
                  <div
                    class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center">
                    <div>
                      <h5 class="mb-1">Appointment with Dr. Jane Smith</h5>
                      <p class="mb-1">Service: Health Checkup</p>
                      <p class="mb-1">Pet: Cat, 2 Yr Old</p>
                      <p>Owner: John Doe</p>
                    </div>
                    <div class="mt-3 mt-md-0 text-md-right">
                      <p class="mb-1">Date: 2024-06-20</p>
                      <p class="mb-1">Time: 2:00 PM</p>
                      <button class="btn btn-primary" data-toggle="modal" data-target="#modal2">View Info</button>
                    </div>
                  </div>
                </li>
                <li class="list-group-item past-appointment">
                  <div
                    class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center">
                    <div>
                      <h5 class="mb-1">Appointment with Dr. Alan Brown</h5>
                      <p class="mb-1">Service: Vaccination</p>
                      <p class="mb-1">Pet: Dog, 3 Yr Old</p>
                      <p>Owner: Emily Clark</p>
                    </div>
                    <div class="mt-3 mt-md-0 text-md-right">
                      <p class="mb-1">Date: 2024-05-15</p>
                      <p class="mb-1">Time: 9:00 AM</p>
                      <button class="btn btn-primary" data-toggle="modal" data-target="#modal3">View Info</button>
                    </div>
                  </div>
                </li>
                <li class="list-group-item past-appointment">
                  <div
                    class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center">
                    <div>
                      <h5 class="mb-1">Appointment with Dr. Sarah White</h5>
                      <p class="mb-1">Service: Surgery</p>
                      <p class="mb-1">Pet: Rabbit, 2 Yr Old</p>
                      <p>Owner: Mark Johnson</p>
                    </div>
                    <div class="mt-3 mt-md-0 text-md-right">
                      <p class="mb-1">Date: 2024-04-22</p>
                      <p class="mb-1">Time: 11:00 AM</p>
                      <button class="btn btn-primary" data-toggle="modal" data-target="#modal4">View Info</button>
                    </div>
                  </div>
                </li>
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

    <!--Book-History Modal Section-->
  <div class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="modalLabel1" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header d-flex justify-content-between">
          <h5 class="modal-title" id="modalLabel1">Appointment Details</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <h5>Appointment with Dr. John Doe</h5>
          <p>Name: Racel Mae Loquellano</p>
          <p>Contact: 09123456789</p>
          <p>Email: bardyardpets@gmail.com</p>
          <p>Adress: Magdiwang Highway</p>
          <h5>Pet Information</h5>
          <p>Pet Type: Cat</p>
          <p>Breed: Husky</p>
          <p>Age: 12months</p>
          <h5>Services</h5>
          <p>Service Category: Non-Medical</p>
          <p>Service: Grooming</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="modal2" tabindex="-1" role="dialog" aria-labelledby="modalLabel2" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header d-flex justify-content-between">
          <h5 class="modal-title" id="modalLabel2">Appointment Details</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <h5>Appointment with Dr. Jane Smith</h5>
          <p>Name: John Doe</p>
          <p>Contact: 09123456789</p>
          <p>Email: bardyardpets@gmail.com</p>
          <p>Adress: Magdiwang Highway</p>
          <h5>Pet Information</h5>
          <p>Pet Type: Cat</p>
          <p>Breed: Husky</p>
          <p>Age: 24months</p>
          <h5>Services</h5>
          <p>Service Category: Medical</p>
          <p>Service:Health Check up</p>
         
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="modal3" tabindex="-1" role="dialog" aria-labelledby="modalLabel3" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header d-flex justify-content-between">
          <h5 class="modal-title" id="modalLabel3">Appointment Details</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <h5>Appointment with Dr. Alan Brown</h5>
          <p>Name: Emily Clark</p>
          <p>Contact: 09123456789</p>
          <p>Email: bardyardpets@gmail.com</p>
          <p>Adress: Magdiwang Highway</p>
          <h5>Pet Information</h5>
          <p>Pet Type: Cat</p>
          <p>Breed: Husky</p>
          <p>Age: 36months</p>
          <h5>Services</h5>
          <p>Service Category: Medical</p>
          <p>Service: Vaccination</p>
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="modal4" tabindex="-1" role="dialog" aria-labelledby="modalLabel4" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header d-flex justify-content-between">
          <h5 class="modal-title" id="modalLabel4">Appointment Details</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <h5>Appointment with Dr. Sarah White</h5>
          <p>Name: Mark Johnson</p>
          <p>Contact: 09123456789</p>
          <p>Email: bardyardpets@gmail.com</p>
          <p>Adress: Magdiwang Highway</p>
          <h5>Pet Information</h5>
          <p>Pet Type: Rabiit</p>
          <p>Breed: White</p>
          <p>Age: 24months</p>
          <h5>Services</h5>
          <p>Service Category: Medical</p>
          <p>Surgery</p>
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  <!--Book-History Modal Section-->


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
        <button>How to book?</button>
        <button>?</button>
        <button>How to book?</button>
        <button>How to book?</button>
        <button>How to book?</button>
        <button>How to book?</button>
      </div>
    </div>
    <div class="line"></div>
    <div class="admin mt-3">
      <div class="admin-chat">
        <img src="../../../../assets/img/vet logo.jpg" alt="Admin">
        <p>Admin</p>
      </div>
      <p class="text">Hello, I am Chat Bot. Please Ask me a question just by pressing the question buttons.</p>
    </div>
  </div>
</body>

<script>
    document.getElementById('dropdownMenuButton1').addEventListener('click', function() {
        // AJAX request to mark notifications as read
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "../../function/php/appointment-notif.php", true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.send();

        // Reset the badge count visually
        var notificationBadge = document.querySelector('.badge-danger');
        if (notificationBadge) {
            notificationBadge.textContent = '';
            notificationBadge.style.display = 'none';
        }
    });
</script>


<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
<script src="../../function/script/pagination-history.js"></script>
<script src="../../function/script/calendar.js"></script>
<script src="../../function/script/toggle-appointment.js"></script>
<script src="../../function/script/tab-bar.js"></script>
<script src="../../function/script/service-dropdown1.js"></script>
<script src="../../function/script/service-dropdown.js"></script>
<script src="../../function/script/chatbot-toggle.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

</html>