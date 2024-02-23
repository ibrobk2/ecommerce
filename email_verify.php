<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Email Verification</title>
  <!-- Bootstrap CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

  <style>
    body {
      background-color: #f8f9fa;
    }
    .verification-container {
      max-width: 400px;
      margin: 50px auto;
      padding: 20px;
      background-color: #fff;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
  </style>
</head>
<body>  

  <div class="verification-container">
    <h2 class="text-center mb-4">Email Verification</h2>
    <p>Please check your email inbox and enter the verification code below:</p>
    <form action="verification.php" method="post">
    <input type="hidden" name="email" value="<?= $_GET['email']; ?>">
      <div class="form-group">
        <input type="text" class="form-control" id="verificationCode" placeholder="Enter verification code" required name="token">
      </div>
      <button type="submit" class="btn btn-primary btn-block" name="btn-verify">Verify</button>
    </form>
    <div class="text-center mt-3">
      <button class="btn btn-link" onclick="<?php resend_token(); ?>">Resend Verification Email</button>
    </div>
  </div>
</body>
</html>
