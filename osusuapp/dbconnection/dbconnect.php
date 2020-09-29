<?php
$con = mysqli_connect("localhost", "root", "");

if (!$con) {
    echo "Not Connected to Server";
}
if (!mysqli_select_db($con, "id14496802_osusudb")) {
    echo "Database Not Selected";
}