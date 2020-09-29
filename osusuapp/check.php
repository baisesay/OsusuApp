<?php
include 'dbconnection/dbconnect.php';

session_start();
if (!$_SESSION['auth']) {
    header('location:index.php');
}

$DT = "";
$MT = "";
$WD = "";
$WM = "";
$DB = "";
$MB = "";

if (isset($_POST["ddaily"])) {

    $ddate = $_POST["ddate"];



    $qry = ("SELECT SUM(amount_deposit) AS Daily from breakdown_account where  b_date LIKE '%$ddate%'");

    $result = mysqli_query($con, $qry);


    $row = mysqli_fetch_array($result);

    $DT = $row["Daily"];
}

if (isset($_POST["dmonth"])) {

    $depositmonth = $_POST["depositmonth"];



    $qry = ("SELECT SUM(amount_deposit) AS Monthly from breakdown_account where  b_date LIKE '%$depositmonth%'");

    $result = mysqli_query($con, $qry);


    $row = mysqli_fetch_array($result);

    $MT = $row["Monthly"];
}


if (isset($_POST["wdaily"])) {

    $ddate = $_POST["ddate"];



    $qry = ("SELECT SUM(amount_withdraw) AS wdaily from breakdown_account where  b_date LIKE '%$ddate%'");

    $result = mysqli_query($con, $qry);


    $row = mysqli_fetch_array($result);

    $WD = $row["wdaily"];
}


if (isset($_POST["wmonthly"])) {

    $depositmonth = $_POST["depositmonth"];



    $qry = ("SELECT SUM(amount_withdraw) AS wmonthly from breakdown_account where  b_date LIKE '%$depositmonth%'");

    $result = mysqli_query($con, $qry);


    $row = mysqli_fetch_array($result);

    $WM = $row["wmonthly"];
}





if (isset($_POST["bdaily"])) {

    $dmdate = $_POST["bdate"];



    $qry = ("SELECT SUM(b_amount) AS Daily from board_account where  date LIKE '%$dmdate%'");

    $result = mysqli_query($con, $qry);


    $row = mysqli_fetch_array($result);

    $DB = $row["Daily"];
}

if (isset($_POST["bmonth"])) {

    $mdate = $_POST["boardmonth"];



    $qry = ("SELECT SUM(b_amount) AS Monthly from board_account where  date LIKE '%$mdate%'");

    $result = mysqli_query($con, $qry);


    $row = mysqli_fetch_array($result);

    $MB = $row["Monthly"];
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Checking</title>
    <link href="../fontawesome-free-5.13.1-web/css/all.css" text="text/css" rel="stylesheet" />
    <link rel="stylesheet" href="../css/bootstrap.min.css" />
    <link rel="stylesheet" href="../css/check.css" />



    <script src="../js/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/sweetalert2.all.min.js"></script>
    <script src="../js/script.js"></script>
</head>

<body>
    <div id="grid-container">
        <header id="dash-header">
            <h1>Checking</h1>
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
                <a href="views.php" class="nav-btn"><i class="fa fa-street-view" aria-hidden="true"></i>Views</a>

            </li>

            <li class="nav-item" id="check">
                <a href="check.php" class="nav-btn active"><i class="fas fa-money-check"
                        aria-hidden="true"></i>Checks</a>

            </li>
            <li class="nav-item">
                <a href="logout.php" class="nav-btn" id="logout"><i class="fas fa-sign-out-alt"></i>Logout</a>
            </li>
        </nav>
        <main id="dash-main">
            <div class="container">
                <div class="check-container">

                    <div class="card">
                        <div class="card-header">
                            Deposit & Withdraw Check
                        </div>

                        <div class="card-body">
                            <h5 class="card-title">Deposit & Withdraw Record Check</h5>
                            <form action="" method="POST" name="depositform">

                                <div class="modal-body">

                                    <div class="form-group">
                                        <label>DAY</label>
                                        <input type="date" name="ddate" id="ddate" value="" class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <label>MONTH</label>
                                        <input type="month" name="depositmonth" id="depositmonth" value=""
                                            class="form-control">
                                    </div>




                                    <div class="form-group">
                                        <label>Daily Deposit</label>
                                        <input type="number" name="dailydeposit" id="dailydeposit"
                                            value="<?php echo $DT ?>" class="form-control" placeholder="DailyDeposit"
                                            readonly>
                                    </div>

                                    <div class="form-group">
                                        <label>Daily Withdraw</label>
                                        <input type="number" name="dailywithdraw" id="dailywithdraw"
                                            value="<?php echo $WD ?>" class="form-control" placeholder="DailyWithdraw"
                                            readonly>
                                    </div>

                                    <div class="form-group">
                                        <label>Monthly Deposit</label>
                                        <input type="number" name="monthlydeposit" id="monthlydeposit"
                                            value="<?php echo $MT ?>" class="form-control" placeholder="MonthlyDeposit"
                                            readonly>
                                    </div>

                                    <div class="form-group">
                                        <label>Monthly Withdraw</label>
                                        <input type="number" name="monthlywithdraw" id="monthlywithdraw"
                                            value="<?php echo $WM ?>" class="form-control" placeholder="MonthlyWithdraw"
                                            readonly>
                                    </div>



                                </div>
                                <div class="modal-footer">
                                    <button type="submit" name="ddaily"
                                        class="btn btn-primary  ddaily">DailyDeposit</button>
                                    <button type="submit" name="dmonth"
                                        class="btn btn-secondary dmonth">MonthlyDeposit</button>
                                </div>

                                <div class="modal-footer">
                                    <button type="submit" name="wdaily"
                                        class="btn btn-success  ddaily">DailyWithdraw</button>
                                    <button type="submit" name="wmonthly"
                                        class="btn btn-warning dmonth">MonthlyWithdraw</button>

                                </div>



                            </form>





                        </div>
                    </div>




                    <div class="card  board-card">
                        <div class="card-header">
                            Board Check
                        </div>

                        <div class="card-body">
                            <h5 class="card-title">Board Record Check</h5>

                            <form action="" method="POST" name="withdrawform">

                                <div class="modal-body">

                                    <div class="form-group">
                                        <label>DAY</label>
                                        <input type="date" name="bdate" id="bdate" value="" class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <label>MONTH</label>
                                        <input type="month" name="boardmonth" id="boardmonth" value=""
                                            class="form-control">
                                    </div>




                                    <div class="form-group">
                                        <label>Daily Board</label>
                                        <input type="number" name="dailyboard" id="dailyboard" value="<?php echo $DB ?>"
                                            class="form-control" placeholder="DailyBoard" readonly>
                                    </div>

                                    <div class="form-group">
                                        <label>Monthly Board</label>
                                        <input type="number" name="monthlyboard" id="monthlyboard"
                                            value="<?php echo $MB ?>" class="form-control" placeholder="MonthlyBoard"
                                            readonly>
                                    </div>



                                </div>
                                <div class="modal-footer">
                                    <button type="submit" name="bdaily"
                                        class="btn btn-primary  bdaily">DailyBoard</button>
                                    <button type="submit" name="bmonth"
                                        class="btn btn-secondary bmonth">MonthlyBoard</button>

                                </div>



                            </form>







                        </div>
                    </div>

                </div>
            </div>
        </main>
    </div>



    <script>
    $(document).ready(function() {

        $('.ddaily').on('click', function() {
            var ddate = $('#ddate').val();
            //var dd = $('#dailydeposit');

            if (ddate == "") {

                $('#ddate').css("border", "1px solid red");

                return false;
            }
            //dd.css("background-color", "#e8491e");
        })

        $('.dmonth').on('click', function() {
            var dmonth = $('#depositmonth').val();

            if (dmonth == "") {

                $('#depositmonth').css("border", "1px solid red");
                return false;

            }

        })


        $('.bdaily').on('click', function() {
            var bdaily = $('#bdate').val();

            if (bdaily == "") {

                $('#bdate').css("border", "1px solid red");
                return false;

            }

        })

        $('.bmonth').on('click', function() {
            var bmonth = $('#boardmonth').val();

            if (bmonth == "") {

                $('#boardmonth').css("border", "1px solid red");
                return false;

            }

        })

    });
    </script>
</body>

</html>