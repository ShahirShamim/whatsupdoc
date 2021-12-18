<?php
$db = mysqli_connect('localhost' , 'id17962441_whatsupdoc_db' , ')sNRJ7&>_?z>!}RZ' , 'id17962441_whatsupdoc');
	if(!$db){
		echo "Database connection failed";
	}

	$name = $_POST['name'];
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


	$sql = "SELECT * FROM doctor WHERE phone_number='".$phone_number."'";


	$result = mysqli_query($db , $sql);
	$data = mysqli_fetch_array($result);

	if($data!=NULL){
		echo json_encode("account already exists");
		?>
		<a href="admin.php">Go back to mainpage</a>
		<?php
	}else{
		$insert = "INSERT INTO doctor (name, phone_number, password, gender, city) VALUES ('$name', '$phone_number', '$password', '$gender', '$city')";
		$sql2 = "SELECT * FROM doctor WHERE phone_number = '".$phone_number."'";
		$result = mysqli_query($db,$q) or die(mysqli_error($db));
		$row = mysqli_fetch_assoc($result)
		$insert2 = "INSERT INTO specialization (doctor_id, hospital_id, name, specialization_institute) VALUES ('$row['doctor_id']','$h_id','$specialization','$specinst')";
		// $insert = "INSERT INTO user_authentication ( user_id,  password) VALUES ( '$user_id', '$password')";

		$result2 = mysqli_query($db,$insert);
		$result3 = mysqli_query($db,$insert2);
		if($result2 & $result3){
			echo json_encode("Doctor Regsitered!");
			?>
			<a href="doc_hos_view.php">View your reviews</a>
			<?php
		}else{
			echo json_encode("Sign up failed :(");
			?>
			<a href="admin.php">Go back to mainpage</a>
			<?php
		}
	}



?>
