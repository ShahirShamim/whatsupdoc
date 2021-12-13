<html>
<head>
  <title>PHP Retrieve Data from MySQL using Drop Down Menu</title>
</head>
<body>
<?php $d_id = $_GET['Key']; ?>
<form name="Book Appointment2" method="post" action="edit_appointment2.php?Key=<?php echo $d_id ?>" style="border: 1px solid #ccc;">
  <h1>Edit Appointment</h1>
  <p>Select new time slot: </p>
  Time:
  <?php $hospital_id = $_POST['hospital']; ?>
  <?php $slot_date = $_POST['date']; ?>
  <?php $s_id = $_POST['slot']; ?>
  <input type="hidden" name="hospital" value="<?php echo $hospital_id; ?>" />
  <input type="hidden" name="slot_date" value="<?php echo $slot_date; ?>" />
  <input type="hidden" name="slot" value="<?php echo $s_id; ?>" />
  <select id="time" name="time">
    <option disabled selected>-- Select Timing --</option>
    <?php
        $db = mysqli_connect('localhost' , 'root' , '', 'whatsupdoc');
        if (!$db) {
            die(mysql_error());
        }
        $d_id = $_GET['Key'];
        $sql2 = "SELECT * FROM slot WHERE (slot.slot_status = 'open' and slot.appointment_status = 'available' AND slot.doctor_id = '$d_id' AND slot.hospital_id = '$hospital_id' AND slot.date = '$slot_date') or slot.slot_id = '$s_id'";
        $results2 = mysqli_query($db , $sql2);

        while($data = mysqli_fetch_array($results2))
        {
            echo "<option value='". $data['timing'] ."'>" .$data['timing'] ."</option>"; // displaying data in option menu
        }
    ?>
  </select>
  <input type="submit" name="button1" class="button" value="Submit" />
</form>
<?php mysqli_close($db);  // close connection ?>

</body>
</html>
