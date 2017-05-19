<?php include 'query.php'?>

<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="css/main.css">
</head>
<body>
	<?php include "left_nav.php";?>
	<h1>Students Page</h1>
	<table>
		<tr>
			<th>UMID</th>
			<th>First Name</th>
			<th>Last Name</th>
			<th>Project</th>
			<th>Email</th>
			<th>Phone</th>
			<th>Timeslot</th>
		</tr>
		<?php 
		$students = get_students();
		foreach ($students as $student){
			echo "<tr>";
				foreach ($student as $key=>$column){
					if($key == "start_time"){
						$date_start = new DateTime($column);
						$date_end = new DateTime($column);
						$date_end->add(new DateInterval('PT1H'));
						echo "<td>";
							echo $date_start->format('m/d/y g:i A')."- ".$date_end->format('g:i A'); 
						echo "</td>";
					} else{
						echo "<td>$column</td>";
					}
				}
			echo "</tr>";
		}
		?>
	</table>
</body>
</html>