<html>
<head>
  <title>PHP Retrieve Data from MySQL using Drop Down Menu</title>
</head>
<body>
<?php $s_id = $_GET['var1']; ?>
<form name="Book Appointment2" method="post" action="edit_docappointment_time.php" style="border: 1px solid #ccc;">
  <h1>Edit Appointment</h1>
  <p>Select new date: </p>
  Date:
  <?php $hospital_id = $_GET['var2']; ?>
  <?php $patient_id = $_GET['var3']; ?>
  <input type="hidden" name="patient" value="<?php echo $patient_id; ?>" />
  <input type="hidden" name="hospital" value="<?php echo $hospital_id; ?>" />
  <input type="hidden" name="slot" value="<?php echo $s_id; ?>" />
  <select id="date" name="date">
    <option disabled selected>-- Select Date --</option>
    <?php
        $db = mysqli_connect('localhost' , 'root' , '', 'whatsupdoc');
        if (!$db) {
            die(mysql_error());
        }
        $d_id = $_SESSION['varid'];
        $sql2 = "SELECT * FROM slot WHERE (slot.slot_status = 'open' and slot.appointment_status = 'available' AND slot.doctor_id = '$d_id' AND slot.hospital_id = '$hospital_id') or slot.slot_id = '$s_id'";
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
