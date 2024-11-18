<?php

include('login_config.php');
session_start();
if (!isset($_SESSION['admin_name'])) {
    header('location:login.php');
}

$username = $_GET['username'];

$admin_name = $_SESSION['admin_name'];

if ($admin_name === $username) {
    header("location:user_list.php");
} else {
    // Prepare the delete query
    $delete_query = "DELETE FROM user_form WHERE username = ?";
    $stmt = $conn->prepare($delete_query);
    $stmt->bind_param("s", $username);

    if ($stmt->execute()) {
        header("location:user_list.php");
    } else {
        $error = "Error deleting user!";
    }
}
