<?php

$mysqli = new mysqli("localhost", "root", "", "task");
if($mysqli->connect_error) {
  exit('Error connecting to database'); //Should be a message a typical user could understand in production
}
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$mysqli->set_charset("utf8mb4");


$uname = $_POST['uname'];
$password = $_POST['pass'];
$date = $_POST['dob'];
$email = $_POST['email'];
$contact = $_POST['contact'];
$about = $_POST['abt'];
$today = date("Y-m-d");
$diff = date_diff(date_create($date), date_create($today));
$age  = $diff->format('%y');

try {
$stmt = $mysqli->prepare("INSERT INTO register (uname, password ,age ,dob ,email ,contact,about) VALUES (?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssissss", $_POST['uname'], $_POST['pass'], $age, $_POST['dob'], $_POST['email'], $_POST['contact'], $_POST['abt']);
$stmt->execute();
$stmt->close();
echo"Submitted,now u can go and login";
} catch(Exception $e) {
  if($mysqli->errno === 1062) echo 'Duplicate entry,Name already exists';
}

$curr = file_get_contents('data.json');
$arr = json_decode($curr, true);
$xtra = array(
    'uname' => $uname,
    'password' => $password,
    'age' => $age,
    'contact' => $contact,
    'email' => $email,
	'about' => $about
     );
$arr[] = $xtra;
$final = json_encode($arr);
if(!file_put_contents('data.json', $final))
    echo "Json error";
else
    echo "";
?>



