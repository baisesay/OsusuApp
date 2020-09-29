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
    <title>Board Record</title>
    <link href="../fontawesome-free-5.13.1-web/css/all.css" rel="stylesheet" />
    <link rel="stylesheet" href="../css/bootstrap.min.css" />
    <link rel="stylesheet" href="../css/newboard.css" />



    <script src="../js/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/sweetalert2.all.min.js"></script>
    <script src="../js/script.js"></script>
</head>

<body onload="textboxFocus()">

    <div class="modal fade" id="updateform" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">UPDATE BOARD RECORD</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" method="POST">

                    <div class="modal-body">
                        <div class="form-group">
                            <label>Date&Time</label>
                            <input type="text" name="datetime" id="datetime" value="" class="form-control" readonly>
                        </div>

                        <div class="form-group">
                            <label>Boardid</label>
                            <input type="text" name="boardid" id="boardid" value="" class="form-control" readonly>
                        </div>

                        <div class="form-group">
                            <label>Osusuid</label>
                            <input type="text" name="osusuid" id="osusuid" value="" class="form-control"
                                placeholder="Osusuid">
                        </div>

                        <div class="form-group">
                            <label>Amount</label>
                            <input type="text" name="amount" id="amount" value="" class="form-control"
                                placeholder="Amount">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="update" class="btn btn-primary">UPDATE</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">CLOSE</button>
                    </div>



                </form>
            </div>
        </div>
    </div>



    <div id="grid-container">

        <header id="dash-header">
            <h1>Board Record</h1>
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
                <a href="newboard.php" class="nav-btn  active"><i class="fas fa-user-circle"></i>Board
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
                    <div class="new-board">New Board</div>
                    <form action="" method="post">
                        <input type="submit" class="view-board" name="viewboard" value="VIEW BOARDS">
                    </form>


                    <form action="" method="POST" class="new-board-form">
                        <input type="number" name="osusu" value="" required placeholder="osusuid" class="input"
                            id="osusutextbox"><br>


                        <input type="number" name="board" value="" required placeholder="board" class="input"><br>


                        <input type="submit" name="insert" value="SUBMIT" class="new-btn"><br>
                        <input type="reset" name="reset" value="CLEAR" class="new-btn">
                    </form>

                    <div class="view-board-section">
                        <div class="view-board-header">
                            <h3>Search Board Record</h3>
                        </div>

                        <div class="search-box" id="search-div">

                            <input type="search" name="search-text" id="search-text" placeholder="Enter Id to search"
                                class="search-text">

                        </div>
                        <?php
                        if (isset($_POST["viewboard"])) {

                            $qry = ("SELECT * FROM board_account");

                            $result = mysqli_query($con, $qry);
                        ?>
                        <script>
                        $("#search-text").focus();
                        $(".view-board-section").show();
                        $(".view-board").css("background", "var(--plain-white)");
                        $(".new-board-form").hide();
                        $(".new-board").css("background", "none");
                        </script>
                        <table id="board-table-view">

                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Boardid</th>
                                    <th>Osusuid</th>
                                    <th>Board</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <?php
                                while ($row = mysqli_fetch_array($result)) {
                                ?>

                            <tbody>
                                <tr>
                                    <td data-label="Date">
                                        <?Php echo $row["date"] ?>
                                    </td>
                                    <td data-label="Boardid">
                                        <?Php echo $row["b_id"] ?>
                                    </td>
                                    <td data-label="Osusuid">
                                        <?Php echo $row["board_id"] ?>
                                    </td>
                                    <td data-label="Board">
                                        <?Php echo $row["b_amount"] ?>
                                    </td>
                                    <td data-label="Action" class="edit">
                                        <button type="button" class="btn btn-success edit_data">

                                            Edit</button>
                                    </td>

                                </tr>

                            </tbody>


                            <?php
                                }

                                ?>


                        </table>

                        <?php

                        }
                        ?>


                    </div>
                </div>



            </div>
        </main>
    </div>
</body>

</html>

<script>
$(document).ready(function() {

    $("#search-text").keyup(function() {
        search_table($(this).val());
    });

    function search_table(value) {
        $("#board-table-view tr").each(function() {
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


    $('.edit_data').on('click', function() {

        $('#updateform').modal('show');


        $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function() {
            return $(this).text();

        }).get();

        console.log(data);

        $('#datetime').val(data[0]);
        $('#boardid').val(data[1]);
        $('#osusuid').val(data[2]);
        $('#amount').val(data[3]);




    });

    //$('.close').on('click', function() {

    // var text = confirm("Do you want to close the update form");

    //if (text == true) {
    // $("#update-form").hide();
    // return true

    //} else {
    // return false
    //}


    //});


    $(".new-board").on('click', function() {
        $("#osusutextbox").focus();
    });


});

function textboxFocus() {
    var st = document.getElementById("search-text");
    var sb = document.getElementById("search-div");
    document.getElementById("osusutextbox").focus();

    st.focus();

    sb.style = "border:1px solid #fd7e14";
}
</script>


<?php
//INSERT QUERY

if (isset($_POST["insert"])) {

    $osusu = $_POST['osusu'];
    $board = $_POST['board'];

    $isat = ("INSERT INTO board_account (board_id,b_amount) VALUES('$osusu','$board')");

    mysqli_query($con, $isat);


    echo "
<script>
$('#osusutextbox').focus();
swal.fire({
   title: 'New Board Record',
   text: 'Board submitted successfully with osusuid:' + ' ' + $osusu + ' and amount: ' + ' ' + $board,
   icon: 'success'

})
</script>";

    //header("location:../php/newboard.php");
}

//UPDATE QUERY

if (isset($_POST["update"])) {

    $bid = $_POST['boardid'];
    $osusuid = $_POST['osusuid'];
    $amount = $_POST['amount'];

    $upd = ("UPDATE board_account SET board_id='$osusuid',b_amount='$amount' WHERE b_id='$bid'");

    mysqli_query($con, $upd);

    echo "
<script>
$('#osusutextbox').focus();
swal.fire(
    'Board Record Update',
    'Board Record updated successfully with osusuid:' + ' ' + $osusuid + ' and amount: ' + ' ' + $amount,
    'success'
)
</script>";
}

?>