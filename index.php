<?php
  session_start();
  include 'index_connection.php';
  

require 'db.php';

if (isset($_SESSION['email'])) {
  $userEmail = $_SESSION['email']; 
} else {
  echo '';  
}

$userEmail = $_SESSION['email'] ?? null;

$email = $_SESSION['email'] ?? null;
$bookingLimitReached = false;
$bookingCount = 0;

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
  echo null;
}

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
    }
}


$notifications = [];

try {
    $stmt = $conn->prepare("SELECT * FROM notifications WHERE email = :email ORDER BY created_at DESC");
    $stmt->bindParam(':email', $userEmail);
    $stmt->execute();
    $notifications = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {

    error_log("Error fetching notifications: " . $e->getMessage());
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
  <link rel="icon" href="assets/img/logo.png" type="image/x-icon">
  <title>Pawfect</title>
  <link rel="stylesheet" href="features/users/css/index.css">


</head>

<body>


<nav class="navbar navbar-expand-lg navbar-light">
  <div class="container">
    <a class="navbar-brand d-none d-md-block" href="#">
      <img src="assets/img/<?php echo $logo_path; ?>" alt="Logo" width="30" height="30"> 
    </a>

    <!-- Toggle button for mobile menu -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" 
      aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="stroke: black; fill: none;">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
      </svg>
    </button>

    <!-- Navbar content -->
    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="#">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#about-us">About Us</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#services">Our Services</a>
        </li>
        <?php if (isset($_SESSION['email'])): ?>
          <li class="nav-item">
            <a class="nav-link" href="features/users/web/api/appointments.php">Appointment</a>
          </li>
        <?php endif; ?>
      </ul>

      <!-- User profile and notifications -->
      <div class="d-flex ml-auto align-items-center">
        <?php if (isset($_SESSION['email'])): ?>
          <div class="dropdown first-dropdown">
            <button class="btn" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="fas fa-bell"></i>
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
              <h5 class="notification-title">Notification</h5>
              <?php if (!empty($notifications)): ?>
                <?php foreach ($notifications as $notification): ?>
                  <li>
                    <div class="notification-content alert alert-<?= $notification['type'] === 'confirm' ? 'success' : ($notification['type'] === 'cancel' || $notification['type'] === 'decline' ? 'danger' : 'primary') ?>">
                      <strong><?= ucfirst($notification['type']) ?>!</strong>
                      <p class="notification-text"><?= htmlspecialchars($notification['message']) ?></p>
                      <?php if ($notification['type'] === 'confirm'): ?>
                        <p class="code">Code: <?= htmlspecialchars($notification['code']) ?></p>
                      <?php endif; ?>
                      <a href="features/users/web/api/appointments.php">View Details</a>
                    </div>
                  </li>
                <?php endforeach; ?>
              <?php else: ?>
                <li>
                  <div class="notification-content alert alert-secondary">
                    <p class="notification-text">No notifications available.</p>
                  </div>
                </li>
              <?php endif; ?>
            </ul>
          </div>

          <!-- Profile dropdown -->
          <div class="dropdown second-dropdown">
            <button class="dropdown-toggle btn" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
              <img src="assets/img/profile/<?php echo $profilePicture; ?>" alt="Profile" class="profile">
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
              <li><a class="dropdown-item" href="features/users/web/api/settings.php">Profile</a></li>
              <li><a class="dropdown-item" href="features/users/web/api/profile.php">Settings</a></li>
              <li><a class="dropdown-item" href="features/users/web/api/logout.php">Logout</a></li>
            </ul>
          </div>

        <?php else: ?>
          <!-- Login button for non-logged in users -->
          <div class="d-flex ml-auto">
            <a href="features/users/web/api/login.php" class="btn-theme" type="button">Login</a>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </div>
</nav>
  <section class="front py-5 relative-container">
    <div class="paws">
      <img src="assets/img/foot2.png" class="foot2" alt="Paw Print 2">
      <img src="assets/img/foot3.png" class="foot3" alt="Paw Print 3">
    </div>
    <div class="container">
      <div class="row align-items-center">
        <div class="col-md-6 order-1 order-md-2 text-center">
          <img src="assets/img/about-us.png" alt="Vet Logo" class="img-fluid front-img">
        </div>
        <div class="col-md-6 order-2 order-md-1 text-md-left mb-4 mb-md-0 front-text">
          <h4>Book Your Pet's Next Appointment with Ease!</h4>
          <p class="text-white">Welcome to Bark Yard Pet Wellness Center, your one-stop destination for pet
            grooming and care.</p>
            <?php if ($userEmail): ?>
                <?php if ($bookingLimitReached): ?>
                    <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#limitModal">Book an Appointment</button>
                <?php else: ?>
                    <a href="features/users/web/api/appointment.php">
                        <button class="btn text-white" style="background-color: #74C2CD" >Book an Appointment</button>
                    </a>
                <?php endif; ?>
              
            <?php endif; ?>

            <!-- Modal -->
            <div class="modal fade" id="limitModal" tabindex="-1" aria-labelledby="limitModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="limitModalLabel">Booking Limit Reached</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            You booked 3 times today! Please come back again tomorrow.
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
      </div>
    </div>
  </section>

  
  <section class="about-us py-5" id="about-us">
    <div class="container">
      <div class="row">
        <div class="col-md-4">
          <img src="assets/img/vet logo.jpg" class="img-fluid" alt="Vet Logo">
        </div>
        <div class="col-md-8">
          <h3 class="mt-3">About Us</h3>
          <p class="about-text"><?php echo nl2br(htmlspecialchars($about_us)); ?></p>
          <a href="features/users/web/api/about-us.php"><button class="btn btn-primary mt-3">Read More</button></a>
        </div>
      </div>
    </div>
  </section>
  <div class="wave-container">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 160" class="wave2">
      <path fill="#EBBF86" fill-opacity="1"
        d="M0,80L40,72C80,64,160,48,240,56C320,64,400,96,480,98.65C560,101.5,640,74.5,720,69.35C800,64,880,80,960,77.35C1040,74.5,1120,53.5,1200,48C1280,42.5,1360,53.5,1400,58.65L1440,64L1440,160L1400,160C1360,160,1280,160,1200,160C1120,160,1040,160,960,160C880,160,800,160,720,160C640,160,560,160,480,160C400,160,320,160,240,160C160,160,80,160,40,160L0,160Z">
      </path>
    </svg>
  </div>
  <section class="services" id="services">
    <h3>Services Offered</h3>

    <div class="container mt-4">
        <div class="slider-container">
            <div class="slider-wrapper">
                <?php 
                    require 'db.php';
                    include 'features/admin/function/php/view_service.php';
                ?>
                <?php if (!empty($services)): ?> 
                    <?php foreach ($services as $service): ?>
                        <div class="service-card <?php echo $service['service_type'] == 'medical' ? 'medical-service' : 'non-medical-service'; ?>">
                            <div class="card">
                                <div class="card-body text-center">
                                    <div class="card-header">
                                        <h5 class="card-title mt-2"><?php echo htmlspecialchars($service['service_name']); ?></h5>
                                        <?php if ($service['discount'] > 0): ?>
                                            <div class="discount-label text-center">
                                                <p><?php echo round($service['discount']); ?>% OFF</p>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <p class="card-text"><?php echo htmlspecialchars($service['info']); ?></p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>




  <section class="choose-us py-5" id="choose-us">
    <h3 class="mb-4" id="review">Pet Parent Feedback</h3>
    <div class="container">
        <div class="row">
           <?php  
              include 'features/users/function/php/review.php'; 
           ?>
        </div>
    </div>
</section>



<?php if (isset($_SESSION['email'])): ?>
  <section class="review">
    <div class="container review-section">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h2 class="text-center">Leave Us A Review</h2>
                <form class="review-form" action="features/users/function/php/process_review.php" method="POST" enctype="multipart/form-data">
                    <div class="mb-3 d-flex justify-content-center">
                        <div class="star-rating mt-2">
                            <input type="radio" id="star5" name="rating" value="5" required />
                            <label for="star5" class="fa fa-star"></label>

                            <input type="radio" id="star4" name="rating" value="4" />
                            <label for="star4" class="fa fa-star"></label>

                            <input type="radio" id="star3" name="rating" value="3" />
                            <label for="star3" class="fa fa-star"></label>

                            <input type="radio" id="star2" name="rating" value="2" />
                            <label for="star2" class="fa fa-star"></label>

                            <input type="radio" id="star1" name="rating" value="1" />
                            <label for="star1" class="fa fa-star"></label>
                        </div>
                    </div>

                    <div class="form-group">
                        <textarea class="form-control" name="comment" id="comment" rows="4" placeholder="Leave Your Comment" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="image" class="form-label text-black mb-2" style="padding-left: 80px;">Upload Image (Optional)</label>
                        <input type="file" class="form-control d-flex" name="image" id="image" accept="image/*">
                    </div>


                    <button type="submit" class="mt-3 submit" style="#74C2CD;">Submit</button>
                </form>
            </div>
        </div>
    </div>
</section>

<?php endif; ?>

  <div class="wave-container1">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 160" class="wave1">
      <path fill="#EBBF86" fill-opacity="1"
        d="M0,80L40,72C80,64,160,48,240,56C320,64,400,96,480,98.65C560,101.5,640,74.5,720,69.35C800,64,880,80,960,77.35C1040,74.5,1120,53.5,1200,48C1280,42.5,1360,53.5,1400,58.65L1440,64L1440,160L1400,160C1360,160,1280,160,1200,160C1120,160,1040,160,960,160C880,160,800,160,720,160C640,160,560,160,480,160C400,160,320,160,240,160C160,160,80,160,40,160L0,160Z">
      </path>
    </svg>
  </div>
  <footer class="footer" id="reviews">
    <div class="container">
      <div class="row">
       
        <div class="col-md-4">
          <h5>Follow Us</h5>
          <ul class="list-unstyled">
            <li><a href="https://www.facebook.com/barkyardpetph?mibextid=ZbWKwL" target="_blank"><i class="fab fa-facebook-f"></i> Facebook</a></li>
           
          </ul>
        </div>
        <div class="col-md-4">
          <h5>Contact Us</h5>
          <p>Email: barkyardpets@gmail.com</p>
          <p>Phone: 09338182822</p>
        </div>
      </div>
      <div class="row">
        <div class="col text-center">
          <p>&copy; 2024 Pawfect. All Rights Reserved.</p>
        </div>
      </div>
    </div>
  </footer>



</body>
<script src="features/users/function/script/services-check.js"></script>
<script src="features/users/function/script/scroll-choose_us.js"></script>
<script src="features/users/function/script/scroll-service.js"></script>
<script src="features/users/function/script/loading_animation.js"></script>
<script src="features/users/function/script/services-carousel.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</html>