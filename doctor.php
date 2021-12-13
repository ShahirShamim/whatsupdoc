<html>
<head></head>
<body>
  <?php session_start(); ?>
  <h1>Welcome Dr. <?php echo $_SESSION['varname'] ?>!</h1>
 <a href="view_myreviews.php">View your reviews</a>
 <form action="view_myhospitalreviews.php" method="post">
   Select hospital:
 <select id="hospital" name="hospital">
   <option disabled selected>-- Select Hospital --</option>
   <?php
       $db = mysqli_connect('localhost' , 'root' , '', 'whatsupdoc');
       if (!$db) {
           die(mysql_error());
       }
       $d_id = $_SESSION['varid'];
       $sql = "SELECT sp.hospital_id, h.name FROM specialization as sp LEFT JOIN hospital as h ON h.hospital_id = sp.hospital_id WHERE sp.doctor_id = '$d_id'";
       $results = mysqli_query($db , $sql);

       while($data = mysqli_fetch_array($results))
       {
           echo $data['hospital_id'];
           echo "<option value='". $data['hospital_id'] ."'>" .$data['name'] ."</option>";  // displaying data in option menu
       }
   ?>
 </select>
 <input type="submit" name="button1" class="button" value="View my hospital's reviews" />
</form>

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
     $d_id = $_SESSION['varid'];
     $q = "SELECT s.patient_id,s.slot_id, s.hospital_id, s.date, s.timing, p.first_name as patient_fname,s.doctor_id, p.last_name as patient_lname,d.name as doctor_name, s.room_number, h.name as hospital_name from slot as s left join patient as p on p.patient_id = s.patient_id left join doctor as d on d.doctor_id = s.doctor_id left join hospital as h on h.hospital_id = s.hospital_id where s.doctor_id = '$d_id' and s.appointment_status = 'booked'";
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
           <td><input type="button" value="Reschedule Appointment" onClick="window.location='edit_docappointment_date.php?var1=<?php echo $row['slot_id'] ?>&var2=<?php echo $row['hospital_id'] ?>&var3=<?php echo $row['patient_id'] ?>'"></td>
           <td><input type="button" value="Cancel Appointment" onClick="window.location='cancel_appointment_doc.php?var1=<?php echo $row['slot_id'] ?>'"></td>
           <td><input type="button" value="View patient medical history" onClick="window.location='view_medical_history_doc.php?var1=<?php echo $row['patient_id'] ?>'"></td>
           <td><input type="button" value="Generate prescription" onClick="window.location='prescription_generate.php?var2=<?php echo $row['patient_id'] ?>'"></td>
           <td><input type="button" value="Close Appointment" onClick="window.location='close_apptstatus.php?var1=<?php echo $row['slot_id'] ?>'"></td>
         </tr>

     <?php
     }
     ?>
     </tbody>
     </table>
     <h3>Here are your upcoming slots: </h3>
     <table>
     <thead>
         <tr>
             <td>Date</td>
             <td>Timing</td>
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
         $d_id = $_SESSION['varid'];
         $q = "SELECT s.date, s.timing,s.room_number, h.name as hospital_name from slot as s left join doctor as d on d.doctor_id = s.doctor_id left join hospital as h on h.hospital_id = s.hospital_id where s.doctor_id = '$d_id' and s.slot_status = 'open' and s.appointment_status = 'available'";
         $result = mysqli_query($db,$q) or die(mysqli_error($db));
         while($row = mysqli_fetch_assoc($result)) {
         ?>
             <tr>
               <td><?php echo $row['date']?></td>
               <td><?php echo $row['timing']?></td>
               <td><?php echo $row['room_number']?></td>
               <td><?php echo $row['hospital_name']?></td>
               <td><input type="button" value="Cancel Slot" onClick="window.location='cancel_slot.php?var1=<?php echo $row['slot_id'] ?>'"></td>
             </tr>

         <?php
         }
         ?>
         </tbody>
         </table>
</body>
</html>
