<?php
session_start();
include('connection.php');
if (empty($_SESSION['id'])) {
    header("location: index.php");
}

$sql = "UPDATE questions SET hint_rate=1,  WHERE id='".$_SESSION['id']."' and question='".$_SESSION['current_q']."'";
$conn->query($sql);

header("location:".$_SESSION['current_q']."".php"");
?>