<?php
include 'dbconnection/dbconnect.php';

$qry = ("SELECT * FROM board_account");

$result = mysqli_query($con, $qry);

$row = mysqli_fetch_array($result);
echo json_encode($row);