<?php
/*
$servername = "localhost";
$username = "root";
$password = "";
$db_name="sami";


// Create connection
$conn = new mysqli($servername, $username, $password, $db_name);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM users";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        print_r($row);
    }
} else {
    echo "0 results";
}
$conn->close();
*/
include('connection.php');
session_start(); // Starting Session
		$username='ali';
		$mail='ali@ali.com';
// SQL query to fetch information of registerd users and finds user match.
		// Check connection
		if ($conn->connect_error) {
		    die("Connection failed: " . $conn->connect_error);
		}
		$sql = "SELECT * from users where mail='$mail' AND username='$username'";
		$result = $conn->query($sql);
		$rows = mysqli_num_rows($result);
		print($rows);
		if ($rows == 1) {
$_SESSION['username']=$username; // Initializing Session
$row = $result->fetch_assoc();
$_SESSION['id']=$row['ID'];
print_r($_SESSION);
//header("location: profile.php"); // Redirecting To Other Page
} else {
	$error = "Username or Mail is invalid2";
}
?> 