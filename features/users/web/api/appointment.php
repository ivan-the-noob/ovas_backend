<?php
session_start();
require '../../../../db.php';
if (isset($_SESSION['email'])) {
  $userEmail = $_SESSION['email']; 
} else {
  echo '';  
}
$email = isset($_SESSION['email']) ? $_SESSION['email'] : 'Email not set';

if ($email) {
  try {
      $stmt = $conn->prepare("SELECT * FROM users WHERE email = :email");
      $stmt->execute(['email' => $email]);
      $user = $stmt->fetch(PDO::FETCH_ASSOC);

      if ($user) {
          $name = htmlspecialchars($user['name']);
          $last_name = htmlspecialchars($user['last_name']);
          $address = htmlspecialchars($user['address']);
          $contact_num = htmlspecialchars($user['contact_num']);
          $profilePicture = htmlspecialchars($user['profile_picture']);
      } else {
          echo "No user found with the given email.";
      }
  } catch (PDOException $e) {
      echo "Error: " . $e->getMessage();
  }
} else {
  echo "Session email is not set.";
}
$bookingLimitReached = false;
$bookingCount = 0;
$name = $_SESSION['name'] ?? '';
$address = $_SESSION['address'] ?? '';
$contactnum = $_SESSION['contact_num'] ?? '';
$last_name = $_SESSION['last_name'] ?? '';
$role = $_SESSION['role'] ?? '';


if ($userEmail) {
  $yesterday = date('Y-m-d', strtotime('-1 day'));

  $stmt = $conn->prepare("
      SELECT COUNT(*) 
      FROM appointments 
      WHERE email = :email AND appointment_date = :yesterday
  ");
  
  $stmt->bindParam(':email', $userEmail);
  $stmt->bindParam(':yesterday', $yesterday);

  $stmt->execute();

  $bookingCount = $stmt->fetchColumn();

  if ($bookingCount >= 3) {
      $bookingLimitReached = true;
      
      header('Location: ../../../../index.php');
      exit;
  }
}


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
  <link rel="icon" href="../../../../assets/img/logo.png" type="image/x-icon">
  <title> Pawfect</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../../css/appointment.css">
  <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css" rel="stylesheet">



</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-light">
    <div class="container">
      <a class="navbar-brand d-none d-md-block" href="#">
        <img src="../../../../assets/img/logo.png" alt="Logo" width="30" height="30">
      </a>

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
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
            <a class="nav-link" href="../../../../index.php#about-us">About Us</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../../../../index.php#services">Our Services</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="appointments.php">Appointment</a>
          </li>
        </ul>

        <div class="d-flex ml-auto align-items-center">
          <?php if (isset($_SESSION['email'])): ?>
            <div class="dropdown second-dropdown">
            <button class="btn btn-link dropdown-toggle" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown"
                aria-expanded="false">
                <img src="../../../../assets/img/profile/<?php echo $profilePicture; ?>" alt="Profile" class="profile">
            </button>
              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                <a class="dropdown-item" href="profile.php">Profile</a>
                <a class="dropdown-item" href="settings.php">Settings</a>
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
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
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
                <button type="button" class="close btn btn-primary d-flex mx-auto mt-4" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">Confirm</span>
                </button>
            </div>
        </div>
    </div>
</div>




  <section class="appointment">
    <div class="content py-5 date">

      <div class="col-md-10 app">
        <div class="appoints">
          <button>Appointment Availability</button>
        </div>
        <form method="POST" action="../../function/php/appointment.php" enctype="multipart/form-data" onsubmit="return validateForm()">
      
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
                        <div class="fully-color"></div>
                        <span class="p-avail">Fully Booked</span>
                      </div>
                      <div class=" d-flex gap-1 unavailable">
                        <div class="unavailable-color"></div>
                        <span class="p-avail">Unavailable</span>
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
    <h5 class="modal-title" id="modalLabel" style="padding-left: 50px;">Book Your Desired Schedule</h5>
   

</div>
<div class="w-50 desired-time">
    <div class="choose-time-div" style="padding-left: 50px;">
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
              <div class="col-md-6"  style="padding-left: 50px;">
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
                  <h6 class="d-flex mx-auto mb-2 mb-2 text-center d-flex justify-content-center text-black">Owner Information</h6>
                  <div class="owner-info">
                    <div class="mb-3 position-relative">
                      <div class="position-relative">
                        <span class="input-label">Name: </span>
                        <input type="text" class="form-control" id="ownerName" name="ownerName"
                        style="padding-left: 60px;" 
                        value="<?php echo htmlspecialchars($name . ' ' . $last_name); ?>" readonly>
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
                        value="<?php echo htmlspecialchars($userEmail); ?>" 
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
                  <h6 class="mt-4 d-flex mx-auto mb-2 text-center d-flex justify-content-center text-black">Pet Information</h6>
                  <div class="owner-info">
                  <div class="mb-3 position-relative">
                      <div class="position-relative">
                        <span class="input-label" id="capitalizeInput">Pet's Name: </span>
                        <input type="text" class="form-control" id="pet_name" name="pet_name"
                          style="padding-left: 95px;" required>
                      </div>
                    </div>
                    <div class="mb-3 position-relative">
                      <div class="position-relative">
                        <span class="input-label" id="capitalizeInput">Pet Type:</span>
                        <select class="form-control" id="petType" name="pet_type"
                          style="padding-left: 90px" required>
                          <option value=""></option>
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
                        <span class="input-label" id="capitalizeInput">Breed:</span>
                        <input type="text" class="form-control" id="breed" name="breed"
                          style="padding-left: 60px;" required>
                      </div>
                    </div>
                    <div class="mb-3 position-relative">
                      <div class="position-relative">
                        <span class="input-label" id="capitalizeInput">Age:</span>
                        <input type="text" class="form-control" id="age" name="age"
                          style="padding-left: 60px;" required>
                      </div>
                    </div>
                  </div>

                </div>

                <!-- Pet Information -->

                <!-- Services -->
                <div class="col-md-6">
                  <h6 class="d-flex mx-auto mb-2 text-center d-flex justify-content-center text-black ">Services</h6>
                  <div class="owner-info">
                    <div class=" justify-content-center gap-1">
                    <div class="mb-3">
                      <label for="serviceCategory" class="form-label text-black">Service Category</label>
                      <div class="dropdowns">
                      <button class="btn  w-100 dropdown-toggle text-black" type="button"
                              id="serviceCategoryDropdown" data-bs-toggle="dropdown" aria-expanded="false">
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
                      <label for="service" class="form-label text-black">Service</label>
                      <div class="dropdowns">
                      <button class="btn  w-100 dropdown-toggle text-black" type="button"
                              id="serviceDropdown" data-bs-toggle="dropdown" aria-expanded="false">
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
                  </div>

                    <div class="mt-3">
                      <label for="totalPayment" class="form-label text-black">Service Price</label>
                      <p id="totalPayment">₱0.00</p>
                    </div>

                   
                  
                </div>
                <h6 class="d-flex mx-auto mb-2 mb-2 text-center d-flex justify-content-center text-black" style="margin-top: 30px;">Down Payment</h6>
                    <div class="owner-info">
                    <div class="mt-3">
                      <div class=" d-flex flex-column align-items-center justify-content-center">
                      <label for="pay-via" class="form-label text-black">Pay Via</label>
                      <div class="d-flex justify-content-start pay-btn">
                      <button id="gcash-btn" class="btn btn-primary" type="button" data-toggle="modal" data-target="#gcashModal" onclick="selectPayment('gcash', this)" style="height: 40px;">
                          Gcash
                      </button>


                  <div class="modal fade" id="gcashModal" tabindex="-1" role="dialog" aria-labelledby="gcashModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered">
                          <div class="modal-content" style="box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);">
                          <div class="modal-header d-flex justify-content-between">
                              <h5 class="modal-title" id="gcashModalLabel">GCash Payment Instructions</h5>
                              <button type="button" class="close" aria-label="Close" onclick="closeGcashModal()">
                                <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                            
                              <div class="modal-body" style="color: #000;">
                                  <p>To successfully confirm your appointment and payment, please follow the steps below. Ensure that you complete all parts of the process to avoid delays in verification.</p>
                                  <ol>
                                      <li>Take a screenshot of the QR code displayed in the system. Ensure the entire QR code is visible and clear.</li>
                                      <li>Open the GCash app and log in with your account.</li>
                                      <li>Tap on "Pay QR" from the GCash home screen.</li>
                                      <li>Select "Upload from Gallery" and choose the screenshot of the QR code.</li>
                                      <li>Once the QR code is scanned, enter ₱250 as the payment amount.</li>
                                      <li>Double-check the details, then tap "Pay" to complete the transaction.</li>
                                      <li>Save or take a screenshot of the payment confirmation as proof of payment.</li>
                                      <li>Go back to the Bark Yard website, upload the screenshot of your payment, and enter the reference number for verification.</li>
                                      <li>Complete the process by booking your appointment.</li>
                                  </ol>
                              </div>
                             
                          </div>
                      </div>
                  </div>
                  
                  <script>
                    function closeGcashModal() {
                        $('#gcashModal').modal('hide');
                    }
                    
                  </script>

                      
                    </div>
                    <input type="hidden" id="payment_method" name="payment_method" value="" required>
                   

                    <div id="gcash-details" class="mt-3" style="display: none;">
                        <div class="gcash">
                            <img src="../../../../assets/img/gcash/gcash.jpg" style="1px solid #000; border-radius: 10px;">
                        </div>
                        <label for="gcash-screenshot" class="form-label">Upload screenshot</label>
                        <input type="file" id="gcash-screenshot" name="gcash-ss" accept="image/*" class="form-control" required>
                        <div class="position-relative mt-2">
                            <span class="input-label">Reference Number:</span>
                            <input type="text" name="reference" class="form-control" 
                                style="padding-left: 150px;" maxlength="13" 
                                oninput="validateLength(this)" onkeypress="return isNumberKey(event)">

                          <script>
                            function isNumberKey(event) {
                              const charCode = event.which || event.keyCode;
                              return charCode >= 48 && charCode <= 57; 
                            }
                            function validateLength(input) {
                              if (input.value.length > 13) {
                                input.value = input.value.slice(0, 13); 
                              }
                              input.setCustomValidity(
                                input.value.length === 13 ? "" : "Please enter exactly 13 digits."
                              );
                            }
                          </script>
                        </div>
                    </div>
                  </div>
                  </div>
                       
            </div>
            
          </div>
                    </div>
                    <div class="d-flex text-black justify-content-center">
                      <button id="book-btn" class="btn btn-primary text-black fw-bold d-flex justify-content-center mt-4" style="background-color:#74C2CD" type="button" data-toggle="modal" data-target="#appointmentModals" onclick="selectAppointment('book', this)" >
                        Book Appointment
                      </button>
              </div>
                    

            <div class="modal fade" id="appointmentModals" tabindex="-1" role="dialog" aria-labelledby="appointmentModalsLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content" style="box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);">
                        <div class="modal-header d-flex justify-content-between">
                            <h5 class="modal-title" id="appointmentModalsLabel">Appointment Confirmation</h5>
                            <button type="button" class="close" aria-label="Close" onclick="closeAppointmentModal()">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body" style="color: #000;">
                            <h5 class="text-center">Are your sure you want to
                              Book this appointment?” 
                            </h5>
                        </div>
                        <div class="modal-footer">
                        <div class="mt-3 d-flex gap-1">
                              <button type="button" class="book-save" aria-label="Close" onclick="closeAppointmentModal()">
                                      <span aria-hidden="true">Cancel</span>
                                </button>
                                  <button type="submit" class="book-save">Confirm</button>
                              </div>
                        </div>
                    </div>
                </div>
            </div>
           


            <script>
                function closeAppointmentModal() {
                    $('#appointmentModals').modal('hide');
                }

                function selectAppointment(action, button) {
                const buttons = document.querySelectorAll('.pay-btn button');
                buttons.forEach(btn => {
                    btn.classList.remove('selected'); 
                    btn.style.backgroundColor = ''; 
                    btn.style.color = ''; 
                    btn.style.borderColor = '#EBBF86'; 
                });

                button.classList.add('selected');
                button.style.backgroundColor = '#EBBF86';
                button.style.color = 'white';
                button.style.borderColor = '#EBBF86'; 

                const appointmentActionInput = document.getElementById('appointment_action');
                if (appointmentActionInput) {
                    appointmentActionInput.value = action;
                } else {
                    console.error("Element with ID 'appointment_action' not found.");
                }

                console.log('action: ' + action);

                const appointmentDetails = document.getElementById('appointmentModals');
                if (appointmentDetails) {
                    if (action === 'book') {
                        appointmentDetails.style.display = 'block'; 
                        const myModal = new bootstrap.Modal(document.getElementById('appointmentModals'), {
                            keyboard: false
                        });
                        myModal.show();
                    } else {
                        appointmentDetails.style.display = 'none'; 
                    }
                } else {
                    console.error("Element with ID 'appointment-details' not found.");
                }
            }

            </script>
              
          


        </div>
      </div>
    </div>
    </div>
  </section>
  </form>

  <!--Appointment Section End-->

  <!--Book-History Section-->
  
  
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
            var appointmentModal = new bootstrap.Modal(document.getElementById('appointmentModal'), {
                backdrop: 'static', 
                keyboard: false   
            });

            appointmentModal.show();

            document.getElementById('openModalButton').addEventListener('click', function() {
                appointmentModal.show();
            });
        });

    </script>
  
  <script>
    function selectTime(button, time) {
        document.getElementById('selectedTime').value = time;
        
        const buttons = document.querySelectorAll('.choose-time');
        buttons.forEach(btn => btn.classList.remove('selected'));
        button.classList.add('selected');
    }


    function validateForm() {
        const time = document.getElementById('selectedTime').value;

        if (!time) {
            alert('Please select time before submitting.');
            return false; 
        }
        return true; 
    }
  </script>

  <script>
     document.addEventListener("DOMContentLoaded", () => {
      const input = document.getElementById("capitalizeInput");
      input.addEventListener("input", () => {
        input.value = input.value
          .toLowerCase()
          .replace(/\b\w/g, char => char.toUpperCase());
      });
    });
  </script>



<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>

<script src="../../function/script/pagination-history.js"></script>
<script src="../../function/script/chat-bot-app.js"></script>
<script src="../../function/script/calendar.js"></script>
<script src="../../function/script/tab-bar.js"></script>
<script src="../../function/script/payment.js"></script>
<script src="../../function/script/service-dropdown1.js"></script>
<script src="../../function/script/service-dropdown.js"></script>
<script src="../../function/script/chatbot-toggle.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>


</html>