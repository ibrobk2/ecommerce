<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Email Verification</title>
  <!-- Bootstrap CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

</head>
<body>
<?php
include "server.php";




// if($_SERVER['REQUEST_METHOD']=="POST"){
  if(isset($_POST['btn-verify'])){
    $email = $_POST['email'];
  
    $sql = "SELECT * FROM users WHERE email='$email'";
    $res = mysqli_query($conn, $sql);
  
    $counter = mysqli_num_rows($res);
  
    if($counter>0){
      $data = mysqli_fetch_assoc($res);
       $db_token = $data['token'];
  $token_entered = $_POST['token'];

  if($db_token==$token_entered){
    $sql = "UPDATE users SET status='verified' WHERE email='$email'";
    $result = mysqli_query($conn, $sql);
    if($result){
      echo "
        <script>
            swal('Good Job', 'Email Verified Successfully..', 'success');
            function x(){
         
                window.location = 'user.php'
            }

            setTimeout(x, 2000);
        </script>";
    }
  }else{
    echo "
    <script>
        swal('Error!', 'Wrong Token Entered', 'error');
        function x(){
     
            window.location = 'email_verify.php?email={$email}'
        }

        setTimeout(x, 2000);
    </script>";
  }
}
}

// }


function resend_token(){
if(isset($_GET['email'])){
$email = $_GET['email'];

$sql = "SELECT * FROM users WHERE email='$email'";
$res = mysqli_query($conn, $sql);

$counter = mysqli_num_rows($res);

if($counter>0){
  $data = mysqli_fetch_assoc($res);
  $db_token = $data['token'];
include "sendEmail.php";
$token = $db_token;
$receiver_email = $_GET['email'];
$subject = 'Email Verification';
$message = 'Your verification code is: <b>' . $token.'</b>';
$sender_email = 'ibrobk@gmail.com';
$app_password = 'uutlrsimejhlogzp';

if(sendEmail($sender_email, $app_password, $receiver_email, $subject, $message)){
  echo "
  <script>
      swal('Email Sent', 'Verification Token Resend Successully', 'success');
      function x(){
  
          window.location = 'email_verify.php?email={$receiver_email}'
      }

      setTimeout(x, 2000);
  </script>";
}
else{
  echo "
  <script>
      swal('Error!', 'Failed to Resend Email', 'error');
      function x(){
  
          window.location = 'email_verify.php?email={$receiver_email}'
      }

      setTimeout(x, 2000);
  </script>";
}
}
}

}
?>

</body>
</html>