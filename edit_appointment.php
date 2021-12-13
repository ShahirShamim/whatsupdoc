<html>
<head>
  <title>PHP Retrieve Data from MySQL using Drop Down Menu</title>
</head>
<body>

<?php $d_id = $_GET['var2']; ?>
<?php $s_id = $_GET['var1']; ?>
<form name="Book Appointment" method="post" action="edit_appointment_date.php?Key=<?php echo $d_id ?>" style="border: 1px solid #ccc;">
  <h1>Edit Appointment</h1>
  Hospital:
  <input type="hidden" name="slot" value="<?php echo $s_id; ?>" />
  <select id="hospital" name="hospital">
    <option disabled selected>-- Select Hospital --</option>
    <?php
        $db = mysqli_connect('localhost' , 'root' , '', 'whatsupdoc');
        if (!$db) {
            die(mysql_error());
        }
        $d_id = $_GET['var2'];
        $s_id = $_GET['var1'];
        $sql = "SELECT s.hospital_id, h.name FROM slot as s LEFT JOIN hospital as h ON h.hospital_id = s.hospital_id WHERE (s.slot_status = 'open' and s.appointment_status = 'available' and s.doctor_id = '$d_id') or s.slot_id = '$s_id'";
        $results = mysqli_query($db , $sql);

        while($data = mysqli_fetch_array($results))
        {
            echo $data['hospital_id'];
            echo "<option value='". $data['hospital_id'] ."'>" .$data['name'] ."</option>";  // displaying data in option menu
        }
    ?>
  </select>
  <input type="submit" name="button1" class="button" value="Submit" />
</form>

<?php mysqli_close($db);  // close connection ?>

</body>
</html>
