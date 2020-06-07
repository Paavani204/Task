<?php
$mysqli = new mysqli("localhost", "root", "", "task");
if($mysqli->connect_error) {
  exit('Error connecting to database'); //Should be a message a typical user could understand in production
}
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$mysqli->set_charset("utf8mb4");

$uname = $_POST['uname'];
$sql = $mysqli->prepare("SELECT * FROM register WHERE uname = ?");
$sql->bind_param("s", $_POST['uname']);
$sql->execute();
$count = $sql->get_result();
if($count->num_rows === 0)
	{
		echo"Sorry... invalid username or password"; 
	}
else
{
	echo "<center><h3> Details: </h3> </br>";
	while($row = $count->fetch_assoc())
	{
		echo "Username:    " . $row["uname"] ."<br> Password:  " .$row["password"] ."<br> age:   " .$row["age"] ."<br> Date of Birth:  " .$row["dob"] . "<br> Email:  " .$row["email"] ."<br> Contact:  " .$row["contact"] ."<br> About:  " .$row["about"] . "<br>";
	}
	echo "</center>";
}
?>

