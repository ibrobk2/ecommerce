
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

</head>
<body>
    <div class="container w-50">
        <h2>Add Product</h2>
        <form action="add_product.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name">Product Name:</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="price">Quantity:</label>
                <input type="number" class="form-control" id="quantity" name="quantity" required>
            </div>
            <div class="form-group">
                <label for="price">Price:</label>
                <input type="number" class="form-control" id="price" name="price" required step="0.1">
            </div>
            <div class="form-group">
                <label for="image">Image:</label>
                <input type="file" class="form-control-file" id="image" name="image" required>
            </div>

            <div class="form-group">
                <label for="description">Description:</label>
                <textarea name="description" id="des" cols="20" rows="5" class="form-control" placeholder="Add Product description here..." ></textarea>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Add Product</button>
        </form>
    </div>


    <?php
include 'server.php'; // Include your database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $image = $_FILES['image']['name'];
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);

    // Check if image file is a actual image or fake image
    // $check = getimagesize($_FILES["image"]["tmp_name"]);
    // if($check !== false) {
       // Allow only certain file formats
        $allowed_types = array('jpg', 'jpeg', 'png', 'gif', 'webp');
        $file_extension = pathinfo($target_file, PATHINFO_EXTENSION);
        if (in_array($file_extension, $allowed_types)) {
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                // Insert product into database
                $sql = "INSERT INTO `products` (`name`, `quantity`, `price`, `image`, `description`) VALUES ('$name', '$quantity', '$price', '$image', '$description')";
                if (mysqli_query($conn, $sql)) {
                    echo "
                        <script>
                            swal('Good Job', 'Product Added Successfully..', 'success');
                            function x(){
                        
                                window.location = 'manage_product.php'
                            }

                            setTimeout(x, 2000);
                        </script>";
                } else {
                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                }
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        } else {
            echo "
        <script>
            swal('Error', 'Sorry, only JPG, JPEG, PNG & GIF files are allowed.', 'error');
            function x(){
         
                window.location = 'add_product.php'
            }

            setTimeout(x, 2000);
        </script>";
        }
    // }
    
    // else {
    //     echo "File is not an image.";
    // }
}
?>

</body>
</html>
