<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
 
  <!--Connection Vercel and Local Host-->
  <script>
    const isVercel = window.location.hostname.includes('vercel.app');    
    const cssPath = isVercel ? '/features/users/css/index.css' : '../ovas_first/features/users/css/index.css'; 
    const linkElement = document.createElement('link');
    linkElement.rel = 'stylesheet';
    linkElement.href = cssPath;
    document.head.appendChild(linkElement);
</script>

<script>
  const isLocal = !window.location.hostname.includes('vercel.app');

  document.addEventListener('DOMContentLoaded', function() {
      if (isLocal) {
          const images = document.querySelectorAll('img');
          images.forEach(img => {
              if (!img.src.startsWith('http')) {
                  img.src = `../ovas_first${img.getAttribute('src')}`;
              }
          });

          const links = document.querySelectorAll('a');
          links.forEach(link => {
              const href = link.getAttribute('href');
              if (!href.startsWith('http') && !href.startsWith('#')) {
                  link.setAttribute('href', `../ovas_first/${href}`);
              }
          });
      }
  });

  const basePath = isLocal ? '../ovas_first/' : '';
  const scripts = [
      'features/users/function/script/services-check.js',
      'features/users/function/script/chatbot-toggle.js',
      'features/users/function/script/scroll-choose_us.js',
      'features/users/function/script/scroll-service.js',
      'features/users/function/script/services-carousel.js'
  ];

  scripts.forEach(script => {
      const scriptElement = document.createElement('script');
      scriptElement.src = basePath + script;
      document.head.appendChild(scriptElement);
  });
</script>

  <!--Connection Vercel and Local Host End-->
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-light">
    <div class="container">
      <a class="navbar-brand d-none d-md-block" href="#">
        <img src="/assets/img/logo.png" alt="Logo" width="30" height="30">
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

        <div class="d-flex ml-auto">
          <a href="/features/users/web/api/login.html" class="btn-theme" type="button">Login</a>
        </div>
      </div>
    </div>
  </nav>

  <section class="front py-5 relative-container">
    <div class="paws">
      <img src="/assets/img/foot2.png" class="foot2" alt="Paw Print 2">
      <img src="/assets/img/foot3.png" class="foot3" alt="Paw Print 3">
    </div>
    <div class="container">
      <div class="row align-items-center">
        <div class="col-md-6 order-1 order-md-2 text-center">
          <img src="/assets/img/about-us.png" alt="Vet Logo" class="img-fluid">
        </div>
        <div class="col-md-6 order-2 order-md-1 text-md-left mb-4 mb-md-0 front-text">
          <h4>Book Your Pet's Next Appointment with Ease!</h4>
          <p>Welcome to <span class="vets-name">Bark Yard Pet Wellness Center</span>, your one-stop destination for pet
            grooming and care.</p>
          <a href="/features/users/web/api/login.html"><button class="btn btn-primary">Book an
              appointment</button></a>
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
          <img src="/assets/img/vet logo.jpg" class="img-fluid" alt="Vet Logo">
        </div>
        <div class="col-md-8">
          <h3 class="mt-3">About Us</h3>
          <p class="about-text">
            <span class="font-weight-bold">The Bark Yard Pet Salon and Wellness Clinic</span> is an animal care facility
            dedicated to providing high customer satisfaction by rendering quality pet care while furnishing a fun,
            clean, thematic, enjoyable atmosphere at an acceptable price. Our experienced team is passionate about
            animals and committed to their well-being. We offer a range of services tailored to meet the unique needs of
            each pet, ensuring they leave happy and healthy.
          </p>
          <a href="/features/users/web/api/about-us.html"><button class="btn btn-primary mt-3">Read More</button></a>
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

          <div class="service-card medical-service">
            <div class="card">
              <div class="card-body text-center">
                <div class="card-header">
                  <h5 class="card-title mt-2">Diagnostic and Therapeutic</h5>
                  <div class="discount-label text-center">
                    <p>10% Off</p>
                  </div>
                </div>
                <p class="d-flex ml-5 price"><i class="fa-solid fa-tag"></i> 1200.00</p>
                <p class="card-text">Comprehensive diagnostic and therapeutic services.</p>
              </div>
            </div>
          </div>
          <div class="service-card medical-service">
            <div class="card">
              <div class="card-body text-center">
                <div class="card-header">
                  <h5 class="card-title mt-2">Preventive Health Care</h5>
                  <i class="fa-solid fa-shield-heart mr-2"></i>
                </div>
                <p class="d-flex ml-5 price"><i class="fa-solid fa-tag"></i> 850.00</p>
                <p class="card-text">Preventive services to maintain your pet's health.</p>
              </div>
            </div>
          </div>
          <div class="service-card medical-service">
            <div class="card">
              <div class="card-body text-center">
                <div class="card-header">
                  <h5 class="card-title mt-2">Internal Medicine Consults</h5>
                  <i class="fa-solid fa-notes-medical mr-2"></i>
                </div>
                <p class="d-flex ml-5 price"><i class="fa-solid fa-tag"></i> 1500.00</p>
                <p class="card-text">Expert consultations in internal medicine.</p>
              </div>
            </div>
          </div>
          <div class="service-card medical-service">
            <div class="card">
              <div class="card-body text-center">
                <div class="card-header">
                  <h5 class="card-title mt-2">Surgical Services</h5>
                  <i class="fa-solid fa-user-md mr-2"></i>
                </div>
                <p class="d-flex ml-5 price"><i class="fa-solid fa-tag"></i> 2500.00</p>
                <p class="card-text">Professional surgical services for your pets.</p>
              </div>
            </div>
          </div>
          <div class="service-card medical-service">
            <div class="card">
              <div class="card-body text-center">
                <div class="card-header">
                  <h5 class="card-title mt-2">Pharmacy</h5>
                  <i class="fa-solid fa-pills mr-2"></i>
                </div>
                <p class="d-flex ml-5 price"><i class="fa-solid fa-tag"></i> 300.00</p>
                <p class="card-text">Wide range of medications available at our pharmacy.</p>
              </div>
            </div>
          </div>
          <div class="service-card medical-service">
            <div class="card">
              <div class="card-body text-center">
                <div class="card-header">
                  <h5 class="card-title mt-2">House Visit</h5>
                  <i class="fa-solid fa-house-medical mr-2"></i>
                </div>
                <p class="d-flex ml-5 price"><i class="fa-solid fa-tag"></i> 500.00</p>
                <p class="card-text">House visit services for pets needing at-home care.</p>
              </div>
            </div>
          </div>

          <div class="service-card non-medical-service">
            <div class="card">
              <div class="card-body text-center">
                <div class="card-header">
                  <h5 class="card-title mt-2">Grooming</h5>
                  <i class="fa-solid fa-scissors fa-2x"></i>\
                  <div class="discount-label text-center">
                    <p>10% Off</p>
                  </div>
                </div>
                <p class="d-flex ml-5 price"><i class="fa-solid fa-tag"></i> 999.00</p>
                <p class="card-text">Professional grooming services to keep your pets looking their best.</p>
              </div>
            </div>
          </div>
          <div class="service-card non-medical-service">
            <div class="card">
              <div class="card-body text-center">
                <div class="card-header">
                  <h5 class="card-title mt-2">Boarding</h5>
                  <i class="fa-solid fa-paw mr-2"></i>
                </div>
                <p class="d-flex ml-5 price"><i class="fa-solid fa-tag"></i> 700.00</p>
                <p class="card-text">Comfortable and safe boarding services for your pets.</p>
              </div>
            </div>
          </div>
          <div class="service-card non-medical-service">
            <div class="card">
              <div class="card-body text-center">
                <div class="card-header">
                  <h5 class="card-title mt-2">Pet Supplies</h5>
                  <i class="fa-solid fa-bone mr-2"></i>
                </div>
                <p class="d-flex ml-5 price"><i class="fa-solid fa-tag"></i> 300.00</p>
                <p class="card-text">A wide range of pet supplies for your pet's needs.</p>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
  </section>



  <section class="choose-us py-5" id="choose-us">
    <h3 class="mb-4" id="review">Why Choose Us</h3>
    <div class="container ">
      <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-12">
          <div class="testimonial-card-custom p-3 review-box" id="translate-1">
            <div class="d-flex align-items-center">
              <img src="/assets/img/customer.jfif" alt="Ivan Ablanida" width="50" height="50">
              <div class="ml-3">
                <p class="testimonial-title">Ivan Ablanida</p>
              </div>
            </div>
            <p class="mt-3">Booking a pet appointment at Pawfect was a breeze. The staff was incredibly friendly, and
              the online booking system made it simple to schedule a visit. Highly recommended for anyone looking for a
              hassle-free experience.</p>
          </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12">
          <div class="testimonial-card-custom p-3 review-box" id="translate-2">
            <div class="d-flex align-items-center">
              <img src="/assets/img/customer.jfif" alt="Jannray Mostajo" width="50" height="50">
              <div class="ml-3">
                <p class="testimonial-title">Jannray Mostajo</p>
              </div>
            </div>
            <p class="mt-3">The appointment booking process was seamless. The user-friendly platform allowed me to
              easily select a time slot that fit my schedule. The clinic's professionalism and care for my pet made the
              experience even better.</p>
          </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12">
          <div class="testimonial-card-custom p-3 review-box" id="translate-3">
            <div class="d-flex align-items-center">
              <img src="/assets/img/customer.jfif" alt="Prince Jherico" width="50" height="50">
              <div class="ml-3">
                <p class="testimonial-title">Prince Jherico</p>
              </div>
            </div>
            <p class="mt-3">I was impressed with how easy it was to book an appointment for my pet. The online system
              was intuitive, and I appreciated the reminder notifications. The staff was welcoming and knowledgeable,
              making the entire process smooth and stress-free.</p>
          </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12">
          <div class="testimonial-card-custom p-3 review-box" id="translate-4">
            <div class="d-flex align-items-center">
              <img src="/assets/img/customer.jfif" alt="Johnloyd Belen" width="50" height="50">
              <div class="ml-3">
                <p class="testimonial-title">Johnloyd Belen</p>
              </div>
            </div>
            <p class="mt-3">Booking a pet appointment at Pawfect was incredibly convenient. The staff was responsive and
              caring, ensuring a positive experience for both me and my pet. The efficient booking system saved me time
              and made the process effortless.</p>
          </div>
        </div>

      </div>
    </div>
  </section>


  <section class="review">
    <div class="container review-section">
      <div class="row justify-content-center">
        <div class="col-md-8">
          <h2 class="text-center">Leave Us A Review</h2>
          <form class="review-form">
            <div class="form-group">
              <textarea class="form-control" id="comment" rows="4" placeholder="Leave Your Comment"></textarea>
            </div>
            <button type="submit" class="mt-3 submit ">Submit</button>
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
        <img src="/assets/img/vet logo.jpg" alt="Admin">
        <p>Admin</p>
      </div>
      <p class="text">Hello, I am Chat Bot. Please Ask me a question just by pressing the question buttons.</p>
    </div>
  </div>



</body>
<script src="/features/users/function/script/services-check.js"></script>
<script src="/features/users/function/script/chatbot-toggle.js"></script>
<script src="/features/users/function/script/scroll-choose_us.js"></script>
<script src="/features/users/function/script/scroll-service.js"></script>
<script src="/features/users/function/script/services-carousel.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

</html>