<?php
	$db = mysqli_connect('localhost' , 'root' , '', 'whatsupdoc');
	if(!$db){
		echo "Database connection failed";
	}

	$patient_id = $_POST['patient_id'];
	$doctor_id = $_POST['doctor_id'];
  $rating = $_POST['rating'];
	$feedback = $_POST['feedback'];

	// $fullname = 'wahid';
	// $user_id = 'wahid111';
	// $email = 'wahid@gmail.com';
	// $password = 'wahid123';
	// $phonenumber = '123456';
	// $validity = 1;


	$sql = "SELECT * FROM doctor WHERE doctor_id='".$doctor_id."'";


	$result = mysqli_query($db , $sql);
	$data = mysqli_fetch_array($result);

	if($data=NULL){
		echo json_encode("no doctor");
	}else{
		$insert = "INSERT INTO `doctor_review`(`patient_id`, `doctor_id`, `rating`, `feedback`)		VALUES ('$patient_id','$doctor_id','$rating','$feedback')";

		// $insert = "INSERT INTO user_authentication ( user_id,  password) VALUES ( '$user_id', '$password')";

		$result = mysqli_query($db,$insert);
		if($result){
			echo json_encode("Review Submitted");

		}else{
			echo json_encode("Review failed :(");
		}
	}



?>
