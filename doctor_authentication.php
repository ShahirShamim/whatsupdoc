<?php
	$db = mysqli_connect('localhost' , 'root' , '' , 'whatsupdoc');
	if(!$db){
		echo "Database connection failed";
	}

	$phone_number = $_POST['phone_number'];
	$password = $_POST['password'];

	// $user_id = 'wah';
	// $password = 'hammad123';

	$sql = "SELECT * FROM doctor WHERE phone_number='".$phone_number."' AND password='".$password."'";
	$result = mysqli_query($db , $sql);
	$data = mysqli_fetch_array($result);
	if($data==NULL){
		echo json_encode("Sign in failed :(");
	}else{
		echo json_encode("Welcome!");
	}		


?>
