<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link href="../fontawesome-free-5.13.1-web/css/all.css" text="text/css" rel="stylesheet" />
    <link rel="stylesheet" href="../css/login.css">

    <script src="../js/jquery.min.js"></script>
    <script src="../js/sweetalert2.all.min.js"></script>
</head>

<body>

    <div class="container">
        <div class="form-title">
            <h2>OSUSU LOGIN FORM</h2>
        </div>

        <form action="index.php" method="POST" class="login-form">
            <div class="form-header">

                <i class="fas fa-user-circle fa-3x"></i>

            </div>
            <div class="form-input">
                <div class="form-label">
                    <label>UserName</label>
                </div>
                <input type="text" name="user" id="user" required>
            </div>
            <div class="form-input">
                <div class="form-label">
                    <label>Password</label>
                </div>
                <input type="password" name="pass" id="pass" required>
            </div>
            <div class="form-btn">
                <input type="submit" value="Login" name="submit" id="btn-submit">
            </div>

        </form>
    </div>
</body>

</html>


<?php

include 'dbconnection/dbconnect.php';

if (isset($_POST["submit"])) {



    $name = $_POST['user'];
    $pass = $_POST['pass'];

    $query = "SELECT * FROM admin WHERE username='$name' && password ='$pass'";

    $result = mysqli_query($con, $query);

    $num = mysqli_num_rows($result);

    if ($num == 1) {
        session_start();
        $_SESSION['auth'] = 'true';
        header('location:home.php');
    } else {
        echo "<script>
        swal.fire(
            'LOGIN!',
            'Login not successful please check UserName and Password and try again',
            'error'
        )
        </script>";
    }
}