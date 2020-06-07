<?php
$mysqli = new mysqli("localhost", "root", "", "task");
if($mysqli->connect_error) {
  exit('Error connecting to database'); //Should be a message a typical user could understand in production
}
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$mysqli->set_charset("utf8mb4");


$uname= $_POST['uname'];
$sql = $mysqli->prepare("select * from register where uname = ?");
$sql->bind_param("s",$uname);
$sql->execute();
$count=$sql->get_result();
if($count->num_rows === 0)
    echo "NO such Username exist";
else
{
$dob = $_POST['dob'];
$abt = $_POST['abt'];
$password=$_POST['pass'];
$email = $_POST['email'];
$contact = $_POST['contact'];
$today = date("Y-m-d");
$diff = date_diff(date_create($dob), date_create($today));
$age  = $diff->format('%y');
if($dob != NULL)
{
	$sql=$mysqli->prepare("UPDATE register SET dob=?,age=? WHERE uname=?");
	$sql->bind_param("sss",$dob,$age,$uname);
	$sql->execute();
}
if($abt != NULL)
{
	$sql= $mysqli->prepare("UPDATE register SET about=? WHERE uname=?");
	$sql->bind_param("ss",$abt,$uname);
	$sql->execute();
}
if($contact != NULL)
{
	$sql=$mysqli->prepare("UPDATE register SET contact=? WHERE uname=?");
	$sql->bind_param("ss",$contact,$uname);
	$sql->execute();
}
if($password != NULL)
{
	$sql=$mysqli->prepare("UPDATE register SET password=? WHERE uname=?");
	$sql->bind_param("ss",$password,$uname);
	$sql->execute();
	
}
if($email != NULL)
{
	$sql= $mysqli->prepare("UPDATE register SET email =? WHERE uname=?");
	$sql->bind_param("ss",$email,$uname);
	$sql->execute();
}
if($sql->execute() == TRUE)
{
	echo "Updated successfully";
}
else
{
	echo"Sorry... username not available"; 
}

$curr = file_get_contents('data.json');
$arr = json_decode($curr, true);
$xtra = array(
    'uname' => $uname,
    'age' => $age,
    'contact' => $contact,
    'email' => $email,
	'about'=> $abt
     );
$arr[] = $xtra;
$final = json_encode($arr);
if(!file_put_contents('data.json', $final))
    echo "Json error";
else
    echo "";
}
?>