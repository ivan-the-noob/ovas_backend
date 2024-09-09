<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<p class='alert alert-danger'>Invalid email address. Please enter a valid email.</p>";
    } else {
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if (password_verify($password, $user['password'])) {
                $_SESSION['email'] = $user['email'];

                echo "<p class='alert alert-success'>Login successful! Redirecting...</p>";
                echo "<script>
                        setTimeout(function() {
                            window.location.href = '../../../../index.php';
                        }, 2000); 
                      </script>";
            } else {
                echo "<p class='alert alert-danger'>Incorrect password. Please try again.</p>";
            }
        } else {
            echo "<p class='alert alert-danger'>No account found with this email. Please sign up.</p>";
        }
    }
}
?>