<?php 
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require '../../../../PHPMailer/src/Exception.php';
    require '../../../../PHPMailer/src/PHPMailer.php';
    require '../../../../PHPMailer/src/SMTP.php';

    session_start();

    function sendVerificationEmail($email, $verification_code) {
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'ejivancablanida@gmail.com'; 
            $mail->Password   = 'acjf ngko qlfb cuju'; 
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;

            $mail->setFrom('Barkyards@gmail.com', 'Barks Yards');
            $mail->addAddress($email);
            $mail->isHTML(true);
            $mail->Subject = 'Your Email Verification Code';
            $mail->Body    = "Your verification code is: $verification_code";

            $mail->send();
            return true;
        } catch (Exception $e) {
            return "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['signup'])) {
        $email = $_POST['email'];
        $name = $_POST['name']; 
        $last_name = $_POST['last_name'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];
        $address = $_POST['address'];
        $contact_num = $_POST['contact_num'];
    
        // Check if password and confirm password match
        if ($password !== $confirm_password) {
            echo "<p class='alert alert-danger'>Passwords do not match. Please try again.</p>";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "<p class='alert alert-danger'>Invalid email address. Please enter a valid email.</p>";
        } elseif (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_])[A-Za-z\d\W_]{8,}$/', $password)) {
            echo "<p class='alert alert-danger'>Password must be at least 8 characters long and include uppercase, lowercase, numbers, and special characters.</p>";
        } else {
            $stmt = $conn->prepare("SELECT * FROM users WHERE email = :email");
            $stmt->bindParam(':email', $email);
            $stmt->execute();
    
            if ($stmt->rowCount() > 0) {
                echo "<p class='alert alert-danger'>Email already exists. Please use a different email.</p>";
            } else {
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                $verification_code = rand(1000, 9999);
    
                $_SESSION['name'] = $name;
                $_SESSION['last_name'] = $last_name;
                $_SESSION['email'] = $email;
                $_SESSION['verification_code'] = $verification_code;
                $_SESSION['hashed_password'] = $hashed_password;
                $_SESSION['address'] = $address;
                $_SESSION['contact_num'] = $contact_num;
    
                $emailSent = sendVerificationEmail($email, $verification_code);
    
                if ($emailSent === true) {
                    echo "<p class='alert alert-success'>Verification code has been sent to your email.</p>";
                    header('Location: ../../web/api/login.php');
                    exit();
                } else {
                    echo "<p class='alert alert-danger'>$emailSent</p>";
                }
            }
        }
    }
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['verify'])) {
        $entered_code = $_POST['verification_code'];
    
        if ($entered_code == $_SESSION['verification_code']) {
            $name = $_SESSION['name'];
            $last_name = $_SESSION['last_name'];
            $email = $_SESSION['email'];
            $hashed_password = $_SESSION['hashed_password'];
            $role = 'user';
            $default_profile_picture = 'customer.jfif';
            $address = $_SESSION['address'];
            $contact_num = $_SESSION['contact_num'];
    
            $stmt = $conn->prepare("INSERT INTO users (name, last_name, email, password, role, profile_picture, address, contact_num) 
                                    VALUES (:name, :last_name, :email, :password, :role, :profile_picture, :address, :contact_num)");
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':last_name', $last_name);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $hashed_password);
            $stmt->bindParam(':role', $role);
            $stmt->bindParam(':profile_picture', $default_profile_picture);
            $stmt->bindParam(':address', $address);
            $stmt->bindParam(':contact_num', $contact_num);
            $stmt->execute();
    
            session_destroy();
    
            echo "<p class='alert alert-success'>Signup successful! Redirecting to login...</p>";
            echo "<script>
                document.getElementById('emailInput').style.display = 'none';
                document.getElementById('passwordInput').style.display = 'none';
            
                setTimeout(function() {
                    window.location.href = 'login.php';
                }; //
              </script>";
        } else {
            echo "<p class='alert alert-danger'>Invalid verification code.</p>";
            
        }
    }
    

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['resend'])) {
        $verification_code = rand(1000, 9999);
        $_SESSION['verification_code'] = $verification_code;

        $emailSent = sendVerificationEmail($_SESSION['email'], $verification_code);

        if ($emailSent === true) {
        } else {
            echo "<p class='alert alert-danger'>$emailSent</p>";
        }
    }

    if (isset($_POST['wrong_email'])) {
        session_start();
        session_destroy(); 
        header('Location: signup.php'); 
        exit();
    }
?>
