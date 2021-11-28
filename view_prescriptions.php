<html>
<head>
  <link rel="stylesheet" type="text/css" href="main.css?v=<?php echo time(); ?>" media=”screen” />
</head>

<h1>Here is a list of your prescriptions: </h1>

<?php

  $db = mysqli_connect('localhost' , 'root' , '', 'whatsupdoc');
  if(!$db){
    echo "Database connection failed";
  }

  // $fullname = 'wahid';
  // $user_id = 'wahid111';
  // $email = 'wahid@gmail.com';
  // $password = 'wahid123';
  // $phonenumber = '123456';
  // $validity = 1;

  $sql = "SELECT * FROM prescription WHERE patient_id = 2 ";


    $result = mysqli_query($db , $sql);
    $data = array();
    while($row=mysqli_fetch_assoc($result))
    {
      $data[] = $row;
    }
    $ans = $data;

    echo json_encode($ans);



?>

</html>
