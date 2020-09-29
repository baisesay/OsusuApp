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
    <title>Deposit Account</title>
    <link href="../fontawesome-free-5.13.1-web/css/all.css" rel="stylesheet" />
    <link rel="stylesheet" href="../css/bootstrap.min.css" />
    <link rel="stylesheet" href="../css/deposit.css" />



    <script src="../js/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/sweetalert2.all.min.js"></script>
    <script src="../js/script.js"></script>
</head>

<body onload="textboxFocus()">

    <div class="modal fade" id="newform" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">NEW DEPOSIT FORM</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" method="POST" name="newform">

                    <div class="modal-body">

                        <div class="form-group">
                            <label>Osusuid</label>
                            <input type="text" name="osusuid" id="osusuid" value="" class="form-control"
                                placeholder="Osusuid" required>
                        </div>

                        <div class="form-group">
                            <label>Deposit Amount</label>
                            <input type="number" name="damount" id="damount" value="" class="form-control"
                                placeholder="DepositAmount" required oninput="btnMultiply()">
                        </div>

                        <div class="form-group">
                            <label>Deposit Days</label>
                            <input type="number" name="ddays" id="ddays" value="" class="form-control"
                                placeholder="DepositDays" required oninput="btnMultiply()">
                        </div>


                        <div class="form-group">
                            <label>Total Deposit</label>
                            <input type="number" name="tdeposit" id="tdeposit" value="" class="form-control"
                                placeholder="TotalDeposit" required readonly>
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="newdeposit" class="btn btn-success">NEW DEPOSIT</button>

                        <button type="button" class="btn btn-secondary" data-dismiss="modal">CLOSE</button>
                    </div>



                </form>
            </div>
        </div>
    </div>

    <!-----------------------depositform---------------------------------------->

    <div class="modal fade" id="depositform" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">DAILY DEPOSIT FORM</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" method="POST" name="depositform">

                    <div class="modal-body">

                        <div class="form-group">
                            <label>Osusuid</label>
                            <input type="number" name="accountid" id="accountid" value="" class="form-control"
                                placeholder="Osusuid" required readonly>
                        </div>

                        <div class="form-group">
                            <label>Deposit Amount</label>
                            <input type="number" name="amountperday" id="amountperday" value="" class="form-control"
                                placeholder="AmountPerDay" required oninput="Multiply()" readonly>
                        </div>

                        <div class="form-group">
                            <label>Deposit Days</label>
                            <input type="number" name="dday" id="dday" value="" class="form-control"
                                placeholder="DepositDays" required oninput="Multiply()">
                        </div>


                        <div class="form-group">
                            <label>Total Deposit</label>
                            <input type="number" name="totaldeposit" id="totaldeposit" value="" class="form-control"
                                placeholder="TotalDeposit" required readonly>
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="deposit" class="btn btn-primary">DEPOSIT</button>

                        <button type="button" class="btn btn-secondary" data-dismiss="modal">CLOSE</button>
                    </div>



                </form>
            </div>
        </div>
    </div>

    <!-----------------------Editform---------------------------------------->

    <div class="modal fade" id="editform" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">UPDATE ACCOUNT FORM</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" method="POST" name="editform">

                    <div class="modal-body">

                        <div class="form-group">
                            <label>Osusuid</label>
                            <input type="text" name="editid" id="editid" value="" class="form-control"
                                placeholder="Osusuid" required readonly>
                        </div>

                        <div class="form-group">
                            <label>Deposit Amount</label>
                            <input type="text" name="amount" id="amount" value="" class="form-control"
                                placeholder="AmountPerDay" readonly>
                        </div>

                        <div class="form-group">
                            <label>Deposit Days</label>
                            <input type="number" name="editday" id="editday" value="" class="form-control"
                                placeholder="DepositDays" required>
                        </div>


                        <div class="form-group">
                            <label>Total Deposited</label>
                            <input type="number" name="editdeposit" id="editdeposit" value="" class="form-control"
                                placeholder="TotalDeposit" required>
                        </div>

                        <div class="form-group">
                            <label>Total Withdrawal</label>
                            <input type="number" name="editwithdraw" id="editwithdraw" value="" class="form-control"
                                placeholder="TotalWithdrawl" required>
                        </div>

                        <div class="form-group">
                            <label> Board</label>
                            <input type="number" name="board" id="board" value="" class="form-control"
                                placeholder="Board" required readonly>
                        </div>

                        <div class="form-group">
                            <label>Balance</label>
                            <input type="number" name="balance" id="balance" value="" class="form-control"
                                placeholder="Balance" required readonly>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="update" class="btn btn-primary"> UPDATE</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">CLOSE</button>
                    </div>



                </form>
            </div>
        </div>
    </div>


    <!-----------------------resetform---------------------------------------->

    <div class="modal fade" id="resetform" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">RESET ACCOUNT FORM</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" method="POST" name="resetform">

                    <div class="modal-body">

                        <div class="form-group">
                            <label>Osusuid</label>
                            <input type="number" name="resetid" id="resetid" value="" class="form-control"
                                placeholder="Osusuid" required readonly>
                        </div>



                        <div class="form-group">
                            <label>Deposit Days</label>
                            <input type="number" name="resetday" id="resetday" value="" class="form-control"
                                placeholder="DepositDays" required readonly>
                        </div>


                        <div class="form-group">
                            <label>Total Deposit</label>
                            <input type="number" name="resetdeposit" id="resetdeposit" value="" class="form-control"
                                placeholder="TotalDeposit" required readonly>
                        </div>

                        <div class="form-group">
                            <label>Total Withdraw</label>
                            <input type="number" name="resetwithdraw" id="resetwithdraw" value="" class="form-control"
                                placeholder="TotalWithdraw" required readonly>
                        </div>

                        <div class="form-group">
                            <label>Board</label>
                            <input type="number" name="resetboard" id="resetboard" value="" class="form-control"
                                placeholder="Board" required readonly>
                        </div>

                        <div class="form-group">
                            <label>Balance</label>
                            <input type="number" name="resetbalance" id="resetbalance" value="" class="form-control"
                                placeholder="Balance" required readonly>
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="reset" class="btn btn-warning areset">RESET ACCOUNT</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">CLOSE</button>
                    </div>



                </form>
            </div>
        </div>
    </div>

    <!-----------------------withdrawform--------------------------------------->

    <div class="modal fade" id="withdrawform" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">WITHDRAWAL FORM</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" method="POST" name="withdrawform">

                    <div class="modal-body">

                        <div class="form-group">
                            <label>Osusuid</label>
                            <input type="number" name="withdrawid" id="withdrawtid" value="" class="form-control"
                                placeholder="Osusuid" required>
                        </div>




                        <div class="form-group">
                            <label>Total Withdraw</label>
                            <input type="number" name="withdrawbal" id="withdrawbal" value="" class="form-control"
                                placeholder="TotalWithdraw" required>
                        </div>



                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="withdraw" class="btn btn-info">WITHDRAW</button>

                        <button type="button" class="btn btn-secondary" data-dismiss="modal">CLOSE</button>
                    </div>



                </form>
            </div>
        </div>
    </div>


    <!-----------------------breakdownform------------------------------------>

    <div class="modal fade" id="breakdownform" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">BREAKDOWN UPDATE FORM</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" method="POST" name="breakdownform">

                    <div class="modal-body">

                        <div class="form-group">
                            <label>Date&Time</label>
                            <input type="text" name="bdate" id="bdate" value="" class="form-control"
                                placeholder="DateTime" required readonly>
                        </div>



                        <div class="form-group">
                            <label hidden>Break Id</label>
                            <input type="number" name="bid" id="bid" value="" class="form-control" placeholder="Breakid"
                                required readonly hidden>
                        </div>


                        <div class="form-group">
                            <label>Osusu Id</label>
                            <input type="number" name="bosusuid" id="bosusuid" value="" class="form-control"
                                placeholder="Osusuid" required>
                        </div>

                        <div class="form-group">
                            <label>Amount Deposit</label>
                            <input type="number" name="bamount" id="bamount" value="" class="form-control"
                                placeholder="AmountDeposit" required>
                        </div>

                        <div class="form-group">
                            <label>Deposit Days</label>
                            <input type="number" name="bdays" id="bdays" value="" class="form-control"
                                placeholder="Days" required>
                        </div>

                        <div class="form-group">
                            <label>Amount Withdraw</label>
                            <input type="number" name="bwithdraw" id="bwithdraw" value="" class="form-control"
                                placeholder="Withdraw" required>
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="bsubmit" class="btn btn-warning">UPDATE</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">CLOSE</button>
                    </div>



                </form>
            </div>
        </div>
    </div>


    <!-----------------------formview------------------------------------>

    <div class="modal fade" id="formview" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">ACCOUNT VIEW</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" method="POST" name="formview">

                    <div class="modal-body">

                        <div class="form-group">
                            <label>Osusu Id</label>
                            <input type="number" name="vosusuid" id="vosusuid" value="" class="form-control" readonly>
                        </div>

                        <div class="form-group">
                            <label>Amount</label>
                            <input type="number" name="vamount" id="vamount" value="" class="form-control" readonly>
                        </div>

                        <div class="form-group">
                            <label>Days</label>
                            <input type="number" name="vdays" id="vdays" value="" class="form-control" readonly>
                        </div>

                        <div class="form-group">
                            <label>Total Deposit</label>
                            <input type="number" name="vdeposit" id="vdeposit" value="" class="form-control" readonly>
                        </div>


                        <div class="form-group">
                            <label>Total Withdraw</label>
                            <input type="number" name="vwithdraw" id="vwithdraw" value="" class="form-control" readonly>
                        </div>

                        <div class="form-group">
                            <label>Board</label>
                            <input type="number" name="vboard" id="vboard" value="" class="form-control" readonly>
                        </div>

                        <div class="form-group">
                            <label>Balance</label>
                            <input type="number" name="vbalance" id="vbalance" value="" class="form-control" readonly>
                        </div>



                    </div>




                </form>
            </div>
        </div>
    </div>



    <div id="grid-container">

        <header id="dash-header">
            <h1>Deposit Account</h1>
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
                <a href="" class="nav-btn"><i class="fa fa-user" aria-hidden="true"></i>Account Opening</a>
                <div class="sub-menu">
                    <a href="newaccount.php">New Account</a>
                    <a href="viewaccount.php">View Account Details</a>
                </div>
            </li>
            <li class="nav-item" id="board">
                <a href="newboard.php" class="nav-btn"><i class="fas fa-user-circle"></i>Board
                    Account</a>

            </li>
            <li class="nav-item" id="deposit">
                <a href="deposit.php" class="nav-btn active"><i class="fa fa-address-book"
                        aria-hidden="true"></i>Deposit
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
                <div class="card">
                    <div class="card-header">
                        Deposit Record
                    </div>

                    <div class="card-body">
                        <h5 class="card-title">Customers Record</h5>

                        <div class="row">
                            <div class="col-md-12">
                                <button class="btn btn-success  new">NEW</button>
                                <button class="btn btn-info  withdraw">WITHDRAW</button>
                                <button class="btn btn-warning  breakdown" name="breakdown">VIEW BREAKDOWN</button>
                                <button class="btn btn-primary  trigger" name="trigger">VIEW
                                    TRIGGER</button>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="search-box" id="search-div">

                                    <input type="search" name="search-text" id="search-text"
                                        placeholder="Type to search" class="search-text">

                                </div>
                            </div>
                        </div>

                        <br>
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
                                        <th scope="col">Deposit</th>
                                        <th scope="col">Edit</th>
                                        <th scope="col">View</th>
                                        <th scope="col">Reset</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                    $sel = ("SELECT * FROM osusubalance");

                                    $result = mysqli_query($con, $sel);
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
                                        <td>
                                            <button type="button" class="btn btn-primary deposit">
                                                DEPOSIT</button>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-secondary edit">
                                                EDIT</button>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-info view">
                                                VIEW</button>
                                        </td>
                                        <td>
                                            <input type="hidden" class="reset_id_value"
                                                value="<?php echo $row["osusuid"]; ?>">
                                            <a href="javascript:void(0)" class="btn btn-danger reset_btn_ajax">
                                                RESET</a>
                                        </td>


                                    </tr>


                                    <?php } ?>

                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>





            </div>
        </main>
    </div>

</body>

</html>


<script>
$(document).ready(function() {

    $("#sweet").on('click', function() {
        swal.fire(

            'Sweet Alert',
            'Your Text!',
            'success'
        )
    });






    $("#search-text").keyup(function() {
        search_table($(this).val());
    });

    function search_table(value) {
        $(".table tr").each(function() {
            var found = "false";
            $(this).each(function() {
                if ($(this).text().toLowerCase().indexOf(value.toLowerCase()) >= 0) {
                    found = "true";
                }
            });

            if (found == "true") {

                $(this).show();

            } else {
                $(this).hide();
            }
        })



    }


    $("#searchbreak").keyup(function() {
        searchtable($(this).val());
    });

    function searchtable(value) {
        $(".breaktable tr").each(function() {
            var found = "false";
            $(this).each(function() {
                if ($(this).text().toLowerCase().indexOf(value.toLowerCase()) >= 0) {
                    found = "true";
                }
            });

            if (found == "true") {

                $(this).show();

            } else {
                $(this).hide();
            }
        })
    }


    $("#searchtrigger").keyup(function() {
        searchtrigger($(this).val());
    });

    function searchtrigger(value) {
        $(".triggertable tr").each(function() {
            var found = "false";
            $(this).each(function() {
                if ($(this).text().toLowerCase().indexOf(value.toLowerCase()) >= 0) {
                    found = "true";
                }
            });

            if (found == "true") {

                $(this).show();

            } else {
                $(this).hide();
            }
        })
    }

    $('.new').on('click', function() {

        $('#newform').modal('show');
    });

    $('.deposit').on('click', function() {

        $('#depositform').modal('show');


        $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function() {
            return $(this).text();

        }).get();

        console.log(data);

        $('#accountid').val(data[0]);
        $('#amountperday').val(data[1]);

    });

    $('.view').on('click', function() {

        $('#formview').modal('show');


        $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function() {
            return $(this).text();

        }).get();

        console.log(data);

        $('#vosusuid').val(data[0]);
        $('#vamount').val(data[1]);
        $('#vdays').val(data[2]);
        $('#vdeposit').val(data[3]);
        $('#vwithdraw').val(data[4]);
        $('#vboard').val(data[5]);
        $('#vbalance').val(data[6]);

    });

    $('.edit').on('click', function() {

        $('#editform').modal('show');


        $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function() {
            return $(this).text();

        }).get();

        console.log(data);

        $('#editid').val(data[0]);
        $('#amount').val(data[1]);
        $('#editday').val(data[2]);
        $('#editdeposit').val(data[3]);
        $('#editwithdraw').val(data[4]);
        $('#board').val(data[5]);
        $('#balance').val(data[6]);

    });


    $('.reset_btn_ajax').on('click', function(e) {

        $("#search-text").focus();
        e.preventDefault();
        var areset = $(this).closest('tr').find('.reset_id_value').val();
        console.log(areset);

        swal.fire({
            title: 'Are you sure?',
            text: 'Account with osusuid ' + +areset + ' will be reset to zero balance',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3885d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Reset Account',

        }).then((willReset) => {

            if (willReset.value) {

                $.ajax({
                    type: "POST",
                    url: "reset.php",
                    data: {
                        "reset_btn_set": 1,
                        "reset_id": areset,
                    },

                    success: function(response) {
                        swal.fire({
                            title: 'ACCOUNT RESET',
                            text: 'Record reset successfully with osusuid:' +
                                +areset,
                            icon: 'success',

                        });

                    }

                })

            }
        })



    });






    $('.withdraw').on('click', function() {

        $('#withdrawform').modal('show');
    });

    $('.breakdown').on('click', function() {

        $('#breakdowntable').modal('show');
    });



    $('.editbreakdown').on('click', function() {

        $('#breakdownform').modal('show');
        $('#breakdowntable').modal('hide');


        $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function() {
            return $(this).text();

        }).get();

        console.log(data);

        $('#bdate').val(data[0]);
        $('#bid').val(data[1]);
        $('#bosusuid').val(data[2]);
        $('#bamount').val(data[3]);
        $('#bdays').val(data[4]);
        $('#bwithdraw').val(data[5]);


    });

    $('.trigger').on('click', function() {

        $('#triggertable').modal('show');
    });


});

function textboxFocus() {
    var sb = document.getElementById("search-div");
    document.getElementById("search-text").focus();

    sb.style = "border:1px solid #fd7e14";
}

function btnMultiply() {
    var num1 = document.getElementById("damount").value;
    var num2 = document.getElementById("ddays").value;

    var cal = num1 * num2;

    document.newform.tdeposit.value = cal;


}

function Multiply() {
    var num1 = document.getElementById("amountperday").value;
    var num2 = document.getElementById("dday").value;

    var cal = num1 * num2;

    document.depositform.totaldeposit.value = cal;


}
</script>

<?php

////INSERT QUERY////

if (isset($_POST["newdeposit"])) {

    $osusuid = $_POST['osusuid'];
    $damount = $_POST['damount'];
    $ddays = $_POST['ddays'];
    $tdeposit = $_POST['tdeposit'];

    $check = ("SELECT * FROM customers_account WHERE account_id = '$osusuid'");

    $result_osusuid = mysqli_query($con, $check) or die(mysqli_errno($con));

    $num = mysqli_num_rows($result_osusuid);

    if ($num > 0) {

        echo "<script>
            alert('Customer already exist with osusuid:'+ '  ' +'$osusuid');
         </script>";
    } else {
        $isat1 = ("INSERT INTO customers_account (account_id,total_deposited,total_days) VALUES('$osusuid','$tdeposit','$ddays')");

        $isat2 = ("INSERT INTO breakdown_account (breakdown_id,amount_deposit,days_deposit) VALUES('$osusuid','$tdeposit','$ddays')");

        mysqli_query($con, $isat1);

        mysqli_query($con, $isat2);

        echo "<script>
        $('#search-text').focus();
        alert('Deposit successfully into Deposit & Breakdown account with osusuid:'+ '  ' +'$osusuid');
         </script>";
    }
}


////DEPOSIT QUERY////

if (isset($_POST["deposit"])) {

    $accountid = $_POST['accountid'];
    $total = $_POST['totaldeposit'];
    $dday = $_POST['dday'];
    $damount = $_POST['amountperday'];

    $isat1 = ("UPDATE customers_account SET total_deposited=(total_deposited)+'$total',total_days=(total_days)+'$dday' WHERE account_id='$accountid'");


    $isat2 = ("INSERT INTO breakdown_account (breakdown_id,amount_deposit,days_deposit) VALUES('$accountid','$total','$dday')");

    mysqli_query($con, $isat1);

    mysqli_query($con, $isat2);

    echo "<script>
    $('#search-text').focus();
    swal.fire(
        'Customer Deposit & Breakdown Record',
        'Deposit successfully with Osusuid:'+  +$accountid+' , '+ 'Amount:'+$damount+' , '+'Days:'+$dday+' and '+'Total Deposited:'+$total,
        'success'
    )

    </script>";
}

////UPDATE QUERY////
if (isset($_POST["update"])) {

    $os = $_POST['editid'];
    $ds = $_POST['editday'];
    $td = $_POST['editdeposit'];
    $tw = $_POST['editwithdraw'];

    $upd = ("UPDATE customers_account SET total_deposited='$td',total_days='$ds', total_withdrawal='$tw' WHERE account_id='$os'");

    mysqli_query($con, $upd);

    echo "<script>
    $('#search-text').focus();
    swal.fire(
        'Customer Record',
        'Record updated successfully with osusuid:'+  +$os,
        'success'
    )
    </script>";
}

////RESET QUERY////
if (isset($_POST["reset"])) {

    $resetid = $_POST['resetid'];

    $upd = ("UPDATE customers_account SET total_deposited=0,total_days=0, total_withdrawal=0 WHERE account_id='$resetid'");
    mysqli_query($con, $upd);
    echo " <
          script >
            swal.fire(
            'Customer Reset Record',
            'Reset successfully with osusuid:' + +$resetid,
            'success'
            )";
}

//WITHDRAW  QUERY//
if (isset($_POST["withdraw"])) {

    $accountid = $_POST['withdrawid'];
    $wamount = $_POST['withdrawbal'];

    $check = ("SELECT balance AS bal FROM osusubalance WHERE osusuid = '$accountid'");

    $result_balance = mysqli_query($con, $check) or die(mysqli_errno($con));

    $row = mysqli_fetch_array($result_balance);

    $bal = $row["bal"];

    if ($wamount <= $bal) {
        $isat1 = ("UPDATE customers_account SET total_withdrawal=(total_withdrawal)+'$wamount' WHERE account_id='$accountid'");

        $isat2 = ("INSERT INTO breakdown_account (breakdown_id,amount_withdraw) VALUES('$accountid','$wamount')");

        mysqli_query($con, $isat1);


        mysqli_query($con, $isat2);

        echo "<script>
        $('#search-text').focus();
        swal.fire(
            'Customer Withdrawal & Breakdown Record',
            'Withdraw successful from account with osusuid:'+  +$accountid+' and '+ 'Amount:'+$wamount,
            'success'
        )
    </script>";
    } else {
        echo "<script>
        $('#search-text').focus();
        swal.fire(
            'Customer Withdrawal Record',
            'Sorry the Customer balance with an osusuid:'+  +$accountid+' is insufficient to make a withdrawal please check his/her balance and try again',
            'success'
        )
        </script>";
    }
}


?>


<!-----------------------breakdowntable------------------------------------->

<div class="modal fade" id="breakdowntable" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog break-modal" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">BREAKDOWN RECORD</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="search-box">

                            <input type="search" name="searchbreak" id="searchbreak" placeholder="Type to search"
                                class="search-text">

                        </div>
                    </div>
                </div>
                <br>
                <div class="table-responsive">
                    <table aling=center class="table table-dark  table-hover table-striped  breaktable">
                        <thead>
                            <tr>


                                <th> Date&Time</th>
                                <th> Breakid</th>
                                <th> Accountid</th>
                                <th> Amount</th>
                                <th> Days</th>
                                <th> Withdraw</th>
                                <th> Edit</th>
                            </tr>


                        </thead>


                        <tbody>
                            <?php
                            $sel = ("SELECT * FROM breakdown_account");
                            $result = mysqli_query($con, $sel);
                            while ($row = mysqli_fetch_array($result)) {
                                echo '
                            <tr>

                                <td>' . $row["b_date"] . '</td>
                                <td>' . $row["break_id"] . '</td>
                                <td>' . $row["breakdown_id"] . '</td>
                                <td>' . $row["amount_deposit"] . '</td>
                                <td>' . $row["days_deposit"] . '</td>
                                <td>' . $row["amount_withdraw"] . '</td>

                                <td>
                                    <button type="button" class="btn btn-warning editbreakdown">
                                        EDIT</button>
                                </td>



                            </tr>


                            ';
                            } ?>
                        </tbody>

                    </table>
                </div>



            </div>

        </div>
    </div>
</div>



<!-----------------------triggertable------------------------------------->


<div class="modal fade" id="triggertable" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog trigger-modal" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">TRIGGER UPDATED RECORD</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="search-box">

                            <input type="search" name="searchtrigger" id="searchtrigger" placeholder="Type to search"
                                class="search-text">

                        </div>
                    </div>
                </div>
                <br>
                <div class="table-responsive">
                    <table aling=center
                        class="table table-striped table-bordered table-hover table-active triggertable">
                        <thead>
                            <tr>


                                <th>Triggerid</th>
                                <th>Date&Time Updated</th>
                                <th>Osusuid</th>
                                <th>Deposited</th>
                                <th>Days</th>
                                <th>Withdrawal</th>
                                <th>Action</th>
                            </tr>


                        </thead>


                        <tbody>
                            <?php
                            $sel = ("SELECT * FROM customer_account_update");
                            $result = mysqli_query($con, $sel);
                            while ($row = mysqli_fetch_array($result)) {
                                echo '
                            <tr>

                                <td>' . $row["id"] . '</td>
                                <td>' . $row["date_time"] . '</td>
                                <td>' . $row["account_id"] . '</td>
                                <td>' . $row["deposit_amount"] . '</td>
                                <td>' . $row["deposit_days"] . '</td>
                                <td>' . $row["withdrawal_amount"] . '</td>
                                <td>' . $row["action"] . '</td>
                            </tr>


                            ';
                            } ?>
                        </tbody>

                    </table>
                </div>


            </div>
        </div>
    </div>

</div>



<?php
if (isset($_POST["bsubmit"])) {

    $id = $_POST["bid"];
    $bid = $_POST["bosusuid"];
    $da = $_POST["bamount"];
    $dy = $_POST["bdays"];
    $aw = $_POST["bwithdraw"];

    $upd = ("UPDATE breakdown_account SET breakdown_id=$bid,amount_deposit='$da', days_deposit='$dy', amount_withdraw='$aw' WHERE break_id='$id'");

    mysqli_query($con, $upd);

    echo "<script>
    $('#search-text').focus();
    swal.fire(
        'Breakdown Record update',
        'Breakdown record updated successfully with osusuid:'+  +$bid+' , '+ 'Deposit amount:'+$da+' , '+'Days:'+$dy+' and '+'Withdraw amount:'+$aw,
        'success'
    )
  </script>";
}