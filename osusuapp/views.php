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
    <title>Views</title>
    <link href="../fontawesome-free-5.13.1-web/css/all.css" text="text/css" rel="stylesheet" />
    <link rel="stylesheet" href="../css/bootstrap.min.css" />
    <link rel="stylesheet" href="../css/deposit.css" />

    <style>
    label {
        font-size: 1.1rem;
    }

    .search-box2 {
        background: #f5f5f5;
        padding: 10px;
        margin-bottom: 10px;
        border-radius: 40px;
        height: 40px;
        border: none;
        outline: none;
        width: 90%;
    }

    .showCT {
        background: #f5f5f5;
        padding: 10px;
        margin-bottom: 10px;
        border-radius: 40px;
        height: 40px;
        border: none;
        outline: none;
        text-align: center;
        font-size: 1rem;
        font-weight: bold;
        max-width: 100px;
    }

    .showCA {
        background: #f5f5f5;
        padding: 10px;
        margin-bottom: 10px;
        border-radius: 40px;
        height: 40px;
        border: none;
        outline: none;
        text-align: center;
        font-size: 1rem;
        font-weight: bold;
        max-width: 150px;
    }
    </style>
</head>

<body onload="textboxFocus()">
    <div id="grid-container">
        <header id="dash-header">
            <h1>View of Account Balances</h1>
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
                <a href="" class="nav-btn"><i class="fa fa-user" aria-hidden="true"></i>Account
                    Opening</a>
                <div class="sub-menu">
                    <a href="newaccount.php">New Account</a><a href="viewaccount.php">View All Account</a>
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
                <a href="views.php" class="nav-btn active"><i class="fa fa-street-view"></i>Views</a>

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

                <div class="card">
                    <div class="card-header">
                        Balance Views
                    </div>

                    <div class="card-body">

                        <div class="row">
                            <div class="col">
                                <form action="" method="post">
                                    <input type="search" name="search-text" id="search-box" placeholder="Enter a value"
                                        value="" class=" search-box2">

                                    <button type="submit" name="getView" onclick="return searchbox()"
                                        class="btn btn-success   view-btn text-right">SEARCH</button>

                                </form>

                            </div>
                        </div>
                        <br>
                        <?php
                        if (isset($_POST["getView"])) {
                            /**Getting the customers information query statement*/
                            $search = $_POST["search-text"];
                            $sel = ("SELECT * FROM osusubalance WHERE balance = '$search'");

                            $result = mysqli_query($con, $sel);

                            /**Getting the customers total number*/
                            $qry = ("SELECT  COUNT(balance) AS bal FROM osusubalance WHERE balance='$search'");

                            $qresult = mysqli_query($con, $qry) or die(mysqli_errno($con));

                            $row = mysqli_fetch_array($qresult);
                            $bal = $row["bal"];

                            /**Getting the customers total balance*/
                            $qry = ("SELECT  SUM(balance) AS bala FROM osusubalance WHERE balance='$search'");

                            $qresult2 = mysqli_query($con, $qry) or die(mysqli_errno($con));

                            $row = mysqli_fetch_array($qresult2);
                            $bala = $row["bala"];

                        ?>
                        <div class="row">
                            <div class="col">
                                <label for="showCT">Total Customers</label>
                                <input type="text" name="" id="showCT" value="<?php echo $bal ?>" class="showCT"
                                    readonly>
                            </div>
                            <div class="col text-right">
                                <label for="showCA">Total Balance</label>
                                <input type="text" name="" id="showCA" value="<?php echo $bala ?>" class="showCA"
                                    readonly>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table aling=center class="table table-striped  table-hover">
                                <thead>
                                    <tr>

                                        <th scope="col">Id</th>
                                        <th scope="col">Amount</th>
                                        <th scope="col">Days</th>
                                        <th scope="col">Deposit</th>
                                        <th scope="col">Withdraw</th>
                                        <th scope="col">Board</th>
                                        <th scope="col">Balance</th>

                                    </tr>
                                </thead>

                                <tbody>
                                    <?php

                                        while ($row = mysqli_fetch_array($result)) {

                                        ?>

                                    <tr>

                                        <td><?php echo $row["osusuid"]; ?></td>
                                        <td><?php echo $row["amount"]; ?></td>
                                        <td><?php echo $row["total_days"]; ?></td>
                                        <td><?php echo $row["total_deposited"]; ?></td>
                                        <td><?php echo $row["total_withdrawal"]; ?></td>
                                        <td><?php echo $row["board"]; ?></td>
                                        <td><?php echo $row["balance"]; ?></td>




                                    </tr>


                                    <?php } ?>

                                </tbody>

                            </table>

                            <?php } ?>

                        </div>
                    </div>
                </div>







            </div>
        </main>
    </div>

    <script src="../js/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/sweetalert2.all.min.js"></script>
    <script src="../js/script.js"></script>

    <script>
    function textboxFocus() {
        var sb = document.getElementById("search-box");

        sb.focus();

    }

    function searchbox() {
        var sb = document.getElementById("search-box");

        if (document.getElementById("search-box").value == "") {
            sb.style = "border:1px solid red";
            sb.focus();
            return false;
        } else {
            return true;
        }

    }
    </script>
</body>

</html>