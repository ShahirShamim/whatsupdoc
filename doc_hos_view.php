
<html>
    <head>
        <title>Here are a list of doctors near you:</title>
    </head>
    <body>
      <a href="admin.php">Go back</a>
        <table>
        <thead>
            <tr>
                <td>Name</td>
                <td>Phone Number</td>
                <td>Specialization</td>
                <td>Gender</td>
                <td>City</td>
            </tr>
        </thead>
        <tbody>
        <?php
            $db = mysqli_connect('localhost' , 'root' , '', 'whatsupdoc');
            if (!$db) {
                die(mysql_error());
            }
            session_start();
            $h_id = $_SESSION['varhospital'];
            $q = "SELECT d.phone_number as phone_number, d.doctor_id as doctor_id, d.name as doctor_name, d.gender as gender, d.city as city, s.name as spec FROM specialization as s left join doctor as d on d.doctor_id = s.doctor_id WHERE s.hospital_id = '$h_id'";
            $result = mysqli_query($db,$q) or die(mysqli_error($db));
            while($row = mysqli_fetch_assoc($result)) {
            ?>
                <tr>
                  <td><?php echo $row['doctor_name']?></td>
                  <td><?php echo $row['phone_number']?></td>
                  <td><?php echo $row['spec']?></td>
                  <td><?php echo $row['gender']?></td>
                  <td><?php echo $row['city']?></td>
                  <td><input type="button" value="View Slots" onClick="window.location='view_hos_appointments.php?var1=<?php echo $row['doctor_id'] ?>&var2=<?php echo $row['phone_number'] ?>'"></td>
                  <td><input type="button" value="View Reviews" onClick="window.location='view_doctor_reviews.php?var1=<?php echo $row['doctor_id'] ?>&var2=<?php echo $row['phone_number'] ?>'"></td>
                  <td><input type="button" value="Create Appointment Slots" onClick="window.location='create_slot.php?var1=<?php echo $row['doctor_id'] ?>'"></td>
                </tr>

            <?php
            }
            ?>
            </tbody>
            </table>
    </body>
</html>
