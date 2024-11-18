<?php

include('login_config.php');
session_start();
if (!isset($_SESSION['user_name'])) {
    header('location:login.php');
}

$sno = $_GET['sno'];
// echo $sno;

$sql = "DELETE FROM `status` WHERE `sno` = $sno";
$result = mysqli_query($conn, $sql);

if ($result) {
    header("location:test_list_user.php");
} else {
    echo "data not deleted";
}
