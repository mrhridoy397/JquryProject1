<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory</title>
    <!-- favion icon -->
    <link rel="shortcut icon" href="./assets/img/logo-dark.png" type="image/x-icon">
    <!-- bootstrap css v4.5 -->
    <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
    <link href="./assets/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <!-- owl carousel 2.4-->
    <link rel="stylesheet" href="./assets/css/owl.theme.default.min.css">
    <link rel="stylesheet" href="./assets/css/owl.carousel.min.css">
    <!-- File Input CSS -->
    <link rel="stylesheet" href="./assets/css/fileinput.min.css">
    <!-- Animate css -->
    <link rel="stylesheet" href="./assets/css/animate.min.css">
    <link rel="stylesheet" href="./assets/css/jquery-ui.css">
    <!-- google fonts -->   
    <link href="./assets/css/fonts.css" rel="stylesheet">
    <!-- mignific popup -->
    <link rel="stylesheet" href="./assets/css/magnific-popup.css">
    <!-- Fontawesome 4.7 -->
    <link rel="stylesheet" href="./assets/fonts/css/font-awesome.min.css">
    <!-- theme style -->
    <link rel="stylesheet" href="./assets/css/educafe.css">
    <!-- theme responsive -->
    <link rel="stylesheet" href="./assets/css/responsive.css">
 

    <script src="./assets/js/jquery.min.js"></script>
    <script src="./assets/js/dataTables.min.js"></script>
    <script src="./assets/js/dataTables.bootstrap4.min.js"></script>

</head>

<body>
    <!-- navbar Start -->
    <nav class="navbar navbar-expand-lg nav-bg-educafe shadow">
        <div class="container">
            <a class="navbar-brand" href="#"><img src="./assets/img/logo-dark.png" alt="!" class="img-fluid"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="educafe navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link fs-w" href="dashboard.php"><i class="fa fa-tachometer" aria-hidden="true"></i> Dashboard</a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link fs-w" href="brand.php"><i class="fa fa-btc fs-w" aria-hidden="true"></i> Brand</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fs-w" href="category.php"><i class="fa fa-list" aria-hidden="true"></i> Category</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fs-w" href="product.php"><i class="fa fa-rub fs-w" aria-hidden="true"></i> Product</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle fs-w" href="order.php" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-shopping-cart" aria-hidden="true"></i>
                            Order
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item bg-info text-light"  href="addOrder.php?o=add"><i class="fa fa-plus" aria-hidden="true"></i> Add Order</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item bg-success text-light"  href="addOrder.php?o=manord"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Manage Orders</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fs-w" href="report.php"><i class="fa fa-check-square-o" aria-hidden="true"></i> Report</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle fs-w" href="order.php" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-user" aria-hidden="true"></i>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="settings.php"><i class="fa fa-cog" aria-hidden="true"></i> Settings</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="user.php"><i class="fa fa-wrench" aria-hidden="true"></i> Add User</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- navbar End -->