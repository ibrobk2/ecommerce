<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trade X</title>
    <link rel="stylesheet" href="bootstrap5/css/bootstrap.min.css">
    <script src="static/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" href="lineawesome/css/line-awesome.min.css">
    <style>
        body {
            height: 100vh;
            padding: 0;
            margin: 0;
            width: 100%;
            background-color: azure;
        }

        .content {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            text-align: center;
            padding: 20px;
        }

        .product {
            padding: 20px;
        }

        .product img {
            width: 100%;
            max-width: 100%;
            height: auto;
            border-radius: 10px;
        }

        #carouselId {
            width: 100%;
            margin-top: 20px;
        }

        .carousel-inner {
            height: 300px;
        }

        .carousel-item {
            text-align: center;
        }

        .carousel-item p {
            max-width: 600px;
            margin: 0 auto;
        }

        #btn1:hover {
            opacity: 0.7;
            cursor: pointer;
        }
    </style>
</head>
<body>

<?php include "header.php" ?>
<br><br><br><br><br>

<center>
<div id="carouselId" class="carousel slide" data-bs-ride="carousel">
        <ol class="carousel-indicators">
            <li data-bs-target="#carouselId" data-bs-slide-to="0" class="active" aria-current="true" aria-label="First slide"></li>
            <li data-bs-target="#carouselId" data-bs-slide-to="1" aria-label="Second slide"></li>
            <li data-bs-target="#carouselId" data-bs-slide-to="2" aria-label="Third slide"></li>
        </ol>
        <div class="carousel-inner" role="listbox" style="height: 400px; width: 100%; margin-top: -80px;">
            <div class="carousel-item active">
                <div class="p-5 mb-4 bg-light bg-dark text-light" style="">
                  <div class="container-fluid py-5">
                    <h1 class="display-5 fw-bold">Register With Us</h1>
                    <p class="col-md-8 fs-4">Using a series of utilities, you can create this jumbotron, just like the one in previous versions of Bootstrap. Check out the examples below for how you can remix and restyle it to your liking.</p>
                    <a href="reg.php" class="text-light btn btn-primary btn-lg" style="text-decoration: none;">Click to Register</a>
                  </div>
                  </div>
            </div>
            <div class="carousel-item">
               <div class="p-5 mb-4 bg-light bg-dark text-light" style="">
                <div class="container-fluid py-5">
                  <h1 class="display-5 fw-bold">Become an admin</h1>
                  <p class="col-md-8 fs-4">Using a series of utilities, you can create this jumbotron, just like the one in previous versions of Bootstrap. Check out the examples below for how you can remix and restyle it to your liking.</p>
                  <a href="admin_reg.php" class="text-light btn btn-primary btn-lg" style="text-decoration: none;">Click to become an admin</a>
                </div>
                 </div>
            </div>
            <div class="carousel-item">
                <div class="p-5 mb-4 bg-light bg-dark text-light" style="">
                  <div class="container-fluid py-5">
                    <h1 class="display-5 fw-bold">Check your cart</h1>
                    <p class="col-md-8 fs-4">Using a series of utilities, you can create this jumbotron, just like the one in previous versions of Bootstrap. Check out the examples below for how you can remix and restyle it to your liking.</p>
                    <a href="cart.php"  class="text-light btn btn-primary btn-lg" style="text-decoration: none;">Go to cart</a>
                  </div>
                  </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselId" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselId" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</center>

<center>
    <h1>Our Products</h1>
</center>

<div class="content">
    <?php
    include "server.php";

    $sql = "SELECT * FROM products";
    $result = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_assoc($result)) { ?>
        <div class="product">
            <img src="uploads/<?php echo $row['image']; ?>" alt="<?php echo $row['image']; ?>" style="width:250px;">
            <b><h6 class="text-dark" style="margin-right: 10px; font-size: 19px;"><?php echo $row['name']; ?></h6></b>
            <b><p style="font-size: 16px;" class="text-danger">&#8358; <?php echo number_format($row['price']); ?></p></b>
            <a href="view_product.php?view=<?php echo $row['id']; ?>" class="btn btn-secondary btn-sm">View Product</a>
        </div>
    <?php } ?>
</div>

<script src="bootstrap5/js/bootstrap.bundle.min.js"></script>
<?php include "footer.php" ?>
</body>
</html>