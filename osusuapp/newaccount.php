<?php

include 'dbconnection/dbconnect.php';
session_start();
if (!$_SESSION['auth']) {
    header('location:index.php');
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Account Opening</title>
    <link href="../fontawesome-free-5.13.1-web/css/all.css" text="text/css" rel="stylesheet" />
    <link rel="stylesheet" href="../css/bootstrap.min.css" />
    <link rel="stylesheet" href="../css/newaccount.css" />




    <script src="../js/jquery.min.js"></script>
    <script src="../js/script.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/sweetalert2.all.min.js"></script>
</head>

<body onload="textboxFocus()">
    <div id="grid-container">
        <header id="dash-header">
            <h1>Account Opening</h1>
            <div class="menu-toggle" id="menu-toggle" onclick="navShow()">
                <div class="btn-line"></div>
                <div class="btn-line"></div>
                <div class="btn-line"></div>
            </div>
        </header>
        <nav id="nav-bar">
            <li class="nav-item">
                <a href="home.php" class="nav-btn"><i class="fa fa-home" aria-hidden="true"></i>Home</a>
            </li>
            <li class="nav-item" id="account-opening">
                <a href="" class="nav-btn active"><i class="fa fa-user" aria-hidden="true"></i>Account Opening</a>
                <div class="sub-menu">
                    <a href="newaccount.php">New Account</a><a href="viewaccount.php">View All
                        Accounts</a>
                </div>
            </li>
            <li class="nav-item" id="board">
                <a href="newboard.php" class="nav-btn"><i class="fas fa-user-circle"></i>Board
                    Account</a>

            </li>
            <li class="nav-item" id="deposit">
                <a href="deposit.php" class="nav-btn"><i class="fa fa-address-book" aria-hidden="true"></i>Deposit
                    Account</a>

            </li>

            <li class="nav-item" id="views">
                <a href="views.php" class="nav-btn"><i class="fa fa-street-view" aria-hidden="true"></i>Views</a>

            </li>

            <li class="nav-item" id="check">
                <a href="check.php" class="nav-btn"><i class="fas fa-money-check" aria-hidden="true"></i>Checks</a>

            </li>

            <li class="nav-item">
                <a href="logout.php" class="nav-btn" id="logout"><i class="fas fa-sign-out-alt"></i>Logout</a>
            </li>
        </nav>
        <main id="dash-main">
            <div class="container">


                <div class="sub-container">
                    <div class="new-account">New Account</div>
                    <div class="view-account">View Details</div>

                    <form action="" class="new-account-form" method="POST">
                        <input type="text" name="osusu" value="" required placeholder="osusuid" class="input"
                            id="idtextbox"><br>
                        <input type="text" name="fname" value="" required placeholder="firstname" class="input"><br>
                        <input type="text" name="lname" value="" required placeholder="lastname" class="input"><br>

                        <input type="radio" id="m" name="gender" required value="m" class="radio">Male</input>
                        <input type="radio" id="f" name="gender" required value="f" checked
                            class="radio">Female</input><br>

                        <input type="text" name="amount" value="" required placeholder="amountperday" class="input"><br>

                        <input type="radio" id="active" name="status" required value="active" checked
                            class="radio">Active</input>
                        <input type="radio" id="notactive" name="status" required value="notactive"
                            class="radio">Notactive</input><br>
                        <input type="text" name="board" required placeholder="board" class="input"><br>
                        <input type="submit" name="create" value="CREATE" class="new-btn"><br>
                        <input type="reset" name="reset" value="CLEAR" class="new-btn">
                    </form>

                    <form action="" method="POST" class="view-account-form">
                        <div class="search-box">

                            <input type="search" name="search-text" id="search-text" placeholder="Enter osusuId "
                                class="search-text">

                            <input type="submit" value="SEARCH" name="search" class="search-btn"
                                onclick="return checktextbox()">


                        </div>



                        <?php



                        //SELECT QUERY   
                        if (isset($_POST["search"])) {

                        ?>


                        <?php
                            $Osusu = $_POST["search-text"];

                            $sql = ("SELECT * FROM customers_info WHERE osusuid = '$Osusu'");

                            $result = mysqli_query($con, $sql) or die(mysqli_errno($con));

                            $num = mysqli_num_rows($result);

                            if ($num == 1) {

                                while ($row = mysqli_fetch_array($result)) {
                                    $osusuid = $row["osusuid"];
                                    $fname = $row["firstname"];
                                    $lname = $row["lastname"];
                                    $gender = $row["gender"];
                                    $amount = $row["amount"];
                                    $status = $row["status"];
                                    $board = $row["board"];


                            ?>

                        <div class="form-details">
                            <label for="" class="form-label">Osusuid</label><br>
                            <input type="text" name="osusu_id" value="<?php echo $osusuid ?>" required
                                placeholder="osusuid" class="input"><br>
                            <label for="" class="form-label">FirstName</label><br>
                            <input type="text" name="fname" value="<?php echo $fname ?>" required
                                placeholder="firstname" class="input"><br>
                            <label for="" class="form-label">LastName</label><br>
                            <input type="text" name="lname" value="<?php echo $lname ?>" required placeholder="lastname"
                                class="input"><br>
                            <label for="" class="form-label">Gender</label><br>
                            <input type="text" name="gender" value="<?php echo $gender ?>" required placeholder="gender"
                                class="input"><br>
                            <label for="" class="form-label">Amount</label><br>
                            <input type="text" name="amount" value="<?php echo $amount ?>" required
                                placeholder="amountperday" class="input"><br>
                            <label for="" class="form-label">Status</label><br>
                            <input type="text" name="status" value="<?php echo $status ?>" required placeholder="status"
                                class="input"><br>
                            <label for="" class="form-label">Board</label><br>
                            <input type="text" name="board" value="<?php echo $board ?>" required placeholder="board"
                                class="input"><br>
                            <input type="submit" name="update" value="UPDATE" class="new-btn"><br>

                        </div>




                        <?php


                                }
                            } else {
                                echo "<script> alert('Details not found, please check the osusuid') </script>";
                            }
                            ?>

                        <script>
                        $(".view-account-form").show();
                        $(".view-account-form").css("height", "1000");
                        $(".view-account").css("background", "var(--plain-white)");
                        $(".new-account-form").hide();
                        $(".new-account").css("background", "none");
                        $("#search-text").focus();
                        </script>

                        <?php

                        }

                        ?>

                    </form>

                </div>

            </div>
        </main>
    </div>

    <script>
    $(document).ready(function() {
        $(".new-account").click(function() {
            $("#idtextbox").focus();
        });

        $(".view-account").click(function() {
            $("#search-text").focus();
        });

        $(".search-btn").click(function() {
            $("#search-text").focus();
        });

    })

    function textboxFocus() {
        var st = document.getElementById("idtextbox");



        st.focus();

    }
    </script>
</body>

</html>





<?php


//INSERT QUERY


if (isset($_POST["create"])) {

    $Osusu = $_POST['osusu'];
    $Fname = $_POST['fname'];
    $Lname = $_POST['lname'];
    $Gender = $_POST['gender'];
    $Amount = $_POST['amount'];
    $Status = $_POST['status'];
    $Board = $_POST['board'];

    $check = ("SELECT * FROM customers_info WHERE osusuid = '$Osusu'");

    $result_osusuid = mysqli_query($con, $check) or die(mysqli_errno($con));

    $num = mysqli_num_rows($result_osusuid);

    if ($num > 0) {

        echo "<script> 
        $('#idtextbox').focus();
        swal.fire(
        'Customer Account Opening',
        'Sorry customer already exist with osusuid:'+  +$Osusu,
        'info'
    ) 
    </script>";
    } else {


        $sql = ("INSERT INTO customers_info (osusuid,firstname,lastname,gender,amount,status,board) VALUES('$Osusu','$Fname','$Lname','$Gender','$Amount','$Status','$Board')");


        $result = mysqli_query($con, $sql) or die(mysqli_errno($con));

        echo "<script>
        $('#idtextbox').focus();
        swal.fire(
        'Customer Account Opening',
        'Account created successfully with osusuid:'+  +$Osusu,
        'success'
    )
    </script>";
    }
}

//UPDATE QUERY

if (isset($_POST["update"])) {

    $Osusu = $_POST['osusu_id'];
    $Fname = $_POST['fname'];
    $Lname = $_POST['lname'];
    $Gender = $_POST['gender'];
    $Amount = $_POST['amount'];
    $Status = $_POST['status'];
    $Board = $_POST['board'];

    $upd = ("UPDATE customers_info SET firstname='$Fname',lastname='$Lname',gender='$Gender',amount='$Amount',status='$Status',board='$Board' WHERE osusuid='$Osusu'");



    mysqli_query($con, $upd);

    echo "<script>
    $('#idtextbox').focus();
    swal.fire(
        'Customer Account Update',
        'Account updated successfully with osusuid:'+  +$Osusu,
        'success'
    )
    </script>";
}