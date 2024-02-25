<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Product</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <style>
        body{
            background: azure;

        }
    </style>
</head>
<body
<?php
include "server.php";

if(isset($_GET['view'])){
    $id = $_GET['view'];    

    $sql = "SELECT * FROM products WHERE id=$id";
    $result = mysqli_query($conn, $sql);

    if($result && mysqli_num_rows($result)>0){
        $row = mysqli_fetch_assoc($result);
    }
}


?>>
<form action="<?php echo $_SERVER['SELF']; ?>" method="post">
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-6 offset-md-3">
                <div class="card">
                    <img src="uploads/<?= $row['image']; ?>" class="card-img-top w-50" alt="Product Image">
                    <div class="card-body">
                        <h5 class="card-title"><?= $row['name']; ?></h5>
                        <p class="card-text">Price: &#8358;<?= number_format($row['price']); ?></p>
                        <p class="card-text">Description: <?= $row['description']; ?></p>
                        <div class="form-group">
                            <label for="quantity">Quantity:</label>
                            <input type="hidden" name="product_id" value="<?=$id; ?>">
                            <input type="number" class="form-control" id="quantity" name="quantity" value="1" min="1" required>
                        </div>
                        <?php session_start();
                            if(isset($_SESSION['logged'])){ ?>
                                <a href="cart.php?product_id=<?=$id; ?>" type="submit" class="btn btn-primary mr-2"><i class="fas fa-cart-plus"></i> Add to Cart</a>

                           <?php }else{ ?>
                                 <a href="user.php?product_id=<?=$id; ?>" class="btn btn-primary mr-2"><i class="fas fa-cart-plus"></i> Add to Cart</a>

                          <?php } ?>
                        <button type="button" class="btn btn-success"><i class="fas fa-credit-card"></i> Pay Now</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
