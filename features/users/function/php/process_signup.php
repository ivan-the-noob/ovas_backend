<?php 
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require '../../../../PHPMailer/src/Exception.php';
    require '../../../../PHPMailer/src/PHPMailer.php';
    require '../../../../PHPMailer/src/SMTP.php';

    session_start();

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['signup'])) {

        $email = $_POST['email'];
        $name = $_POST['name'];
        $password = $_POST['password'];

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "<p class='alert alert-danger'>Invalid email address. Please enter a valid email.</p>";
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
                $_SESSION['email'] = $email;
                $_SESSION['verification_code'] = $verification_code;
                $_SESSION['hashed_password'] = $hashed_password; 

                $mail = new PHPMailer(true);
                try {
                    $mail->isSMTP();
                    $mail->Host       = 'smtp.gmail.com';
                    $mail->SMTPAuth   = true;
                    $mail->Username   = 'ejivancablanida@gmail.com'; 
                    $mail->Password   = 'acjf ngko qlfb cuju'; 
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                    $mail->Port       = 587;

                    $mail->setFrom('your-email@gmail.com', 'Your Name');
                    $mail->addAddress($email);
                    $mail->isHTML(true);
                    $mail->Subject = 'Your Email Verification Code';
                    $mail->Body    = "Your verification code is: $verification_code";

                    $mail->send();
                    echo "<p class='alert alert-success'>Verification code has been sent to your email.</p>";

                    echo "<script>toggleSignupFields();</script>";
                } catch (Exception $e) {
                    echo "<p class='alert alert-danger'>Message could not be sent. Mailer Error: {$mail->ErrorInfo}</p>";
                }
            }
        }
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['verify'])) {
        $entered_code = $_POST['verification_code'];

        if ($entered_code == $_SESSION['verification_code']) {
            $name = $_SESSION['name']; 
            $email = $_SESSION['email'];
            $hashed_password = $_SESSION['hashed_password']; 

            $stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (:name, :email, :password)");
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $hashed_password);
            $stmt->execute();

            echo "<p class='alert alert-success'>Signup successful! Redirecting to login...</p>";
            echo "<script>
                    setTimeout(function() {
                        window.location.href = 'login.php';
                    }, 2000); // 2 seconds delay
                </script>";
        } else {
            echo "<p class='alert alert-danger'>Invalid verification code.</p>";
        }
    }
?>