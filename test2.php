<!DOCTYPE html>
<html>
<body>

<?php
  session_start();
include('connection.php');
if (empty($_SESSION['id'])) {
    header("location: index.php");
	print("1");
}
//else{
$_SESSION['next']="logout_page.php";
///////////////////////
$url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
$sql = "INSERT INTO logs (id, url)
VALUES ('".$_SESSION['id']."',,'$url')";

if ($conn->query($sql) === TRUE) {
    //echo "New record created successfully";
} else {
    //echo "Error: " . $sql . "<br>" . $conn->error;
  header( "location:".$_SESSION['next']."" );
	print("2");
}
//}
  ?>

</body>
</html>