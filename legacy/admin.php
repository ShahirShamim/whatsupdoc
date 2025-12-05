<html>
<head></head>
<body>
  <?php session_start(); ?>
  <h1>Welcome <?php echo $_SESSION['varname'] ?>!</h1>
 <a href="view_hospitalreviews.php">View your reviews</a>
 <a href="doctor_signup.html">Register a Doctor</a>
 <a href="doc_hos_view.php">View your hospital's doctors</a>
 <form>
 <input type="button" value="Logout" onClick="window:location='logout.php'">
</form>
</body>
</html>
