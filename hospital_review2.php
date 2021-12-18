<?php
$db = mysqli_connect('localhost' , 'id17962441_whatsupdoc_db' , ')sNRJ7&>_?z>!}RZ' , 'id17962441_whatsupdoc');
	if(!$db){
		echo "Database connection failed";
	}
	session_start();
	$patient_id = $_SESSION['varid'];
	$hospital_id = $_POST['hospital'];
  $rating = $_POST['rating'];
	$feedback = $_POST['feedback'];

	// $fullname = 'wahid';
	// $user_id = 'wahid111';
	// $email = 'wahid@gmail.com';
	// $password = 'wahid123';
	// $phonenumber = '123456';
	// $validity = 1;



		$insert = "INSERT INTO `hospital_review`(`patient_id`, `hospital_id`, `rating`, `feedback`)		VALUES ('$patient_id','$hospital_id','$rating','$feedback')";

		// $insert = "INSERT INTO user_authentication ( user_id,  password) VALUES ( '$user_id', '$password')";

		$result = mysqli_query($db,$insert);
		if($result){
			header("location: patient.php")

		}else{
			echo json_encode("Review failed :(");
		}



?>
