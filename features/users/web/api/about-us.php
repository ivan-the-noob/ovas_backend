<?php 
  include '../../../../index_connection.php';
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
  <link rel="stylesheet" href="../../css/about-us.css">

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
            <a class="nav-link" href="#">About Us</a>
          </li>
        </ul>
        <div class="d-flex ml-auto align-items-center">
          <div class="dropdown first-dropdown">
            <button class="" type="button" id="dropdownMenuButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-bell"></i>
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                <h5 class="notification-title">Notification</h5>
                <div class="notification-content alert alert-success">
                  <strong>Appointment Confirmed!</strong>
                  <p class="notification-text">Your appointment has been confirmed!</p>
                  <p class="code">Code:   OVAS-01234</p>
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
          <!--Notification End-->
          <div class="dropdown">
              <button class=" dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <img src="../../../../assets/img/customer.jfif" alt="" class="profile">
              </button>
              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                  <a class="dropdown-item" href="../../../users/web/api/dashboard.html">Profile</a>
                  <a class="dropdown-item" href="login.html">Logout</a>
              </div>
          </div>
        </div>
      </div>
    </div>
  </nav>
    <!--About Us Section-->
  <section class="about-us py-5">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-8">
          <img src="../../../../assets/img/map.PNG" alt="Map Image" class="img-fluid">
          <h3 class="mt-4">About Us</h3>
          <p class="about-text"><?php echo $about_us; ?></p>
        </div>
      </div>
    </div>
    <div class="contact">
      <div class=" text-center my-5">
        <div class="row mt-4">
          <div class="col-lg-2 col-md-12 mb-4 d-flex flex-column align-items-center">
            <div class="contact-card">
              <div class="contact-icon">
                <img src="../../../../assets/svg/call-icon.svg" alt="Call Icon">
              </div>
              <div class="contact-title">Call</div>
              <div class="contact-info"><?php echo $contact_num; ?></div>
            </div>
          </div>

          <div class="col-lg-2 col-md-12 mb-4 d-flex flex-column align-items-center">
            <div class="contact-card">
              <div class="contact-icon">
                <img src="../../../../assets/svg/email-icon.svg" alt="Email Icon">
              </div>
              <div class="contact-title">Email</div>
              <div class="contact-info"><?php echo $email; ?></div>
            </div>
          </div>
          <div class="col-lg-2 col-md-12 mb-4 d-flex flex-column align-items-center">
            <div class="contact-card">
              <div class="contact-icon">
                <img src="../../../../assets/svg/location-icon.svg" alt="Location Icon">
              </div>
              <div class="contact-title">Location</div>
              <div class="contact-info">
                <p><?php echo $location; ?></p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
    <!--About Us Section End-->
  <div class="wave-container1" id="about-us">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 160" class="wave1">
      <path fill="#7A3015" fill-opacity="1"
        d="M0,80L40,72C80,64,160,48,240,56C320,64,400,96,480,98.65C560,101.5,640,74.5,720,69.35C800,64,880,80,960,77.35C1040,74.5,1120,53.5,1200,48C1280,42.5,1360,53.5,1400,58.65L1440,64L1440,160L1400,160C1360,160,1280,160,1200,160C1120,160,1040,160,960,160C880,160,800,160,720,160C640,160,560,160,480,160C400,160,320,160,240,160C160,160,80,160,40,160L0,160Z">
      </path>
    </svg>
  </div>

     <!--Why Choose Us Section-->
  <section class="why-choose-us py-5">
    <div class="container">
      <h3>Heres A Reason Why Choose Us</h3>
      <div class="row">
        <div class="col-md-4 mb-4">
          <div class="card h-100 text-center">
            <div class="card-body">
              <div class="icon mb-3">
                <i class="fas fa-heart fa-2x" style="color: #7A3015;"></i>
              </div>
              <h5 class="card-title h-5">Expert Care & Compassion</h5>
              <p class="card-text">Our experienced team is passionate about animals and dedicated to providing top-notch
                care. We treat every pet like our own, ensuring they receive the love and attention they deserve.</p>
            </div>
          </div>
        </div>
        <div class="col-md-4 mb-4">
          <div class="card h-100 text-center">
            <div class="card-body">
              <div class="icon mb-3">
                <i class="fas fa-paw fa-2x" style="color: #7A3015;"></i>
              </div>
              <h5 class="card-title">Comprehensive Services</h5>
              <p class="card-text">We offer a wide range of services, from grooming to veterinary care, all under one
                roof. Whether your pet needs a spa day, a routine check-up, or specialized treatment, we've got you
                covered.</p>
            </div>
          </div>
        </div>
        <div class="col-md-4 mb-4">
          <div class="card h-100 text-center">
            <div class="card-body">
              <div class="icon mb-3">
                <i class="fas fa-home fa-2x" style="color: #7A3015;"></i>
              </div>
              <h5 class="card-title">Friendly & Safe Environment</h5>
              <p class="card-text">Our facility is designed to be a welcoming and safe space for pets and their owners.
                We prioritize cleanliness and create a stress-free atmosphere, making your pet's visit comfortable and
                enjoyable.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
    <!--Why Choose Us Section End-->
  <div class="wave-container">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 160" class="wave2">
      <path fill="#7A3015" fill-opacity="1"
        d="M0,80L40,72C80,64,160,48,240,56C320,64,400,96,480,98.65C560,101.5,640,74.5,720,69.35C800,64,880,80,960,77.35C1040,74.5,1120,53.5,1200,48C1280,42.5,1360,53.5,1400,58.65L1440,64L1440,160L1400,160C1360,160,1280,160,1200,160C1120,160,1040,160,960,160C880,160,800,160,720,160C640,160,560,160,480,160C400,160,320,160,240,160C160,160,80,160,40,160L0,160Z">
      </path>
    </svg>
  </div>
  <section class="discount">
    <h3 class="text-center">Get 5% OFF On All Services Today!</h3>
    <a href="#"><button>Book Now!</button></a>
  </section>
  <div class="wave-container1" id="about-us">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 160" class="wave1">
      <path fill="#7A3015" fill-opacity="1"
        d="M0,80L40,72C80,64,160,48,240,56C320,64,400,96,480,98.65C560,101.5,640,74.5,720,69.35C800,64,880,80,960,77.35C1040,74.5,1120,53.5,1200,48C1280,42.5,1360,53.5,1400,58.65L1440,64L1440,160L1400,160C1360,160,1280,160,1200,160C1120,160,1040,160,960,160C880,160,800,160,720,160C640,160,560,160,480,160C400,160,320,160,240,160C160,160,80,160,40,160L0,160Z">
      </path>
    </svg>
  </div>
    <!--Footer-->
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
          <p>Email: bardyardpets@gmail.com</p>
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
    <!--Footer End-->

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
    <!--Chat Bot End-->



</body>
<script src="../../function/script/chatbot_questionslide.js"></script>
<script src="../../function/script/chatbot-toggle.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

</html>