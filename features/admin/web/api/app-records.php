<?php
session_start();

if (!isset($_SESSION['email']) || $_SESSION['role'] !== 'admin') 
{
    header("Location: ../../../users/web/api/login.php");
    exit(); 
}

require '../../../../db.php';

try {
  $sql = "SELECT category_name FROM categories";
  $stmt = $conn->query($sql);

  $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
    <title>Patients Records | Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../css/app-records.css">
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
            <a href="app-records.php" class="navbar-highlight">
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

        <!--Input fields of Patients Records-->
        <form action="../../function/php/save_patient.php" method="POST">
  <div class="app-req">
    <h3>Patient Records</h3>
    <div class="container px-5 pt-3 patientss">
      <div class="row justify-content-center">
        <!-- Client Information -->
        <div class="col-md-3 section">
          <h6 class="mb-4">Client Information</h6>
          <div class=" mb-3 position-relative">
            <div class="position-relative">
            <span class="input-label">Name: </span>
            <input type="text" class="form-control" id="ownerName" name="ownerName" style="padding-left: 60px;">
          </div>
        </div>
         
          <div class="mb-3 position-relative">
            <div class="position-relative">
              <span class="input-labels">Address: </span>
              <textarea class="form-control" id="ownerAddress" name="ownerAddress" rows="3" style=" padding-top: 25px;"
               ></textarea>
            </div>
          </div>
          <div class="mb-3 contacts">
            <label for="contactNum" class="form-label">Contact Details</label>
            <div class="position-relative">
              <span class="input-label">Mobile:</span>
              <input type="number" class="form-control" name="mobile" style="padding-left: 65px;">
            </div>
            <div class="position-relative">
              <span class="input-label">Home:</span>
              <input type="number" class="form-control" name="home" style="padding-left: 65px;">
            </div>
            <div class="position-relative">
              <span class="input-label">Work:</span>
              <input type="number" class="form-control" name="work" style="padding-left: 65px;">
            </div>
            <div class="position-relative">
              <span class="input-label">Viber:</span>
              <input type="number" class="form-control" name="viber" style="padding-left: 65px;">
            </div>
          </div>
          <div class="mb-3">
            <label for="ownerEmail" class="form-label">Email</label>
            <div class="position-relative">
            <span class="input-label">Email:</span>
            <input type="email" class="form-control" id="ownerEmail" name="ownerEmail" style="padding-left: 65px;">
          </div>
          </div>
          <div class="mb-3">
            <label for="preferredContact" class="form-label">Preferred Contact</label>
            <div class="d-flex flex-wrap">
              <div class="form-check me-3">
                <input class="form-check-input" type="radio" name="preferredContact" id="preferredEmail" value="Email">
                <label class="form-check-label" for="preferredEmail">Email</label>
              </div>
              <div class="form-check me-3">
                <input class="form-check-input" type="radio" name="preferredContact" id="preferredMobile" value="Mobile">
                <label class="form-check-label" for="preferredMobile">Mobile</label>
              </div>
              <div class="form-check me-3">
                <input class="form-check-input" type="radio" name="preferredContact" id="preferredHome" value="Home">
                <label class="form-check-label" for="preferredHome">Home</label>
              </div>
              <div class="form-check me-3">
                <input class="form-check-input" type="radio" name="preferredContact" id="preferredWork" value="Work">
                <label class="form-check-label" for="preferredWork">Work</label>
              </div>
              <div class="form-check me-3">
                <input class="form-check-input" type="radio" name="preferredContact" id="preferredFbMessenger" value="Fb Messenger">
                <label class="form-check-label" for="preferredFbMessenger">Fb Messenger</label>
              </div>
              <div class="form-check me-3">
                <input class="form-check-input" type="radio" name="preferredContact" id="preferredViber" value="Viber">
                <label class="form-check-label" for="preferredViber">Viber</label>
              </div>
            </div>
          </div>
        </div>
        <!-- Pet Information -->
        <div class="col-md-3 section">
          <h6 class="mb-4">Pet Information</h6>
          <div class="mb-3">
            <div class="position-relative">
             <span class="input-label">Pet Name:</span>
              <input type="text" class="form-control" name="petName" id="pet-name" style="padding-left: 90px;">
            </div>
            
          </div>
          <div class="mb-3">
            <div class="position-relative">
            <span class="input-label">Species:</span>
              <select class="form-control" id="petType" name="petType" style="padding-left: 80px;">
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
          </div>

          <div class="mb-3">
            <div class="position-relative">
            <span class="input-label">Sex:</span>
              <select class="form-control" id="sex" name="sex" style="padding-left: 50px">
                <option>Male Intact</option>
                <option>Male Neutered (kapon)</option>
                <option>Female Intact</option>
                <option>Female Spayed (kapon)</option>
              </select>
            </div>
          </div>
          <div class="mb-3">
            <div class="position-relative">
              <span class="input-label">Breed:</span> 
              <input type="text" class="form-control" name="breed"  id="breed" style="padding-left: 70px;">
            </div>
          </div>
          <div class="mb-3">
            <div class="position-relative">
              <span class="input-label">Colors:</span> 
            <input type="text" class="form-control" name="colorMarkings" id="color-markings" style="padding-left: 70px">
            </div>
          </div>
          <div class="mb-3">
            <div class="position-relative">
              <span class="input-label">Microchip No:</span> 
              <input type="number" class="form-control" name="microchipNo" id="micro-no" style="padding-left: 115px">
            </div>
          </div>
          <div class="mb-3">
            <label for="Date of Birth" class="form-label">Date of Birth</label>
            <input type="date" class="form-control" name="dob" placeholder="01/01/24" id="dob">
          </div>
          <div class="mb-3">
            <div class="position-relative">
            <span class="input-label">Age:</span> 
            <input type="number" class="form-control" name="age" id="age" style="padding-left: 60px;">
            </div>         
          </div>
        </div>
        <div class="col-md-2 section">
          <h6 class="mb-4">Services</h6>
          <div class="mb-3">
            <label for="serviceCategory" class="form-label">Service Category</label>
            <div class="dropdowns">
              <select class="form-control" id="serviceCategory" name="serviceCategory">
                <option value="medical">Medical</option>
                <option value="nonMedical">Non-Medical</option>
              </select>
            </div>
          </div>
          <div class="mb-3">
            <label for="service" class="form-label">Service</label>
            <select class="form-control" id="service" name="service">
              <option value="1200">Diagnostic and Therapeutic - ₱1200.00</option>
              <option value="850">Preventive Health Care - ₱850.00</option>
              <option value="1500">Internal Medicine Consults - ₱1500.00</option>
              <option value="2500">Surgical Services - ₱2500.00</option>
              <option value="300">Pharmacy - ₱300.00</option>
              <option value="500">House Visit - ₱500.00</option>
              <option value="999">Grooming - ₱999.00</option>
              <option value="700">Boarding - ₱700.00</option>
              <option value="300">Pet Supplies - ₱300.00</option>
            </select>
          </div>

          <input type="hidden" id="payment" name="payment" value="0">

          <div class="mt-3">
            <label for="totalPayment" class="form-label">Total Payment</label>
            <p id="totalPayment">₱0.00</p>
          </div>

            <script>
              document.addEventListener('DOMContentLoaded', function () {
                  const serviceSelect = document.getElementById('service');
                  const totalPayment = document.getElementById('totalPayment');
                  const paymentInput = document.getElementById('payment'); 


                  serviceSelect.addEventListener('change', function () {

                      const selectedValue = serviceSelect.value;


                      if (selectedValue) {
                          totalPayment.textContent = `₱${selectedValue}`;
                          paymentInput.value = selectedValue; 
                      } else {
                          totalPayment.textContent = '₱0.00';
                          paymentInput.value = '0'; 
                      }
                  });
              });
            </script>

            <script>
              document.addEventListener('DOMContentLoaded', function () {
                  const notificationDropdown = document.getElementById('notificationDropdown');

                  notificationDropdown.addEventListener('click', function () {
                      fetch('', {
                          method: 'POST',
                          headers: {
                              'Content-Type': 'application/x-www-form-urlencoded'
                          },
                          body: 'markAsRead=true'
                      }).then(response => response.text())
                      .then(data => {
                          const badge = document.querySelector('.badge');
                          if (badge) {
                              badge.remove();
                          }
                      }).catch(error => console.error('Error:', error));
                  });
              });

            </script>

        </div>
        <div class="col-md-3 section">
          <h6 class="mb-4">Other Information</h6>
          <div class="mb-3">
            <label for="date" class="form-label">Date</label>
            <input type="date" class="form-control" name="date" id="date">
          </div>
          <div class="mb-3">
            <label class="form-label">Is there an authorization for medical and/or surgical treatment?</label><br>
            <div class="input-radio">
              <input type="radio" id="auth-yes" name="authorization" value="yes">Yes
              <input type="radio" id="auth-no" name="authorization" value="no">No
            </div>
          </div>
          <div class="mb-3">
            <label for="entering-complaint" class="form-label">Veterinarian's Report:<br> Entering Complaint</label>
            <textarea class="form-control" id="entering-complaint" name="enteringComplaint" rows="5"></textarea>
          </div>
          <div class="mb-3">
            <label for="history-physical-diagnosis-treatment" class="form-label">History • Physical Findings • Diagnosis • Treatment</label>
            <textarea class="form-control" id="history-physical-diagnosis-treatment" name="historyPhysical" rows="5"></textarea>
          </div>
          <div class="mb-3">
            <button type="submit" class="book-save">Save</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</form>

           
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