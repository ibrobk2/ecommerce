<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;








function sendMail($sender_email, $receiver_email, $subject, $message ){
     // Send and Email to the user
     $mail = new PHPMailer();
     $mail->isSMTP();
     $mail->Host = 'smtp.gmail.com';
     $mail->Port = 465;
     $mail->SMTPSecure = 'ssl';
     $mail->SMTPAuth = true;
     $mail->isHTML(true);
     $mail->Username = $sender_email; // Your Gmail address
     $mail->Password = 'uutlrsimejhlogzp'; // Your Gmail password
     $mail->setFrom($sender_email, 'eCommerce App');
     $mail->addAddress($receiver_email);
     $mail->Subject = $subject;
     $mail->Body = $message;
     $mail->send();
        
}



