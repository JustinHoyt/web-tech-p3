<?php
function get_students(){
	include('connect.php');

	$sql = "SELECT s.umid, s.first_name, s.last_name, s.project_title, s.email_address, s.phone, t.start_time FROM student s LEFT JOIN time_slot t ON s.time_slot_id = t.time_slot_id";
		
	try {
		$results = $db->query($sql);
		$students = $results->fetchAll(PDO::FETCH_ASSOC);
		return $students;
	} catch (Exception $e) {
		echo "Error!: " . $e->getMessage() . "<br />";
	}
}

function get_time_slots(){
	include('connect.php');

	$sql = "SELECT time_slot.time_slot_id, start_time, (6 - count(student.time_slot_id)) as num_slots_open 
			FROM `time_slot`
			LEFT JOIN student
			ON student.time_slot_id = time_slot.time_slot_id
			group by time_slot.time_slot_id
			";

	try {
		$results = $db->query($sql);
		$time_slots = $results->fetchAll(PDO::FETCH_ASSOC);
		return $time_slots;
	} catch (Exception $e) {
		echo "Error!: " . $e->getMessage() . "<br />";
	}
}

function is_registered($umid){
	include('connect.php');

	$sql = "SELECT * FROM student WHERE student.umid = $umid";

	try {
		$results = $db->query($sql);
		return ($results->rowCount() > 0);
	} catch (Exception $e){
		echo "Error!: " . $e->getMessage() . "<br />";
	}
}