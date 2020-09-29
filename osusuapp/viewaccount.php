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
    <title>View All Accounts</title>
    <link href="../fontawesome-free-5.13.1-web/css/all.css" rel="stylesheet" />
    <link rel="stylesheet" href="../css/bootstrap.min.css" />
    <link rel="stylesheet" href="../css/viewaccount.css" />
    <link rel="stylesheet" href="../css/dataTables.bootstrap.min.css" />



</head>

<body onload="textboxFocus()">
    <div id="grid-container">
        <header id="dash-header">
            <h1>View All Accounts</h1>
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
                    <a href="newaccount.php">New Account</a><a href="viewaccount.php">View Account
                        Details</a>
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
                <div class="card">
                    <div class="card-header">
                        <h3>Customers Information</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <button type="button" name="trigger" class="btn btn-info trigger ">
                                    VIEW UPDATED RECORS</button>
                            </div>
                        </div>

                        <br>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="search-box">

                                    <input type="search" name="search-box" id="search-box" placeholder="Type to search"
                                        class="search-box">

                                </div>
                            </div>
                        </div>

                        <br>
                        <div class="table-responsive">
                            <table id="table-view" class="table table-striped table-hover">

                                <thead>
                                    <tr>

                                        <th scope="col"> Osusuid</th>
                                        <th scope="col">FirstName </th>
                                        <th scope="col"> LastName</th>
                                        <th scope="col"> Gender</th>
                                        <th scope="col">Amount</th>
                                        <th scope="col">Board</th>


                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $qry = ("SELECT osusuid, firstname, lastname, gender,amount, board FROM customers_info");

                                    $result = mysqli_query($con, $qry);
                                    while ($row = mysqli_fetch_array($result)) {

                                        echo '
                                            <tr>

                                            <td>' . $row["osusuid"] . '</td>
                                            <td>' . $row["firstname"] . '</td>
                                            <td>' . $row["lastname"] . '</td>
                                            <td>' . $row["gender"] . '</td>
                                            <td>' . $row["amount"] . '</td>
                                            <td>' . $row["board"] . '</td>

                                            </tr>


                                            ';
                                    }
                                    ?>
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </main>


        <!-----------------------triggertable------------------------------------->

        <div class="modal fade" id="triggertable" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog trigger-modal" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">CUSTOMERS RECORD UPDATED
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="input">
                                    <input type="search" name="search-box" id="search-box" class="trigger-search"
                                        placeholder="Type to Search">
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="table-responsive">
                            <table aling=center style="width: 100%"
                                class="table table-dark table-striped  table-hover  triggertable">
                                <thead>
                                    <tr>



                                        <th hidden> Date&TimeUpdated</th>
                                        <th> Osusutid</th>
                                        <th> FirstName</th>
                                        <th> LastName</th>
                                        <th> Amount</th>
                                        <th> Board</th>
                                        <th> Action</th>





                                    </tr>


                                </thead>


                                <tbody>

                                    <?php
                                    $sar = ("SELECT date_time,osusuid,firstname,lastname,amount,board,
                                    action FROM customers_info_update");

                                    $result = mysqli_query($con, $sar);

                                    while ($row = mysqli_fetch_array($result)) {
                                        echo '
                                    <tr>


                                        <td hidden>' . $row["date_time"] . '</td>
                                        <td>' . $row["osusuid"] . '</td>
                                        <td>' . $row["firstname"] . '</td>
                                        <td>' . $row["lastname"] . '</td>
                                        <td>' . $row["amount"] . '</td>
                                        <td>' . $row["board"] . '</td>
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


    </div>
    <script type="text/javascript" src="../js/jquery.min.js"></script>
    <script type="text/javascript" src="../js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="../js/bootstrap.min.js"></script>

    <script type="text/javascript" src="../js/dataTables.bootstrap.min.js"></script>
    <script src="../js/sweetalert2.all.min.js"></script>
    <script src="../js/script.js"></script>

    <script>
    $(document).ready(function() {

        $("#search-box").keyup(function() {
            search_table($(this).val());
        });

        function search_table(value) {
            $("#table-view tr").each(function() {
                var found = "false";
                $(this).each(function() {
                    if ($(this).text().toLowerCase().indexOf(value
                            .toLowerCase()) >= 0) {
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

        $(".trigger-search").keyup(function() {
            trigger_table($(this).val());
        });

        function trigger_table(value) {
            $(".triggertable tr").each(function() {
                var found = "false";
                $(this).each(function() {
                    if ($(this).text().toLowerCase().indexOf(value
                            .toLowerCase()) >= 0) {
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



        $('.trigger').on('click', function() {

            $('#triggertable').modal('show');
        });



    });

    function textboxFocus() {
        var st = document.getElementById("search-box");
        st.focus();


    }
    </script>

</body>

</html>