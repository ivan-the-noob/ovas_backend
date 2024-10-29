<?php
  session_start();
  include 'index_connection.php';
  $profilePicture = isset($_SESSION['profile_picture']) ? $_SESSION['profile_picture'] : 'assets/img/customer.jfif';
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pawfect</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
  <link rel="icon" href="assets/img/logo.png" type="image/x-icon">
  <link rel="stylesheet" href="features/users/css/index.css">


</head>

<body>


  <nav class="navbar navbar-expand-lg navbar-light">
    <div class="container">
      <a class="navbar-brand d-none d-md-block" href="#">
      <img src="assets/img/<?php echo $logo_path; ?>" alt="Logo" width="30" height="30"> 
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
            <a class="nav-link" href="#">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#about-us">About Us</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#services">Our Services</a>
          </li>
        </ul>

        <div class="d-flex ml-auto align-items-center">
    <?php if (isset($_SESSION['email'])): ?>
        <div class="dropdown first-dropdown">
            <button type="button" id="dropdownMenuButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-bell"></i>
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                <h5 class="notification-title">Notification</h5>
                <div class="notification-content alert alert-success">
                    <strong>Appointment Confirmed!</strong>
                    <p class="notification-text">Your appointment has been confirmed!</p>
                    <p class="code">Code: OVAS-01234</p>
                    <a href="/features/users/web/api/appointment.html" onclick="localStorage.setItem('showBookedHistory', 'true');">View Details</a>
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
            <button class="dropdown-toggle" type="button" id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <img src="assets/img/profile/<?php echo $profilePicture; ?>" alt="Profile" class="profile">
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                <a class="dropdown-item" href="features/users/web/api/dashboard.php">Profile</a>
                <a class="dropdown-item" href="features/users/web/api/logout.php">Logout</a>
            </div>
        </div>
    <?php else: ?>

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
          <p>Welcome to Bark Yard Pet Wellness Center, your one-stop destination for pet
            grooming and care.</p>
            <a href="<?php echo isset($_SESSION['email']) ? 'features/users/web/api/appointment.php' : 'features/users/web/api/login.php'; ?>">
                <button class="btn btn-primary">Book an appointment</button>
            </a>
        </div>
      </div>
    </div>
  </section>

  <div class="wave-container1" id="about-us">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" class="wave1">
      <path fill="#7A3015" fill-opacity="1"
        d="M0,128L60,138.7C120,149,240,171,360,170.7C480,171,600,149,720,133.3C840,117,960,107,1080,112C1200,117,1320,139,1380,149.3L1440,160L1440,320L1380,320C1320,320,1200,320,1080,320C960,320,840,320,720,320C600,320,480,320,360,320C240,320,120,320,60,320L0,320Z">
      </path>
    </svg>
  </div>
  <section class="about-us py-5">
    <div class="container">
      <div class="row">
        <div class="col-md-4">
          <img src="assets/img/vet logo.jpg" class="img-fluid" alt="Vet Logo">
        </div>
        <div class="col-md-8">
          <h3 class="mt-3">About Us</h3>
          <p class="about-text"><?php echo $about_us; ?></p>
          <a href="features/users/web/api/about-us.php"><button class="btn btn-primary mt-3">Read More</button></a>
        </div>
      </div>
    </div>
  </section>
  <div class="wave-container">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 160" class="wave2">
      <path fill="#7A3015" fill-opacity="1"
        d="M0,80L40,72C80,64,160,48,240,56C320,64,400,96,480,98.65C560,101.5,640,74.5,720,69.35C800,64,880,80,960,77.35C1040,74.5,1120,53.5,1200,48C1280,42.5,1360,53.5,1400,58.65L1440,64L1440,160L1400,160C1360,160,1280,160,1200,160C1120,160,1040,160,960,160C880,160,800,160,720,160C640,160,560,160,480,160C400,160,320,160,240,160C160,160,80,160,40,160L0,160Z">
      </path>
    </svg>
  </div>
  <section class="services" id="services">
    <h3>Services Category</h3>

    <div class="checkbox-container text-start">
      <label>
        <input type="checkbox" id="medical-checkbox" onclick="filterServices()" checked> Medical Services
      </label>
      <label>
        <input type="checkbox" id="non-medical-checkbox" onclick="filterServices()"> Non-Medical Services
      </label>
    </div>

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
                          <p class="d-flex ml-5 price"><i class="fa-solid fa-tag"></i> <?php echo number_format($service['cost'], 2); ?></p>
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
    <h3 class="mb-4" id="review">Why Choose Us</h3>
    <div class="container">
        <div class="row">
           <?php  
              include 'features/users/function/php/review.php'; 
           ?>
        </div>
    </div>
</section>



  <section class="review">
    <div class="container review-section">
      <div class="row justify-content-center">
        <div class="col-md-8">
          <h2 class="text-center">Leave Us A Review</h2>
          <form class="review-form" action="features/users/function/php/process_review.php" method="POST">
            <div class="form-group">
              <textarea class="form-control" name="comment" id="comment" rows="4" placeholder="Leave Your Comment" required></textarea>
            </div>
            <button type="submit" class="mt-3 submit">Submit</button>
          </form>
        </div>
      </div>
    </div>
</section>
  <div class="wave-container1" id="about-us">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 160" class="wave1">
      <path fill="#7A3015" fill-opacity="1"
        d="M0,80L40,72C80,64,160,48,240,56C320,64,400,96,480,98.65C560,101.5,640,74.5,720,69.35C800,64,880,80,960,77.35C1040,74.5,1120,53.5,1200,48C1280,42.5,1360,53.5,1400,58.65L1440,64L1440,160L1400,160C1360,160,1280,160,1200,160C1120,160,1040,160,960,160C880,160,800,160,720,160C640,160,560,160,480,160C400,160,320,160,240,160C160,160,80,160,40,160L0,160Z">
      </path>
    </svg>
  </div>
  <footer class="footer" id="reviews">
    <div class="container">
      <div class="row">
        <div class="col-md-4">
          <h5>Pawfect</h5>
          <ul class="list-unstyled">
            <li><a href="#home">Home</a></li>
            <li><a href="#about">About Us</a></li>
            <li><a href="#services">Our Services</a></li>
            <li><a href="#review">Review</a></li>
          </ul>
        </div>
        <div class="col-md-4">
          <h5>Follow Us</h5>
          <ul class="list-unstyled">
            <li><a href="https://facebook.com" target="_blank"><i class="fab fa-facebook-f"></i> Facebook</a></li>
            <li><a href="https://instagram.com" target="_blank"><i class="fab fa-instagram"></i> Instagram</a></li>
            <li><a href="https://youtube.com" target="_blank"><i class="fab fa-youtube"></i> YouTube</a></li>
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
            include 'db.php';

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
                <img src="assets/img/logo.png" alt="Admin">
                <p>Admin</p>
            </div>
            <p class="text" id="typing-text">Hello, I am Chat Bot. Please ask me a question by pressing the question buttons.</p>
        </div>
      
    </div>

</div>

</body>
<script src="features/users/function/script/chat-bot.js"></script>
<script src="features/users/function/script/services-check.js"></script>
<script src="features/users/function/script/chatbot-toggle.js"></script>
<script src="features/users/function/script/scroll-choose_us.js"></script>
<script src="features/users/function/script/scroll-service.js"></script>
<script src="features/users/function/script/loading_animation.js"></script>
<script src="features/users/function/script/services-carousel.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

</html>