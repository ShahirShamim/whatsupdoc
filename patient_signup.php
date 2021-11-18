<?php
	$db = mysqli_connect('localhost' , 'root' , '', 'whatsupdoc');
	if(!$db){
		echo "Database connection failed";
	}

	$first_name = $_POST['first_name'];
  $last_name = $_POST['last_name'];
	$phone_number = $_POST['phone_number'];
  $password = $_POST['password'];
	$gender = $_POST['gender'];
	$date_of_birth = $_POST['date_of_birth'];
	$city = $_POST['city'];

	// $fullname = 'wahid';
	// $user_id = 'wahid111';
	// $email = 'wahid@gmail.com';
	// $password = 'wahid123';
	// $phonenumber = '123456';
	// $validity = 1;


	$sql = "SELECT * FROM patient WHERE phone_number='".$phone_number."'";


	$result = mysqli_query($db , $sql);
	$data = mysqli_fetch_array($result);

	if($data!=NULL){
		echo json_encode("account already exists");
	}else{
		$insert = "INSERT INTO patient ( first_name, last_name, phone_number, password, gender, date_of_birth, city) VALUES ('$first_name', '$last_name', '$phone_number', '$password', '$gender', '$date_of_birth', '$city')";

		// $insert = "INSERT INTO user_authentication ( user_id,  password) VALUES ( '$user_id', '$password')";

		$result = mysqli_query($db,$insert);
		if($result){
			echo json_encode("true");
		}else{
			echo json_encode("false");
		}
	}



?>
