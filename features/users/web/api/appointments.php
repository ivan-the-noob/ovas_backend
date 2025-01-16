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
  <link rel="icon" href="../../../../assets/img/logo.png" type="image/x-icon">
  <title> Pawfect</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css" rel="stylesheet">
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
            <a class="nav-link" href="../../../../index.php#about-us">About Us</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../../../../index.php#services">Our Services</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="appointments.php">Appointment</a>
          </li>
        </ul>

        <div class="d-flex ml-auto">
          <div class="dropdown">
              <button class=" dropdown-toggle d-flex align-items-center" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <img src="../../../../assets/img/profile/<?php echo htmlspecialchars($profilePicture, ENT_QUOTES, 'UTF-8'); ?>" alt="Profile" class="profile" alt="Profile Picture" id="profileImg">
              </button>
              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
              <a class="dropdown-item" href="profile.php">Profile</a>
                <a class="dropdown-item" href="settings.php">Settings</a>
                <a class="dropdown-item" href="logout.php">Logout</a>
              </div>
          </div>
        </div>
      </div>
    </div>
  </nav>
  <!--Dashboard Section-->

  <?php if (isset($_SESSION['booked']) && $_SESSION['booked'] === true): ?>
    <div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content" >
                <div class="modal-header d-flex justify-content-between" style="color: #000;">
                    <h5 class="modal-title" id="successModalLabel">Appointment Successfully Booked</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body"  style="color: #000;">
                    <p>You have successfully booked an appointment for your wonderful pet! Please wait for the admin to confirm your booking and provide your appointment code. Once your appointment is confirmed, take note of or screenshot your code and present it at the clinic during your visit.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>

<?php endif; ?>

  
</div>
<div class="col-md-10 d-flex flex-column mx-auto">
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
            <div class="card-body p-0">
              <ul class="list-group" id="historyList">
              <?php 
                  try {
                    require '../../../../db.php';
          

                    if (isset($_SESSION['email'])) {
                      $sessionEmail = $_SESSION['email'];
              
                      $sql = "SELECT * FROM appointments WHERE email = :email AND status IN ('pending', 'confirm', 'complete','resched')";
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
                              } elseif ($status === 'resched') {
                                  $statusClass = 'bg-warning'; 
                              } elseif ($status === 'pending') {
                                  $statusClass = 'bg-primary text-white'; 
                              }
              
                              echo '<li class="list-group-item current-appointment">
                              <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center">
                                <div>
                                 <p class="mb-1 status btn btn-primary ' . htmlspecialchars($statusClass) . '">' . ($status === 'confirm' ? 'Confirmed' : htmlspecialchars($status)) . '</p>
                                  <p class="mb-1">Service: ' . htmlspecialchars($serviceType) . '</p>
                                  <p class="mb-1">Pet: ' . htmlspecialchars($petType) . ', ' . htmlspecialchars($age) . ' Yr(s) Old</p>
                                  <p>Owner: ' . htmlspecialchars($ownerName) . '</p>
                                </div>
                                <div class="mt-3 mt-md-0 text-md-right">
                                  <p class="mb-1">Date: ' . htmlspecialchars($appointmentDate) . '</p>
                                  <p class="mb-1">Time: ' . htmlspecialchars($appointmentTime) . '</p>
                                  <div class="d-flex gap-1">
                                  <button class="btn btn-primary" data-toggle="modal" data-target="#modal' . $appointmentId . '">View Info</button>';
                                    
                                  if ($status === 'pending') {
                                      echo '<button class="btn btn-danger" data-toggle="modal" data-target="#deleteModal' . $appointmentId . '">Cancel</button>';
                                  }
                                  if ($status === 'pending' || $status === 'scheduled') {
                                    echo '<button 
                                        class="btn btn-warning text-white" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#reschedModal" 
                                        data-booking-id="' . $appointmentId . '" 
                                        data-booking-date="' . htmlspecialchars($appointmentDate) . '">
                                        Re-schedule
                                    </button>';
                                }
                                  
                                  echo '    </div>
                                            </div>
                                            </div>
                                        </li>';

                                        echo '
                                        <div class="modal fade" id="reschedModal" tabindex="-1" aria-labelledby="reschedModalLabel" aria-hidden="true">
                                              <div class="modal-dialog modal-xl">
                                                  <div class="modal-content">
                                                      <div class="modal-header">
                                                          <h5 class="modal-title" id="reschedModalLabel">Select Reschedule Date</h5>
                                                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                      </div>
                                                      <div class="modal-body">
                                                          <form id="rescheduleForm" method="POST" action="../../function/php/updateAppointment.php">
                                                              <div class="d-flex gap-2" style="font-size: 20px; padding-left: 50px;">
                                                                  <p>Selected Date:</p>
                                                                  <div class="selected-date"><p></p></div>
                                                              </div>
                                                              <div id="appointmentCalendar"></div>
                                                              <!-- Hidden input field with name attribute -->
                                                              <input type="hidden" id="appointment_date" name="appointment_date" value="">
                                                              <!-- Hidden field for status -->
                                                              <input type="hidden" name="status" value="pending">
                                                          <input type="hidden" id="email" name="email" value="' . (isset($_SESSION['email']) ? $_SESSION['email'] : '') . '" />
                                                      </div>
                                                      <div class="modal-footer">
                                                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                          <button type="submit" class="btn btn-primary">Confirm Reschedule</button>
                                                      </div>
                                                      </form>
                                                  </div>
                                              </div>
                                          </div>
                                        '; 

                                      
                              echo '<div class="modal fade" id="modal' . $appointmentId . '" tabindex="-1" role="dialog" aria-labelledby="modalLabel' . $appointmentId . '" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                      <div class="modal-content">
                                        <div class="modal-header d-flex justify-content-between">
                                          <h5 class="modal-title" id="modalLabel' . $appointmentId . '">Appointment Details</h5>
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                           </button>
                                        </div>
                                        <div class="modal-body info">
                                          <form>
                                            <div class="owner-info">
                                              <div class="form-group">
                                                <label for="ownerName' . $appointmentId . '">Name</label>
                                                <input type="text" class="form-control" id="ownerName' . $appointmentId . '" value="' . htmlspecialchars($ownerName) . '" readonly>
                                              </div>
                                              <div class="form-group">
                                                <label for="contact' . $appointmentId . '">Contact</label>
                                                <input type="text" class="form-control" id="contact' . $appointmentId . '" value="' . htmlspecialchars($contact) . '" readonly>
                                              </div>
                                              <div class="form-group">
                                                <label for="email' . $appointmentId . '">Email</label>
                                                <input type="email" class="form-control" id="email' . $appointmentId . '" value="' . htmlspecialchars($email) . '" readonly>
                                              </div>
                                              <div class="form-group">
                                                <label for="address' . $appointmentId . '">Address</label>
                                                <input type="text" class="form-control" id="address' . $appointmentId . '" value="' . htmlspecialchars($address) . '" readonly>
                                              </div>
                                            </div>
                                            
                                            <h5 class="mt-4 d-flex justify-content-center mx-auto">Pet Information</h5>
                                            <div class="owner-info">
                                              <div class="form-group">
                                                <label for="petType' . $appointmentId . '">Pet Type</label>
                                                <input type="text" class="form-control" id="petType' . $appointmentId . '" value="' . htmlspecialchars($petType) . '" readonly>
                                              </div>
                                              <div class="form-group">
                                                <label for="breed' . $appointmentId . '">Breed</label>
                                                <input type="text" class="form-control" id="breed' . $appointmentId . '" value="' . htmlspecialchars($breed) . '" readonly>
                                              </div>
                                              <div class="form-group">
                                                <label for="age' . $appointmentId . '">Age</label>
                                                <input type="text" class="form-control" id="age' . $appointmentId . '" value="' . htmlspecialchars($age) . ' months" readonly>
                                              </div>
                                            </div>

                                            <h5 class="mt-4 d-flex justify-content-center mx-auto">Services</h5>
                                            <div class="owner-info">
                                              <div class="form-group">
                                                <label for="serviceCategory' . $appointmentId . '">Service Category</label>
                                                <input type="text" class="form-control" id="serviceCategory' . $appointmentId . '" value="' . htmlspecialchars($serviceCategory) . '" readonly>
                                              </div>
                                              <div class="form-group">
                                                <label for="serviceType' . $appointmentId . '">Service</label>
                                                <input type="text" class="form-control" id="serviceType' . $appointmentId . '" value="' . htmlspecialchars($serviceType) . '" readonly>
                                              </div>
                                            </div>

                                            <h5 class="mt-4 d-flex justify-content-center mx-auto">Payment Details</h5>
                                            <div class="owner-info">
                                              <div class="form-group">
                                                <label for="totalPayment' . $appointmentId . '">Total Payment</label>
                                                <input type="text" class="form-control" id="totalPayment' . $appointmentId . '" value="₱' . htmlspecialchars($totalPayment) . '" readonly>
                                              </div>
                                              <div class="form-group">
                                                <label for="paymentMethod' . $appointmentId . '">Payment Method</label>
                                                <input type="text" class="form-control" id="paymentMethod' . $appointmentId . '" value="' . htmlspecialchars($paymentMethod) . '" readonly>
                                              </div>
                                              <div class="form-group">
                                                <label for="gcashScreenshot' . $appointmentId . '">GCash Screenshot</label>
                                                <input type="text" class="form-control" id="gcashScreenshot' . $appointmentId . '" value="' . htmlspecialchars($gcashScreenshot) . '" readonly>
                                                <img src="../../../../assets/img/gcash/' . htmlspecialchars($gcashScreenshot) . '" alt="GCash Screenshot" style="max-width: 100%; height: auto;">
                                              </div>
                                              <div class="form-group">
                                                <label for="reference' . $appointmentId . '">Reference</label>
                                                <input type="text" class="form-control" id="reference' . $appointmentId . '" value="' . htmlspecialchars($reference) . '" readonly>
                                              </div>
                                            </div>
                                          </form>
                                        </div>
                                        <div class="modal-footer">
                                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  ';
              
                              echo '<div class="modal fade" id="deleteModal' . $appointmentId . '" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel' . $appointmentId . '" aria-hidden="true">
                                  <div class="modal-dialog modal-dialog-centered" role="document">
                                      <div class="modal-content">
                                          <div class="modal-header d-flex justify-content-between">
                                              <h5 class="modal-title" id="deleteModalLabel' . $appointmentId . '">Cancel Appointment</h5>
                                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                  <span aria-hidden="true">&times;</span>
                                              </button>
                                          </div>
                                          <form action="../../function/php/delete_appointment.php" method="POST">
                                          <div class="modal-body">
                                              <p>Are you sure you want to cancel this appointment? Please provide a reason for cancellation.</p>
                                              <div class="form-group">
                                                  <label for="reasonCancel' . $appointmentId . '">Reason for Cancellation</label>
                                                  <textarea class="form-control" id="reasonCancel' . $appointmentId . '" name="reason_cancel" rows="4" required></textarea>
                                              </div>
                                          </div>
                                          <div class="modal-footer">
                                              <!-- Form triggers PHP script to update the appointment -->
                                                  <input type="hidden" name="id" value="' . $appointmentId . '">
                                                  <button type="submit" class="btn btn-danger">Yes, Cancel Appointment</button>
                                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">No, Keep Appointment</button>
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
              
                      $sql = "SELECT * FROM appointments WHERE email = :email AND status IN ('decline','complete','cancelled')";
                    
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
                              $reasonCancel = $row['reason_cancel'];

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
                                      <p class="mb-1 status btn btn-primary ' . htmlspecialchars($statusClass) . '">' . htmlspecialchars($status) . '</p>
                                      <p class="mb-1">Service: ' . htmlspecialchars($serviceType) . '</p>
                                      <p class="mb-1">Pet: ' . htmlspecialchars($petType) . ', ' . htmlspecialchars($age) . ' Yr(s) Old</p>
                                      <p class="mb-1">Owner: ' . htmlspecialchars($ownerName) . '</p>';
                                    
                                      
                                      if ($status === 'cancelled' && !empty($reasonCancel)) {
                                          echo '<p class="mb-1 reason">Reason for Cancellation: ' . htmlspecialchars($reasonCancel) . '</p>';
                                      }
                      
                      echo '    </div>
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


</body>
<script>
document.addEventListener('DOMContentLoaded', function () {
  var calendarEl = document.getElementById('appointmentCalendar');
  var selectedDateDiv = document.querySelector('.selected-date p');

  $('#reschedModal').on('shown.bs.modal', function () {
    var calendar = new FullCalendar.Calendar(calendarEl, {
      initialView: 'dayGridMonth',
      headerToolbar: {
        left: '',
        center: 'title',
        right: 'prev,next',
      },
      dayCellDidMount: async function (info) {
        var dayCell = info.el;
        var date = new Date(info.date);
        var today = new Date();
        today.setHours(0, 0, 0, 0);
        var maxDate = new Date(today);
        maxDate.setDate(today.getDate() + 14); 

        var formattedDate = date.toISOString().split('T')[0]; 

        var xhrUnavailable = new XMLHttpRequest();
        xhrUnavailable.open('POST', '../../function/php/getUnavailableDates.php', true);
        xhrUnavailable.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhrUnavailable.onload = function () {
          if (xhrUnavailable.status === 200) {
            var unavailableDates = xhrUnavailable.responseText.split(',');

            if (
              unavailableDates.includes(formattedDate) ||
              date < today ||
              date > maxDate
            ) {
              disableDayCell(dayCell); 
            } else {

              checkBookingCapacity(dayCell, formattedDate);
            }
          }
        };
        xhrUnavailable.send('action=fetchUnavailable');

        dayCell.addEventListener('click', function () {
  var appointmentDateField = document.getElementById('appointment_date');
  var selectedDateDiv = document.querySelector('.selected-date p');

  if (appointmentDateField) {
    var clickedDate = new Date(formattedDate);
    var localDate = new Date(clickedDate.getTime() - clickedDate.getTimezoneOffset() * 60000);
    var localFormattedDate = localDate.toISOString().split('T')[0]; 

    appointmentDateField.value = localFormattedDate;

 
  }

        if (selectedDateDiv) {
          var clickedDate = new Date(formattedDate);

          var localDate = new Date(clickedDate.getTime() - clickedDate.getTimezoneOffset() * 60000);

          selectedDateDiv.textContent = localDate.toLocaleDateString('en-US', {
            year: 'numeric',
            month: 'long',
            day: 'numeric',
          });
        }
      });


      },
    });

    calendar.render();
  });
});

function disableDayCell(dayCell) {
  dayCell.style.backgroundColor = '#808080';
  dayCell.style.cursor = 'not-allowed';
  dayCell.style.pointerEvents = 'none';
}

function checkBookingCapacity(dayCell, formattedDate) {
  var xhr = new XMLHttpRequest();
  xhr.open('POST', '../../function/php/check-bookings.php', true);
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  xhr.onload = function () {
    if (xhr.status === 200) {
      var response = JSON.parse(xhr.responseText);
      if (response.error) {
        console.error('Error:', response.error);
        return;
      }

      var bookingCount = response.bookingCount;
      var maxBooking = response.maxBooking;

      if (bookingCount >= maxBooking) {
        dayCell.style.backgroundColor = '#F65859'; 
        dayCell.style.pointerEvents = 'none';
        dayCell.style.cursor = 'not-allowed';
      } else {
        enableDayCell(dayCell, formattedDate); 
      }
    }
  };
  xhr.send('date=' + formattedDate);
}

function enableDayCell(dayCell, formattedDate) {
  dayCell.style.backgroundColor = '#9EF3A0';
  dayCell.addEventListener('mouseover', function () {
    dayCell.style.backgroundColor = '#73BD1E'; 
  });
  dayCell.addEventListener('mouseout', function () {
    dayCell.style.backgroundColor = '#9EF3A0'; 
  });

  dayCell.addEventListener('click', function () {
  var appointmentDateField = document.getElementById('appointment_date');
  var selectedDateDiv = document.querySelector('.selected-date p');

  if (appointmentDateField) {
    var clickedDate = new Date(formattedDate);
    appointmentDateField.value = clickedDate.toISOString().split('T')[0]; 

    console.log("Selected date: " + appointmentDateField.value);
  }

  if (selectedDateDiv) {
    var clickedDate = new Date(formattedDate);
    clickedDate.setDate(clickedDate.getDate() + 1); 

    selectedDateDiv.textContent = clickedDate.toLocaleDateString('en-US', {
      year: 'numeric',
      month: 'long',
      day: 'numeric',
    });
  }
});

}




// Disable time button helper
function disableTimeButton(button) {
  button.disabled = true;
  button.style.backgroundColor = '#808080';
  button.style.cursor = 'not-allowed';
  button.style.color = 'white';
}

// Enable time button helper
function enableTimeButton(button) {
  button.disabled = false;
  button.style.backgroundColor = '';
  button.style.cursor = '';
}

// Convert time to 24-hour format
function convertTo24HourFormat(time) {
  var timeParts = time.split(' ');
  var hour = parseInt(timeParts[0], 10);
  var period = timeParts[1].toUpperCase();

  if (period === 'PM' && hour !== 12) {
    hour += 12;
  }
  if (period === 'AM' && hour === 12) {
    hour = 0;
  }

  return (hour < 10 ? '0' + hour : hour) + ':00:00';
}



</script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function () {
        <?php if (isset($_SESSION['booked']) && $_SESSION['booked'] === true): ?>
            var myModal = new bootstrap.Modal(document.getElementById('successModal'));
            myModal.show();
            <?php unset($_SESSION['booked']); ?>  <!-- Unset session variable after modal is shown -->
        <?php endif; ?>
    });
</script>

<script src="../../function/script/chatbot-toggle.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
<script src="../../function/script/tab-bar.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>

</html>