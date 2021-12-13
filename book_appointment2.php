<?php
	$db = mysqli_connect('localhost' , 'root' , '', 'whatsupdoc');
	if(!$db){
		echo "Database connection failed";
	}

	$hospital_id = $_POST['hospital'];
  $date = $_POST['slot_date'];
  $time = $_POST['time'];
  session_start();
  $pid = $_SESSION['varid'];
  $d_id = $_GET['Key'];
	// $fullname = 'wahid';
	// $user_id = 'wahid111';
	// $email = 'wahid@gmail.com';
	// $password = 'wahid123';
	// $phonenumber = '123456';
	// $validity = 1;



		$update = "UPDATE slot SET appointment_status = 'booked', patient_id='$pid' WHERE hospital_id = '$hospital_id' AND doctor_id = '$d_id' AND date = '$date' AND timing = '$time'";

		// $insert = "INSERT INTO user_authentication ( user_id,  password) VALUES ( '$user_id', '$password')";

		$result = mysqli_query($db,$update);
		if($result){
			header("location: patient.php");
		}else{
			echo json_encode("false");
		}



?>
