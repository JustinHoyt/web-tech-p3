<?php
session_start();
$umid_error = $first_name_error = $last_name_error = $project_title_error = $email_address_error = $phone_number_error = $time_slot_id_error = "";
$umid = $first_name = $last_name = $project_title = $email_address = $phone_number = $time_slot_id = "";

function add_student($umid, $first_name, $last_name, $project_title, $email_address, $phone_number, $time_slot_id){
	include('connect.php');

	$sql = "INSERT INTO `student` (`umid`, `first_name`, `last_name`, `project_title`, `email_address`, `phone`, `time_slot_id`) 
			VALUES ('$umid', '$first_name', '$last_name', '$project_title', '$email_address', '$phone_number', '$time_slot_id')";
	
	try {
		$results = $db->exec($sql);
	} catch (Exception $e) {
		echo "Error!: " . $e->getMessage() . "<br />";
	}
}

if ($_SERVER ['REQUEST_METHOD'] == 'POST') {
	$is_valid = true;
	$umid = trim ( filter_input ( INPUT_POST, 'umid', FILTER_SANITIZE_NUMBER_INT ) );
	$first_name = trim ( filter_input ( INPUT_POST, 'first_name', FILTER_SANITIZE_STRING ) );
	$last_name = trim ( filter_input ( INPUT_POST, 'last_name', FILTER_SANITIZE_STRING ) );
	$project_title = trim ( filter_input ( INPUT_POST, 'project_title', FILTER_SANITIZE_STRING ) );
	$email_address = trim ( filter_input ( INPUT_POST, 'email_address', FILTER_SANITIZE_EMAIL ) );
	$phone_number = trim ( filter_input ( INPUT_POST, 'phone_number', FILTER_SANITIZE_STRING ) );
	$time_slot_id = trim ( filter_input ( INPUT_POST, 'time_slot_id', FILTER_SANITIZE_NUMBER_INT ) );

	if (!(strlen($_POST["umid"]) == 8 and ctype_digit($_POST["umid"]))) {
		$umid_error = "Invalid: Must be an 8-digit number";
		$is_valid = false;
	}

	if (empty($_POST["first_name"]) or !ctype_alpha($_POST["first_name"])) {
		$first_name_error = "Invalid: Cannot be empty and must not contain numbers or special characters";
		$is_valid = false;
	}

	if (empty($_POST["last_name"]) or !ctype_alpha($_POST["last_name"]))  {
		$last_name_error = "Invalid: Cannot be empty and must not contain numbers or special characters";
		$is_valid = false;
	}

	if (empty($_POST["project_title"])) {
		$project_title_error = "Invalid: Cannot be empty";
		$is_valid = false;
	}

	if (empty($_POST["email_address"]) or !filter_var($email_address, FILTER_VALIDATE_EMAIL)) {
		$email_address_error = "Invalid: Cannot be empty and must be a valid email address";
		$is_valid = false;
	}

	if (empty($_POST["phone_number"]) or !preg_match("/^[0-9]{3}-[0-9]{3}-[0-9]{4}$/", $phone_number)) {
		$phone_number_error = "Invalid: Cannot be empty and must be of the form XXX-XXX-XXXX";
		$is_valid = false;
	}

	if (!isset($_POST["time_slot_id"])) {
		$time_slot_id_error = "Missing";
		$is_valid = false;
	}

	if($is_valid == true){
		//check if the student has already registered
		include 'query.php';
		if(is_registered($umid)) {
			$_SESSION["umid"] = $umid;
			$_SESSION["first_name"] = $first_name;
			$_SESSION["last_name"] = $last_name;
			$_SESSION["project_title"] = $project_title;
			$_SESSION["email_address"] = $email_address;
			$_SESSION["phone_number"] = $phone_number;
			$_SESSION["time_slot_id"] = $time_slot_id;
	
			header('Location: registration_conflict.php');
		} else{
			add_student($umid, $first_name, $last_name, $project_title, $email_address, $phone_number, $time_slot_id);
			header('Location: insert_student.php');
		}
	}
}
?>

<?php include "query.php";?>
<?php $time_slots = get_time_slots(); ?>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="css/main.css">
	
<!-- 	<link rel="stylesheet" href="css/test.css"> -->
<!-- 	<link rel="stylesheet" href="css/font-awesome.min.css"> -->
</head>
<body>
	<header>
		<?php include "left_nav.php";?>
	</header>
	
	<div>	
		<h1>Home Page</h1>
		<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">	
			
			UMID:<br> 
			<input <?php if($umid_error != ""){echo " class='invalid' ";}?> 
				type="text" name="umid" value="<?php echo htmlspecialchars($umid);?>">
			<span class="error"><?php echo $umid_error;?></span> <br>
			
			First name:<br> 
			<input <?php if($first_name_error != ""){echo " class='invalid' ";}?> 
			 	type="text" name="first_name" value="<?php echo htmlspecialchars($first_name);?>"> 
			<span class="error"><?php echo $first_name_error;?></span> <br>
			
			Last name:<br> 
			<input <?php if($last_name_error != ""){echo " class='invalid' ";}?>  
				type="text" name="last_name" value="<?php echo htmlspecialchars($last_name);?>">
			<span class="error"><?php echo $last_name_error;?></span> <br>
			
			Project title:<br> 
			<input <?php if($project_title_error != ""){echo " class='invalid' ";}?> 
				type="text" name="project_title" value="<?php echo htmlspecialchars($project_title);?>">
			<span class="error"><?php echo $project_title_error;?></span> <br>
			
			Email address:<br> 
			<input <?php if($email_address_error != ""){echo " class='invalid' ";}?> 
				type="text" name="email_address" value="<?php echo htmlspecialchars($email_address);?>">
			<span class="error"><?php echo $email_address_error;?></span> <br>
			
			Phone number:<br> 
			<input <?php if($phone_number_error != ""){echo " class='invalid' ";}?>  
				type="text" name="phone_number" value="<?php echo htmlspecialchars($phone_number);?>">
			<span class="error"><?php echo $phone_number_error;?></span> <br>
			
			Time Slot:<br>
				<select name="time_slot_id">
					<?php 
					foreach ($time_slots as $time_slot){
						$date_start = new DateTime($time_slot['start_time']);
						$date_end = new DateTime($time_slot['start_time']);
						$date_end->add(new DateInterval('PT1H'));
						if($time_slot['num_slots_open'] > 0){
							echo "<option value='".$time_slot['time_slot_id']."'> ".
								$date_start->format('m/d/y g:i A'). '-' . $date_end->format('g:i A').
								', '.$time_slot['num_slots_open'].' seats remaining'.
							"</option>";
						} else{
							echo "<option value='".$time_slot['time_slot_id']."' disabled> ".
									$date_start->format('m/d/y g:i A'). '-' . $date_end->format('g:i A').
									', '.$time_slot['num_slots_open'].' seats remaining'.
									"</option>";
						}
					}
					?>
				</select>
				<span class="error"><?php echo $time_slot_id_error;?></span>
				
			 <br>
			<br> <input type="submit" class="btn" value="Submit">
		</form>
	</div>
</body>
</html>