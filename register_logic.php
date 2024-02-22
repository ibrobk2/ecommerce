<?php
// Include the database connection file
include 'server.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

// Check if the form is submitted
if (isset($_POST['register-btn'])) {
    // Retrieve form data
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $password = $_POST['password']; // Note: This should be hashed before storing in the database
    $token = substr(rand()*time(),0,6);
    // Hash the password (using bcrypt for example)
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    
    // SQL query to insert user data into the database
    $sql = "INSERT INTO users (full_name, email, phone_number, password_hash, token) VALUES ('$full_name', '$email', '$phone_number', '$hashed_password', '$token')";

    // Execute the query
    if (mysqli_query($conn, $sql)) {
        // echo "User registered successfully.";
        // Send and Email to the user
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 465;
        $mail->SMTPSecure = 'ssl';
        $mail->SMTPAuth = true;
        $mail->isHTML(true);
        $mail->Username = 'ibrobk@gmail.com'; // Your Gmail address
        $mail->Password = ''; // Your Gmail password
        $mail->setFrom('ibrobk@gmail.com', 'eCommerce App');
        $mail->addAddress($email, $full_name);
        $mail->Subject = 'Email Verification';
        $mail->Body = 'Your verification code is: <b>' . $token.'</b>';
        
        if ($mail->send()) {
            echo "
            <script>
                 alert('Registration successfully.');
                 window.location = 'email_verify.php?email={$email}'
            </script>";
        } else {
            echo "Error sending verification code: " . $mail->ErrorInfo;
        }
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    // Close the database connection
    mysqli_close($conn);
}
?>
