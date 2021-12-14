<?php
	$db = mysqli_connect('localhost' , 'root' , '', 'whatsupdoc');
	if(!$db){
		echo "Database connection failed";
	}

	$s_id = $_GET['var1'];



		$update = "UPDATE slot SET slot_status = 'closed', patient_id = NULL, appointment_status = 'available' WHERE slot_id = '$s_id'";

		// $insert = "INSERT INTO user_authentication ( user_id,  password) VALUES ( '$user_id', '$password')";

		$result = mysqli_query($db,$update);
		if($result){
			header("location: doctor.php");
		}else{
			echo json_encode("false");
		}



?>
