<?php 
    session_start();  

    if (!isset($_SESSION['email']) || $_SESSION['role'] !== 'admin') {
        header("Location: ../../../users/web/api/login.php");
        exit(); 
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
            <a href="admin.html">
                <i class="fa-solid fa-gauge"></i>
                <span>Dashboard</span>
            </a>
            <a href="app-req.html">
                <i class="fa-regular fa-calendar-check"></i>
                <span>Appointment Request</span>
            </a>
            <a href="app-records.html" class="navbar-highlight">
                <i class="fa-regular fa-calendar-check"></i>
                <span>Patients Records</span>
            </a>
            <a href="app-records-list.html">
                <i class="fa-regular fa-calendar-check"></i>
                <span>Record Lists</span>
            </a>
            <a href="pos.html">
                <i class="fas fa-cash-register"></i>
                <span>Point of Sales</span>
            </a>
            <a href="transaction.html">
                <i class="fas fa-exchange-alt"></i>
                <span>Transaction</span>
            </a>
            <div class="maintenance">
                <p class="maintenance-text">Maintenance</p>
                <a href="category-list.html" >
                    <i class="fa-solid fa-list"></i>
                    <span>Category List</span>
                </a>
                <a href="service-list.html">
                    <i class="fa-solid fa-layer-group"></i>
                    <span>Service List</span>
                </a>
                <a href="admin-user.html">
                    <i class="fa-solid fa-user-tie"></i>
                    <span>Admin User List</span>
                </a>
                <a href="settings.html">
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
                    <button class="" type="button" id="notificationDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-bell"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="notificationDropdown">
                        <li class="dropdown-header">
                            <h5 class=" mb-0">Notification</h5>
                        </li>
                        <li class="dropdown-item">
                            <div class="alert alert-primary mb-0">
                                <strong>Successfully Booked!</strong>
                                <p>Rachel booked an appointment! <a href="#" class="alert-link">Check it now!</a></p>                               
                            </div>
                        </li>
                        <li class="dropdown-item">
                            <div class="alert alert-danger mb-0">
                                <strong>Decline</strong>
                                <p>Admin Kim declined Jana's appointment.<a href="#" class="alert-link">See here.</a></p> 
                            </div>
                        </li>
                        <li class="dropdown-item">
                            <div class="alert alert-success mb-0">
                                <strong>Paid!</strong>
                                <p>James paid the bill.</p> 
                            </div>
                        </li>
                        <li class="dropdown-item">
                            <div class="alert alert-primary mb-0">
                                <strong>Successfully Booked!</strong>
                                <p>Rachel booked an appointment! <a href="#" class="alert-link">Check it now!</a></p>                               
                            </div>
                        </li>
                       
                    </ul>
                </div>
                <div class="dropdown">
                    <button class="" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="../../../../assets/img/vet logo.jpg" style="width: 40px; height: 40px; object-fit: cover;">
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="../../../users/web/api/login.html">Logout</a></li>
                    </ul>
                </div>
            </div>
        </div>
         <!--Notification and Profile Admin End-->

        <!--Input fields of Patients Records-->
        <div class="app-req">
          <h3>Patients Records</h3>
          <div class="container px-5 pt-3">
              <div class="row justify-content-center">
                  <!-- Client Information -->
                  <div class="col-md-3">
                    <h6>Client Information</h6>
                    <div class="mb-3">
                      <label for="ownerName" class="form-label">Client Name</label>
                      <input type="text" class="form-control" id="ownerName" placeholder="Racel Mae Loquellano">
                    </div>
                    <div class="mb-3">
                      <label for="ownerAddress" class="form-label">Complete Address</label>
                      <textarea class="form-control" id="ownerAddress" rows="3"
                        placeholder="2nd Floor A & A Building Magdiwang Highway"></textarea>
                    </div>
                    <div class="mb-3 contacts">
                      <label for="contactNum" class="form-labels">Contact Details</label>
                      <input type="number" class="form-control" id="contactNum" placeholder="Mobile">
                      <input type="number" class="form-control" id="contactNum" placeholder="Home">
                      <input type="number" class="form-control" id="contactNum" placeholder="Work">
                      <input type="number" class="form-control" id="contactNum" placeholder="Viber">
                    </div>
                    <div class="mb-3">
                      <label for="ownerEmail" class="form-label">Email</label>
                      <input type="email" class="form-control" id="ownerEmail" placeholder="bardyardpets@gmail.com">
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
                  <div class="col-md-3">
                    <h6>Pet Information</h6>
                    <div class="mb-3">
                      <label for="pet-name" class="form-label">Pet's Name</label>
                      <input type="text" class="form-control" placeholder="Ara" id="pet-name">
                    </div>
                    <div class="mb-3">
                      <label for="petType" class="form-label">Species</label>
                      <select class="form-control" id="petType">
                        <option>Cat</option>
                        <option>Dog</option>
                        <option>Rabit</option>
                        <option>Reptile</option>
                      </select>
                    </div>
                    <div class="mb-3">
                      <label for="petType" class="form-label">Sex</label>
                      <select class="form-control" id="sex">
                        <option>Male Intact</option>
                        <option>Male Neutered (kapon)</option>
                        <option>Female Intact</option>
                        <option>Female Spayed (kapon)</option>
                      </select>
                    </div>
                    <div class="mb-3">
                      <label for="breed" class="form-label">Breed</label>
                      <input type="text" class="form-control" placeholder="husky" id="breed">
                    </div>
                    <div class="mb-3">
                      <label for="Color & markings" class="form-label">Colors and Marking</label>
                      <input type="text" class="form-control" placeholder="White" id="color-markings">
                    </div>
                    <div class="mb-3">
                      <label for="Microchip No" class="form-label">Microchip No.</label>
                      <input type="number" class="form-control" placeholder="312421" id="micro-no">
                    </div>
                    <div class="mb-3">
                      <label for="Date of Birth" class="form-label">Date of Birth</label>
                      <input type="date" class="form-control" placeholder="01/01/24" id="micro-no">
                    </div>
                    <div class="mb-3">
                      <label for="age" class="form-label">Age</label>
                      <input type="number" class="form-control" placeholder="Months" id="age">
                    </div>  
                  </div> 
                  <div class="col-md-3">
                    <h6>Services</h6>
                    <div class="mb-3">
                      <label for="serviceCategory" class="form-label">Service Category</label>
                      <div class="dropdowns">
                        <button class="dropdown-toggle" type="button" id="serviceCategoryDropdown"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Select Category
                </button>
                        <div class="dropdown-menu" aria-labelledby="serviceCategoryDropdown">
                          <a class="dropdown-item" href="#" data-value="medical">Medical</a>
                          <a class="dropdown-item" href="#" data-value="nonMedical">Non-Medical</a>
                        </div>
                      </div>
                    </div>
                    <div class="mb-3">
                      <label for="service" class="form-label">Service</label>
                      <div class="dropdowns">
                        <button class=" dropdown-toggle" type="button" id="serviceDropdown"
                          data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          Select Service
                        </button>
                        <div class="dropdown-menu" aria-labelledby="serviceDropdown">
                          <!-- Medical Services -->
                          <div class="medical-services">
                            <a class="dropdown-item" href="#" data-value="1200.00">Diagnostic and Therapeutic -
                              ₱1200.00</a>
                            <a class="dropdown-item" href="#" data-value="850.00">Preventive Health Care - ₱850.00</a>
                            <a class="dropdown-item" href="#" data-value="1500.00">Internal Medicine Consults -
                              ₱1500.00</a>
                            <a class="dropdown-item" href="#" data-value="2500.00">Surgical Services - ₱2500.00</a>
                            <a class="dropdown-item" href="#" data-value="300.00">Pharmacy - ₱300.00</a>
                            <a class="dropdown-item" href="#" data-value="500.00">House Visit - ₱500.00</a>
                          </div>
                          <!-- Non-Medical Services -->
                          <div class="nonMedical-services">
                            <a class="dropdown-item" href="#" data-value="999.00">Grooming - ₱999.00</a>
                            <a class="dropdown-item" href="#" data-value="700.00">Boarding - ₱700.00</a>
                            <a class="dropdown-item" href="#" data-value="300.00">Pet Supplies - ₱300.00</a>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="mt-3">
                      <label for="totalPayment" class="form-label">Total Payment</label>
                      <p id="totalPayment">₱0.00</p>
                    </div>     
                  </div>
                  <div class="col-md-3">
                    <h6>Other Information</h6>
                    <div class="mb-3">
                      <label for="Color & markings" class="form-label">Date</label>
                      <input type="date" class="form-control" placeholder="White" id="color-markings">
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
                      <textarea class="form-control" id="entering-complaint" rows="5"></textarea>
                    </div>
                    <div class="mb-3">
                      <label for="history-physical-diagnosis-treatment" class="form-label">History • Physical Findings • Diagnosis • Treatment</label>
                      <textarea class="form-control" id="history-physical-diagnosis-treatment" rows="5"></textarea>
                    </div>
                    <div class="mb-3">
                      <button class="book-save">Save</button>
                    </div>
                  </div>

                  </div>
                 
                </div>
          </div>
           <!--Input fields of Patients Records-->
           
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