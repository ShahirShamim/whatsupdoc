<?php
	$db = mysqli_connect('localhost' , 'root' , '', 'whatsupdoc');
	if(!$db){
		echo "Database connection failed";
	}
	session_start();
	$patient_id = $_SESSION['varid'];
  $type = $_POST['type'];
	$details = $_POST['details'];

	// $fullname = 'wahid';
	// $user_id = 'wahid111';
	// $email = 'wahid@gmail.com';
	// $password = 'wahid123';
	// $phonenumber = '123456';
	// $validity = 1;



		$insert = "INSERT INTO `medical_history`(`patient_id`, `type`, `details`)		VALUES ('$patient_id','$type','$details')";

		// $insert = "INSERT INTO user_authentication ( user_id,  password) VALUES ( '$user_id', '$password')";

		$result = mysqli_query($db,$insert);
		if($result){
			header("location: view_medical_history.php");
    }
    else{
			echo json_encode("Review failed :(");
		}



?>
