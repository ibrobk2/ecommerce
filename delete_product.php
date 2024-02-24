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
include 'server.php'; // Include your database connection file

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $id = $_GET['id'];

    // Select image file name from the database
    $sql = "SELECT image FROM products WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $image = $row['image'];

        // Delete record from the database
        $delete_sql = "DELETE FROM products WHERE id = $id";
        if (mysqli_query($conn, $delete_sql)) {
            // Delete image file from the server
            $file_path = 'uploads/' . $image;
            if (file_exists($file_path)) {
                unlink($file_path);
            }
            echo "
        <script>
            swal('Good Job', 'Product Deleted Successfully..', 'success');
            function x(){
         
                window.location = 'manage_product.php'
            }

            setTimeout(x, 2000);
        </script>";
        } else {
            echo "Error deleting product: " . mysqli_error($conn);
        }
    } else {
        echo "Product not found.";
    }
} else {
    echo "Invalid request.";
}
?>


</body>
</html>