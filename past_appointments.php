<html>
<head></head>
<body>
<a href="patient.php">Go back</a>
<h3>Here are your upcoming appointments: </h3>
<table>
<thead>
    <tr>
        <td>Date</td>
        <td>Timing</td>
        <td>Patient Name</td>
        <td>Doctor Name</td>
        <td>Room Number</td>
        <td>Hospital Name</td>
        <td>Status</td>
    </tr>
</thead>
<tbody>
<?php
    $db = mysqli_connect('localhost' , 'root' , '', 'whatsupdoc');
    if (!$db) {
        die(mysql_error());
    }
    $pid = $_SESSION['varid'];
    $q = "SELECT s.hospital_id,s.appointment_status, s.slot_id, s.date, s.timing, p.first_name as patient_fname,s.doctor_id, p.last_name as patient_lname,d.name as doctor_name, s.room_number, h.name as hospital_name from slot as s left join patient as p on p.patient_id = s.patient_id left join doctor as d on d.doctor_id = s.doctor_id left join hospital as h on h.hospital_id = s.hospital_id where s.patient_id = '$pid' and slot.appointment_status = 'closed'";
    $result = mysqli_query($db,$q) or die(mysqli_error($db));
    while($row = mysqli_fetch_assoc($result)) {
    ?>
        <tr>
          <td><?php echo $row['date']?></td>
          <td><?php echo $row['timing']?></td>
          <td><?php echo $row['patient_fname']." ".$row['patient_lname']?></td>
          <td><?php echo $row['doctor_name']?></td>
          <td><?php echo $row['room_number']?></td>
          <td><?php echo $row['hospital_name']?></td>
          <td><?php echo $row['appointment_status']?></td>
          <td><input type="button" value="Leave Doctor review" onClick="window.location='doctor_review.php?var1=<?php echo $row['doctor_id'] ?>'"></td>
          <td><input type="button" value="Leave Hospital review" onClick="window.location='hospital_review.php?var1=<?php echo $row['hospital_id'] ?>'"></td>
        </tr>

    <?php
    }
    ?>
    </tbody>
    </table>
  </body>
  </html>
