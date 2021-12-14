<?php
	$db = mysqli_connect('localhost' , 'root' , '', 'whatsupdoc');
	if(!$db){
		echo "Database connection failed";
	}
	$d_id - $_POST['doctor'];
	$phone_number = $_POST['phone_number'];
  $password = $_POST['password'];
	$gender = $_POST['gender'];
	$city = $_POST['city'];
	$specialization = $_POST['specialization'];
	$specinst = $_POST['specinst'];
	session_start();
	$h_id = $_SESSION['varhospital'];
	// $fullname = 'wahid';
	// $user_id = 'wahid111';
	// $email = 'wahid@gmail.com';
	// $password = 'wahid123';
	// $phonenumber = '123456';
	// $validity = 1;


	$update = "UPDATE doctor SET phone_number = '$phone_number', $password WHERE hospital_id = '$hospital_id' AND doctor_id = '$d_id' AND date = '$date' AND timing = '$time'";
	$update2 = "UPDATE slot SET appointment_status = 'available', patient_id=NULL WHERE slot_id = '$s_id''";
	$result = mysqli_query($db,$update);
	$result2 = mysqli_query($db,$update2);
	if($result){
		header("location: patient.php");
	}else{
		echo json_encode("false");
	}


?>
