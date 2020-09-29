<?php
include 'dbconnection/dbconnect.php';

session_start();
if (!$_SESSION['auth']) {
    header('location:index.php');
}

//getting all customers

$qry = ("SELECT  COUNT(osusuid) AS tc FROM customers_info");

$result = mysqli_query($con, $qry) or die(mysqli_errno($con));

$row = mysqli_fetch_array($result);
$c = $row["tc"];

//getting female customers

$qry = ("SELECT  COUNT(gender) AS tf FROM customers_info WHERE gender = 'f' ");

$result = mysqli_query($con, $qry) or die(mysqli_errno($con));

$row = mysqli_fetch_array($result);
$f = $row["tf"];

//getting male customers

$qry = ("SELECT  COUNT(gender) AS tm FROM customers_info WHERE gender = 'm' ");

$result = mysqli_query($con, $qry) or die(mysqli_errno($con));

$row = mysqli_fetch_array($result);
$m = $row["tm"];

//getting the total amounts

$qry = ("SELECT SUM(total_deposited) AS td,SUM(total_withdrawal) AS tw,SUM(total_deposited)-(SUM(total_withdrawal)+SUM(board)) as bal  from customers_account  inner join customers_info on account_id=osusuid");

$result = mysqli_query($con, $qry) or die(mysqli_errno($con));

$row = mysqli_fetch_array($result) or die(mysqli_errno($con));

$td = $row["td"];
$tw = $row["tw"];
$tb = $row["bal"];

//getting the accumulated amounts

$qry = ("SELECT SUM(amount_deposit) AS ad,SUM(amount_withdraw) as aw FROM breakdown_account");

$result = mysqli_query($con, $qry) or die(mysqli_errno($con));

$row = mysqli_fetch_array($result);

$ad = $row["ad"];
$aw = $row["aw"];

//getting the accumulated records

$qry = ("SELECT COUNT(amount_deposit) AS rd FROM breakdown_account WHERE amount_deposit > 0");

$result = mysqli_query($con, $qry) or die(mysqli_errno($con));

$row = mysqli_fetch_array($result);

$rd = $row["rd"];

$qry = ("SELECT COUNT(amount_withdraw) AS rw FROM breakdown_account WHERE amount_withdraw > 0");

$result = mysqli_query($con, $qry) or die(mysqli_errno($con));

$row = mysqli_fetch_array($result);

$rw = $row["rw"];

//getting the accumulated board amount and record

$qry = ("SELECT COUNT(b_id) as rb,SUM(b_amount) as ab FROM board_account");

$result = mysqli_query($con, $qry) or die(mysqli_errno($con));

$row = mysqli_fetch_array($result);

$rb = $row["rb"];
$ab = $row["ab"];
?>





<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Osusu Dashboard</title>
    <link href="../fontawesome-free-5.13.1-web/css/all.css" text="text/css" rel="stylesheet" />
    <link rel="stylesheet" href="../css/bootstrap.min.css" />
    <link rel="stylesheet" href="../css/home.css" />



    <script src="../js/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/sweetalert2.all.min.js"></script>
    <script src="../js/script.js"></script>
</head>

<body>
    <div id="grid-container">
        <header id="dash-header">
            <h1>Osusu Dashboard</h1>
            <div class="menu-toggle" id="menu-toggle" onclick="navShow()">
                <div class="btn-line"></div>
                <div class="btn-line"></div>
                <div class="btn-line"></div>
            </div>
        </header>
        <nav id="nav-bar">
            <li class="nav-item">
                <a href="home.php" class="nav-btn  active"><i class="fa fa-home" aria-hidden="true"></i>Home</a>
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
                <div class="main-cus">
                    <div class="cus-graph">
                        <p>9 Months Record</p>
                    </div>
                    <div class="num-customers-card total-cus">
                        <i class="fa fa-users fa-3x" aria-hidden="true"></i>
                        <h3>Total Customers</h3>
                        <input type="text" name="tc" id="tc" value="<?php echo $c ?>" readonly />
                    </div>
                    <div class="num-customers-card total-female">
                        <i class="fa fa-female fa-3x" aria-hidden="true"></i>
                        <h3>Female</h3>
                        <input type="text" name="tf" id="tf" value="<?php echo $f ?>" readonly />
                    </div>
                    <div class="num-customers-card total-male">
                        <i class="fa fa-male fa-3x" aria-hidden="true"></i>
                        <h3>Male</h3>
                        <input type="text" name="tm" id="tm" value="<?php echo $m ?>" readonly />
                    </div>
                </div>
                <div class="main-amount">
                    <div class="amount-graph">
                        <p>Customers Balance</p>
                    </div>
                    <div class="total-amount deposit">
                        <i class="fas fa-money-check fa-3x"></i>
                        <input type="text" name="t-dep" id="" value="le <?php echo $td ?>" readonly />
                        <h3>Deposit</h3>
                    </div>
                    <div class="total-amount withdraw">
                        <i class="fas fa-money-bill-alt fa-3x"></i>
                        <input type="text" name="t-wit" id="" value="le <?php echo $tw ?>" readonly />
                        <h3>Withdraw</h3>
                    </div>

                    <div class="total-amount balance">
                        <i class="far fa-money-bill-alt fa-3x"></i>
                        <input type="text" name="t-bal" id="" value="le <?php echo $tb ?>" readonly />
                        <h3>Balance</h3>
                    </div>
                </div>

                <div class="main-accumulated">
                    <div class="accumulated deposit-accumulated">
                        <div class="circle">
                            <p>AD</p>
                        </div>
                        <h3>Accumulated Deposit</h3>
                        <input type="text" name="a-dep" id="" value="le <?php echo $ad ?>" readonly />
                    </div>

                    <div class="accumulated withdraw-accumulated">
                        <div class="circle">
                            <p>AW</p>
                        </div>
                        <h3>Accumulated Withdraw</h3>
                        <input type="text" name="a-wit" id="" value="le <?php echo $aw ?>" readonly />
                    </div>

                    <div class="accumulated deposit-board">
                        <div class="circle">
                            <p>AB</p>
                        </div>
                        <h3>Accumulated Board</h3>
                        <input type="text" name="a-bod" id="" value="le <?php echo $ab ?>" readonly />
                    </div>

                    <div class="accumulated deposit-record">
                        <div class="circle">
                            <p>DR</p>
                        </div>
                        <h3>Deposit Record</h3>
                        <input type="text" name="r-dep" id="" value="<?php echo $rd ?>" readonly />
                    </div>

                    <div class="accumulated withdraw-record">
                        <div class="circle">
                            <p>WR</p>
                        </div>
                        <h3>Withdraw Record</h3>
                        <input type="text" name="r-wit" id="" value="<?php echo $rw ?>" readonly />
                    </div>

                    <div class="accumulated board-record">
                        <div class="circle">
                            <p>BR</p>
                        </div>
                        <h3>Board Record</h3>
                        <input type="text" name="r-bod" id="" value="<?php echo $rb ?>" readonly />
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>

</html>