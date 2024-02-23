<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<body>
    


<?php
// Include the database connection file
include 'server.php';

// Check if the form is submitted
if (isset($_POST['register-btn'])) {
    include "sendEmail.php";
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
       
        $sender_email = 'ibrobk@gmail.com';
        $receiver_email = $email;
        $subject = 'Email Verification';
        $message = 'Your verification code is: <b>' . $token.'</b>';
        $app_password = 'uutlrsimejhlogzp';
        // echo "User registered successfully.";
        // Send and Email to the user
        
        // sendMail($conn, $sender_email, $receiver_email, $subject, $message)
        if (sendEmail($sender_email, $app_password, $receiver_email, $subject, $message)) {
            echo "
            <script>
                swal('Good Job', 'Registration Successful...', 'success');
                function x(){
             
                    window.location = 'email_verify.php?email={$email}'
                }

                setTimeout(x, 2000);
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

</body>
</html>
