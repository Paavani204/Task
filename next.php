<?php
$mysqli = new mysqli("localhost", "root", "", "task");
if($mysqli->connect_error) {
  exit('Error connecting to database'); //Should be a message a typical user could understand in production
}
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$mysqli->set_charset("utf8mb4");

$uname = $_POST['uname'];
$password = $_POST['pass'];
$sql = $mysqli->prepare("SELECT * FROM register WHERE uname = ? AND password= ?");
$sql->bind_param("ss", $_POST['uname'] , $_POST['pass']);
$sql->execute();
$result = $sql->get_result();
if($result->num_rows === 0){
      echo"Sorry... invalid username or password"; 
}
else
{
	echo "Login Successful!";
	header('Location: home.html');
}
?>
