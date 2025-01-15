

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pawfect - Signup</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../css/signup.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0-alpha1/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-2 col-lg-6">
                <div class="row login-container">
                    <div class="col-md-5 login-left text-center">
                        <img src="../../../../assets/img/sign-up.png">
                    </div>
                    <div class="col-md-7 login-right">
                        <?php
                        require '../../../../db.php';
                        include '../../function/php/process_signup.php'; 
                        ?>
                        <form method="POST">
                            <button type="submit" name="wrong_email" class="back-button" id="back-button" style="display:none;">
                                <i class="fas fa-arrow-left"></i>
                            </button>
                        </form>                 
                        <h5 class="p-1">Sign Up</h5>

                        <form action="" method="POST">
                            <div id="signup-fields">
                                <div class="d-flex gap-1">
                                    <div class="mb-3">
                                        <input type="text" name="name" class="form-control" placeholder="First Name" required>
                                    </div>
                                    <div class="mb-3">
                                        <input type="text" name="last_name" class="form-control" placeholder="Last Name" required>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <input type="text" name="address" class="form-control" placeholder="Enter your full address" required>
                                </div>
                                <div class="mb-3">
                                    <input type="tel" name="contact_num" class="form-control" placeholder="Enter your contact #" 
                                        required pattern="^\d{11}$" title="Contact number must be exactly 11 digits." maxlength="11">
                                </div>
                                <div class="mb-3">
                                    <input type="email" name="email" class="form-control" placeholder="Enter your email" required>
                                </div>
                                <div class="mb-3">
                                    <input type="password" name="password" class="form-control" 
                                        placeholder="Enter password" 
                                        pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_])[A-Za-z\d\W_]{8,}" 
                                        title="Password must be at least 8 characters long, include uppercase and lowercase letters, numbers, and special characters."
                                        required>
                                </div>
                                <div class="mb-3">
                                    <input type="password" id="confirm-password" name="confirm_password" class="form-control" 
                                        placeholder="Confirm password" required>
                                </div>
                                <div class="form-check mb-3">
                                    <input type="checkbox" class="form-check-input" id="showPassword">
                                    <label class="form-check-label" for="showPassword">Show Password</label>
                                </div>

                                
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="acceptTerms" name="accept_terms" required>
                                    <label class="form-check-label" for="acceptTerms">
                                        I accept the Terms and Conditions.
                                    </label>
                                </div>

                                <!-- Modal -->
                                <div class="modal fade" id="termsModal" tabindex="-1" aria-labelledby="termsModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title text-black" id="termsModalLabel">Terms and Conditions</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <h5>Welcome to Bark Yard Pet Wellness Center</h5>
                                                <p>By signing up and using our services, you agree to the following terms and conditions:</p>
                                                <ol>
                                                    <li><strong>Acceptance of Terms</strong>
                                                        <p>By creating an account, you acknowledge that you have read, understood, and agreed to comply with these terms. If you do not agree, please do not proceed with the registration.</p>
                                                    </li>
                                                    <li><strong>Account Registration</strong>
                                                        <ul>
                                                            <li>You must provide accurate and complete information when signing up.</li>
                                                            <li>You are responsible for maintaining the confidentiality of your login credentials.</li>
                                                            <li>You are solely responsible for all activities under your account.</li>
                                                        </ul>
                                                    </li>
                                                    <li><strong>Use of Services</strong>
                                                        <ul>
                                                            <li>Our platform is intended solely for managing appointments, storing pet health records, and other veterinary clinic-related functions.</li>
                                                            <li>You agree not to use the system for any unauthorized or illegal purposes.</li>
                                                        </ul>
                                                    </li>
                                                    <li><strong>Privacy and Data Protection</strong>
                                                        <ul>
                                                            <li>We are committed to protecting your privacy and personal information in accordance with our Privacy Policy</a>.</li>
                                                            <li>By signing up, you consent to the collection and use of your data for system operations.</li>
                                                        </ul>
                                                    </li>
                                                    <li><strong>Prohibited Activities</strong>
                                                        <p>You agree not to:</p>
                                                        <ul>
                                                            <li>Share your account with others or use another person’s account.</li>
                                                            <li>Attempt to disrupt, hack, or compromise the system’s security.</li>
                                                        </ul>
                                                    </li>
                                                    <li><strong>Termination of Account</strong>
                                                        <ul>
                                                            <li>We reserve the right to suspend or terminate accounts found in violation of these terms without prior notice.</li>
                                                            <li>Users may request to delete their account by contacting support.</li>
                                                        </ul>
                                                    </li>
                                                    <li><strong>Service Availability</strong>
                                                        <ul>
                                                            <li>While we strive to maintain system uptime, we do not guarantee uninterrupted service.</li>
                                                            <li>Scheduled maintenance and unexpected outages may occur.</li>
                                                        </ul>
                                                    </li>
                                                    <li><strong>Limitation of Liability</strong>
                                                        <ul>
                                                            <li>The system and its services are provided "as-is."</li>
                                                            <li>We are not liable for any indirect or consequential damages arising from the use of the platform.</li>
                                                        </ul>
                                                    </li>
                                                    <li><strong>Changes to Terms</strong>
                                                        <p>We may update these terms from time to time. Changes will be communicated via email or through the platform.</p>
                                                    </li>
                                                        <p>By clicking Sign Up, you agree to our Terms and Conditions and Privacy Policy, including the collection, use, and sharing of your information as described therein</p>
                                                </ol>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Accept</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <script>
                                   document.addEventListener('DOMContentLoaded', function() {
                                        document.getElementById('acceptTerms').addEventListener('change', function() {
                                            if (this.checked) {
                                                var termsModal = new bootstrap.Modal(document.getElementById('termsModal'));
                                                termsModal.show();
                                            }
                                        });
                                    });
                                </script>

                                <button type="submit" name="signup" class="btn btn-success w-100">Sign Up</button>
                                <div class="text-center mt-3">
                                    <a href="login.php">Already have an account? <span class="btn-link login">Login</span></a>
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
                            <button type="button" class="resent" onclick="showResentModal()">Didn't get a code? <span class="btn-link">Click to resend</span></button>
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

    <script>
        function toggleSignupFields() {
            const signUpFields = document.getElementById('signup-fields');
            const verifyCodeFields = document.getElementById('verify-code');
            const resendSection = document.getElementById('resend-section');
            const backButton = document.getElementById('back-button');
            const verificationInput = document.getElementById('verification_code'); // Get the verification input

            // Disable required fields for sign up to allow toggling
            document.querySelector('input[name="name"]').removeAttribute('required');
            document.querySelector('input[name="email"]').removeAttribute('required');
            document.querySelector('input[name="password"]').removeAttribute('required');
            document.querySelector('input[name="address"]').removeAttribute('required');
            document.querySelector('input[name="contact_num"]').removeAttribute('required');
            document.querySelector('input[name="last_name"]').removeAttribute('required');
            document.querySelector('input[name="confirm_password"]').removeAttribute('required');
            document.querySelector('input[name="accept_terms"]').removeAttribute('required');

            // Toggle display of signup fields and verification code fields
            signUpFields.style.display = 'none';
            verifyCodeFields.style.display = 'block';
            resendSection.style.display = 'block';

            // Show back button when verification fields are visible
            backButton.style.display = 'flex'; 
            
            // Set the verification input to required
            verificationInput.setAttribute('required', true);

            // Focus the verification input field
            verificationInput.focus();
        }

        function showSignupFields() {
            const signUpFields = document.getElementById('signup-fields');
            const verifyCodeFields = document.getElementById('verify-code');
            const resendSection = document.getElementById('resend-section');
            const backButton = document.getElementById('back-button');
            const verificationInput = document.getElementById('verification_code');

            // Show signup fields again
            signUpFields.style.display = 'block';
            verifyCodeFields.style.display = 'none';
            resendSection.style.display = 'none';
            backButton.style.display = 'none';

            // Add 'required' back to fields
            document.querySelector('input[name="name"]').setAttribute('required', true);
            document.querySelector('input[name="email"]').setAttribute('required', true);
            document.querySelector('input[name="password"]').setAttribute('required', true);
            document.querySelector('input[name="address"]').setAttribute('required', true);
            document.querySelector('input[name="contact_num"]').setAttribute('required', true);
            document.querySelector('input[name="last_name"]').setAttribute('required', true);
            document.querySelector('input[name="confirm_password"]').setAttribute('required', true);
            document.querySelector('input[name="accept_terms"]').setAttribute('required', true);
            
            // Focus the first field after toggling
            document.querySelector('input[name="name"]').focus();
        }

        <?php if (isset($_SESSION['verification_code'])): ?>
            toggleSignupFields();
        <?php endif; ?>
    </script>


    <script>
         document.querySelector('form').addEventListener('submit', function(event) {
        const password = document.querySelector('input[name="password"]').value;
        const confirmPassword = document.querySelector('input[name="confirm_password"]').value;
        const passwordPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_])[A-Za-z\d\W_]{8,}$/;

        if (password !== confirmPassword) {
            event.preventDefault();
            alert('Passwords do not match. Please make sure both passwords are the same.');
        } else if (!passwordPattern.test(password)) {
            event.preventDefault();
            alert('Password must be at least 8 characters long and include uppercase, lowercase, numbers, and special characters.');
        }
    });

        if (strlen($contact_num) != 11 || !ctype_digit($contact_num)) {
            echo "<p class='alert alert-danger'>Contact number must be exactly 11 digits.</p>";
            exit;
        }  
    </script>

<script>
    const passwordInput = document.querySelector('[name="password"]');
    const confirmPasswordInput = document.getElementById('confirm-password');
    const showPasswordCheckbox = document.getElementById('showPassword');

    showPasswordCheckbox.addEventListener('change', function () {
        if (showPasswordCheckbox.checked) {
        passwordInput.type = 'text'; 
        confirmPasswordInput.type = 'text'; 
        } else {
        passwordInput.type = 'password';
        confirmPasswordInput.type = 'password'; 
        }
    });
    </script>
    
    <script src="../../function/script/sign-up.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0-alpha1/js/bootstrap.bundle.min.js"></script>

</body>
</html>
