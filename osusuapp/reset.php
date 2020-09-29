<?php
include 'dbconnection/dbconnect.php';

if (isset($_POST["reset_btn_set"])) {

    $resetid = $_POST['reset_id'];

    $upd = ("UPDATE customers_account SET total_deposited=0,total_days=0, total_withdrawal=0 WHERE account_id='$resetid'");
    mysqli_query($con, $upd);
}