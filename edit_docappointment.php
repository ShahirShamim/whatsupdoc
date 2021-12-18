<?php
$db = mysqli_connect('localhost' , 'id17962441_whatsupdoc_db' , ')sNRJ7&>_?z>!}RZ' , 'id17962441_whatsupdoc');
	if(!$db){
		echo "Database connection failed";
	}

	$hospital_id = $_POST['hospital'];
  $date = $_POST['slot_date'];
  $time = $_POST['time'];
  session_start();
  $d_id = $_SESSION['varid'];
	$s_id = $_POST['slot'];
	$p_id = $_POST['patient'];
	// $fullname = 'wahid';
	// $user_id = 'wahid111';
	// $email = 'wahid@gmail.com';
	// $password = 'wahid123';
	// $phonenumber = '123456';
	// $validity = 1;

		$sql2 = "SELECT slot_id from slot where slot.hospital_id = '$hospital_id' and slot.doctor_id = '$d_id' and slot.date = '$date' and slot.timing = '$time'";
		$results2 = mysqli_query($db , $sql2);

		$data = mysqli_fetch_array($results2);
		if($data['slot_id'] != $s_id)
		{
			$update = "UPDATE slot SET appointment_status = 'booked', patient_id='$p_id' WHERE hospital_id = '$hospital_id' AND doctor_id = '$d_id' AND date = '$date' AND timing = '$time'";
			$update2 = "UPDATE slot SET appointment_status = 'available', patient_id=NULL WHERE slot_id = '$s_id''";
			$result = mysqli_query($db,$update);
			$result2 = mysqli_query($db,$update2);
			if($result){
				header("location: doctor.php");
			}else{
				echo json_encode("false");
			?>
				<a href="doctor.php">Go back</a>
			<?php
			}
		}else{
			header("location: doctor.php");
		}
		?>

		// $insert = "INSERT INTO user_authentication ( user_id,  password) VALUES ( '$user_id', '$password')";





?>
