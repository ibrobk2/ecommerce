<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login and Registration Page</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
    body {
      background-color: #f8f9fa;
    }
    .form-container {
      margin-top: 100px;
    }
  </style>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

</head>
<body>

<?php
include 'server.php'; // Include your database connection file

session_start();


if(isset($_GET['product_id'])){

   $product_id = $_GET['product_id'];
   $product_set = true;

   $_SESSION['set'] = $product_set;
   $_SESSION['product'] = $product_id;
}
 




if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check if the email exists in the database
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $password_hash = $row['password_hash'];

        // Verify the password
        if (password_verify($password, $password_hash)) {
            // Password is correct, set session and redirect
            $_SESSION['logged'] = $email;
             if(isset($_SESSION['set'])){
         
              echo "
              <script>
                  swal('Good Job', 'Logged In Successful', 'success');
                  function y(){
               
                      window.location = 'view_product.php?view=".$_SESSION["product"]."'
                  }
      
                  setTimeout(y, 2000);
              </script>";    
              exit();
             }  
              else{
                echo "
                <script>
                    swal('Good Job', 'Logged In Successful3', 'success');
                    function x(){
                 
                        window.location = './'
                    }
        
                    setTimeout(x, 6000);
                </script>";  
                exit();  
             }     
            
        } else {
            echo "<script>alert('Incorrect password!');</script>";
        }
    } else {
        echo "<script>alert('User not found!');</script>";
    }
}

?>

  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card form-container">
          <div class="card-header">
            <ul class="nav nav-tabs card-header-tabs">
              <li class="nav-item">
                <a class="nav-link active" id="login-tab" data-toggle="tab" href="#login-form">Login</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="register-tab" data-toggle="tab" href="#register-form">Register</a>
              </li>
            </ul>
          </div>
          <div class="card-body">
            <div class="tab-content">
              <div class="tab-pane fade show active" id="login-form">
                <form action="user.php" method="post">
                  <div class="form-group">
                    <label for="login-email">Email</label>
                    <input type="email" class="form-control" id="login-email" placeholder="Enter email" name="email">
                  </div>
                  <div class="form-group">
                    <label for="login-password">Password</label>
                    <input type="password" class="form-control" id="login-password" placeholder="Password" name="password">
                  </div>
                  <button type="submit" class="btn btn-primary btn-block" name="login-btn">Login</button>
                </form>
              </div>
              <div class="tab-pane fade" id="register-form">
                <form action="register_logic.php" method="post">
                  <div class="form-group">
                    <label for="register-name">Full Name</label>
                    <input type="text" class="form-control" id="register-name" placeholder="Enter full name" name="full_name">
                  </div>
                  <div class="form-group">
                    <label for="register-email">Email</label>
                    <input type="email" class="form-control" id="register-email" placeholder="Enter email" name="email">
                  </div>
                  <div class="form-group">
                    <label for="register-phone">Phone Number</label>
                    <input type="text" class="form-control" id="register-phone" placeholder="Enter phone number" name="phone_number">
                  </div>
                  <div class="form-group">
                    <label for="register-password">Password</label>
                    <input type="password" class="form-control" id="register-password" placeholder="Password" name="password">
                  </div>
                  <div class="form-group">
                    <label for="register-confirm-password">Confirm Password</label>
                    <input type="password" class="form-control" id="register-confirm-password" placeholder="Confirm password">
                  </div>
                  <button type="submit" class="btn btn-primary btn-block" name="register-btn">Register</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
