<?php
session_start();
require_once("connection.php");

if (isset($_SESSION['userId']) && $_SESSION['userId'] != "") {
    header("location:http://localhost/inventory/dashboard.php");
}
$errors = array();
if (($_REQUEST)) {
    $user = $_REQUEST['username'];
    $pass = $_REQUEST['password'];
    // validation
    if (empty($user) || empty($pass)) {
        if ($user == "") {
            $errors[] = "This userName is required";
        }
        if ($pass == "") {
            $errors[] = "This Password is required";
        }
    } else {
        $sql = "SELECT * FROM users WHERE username = '$user'";
        $result = $conn->query($sql);
        // chak data matching
        if ($result->num_rows > 0) {
            $password = md5($pass);
            $sql = "SELECT * FROM users WHERE username = '$user' AND password = '$password'";
            $result = $conn->query($sql);
            // chak data matching
            if ($result->num_rows > 0) {
                $value = $result->fetch_assoc();
                $userId = $value['user_id'];
                $username = $value['username'];
                // session load
                $_SESSION['userId'] = $userId;
                $_SESSION['username'] = $username;
                header("location:http://localhost/inventory/dashboard.php");
            } else {
                $errors[] = "Incorrent username/password combination";
            }
        } else {
            $errors[] = "username doesnot exists";
        }
    }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | inventory</title>
    <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
</head>

<body>
    <section class="vh-100" style="background-color: #508bfc;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card shadow-2-strong p-2" style="border-radius: 1rem;">
                        <div class="card-body p-5 text-center">
                            <h3 class="mb-5">Sign in</h3>
                            <div class="massage">
                                <?php
                                if ($errors) {
                                    foreach ($errors as $key => $value) {
                                        echo '<div class="alert alert-warning" role="alert"> <i class="glyphicon glyphicon-exclamation-sign"></i>' . $value . '</div>';
                                    }
                                }

                                ?>
                            </div>
                            <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
                                <div class="form-outline mb-4">
                                    <input type="text" id="typeEmailX-2" name="username" class="form-control form-control-lg" autocomplete="off" />
                                    <!-- <label class="form-label" for="typeEmailX-2">Email</label> -->
                                </div>

                                <div class="form-outline mb-4">
                                    <input type="password" id="typePasswordX-2" name="password" class="form-control form-control-lg" autocomplete="off" />
                                    <!-- <label class="form-label" for="typePasswordX-2">Password</label> -->
                                </div>
                                <button class="btn btn-primary btn-lg btn-block" type="submit">Login</button>
                            </form>
                        </div>
                        <a href="forgotPassword.php" class="text-right">Forgate Password</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>