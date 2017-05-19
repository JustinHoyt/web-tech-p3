<?php

function update_time_slot($umid, $time_slot_id){
	include 'connect.php';
	
	$sql = "
		UPDATE `student` 
		SET time_slot_id = $time_slot_id 
		WHERE umid = $umid";
	
	try {
		$results = $db->exec($sql);
	} catch (Exception $e) {
		echo "Error!: " . $e->getMessage() . "<br />";
	}
}