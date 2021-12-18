<html>
<head>
  <title>PHP Retrieve Data from MySQL using Drop Down Menu</title>
</head>
<body>
<?php $d_id = $_GET['Key']; ?>
<form name="Book Appointment2" method="post" action="book_appointment_time.php?Key=<?php echo $d_id ?>" style="border: 1px solid #ccc;">
  <h1>Book an Appointment</h1>
  <p>Please fill in the following details: </p>
  Date:
  <?php $hospital_id = $_POST['hospital']; ?>
  <?php echo $hospital_id ?>
  <input type="hidden" name="hospital" value="<?php echo $hospital_id; ?>" />
  <select id="date" name="date">
    <option disabled selected>-- Select Date --</option>
    <?php
$db = mysqli_connect('localhost' , 'id17962441_whatsupdoc_db' , ')sNRJ7&>_?z>!}RZ' , 'id17962441_whatsupdoc');
        if (!$db) {
            die(mysql_error());
        }
        $d_id = $_GET['Key'];
        $sql2 = "SELECT * FROM slot WHERE slot.slot_status = 'open' and slot.appointment_status = 'available' AND slot.doctor_id = '$d_id' AND slot.hospital_id = '$hospital_id'";
        $results2 = mysqli_query($db , $sql2);

        while($data = mysqli_fetch_array($results2))
        {
            echo "<option value='". $data['date'] ."'>" .$data['date'] ."</option>"; // displaying data in option menu
        }
    ?>
  </select>
  <input type="submit" name="button1" class="button" value="Submit" />
</form>
<?php mysqli_close($db);  // close connection ?>

</body>
</html>
