<?php
session_start();
if (!isset($_SESSION["user"])) {
    header("Location: ../auth/login.php");
    exit();
}

include '../config/database.php';

if (isset($_GET['id'])) {
    $task_id = $_GET['id'];
    $query = "DELETE FROM production_schedule WHERE id='$task_id'";

    if (mysqli_query($conn, $query)) {
        header("Location: dashboard.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
