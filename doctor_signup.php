<?php
	$db = mysqli_connect('localhost' , 'root' , '', 'whatsupdoc');
	if(!$db){
		echo "Database connection failed";
	}

	$name = $_POST['name'];
	$phone_number = $_POST['phone_number'];
  $password = $_POST['password'];
	$gender = $_POST['gender'];
	$city = $_POST['city'];

	// $fullname = 'wahid';
	// $user_id = 'wahid111';
	// $email = 'wahid@gmail.com';
	// $password = 'wahid123';
	// $phonenumber = '123456';
	// $validity = 1;


	$sql = "SELECT * FROM doctor WHERE phone_number='".$phone_number."'";


	$result = mysqli_query($db , $sql);
	$data = mysqli_fetch_array($result);

	if($data!=NULL){
		echo json_encode("account already exists");
	}else{
		$insert = "INSERT INTO doctor (name, phone_number, password, gender, city) VALUES ('$name', '$phone_number', '$password', '$gender', '$city')";

		// $insert = "INSERT INTO user_authentication ( user_id,  password) VALUES ( '$user_id', '$password')";

		$result = mysqli_query($db,$insert);
		if($result){
			echo json_encode("You have signed up!");
			
		}else{
			echo json_encode("Sign up failed :(");
		}
	}



?>
