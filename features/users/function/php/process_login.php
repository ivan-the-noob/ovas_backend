<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<p class='alert alert-danger'>Invalid email address. Please enter a valid email.</p>";
    } else {
        // Prepare the query to fetch user data
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC); // Fetch user data

            if (password_verify($password, $user['password'])) {
                // Set session variables
                $_SESSION['email'] = $user['email'];
                $_SESSION['role'] = $user['role'];
                $_SESSION['name'] = $user['name']; // Store user's name
                $_SESSION['profile_picture'] = $user['profile_picture']; // Store user's profile picture

                echo "<p class='alert alert-success'>Login successful! Redirecting...</p>";

                // Redirect based on user role
                if ($user['role'] === 'admin') {
                    echo "<script>
                            setTimeout(function() {
                                window.location.href = '../../../admin/web/api/admin.php';
                            }, 2000); 
                          </script>";
                } elseif ($user['role'] === 'staff') { 
                    echo "<script>
                            setTimeout(function() {
                                window.location.href = '../../../Staff/web/api/admin.php';
                            }, 2000); 
                          </script>";
                } else {
                    echo "<script>
                            setTimeout(function() {
                                window.location.href = '../../../../index.php';
                            }, 2000); 
                          </script>";
                }
            } else {
                echo "<p class='alert alert-danger'>Incorrect password. Please try again.</p>";
            }
        } else {
            echo "<p class='alert alert-danger'>No account found with this email. Please sign up.</p>";
        }
    }
}
?>
