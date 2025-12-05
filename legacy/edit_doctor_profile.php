<html>
<head>
  <link rel="stylesheet" type="text/css" href="main.css?v=<?php echo time(); ?>" media=”screen” />
</head>

<?php $d_id = $_GET['var1']; ?>

<form name="Registration" method="post" action="edit_doctor_profile.php" style="border: 1px solid #ccc;">
<div class="container">
<h1>Edit Profile</h1>
<hr/>
<input type="hidden" name="doctor" value="<?php echo $d_id; ?>" />
<p><label for="phone">Phone number:</label><br /><input id="phone" name="phone_number" type="number" /></p>
<p><label for="psw"><b>Password</b></label><br /><input name="password" required="" type="password" placeholder="Enter Password" /></p>
<p><label for="gender">Gender</label><br /><select id="gender" name="gender">
<option value="male">Male</option>
<option value="female">Female</option>
<option value="other">Other</option>
</select></p>
<p><label for="city">City</label><br /><select id="city" name="city">
<option value="lahore">Lahore</option>
<option value="karachi">Karachi</option>
<option value="islamabad">Islamabad</option>
</select></p>
<p><label for="spec"><b>Specialization</b></label><br /><input name="specialization" required="" type="specialization" placeholder="Enter specialization" /></p>
<p><label for="specinst"><b>Specialization Institute</b></label><br /><input name="specinst" required="" type="specinst" placeholder="Enter specialization institute" /></p>
</div>
<input type="submit" name="button1" class="button" value="Submit  " />
</form>

</html>
