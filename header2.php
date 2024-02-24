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
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .navbar {
            border-radius: 0;
        }

        .nav-item a {
            padding: 15px;
            text-decoration: none;
            font-size: 18px;
            color: black;
            display: block;
        }

        .nav-item a:hover {
            background-color: skyblue;
            border-radius: 5px;
        }
    </style>
</head>

<body>

    <?php
    echo '
    <header>
        <nav class="navbar navbar-expand-md navbar-dark bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="#"><h2>Trade X</h2></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav me-auto mb-2 mb-sm-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="dashboard.php">Dashboard</a>
                        </li>
                        <li class="nav-item" style="margin-left: auto;">
                            ';

    include "server.php";

    session_start();
    if (!isset($_SESSION['logged'])) {
        echo '<a class="nav-link active" href="login.php"><b>Login</b></a>';
    } else {
        echo '<a class="nav-link active" href="logout.php"><b>Logout</b></a>';
    }

    echo '
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="cart.php"><b>Cart</b></a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    ';
    ?>

</body>

</html>