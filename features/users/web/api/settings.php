<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'user') {
    header('Location: login.php'); 
    exit();
}

// Include database connection
require_once '../../../../db.php'; // Ensure db.php defines $conn

$profilePicture = isset($_SESSION['profile_picture']) ? $_SESSION['profile_picture'] : 'assets/img/customer.jfif';
$name = isset($_SESSION['name']) ? $_SESSION['name'] : 'Name not set';
$email = isset($_SESSION['email']) ? $_SESSION['email'] : 'Email not set';
$lastname = isset($_SESSION['last_name']) ? $_SESSION['last_name'] : null;

$alert = '';

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
        } else {
            echo "No user found with the given email.";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "Session email is not set.";
}

if (isset($_SESSION['alert'])) {
    $alertType = htmlspecialchars($_SESSION['alert']['type']);
    $alertMessage = htmlspecialchars($_SESSION['alert']['message']);
    $alert = "<div class='alert alert-{$alertType}' role='alert'>{$alertMessage}</div>";
    unset($_SESSION['alert']);
}
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

  <div class="settings m-0 p-3 w-100 mt-4 ">
    <div class="row d-flex justify-content-center">
      <div class="col-md-3">
        <div class="profile">
        <img src="../../../../assets/img/profile/<?php echo htmlspecialchars($profilePicture, ENT_QUOTES, 'UTF-8'); ?>" alt="Profile" alt="Profile Picture" id="profileImg">
        </div>
      </div>
      <div class="col-md-5 mt-4">
          <h3><?php echo htmlspecialchars($name . ' ' . $lastname); ?></h3>
          <hr>
          <p><?php echo htmlspecialchars($address); ?></p>
          <p><?php echo htmlspecialchars($email); ?></p>
          <p><?php echo htmlspecialchars($contact_num); ?></p>
        </div>
    </div>
    <div class="col-md-12 update mt-4">
  <div class="row mt-4 d-flex justify-content-center">
 
    <div class="col-md-5">
    <form action="../../function/php/profile_update.php" method="POST" enctype="multipart/form-data">
      <label for="" class="w-50 bg-white title">CHANGE PASSWORD</label>
      <div class="d-flex mb-1">
      <label for="">CURRENT PASSWORD</label>
      <input type="password" class="form-control" name="current_password" id="currentPassword" placeholder="Enter current password">
      </div>
      <div class="d-flex mb-1">
      <label for="">NEW PASSWORD</label>
      <input type="password" class="form-control" name="new_password" id="newPassword" placeholder="Enter new password">
      </div>
      <div class="d-flex mb-1">
      <label for="">CONFIRM PASSWORD</label>
      <input type="password" class="form-control" name="confirm_password" id="confirmPassword" placeholder="Confirm new password">
      <div id="passwordError" class="text-danger mt-2" style="display: none;">Passwords do not match.</div>
      </div>
      <div class="d-flex justify-content-end save">
        <button type="submit">Save</button>
      </div>
    </div>
</form>
    <div class="col-md-5">
      
<form method="POST" action="../../function/php/update_details.php">
        <label for="" class="w-50 bg-white title">CHANGE DETAILS</label>
        <div class="d-flex mb-1">
            <label for="change_name">CHANGE NAME</label>
            <input type="text" class="form-control w-100" name="change_name" id="change_name" value="<?php echo htmlspecialchars($user['name']); ?>">
        </div>
        <div class="d-flex mb-1">
            <label for="change_address">CHANGE ADDRESS</label>
            <input type="text" class="form-control w-100" name="change_address" id="change_address" value="<?php echo htmlspecialchars($user['address']); ?>">
        </div>
        <div class="d-flex mb-1">
            <label for="change_number">CHANGE NUMBER</label>
            <input type="text" class="form-control w-100" name="change_number" id="change_number" value="<?php echo htmlspecialchars($user['contact_num']); ?>">
        </div>
        <div class="d-flex justify-content-end save">
            <button type="submit">Save</button>
        </div>
    </div>
</form>


    
  </div>
</div>
 
</form>
</div>

</div>
</div>

  <!--Dashboard Section End-->
</body>

<script>
  function validatePassword() {
    const newPassword = document.getElementById('newPassword').value;
    const confirmPassword = document.getElementById('confirmPassword').value;
    const passwordError = document.getElementById('passwordError');

    if (newPassword !== confirmPassword) {
        passwordError.style.display = 'block';
    } else {
        passwordError.style.display = 'none';
        document.getElementById('passwordForm').submit();
    }
}
</script>
<script src="../../function/script/chatbot-toggle.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="../../function/script/tab-bar.js"></script>

</html>