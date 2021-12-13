<?php
	$db = mysqli_connect('localhost' , 'root' , '' , 'whatsupdoc');
	if(!$db){
		echo "Database connection failed";
	}

	$sql = "SELECT * FROM patient";
	$result = mysqli_query($db , $sql);
	$data = mysqli_fetch_array($result);
	if($data==NULL){
		echo json_encode("false");
	}else{
		echo json_encode("true");
	}


?>
