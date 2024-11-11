<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pawfect - Signup</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../css/signup.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-2 col-lg-6">
                <div class="row login-container">
                    <div class="col-md-5 login-left text-center">
                        <img src="../../../../assets/img/sign-up.png">
                    </div>
                    <div class="col-md-7 login-right">
                    <form method="POST">
                        <button type="submit" name="wrong_email" class="back-button" id="back-button" style="display:none;">
                                    <i class="fas fa-arrow-left"></i>
                                </button>
                        </form>                 
                            <h5 class="p-1">Sign Up</h5>
                        <?php
                            require '../../../../db.php';
                            include '../../function/php/process_signup.php';                          
                        ?>
                        <form action="" method="POST">
                            <div id="signup-fields">
                                <div class="mb-3">
                                    <input type="text" name="name" class="form-control" placeholder="Enter name" required>
                                </div>
                                <div class="mb-3">
                                    <input type="email" name="email" class="form-control" placeholder="Enter your email" required>
                                </div>
                                <div class="mb-3">
                                    <input type="password" name="password" class="form-control" placeholder="Enter password" required>
                                </div>
                                <button type="submit" name="signup" class="btn btn-success w-100">Sign Up</button>
                                <div class="text-center mt-3">
                                <a href="login.php">Have an account? <span class="btn-link login">Login</span></a>
                            </div>
                            </div>        
                            <div id="verify-code" style="display:none;">
                                <div class="mb-3">
                                    <input type="number" id="verification_code" name="verification_code" class="form-control" placeholder="Enter 4-digit code">
                                </div>
                                <button type="submit" name="verify" class="btn btn-warning w-100">Verify Code</button>       
                            </div>
                        </form>
                    <div id="resend-section" style="display:none;" class="text-center mt-2">

                        <button type="button" class="resent" onclick="showResentModal()">
                        Didn't get a code? <span class="btn-link">Click to resend</span>
                        </button>
                      
                       
                        <div class="modal fade" id="resentModal" tabindex="-1" aria-labelledby="resentModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="resentModalLabel">Code Resent</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Your verification code has been resent.
                            </div>
                          
                            </div>
                        </div>
                    </div>
                        </div>
                        <p id="resend-message"></p>
                    </div>
                </div>
            </div>
        </div>
    </div>  
</body>
<script>
    function toggleSignupFields() {
            const signUpFields = document.getElementById('signup-fields');
            const verifyCodeFields = document.getElementById('verify-code');
            const resendSection = document.getElementById('resend-section');
            const backButton = document.getElementById('back-button');

            document.querySelector('input[name="name"]').removeAttribute('required');
            document.querySelector('input[name="email"]').removeAttribute('required');
            document.querySelector('input[name="password"]').removeAttribute('required');

            // Toggle display of signup fields and verification code fields
            signUpFields.style.display = 'none';
            verifyCodeFields.style.display = 'block';
            resendSection.style.display = 'block';

            // Show back button when verification fields are visible
            backButton.style.display = 'flex'; 
            
            document.getElementById('verification_code').setAttribute('required', true);
        }

        <?php if (isset($_SESSION['verification_code'])): ?>
            toggleSignupFields();
        <?php endif; ?>

</script>
    <script src="../../function/script/sign-up.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</html>
