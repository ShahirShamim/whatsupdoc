<html>
<head>
  <link rel="stylesheet" type="text/css"  href="/main.css"/>
</head>
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
	$result = $db->query($sql);
	$data = mysqli_fetch_array($result);

	if($data==NULL){
    echo json_encode("Sign in failed :(");
    exit;
	}else{
    session_start();
    $_SESSION['varid'] = $data['doctor_id'];
    $_SESSION['varphone'] = $data['phone_number'];
    $_SESSION['varname'] = $data['name'];
    $_SESSION['varcity'] = $data['city'];
    header("location: doctor.php");
	}


?>
</html>
