<?php
$db = mysqli_connect('localhost' , 'id17962441_whatsupdoc_db' , ')sNRJ7&>_?z>!}RZ' , 'id17962441_whatsupdoc');
	if(!$db){
		echo "Database connection failed";
	}

	$patient_id = $_POST['patient_id'];
  $type = $_POST['type'];
	$details = $_POST['details'];

	// $fullname = 'wahid';
	// $user_id = 'wahid111';
	// $email = 'wahid@gmail.com';
	// $password = 'wahid123';
	// $phonenumber = '123456';
	// $validity = 1;


		$insert = "INSERT INTO `medical_history`(`patient_id`, `type`, `details`) VALUES ('$patient_id','$type','$details')";

		// $insert = "INSERT INTO user_authentication ( user_id,  password) VALUES ( '$user_id', '$password')";

		$result = mysqli_query($db,$insert);
		if($result){
			echo json_encode("true");
		}else{
			echo json_encode("false");
		}




?>
