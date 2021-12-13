<html>
<head></head>
<body>
  <?php session_start(); ?>
  <h1>Welcome <?php echo $_SESSION['varname'] ?>!</h1>
 <a href="view_doctors.php">View Doctors</a>
 <a href="view_hospitals.php">View Hospitals</a>
 <a href="view_medical_history.php">View Medical History</a>
 <a href="past_appointments.php">View Past Appointments</a>
 <form>
 <input type="button" value="Logout" onClick="window:location='logout.php'">
</form>
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
     </tr>
 </thead>
 <tbody>
 <?php
     $db = mysqli_connect('localhost' , 'root' , '', 'whatsupdoc');
     if (!$db) {
         die(mysql_error());
     }
     $pid = $_SESSION['varid'];
     $q = "SELECT s.slot_id, s.date, s.timing, p.first_name as patient_fname,s.doctor_id, p.last_name as patient_lname,d.name as doctor_name, s.room_number, h.name as hospital_name from slot as s left join patient as p on p.patient_id = s.patient_id left join doctor as d on d.doctor_id = s.doctor_id left join hospital as h on h.hospital_id = s.hospital_id where s.patient_id = '$pid' and s.appointment_status = 'booked'";
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
           <td><input type="button" value="Edit Appointment" onClick="window.location='edit_appointment.php?var1=<?php echo $row['slot_id'] ?>&var2=<?php echo $row['doctor_id'] ?>'"></td>
           <td><input type="button" value="Cancel Appointment" onClick="window.location='cancel_appointment.php?var1=<?php echo $row['slot_id'] ?>'"></td>
         </tr>

     <?php
     }
     ?>
     </tbody>
     </table>
     <h3>Here are your prescriptions: </h3>
     <table>
     <thead>
         <tr>
             <td>Date</td>
             <td>Doctor</td>
             <td>Type</td>
             <td>Details</td>
         </tr>
     </thead>
     <tbody>
     <?php
         $db = mysqli_connect('localhost' , 'root' , '', 'whatsupdoc');
         if (!$db) {
             die(mysql_error());
         }
         $pid = $_SESSION['varid'];
         $q = "SELECT date(pr.created_at) as date, d.name as doctor_name, pr.type,pr.details from prescription as pr left join doctor as d on d.doctor_id = pr.doctor_id where pr.patient_id = '$pid'";
         $result = mysqli_query($db,$q) or die(mysqli_error($db));
         while($row = mysqli_fetch_assoc($result)) {
         ?>
             <tr>
               <td><?php echo $row['date']?></td>
               <td><?php echo $row['doctor_name']?></td>
               <td><?php echo $row['type']?></td>
               <td><?php echo $row['details']?></td>
             </tr>

         <?php
         }
         ?>
         </tbody>
         </table>
</body>
</html>
