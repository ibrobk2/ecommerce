<?php
session_start();
include 'server.php'; // Include your database connection file

if (isset($_SESSION['set'])) {
    // Check if user is logged in
    if (!isset($_SESSION['logged'])) {
        echo "Please login to add products to your cart.";
        exit();
    }

    $product_id = $_SESSION['set'];
    // Assuming you have a 'users' table with a 'user_id' column to associate with the cart item
    $user_id = $_SESSION['logged']; // You need to set the user_id after login

    // Check if the product is already in the cart
    $check_sql = "SELECT * FROM cart WHERE user_id = $user_id AND product_id = $product_id";
    $check_result = mysqli_query($conn, $check_sql);
    if ($check_result && mysqli_num_rows($check_result) > 0) {
        echo "Product is already in your cart.";
        exit();
    }

    // Insert the product into the cart table
    $insert_sql = "INSERT INTO cart (user_id, product_id, quantity, price) VALUES ($user_id, $product_id)";
    if (mysqli_query($conn, $insert_sql)) {
        echo "Product added to cart successfully.";
    } else {
        echo "Error adding product to cart: " . mysqli_error($conn);
    }
} else {
    echo "Invalid request.";
}
?>
