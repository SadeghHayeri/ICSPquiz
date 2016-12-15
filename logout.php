<?php
include('connection.php');
session_start();
//print($_SERVER['HTTP_REFERER']);
$sql = "UPDATE users SET leave_first='".$_SERVER['HTTP_REFERER']."' WHERE id='".$_SESSION['id']."'";

if ($conn->query($sql) === TRUE) {
    //echo "Record updated successfully";
} else {
    //echo "Error updating record: " . $conn->error;
}

unset($_SESSION['username']);
unset($_SESSION['id']);
header("Location:index.php");
?>