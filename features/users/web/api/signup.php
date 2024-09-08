<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cavite State University - Signup</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../css/signup.css">
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-2 col-lg-6">
                <div class="row login-container">
                    <div class="col-md-5 login-left text-center">
                        <img src="../../../../assets/img/logo.png">
                    </div>
                    <div class="col-md-7 login-right">
                        <h5 class="mb-3">Sign Up</h5>

                        <?php
                            require '../../../../db.php';
                            include '../../function/php/process_signup.php';
                           
                            ?>


                        <!-- Signup and verification form -->
                        <form action="" method="POST">
                            <!-- Sign Up Fields -->
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
                            </div>

                            <!-- Verification Code Field (Hidden Initially) -->
                            <div id="verify-code" style="display:none;">
                                <div class="mb-3">
                                    <input type="text" id="verification_code" name="verification_code" class="form-control" placeholder="Enter 4-digit code">
                                </div>
                                <button type="submit" name="verify" class="btn btn-warning w-100">Verify Code</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript to Toggle Visibility and Handle Required Attributes -->
    <script>
        function toggleSignupFields() {
            const signUpFields = document.getElementById('signup-fields');
            const verifyCodeFields = document.getElementById('verify-code');

            // Remove 'required' from sign-up fields
            document.querySelector('input[name="name"]').removeAttribute('required');
            document.querySelector('input[name="email"]').removeAttribute('required');
            document.querySelector('input[name="password"]').removeAttribute('required');

            // Hide signup fields and show verification fields
            signUpFields.style.display = 'none';
            verifyCodeFields.style.display = 'block';

            // Add 'required' to the verification code field
            document.getElementById('verification_code').setAttribute('required', true);
        }

        // Automatically toggle fields if verification code has been sent
        <?php if (isset($_SESSION['verification_code'])): ?>
            toggleSignupFields();
        <?php endif; ?>
    </script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
