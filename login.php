<?php
include('connection.php');
session_start(); // Starting Session
$_SESSION['error_login'] = "";
$error = 'first'; // Variable To Store Error Message
if (!empty($_POST)) {
    if (empty($_POST['username']) || empty($_POST['mail']) || empty($_POST['studentnumber'])) {
        $_SESSION['error_login'] = "Username or Email or StudentNumber is invalid";
        header("location: index.php");
    } else {
// Define $username and $password
        $username = $_POST['username'];
        $mail = $_POST['mail'];
        $studentNumber = $_POST['studentnumber'];
// SQL query to fetch information of registerd users and finds user match.
        $sql = "SELECT * from users where mail='$mail' AND username='$username'";
        $result = $conn->query($sql);
        $rows = mysqli_num_rows($result);
        if ($rows == 1) {
            $_SESSION['username'] = $username; // Initializing Session
            $row = $result->fetch_assoc();
            $_SESSION['id'] = $row['ID'];
            header("location: 1-1.php"); // Redirecting To Other Page
        } else {
            $_SESSION['error_login'] = "Username or Email or StudentNumber is invalid";
            header("location: index.php");

            /*$sql = "INSERT INTO users (mail, username, student_number, leave_first) VALUES ('$mail', '$username', '$studentNumber', 'http://localhost/sami/end_effort.php')";
            $conn->query($sql);

            $sql = "SELECT * from users where mail='$mail' AND username='$username'";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();

            $_SESSION['username'] = $username; // Initializing Session
            $_SESSION['id'] = $row['ID'];

            header("location: 1-1.php");*/
        }
    }
}
if (!empty($_SESSION['id'])) {
    //print($_SESSION['id']);
}
?>