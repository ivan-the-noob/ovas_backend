<?php 
  session_start();
  if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'user') {
    header('Location: login.php'); 
    exit();
}
  $profilePicture = isset($_SESSION['profile_picture']) ? $_SESSION['profile_picture'] : 'assets/img/customer.jfif';
  $name = isset($_SESSION['name']) ? $_SESSION['name'] : 'Name not set';

  $alert = '';

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
  <title>Document</title>
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

  <div class="container mt-4 settings">
    <div class="row d-flex justify-content-center">
      <div class="col-md-3">
        <div class="profile">
          <img src="../../../../assets/img/profile/pet.jpg" alt="">
        </div>
      </div>
      <div class="col-md-5 mt-4">
          <h3>Racel Mae Loquello</h3>
          <hr>
          <p>Belvedere</p>
          <p>Racel@gmail.com</p>
          <p>0993129321</p>
        </div>
    </div>
    <div class="col-md-12 update mt-4">
    <div class="form-container">
            <span class="form-title">CHANGE PASSWORD</span>
            <form>
                <label for="currentPassword" class="form-label">CURRENT PASSWORD:</label>
                <input type="password" class="form-control" id="currentPassword" placeholder="Enter current password">

                <label for="newPassword" class="form-label">NEW PASSWORD:</label>
                <input type="password" class="form-control" id="newPassword" placeholder="Enter new password">

                <label for="confirmPassword" class="form-label">CONFIRM PASSWORD:</label>
                <input type="password" class="form-control" id="confirmPassword" placeholder="Confirm new password">

                <button type="submit" class="btn-save text-white">SAVE</button>
            </form>
        </div>

        <!-- Change Details Form -->
        <div class="form-container">
            <span class="form-title">CHANGE DETAILS</span>
            <form>
                <label for="changeName" class="form-label">CHANGE NAME:</label>
                <input type="text" class="form-control" id="changeName" placeholder="Enter new name">

                <label for="changeAddress" class="form-label">CHANGE ADDRESS:</label>
                <input type="text" class="form-control" id="changeAddress" placeholder="Enter new address">

                <label for="changeNumber" class="form-label">CHANGE NUMBER:</label>
                <input type="text" class="form-control" id="changeNumber" placeholder="Enter new number">

                <button type="submit" class="btn-save text-white">SAVE</button>
            </form>
        </div>
    </div>
  </div>

  <div class="container d-none">
    <div class="row d-flex flex-direction justify-content-center">   
       <div class="col-md-10">
     <form action="../../function/php/profile_update.php" method="POST" enctype="multipart/form-data">
    <div class="r mt-5">
        <h1 class="text-center mb-4">Profile</h1>
        <div class="row justify-content-center">
            <div class="col-12 col-md-6 text-center mb-4">
                <img src="../../../../assets/img/profile/<?php echo htmlspecialchars($profilePicture, ENT_QUOTES, 'UTF-8'); ?>" alt="Profile" class="rounded-circle" alt="Profile Picture" style="width: 150px; height: 150px; border: 2px solid #EBBF86;" id="profileImg">
                <h4 class="mt-3"><?php echo htmlspecialchars($name); ?></h4>
                <div class="mt-3">
                     <input type="file" class="form-control" name="profile_picture" id="changeProfile">
    
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-12 col-md-6">
                <div class="mb-3">
                    <label for="currentPassword" class="form-label">Current Password</label>
                    <input type="password" class="form-control" name="current_password" id="currentPassword" placeholder="Enter current password">
                </div>
                <div class="mb-4">
                    <label for="newPassword" class="form-label">New Password</label>
                    <input type="password" class="form-control" name="new_password" id="newPassword" placeholder="Enter new password">
                </div>
                <div class="mb-4">
                    <label for="confirmPassword" class="form-label">Confirm Password</label>
                    <input type="password" class="form-control" name="confirm_password" id="confirmPassword" placeholder="Confirm new password">
                    <div id="passwordError" class="text-danger mt-2" style="display: none;">Passwords do not match.</div>
                </div>
                <?php echo $alert; ?>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-12 col-md-6">
                <div class="dash-button">
                    <div class="col-12">
                        <button type="submit" class="save">Save</button>
                    </div>
                </div>
            </div>
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