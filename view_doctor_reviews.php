<html>


<h1>Here are reviews for the doctor you selected: </h1>

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

  $sql = "SELECT * FROM doctor_review where doctor_id = 2 ";


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
