<?php
session_start();
include 'update_time_slot.php';

$umid = $_SESSION["umid"];;
$first_name = $_SESSION["first_name"]; 
$last_name = $_SESSION["last_name"];
$project_title = $_SESSION["project_title"];
$email_address = $_SESSION["email_address"];
$phone_number = $_SESSION["phone_number"];
$time_slot_id = $_SESSION["time_slot_id"]; 

if ($_SERVER ['REQUEST_METHOD'] == 'POST') {
	if($_POST['change_time'] == "yes"){
		update_time_slot($umid, $time_slot_id);
		header("Location: insert_student.php");
	} elseif ($_POST['change_time'] == "no"){
		header("Location: students.php");
	} else {
		header("Location: registration_conflict.php");
	}
}

?>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="css/main.css">
</head>
<body>
	<?php include "left_nav.php";?>
	<h1>Registration Conflict</h1>
	<h3>do you want to change your time slot?</h3>
	<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
		Yes <input type="radio" name="change_time" value="yes">
		No <input type="radio" name="change_time" value="no">
		<br> 
		<br> 
		<input type="submit" class="btn" value="Submit">
	</form>
</body>
</html>