<?php
$mysqli = new mysqli("localhost", "root", "", "task");
if($mysqli->connect_error) {
  exit('Error connecting to database'); //Should be a message a typical user could understand in production
}
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$mysqli->set_charset("utf8mb4");

$uname = $_POST['uname'];
$sql = $mysqli->prepare("select * from register where uname = ?");
$sql->bind_param("s",$uname);
$sql->execute();
$count=$sql->get_result();
if($count->num_rows === 0)
	echo"Sorry... invalid username";
else
{
$stmt = $mysqli->prepare("DELETE FROM register WHERE uname = ?");
 $stmt->bind_param("s", $_POST['uname']);
     $stmt->execute();
     echo"Your Account deleted Successfully";
     $stmt->close();
}
?>