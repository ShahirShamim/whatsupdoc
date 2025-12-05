<html>

<?php $d_id = $_GET['var1']; ?>
<form name="Registration" method="post" action="doctor_review2.php" style="border: 1px solid #ccc;">
<input type="hidden" name="doctor" value="<?php echo $d_id; ?>" />
<div class="container">
<h1>Leave Review</h1>
<p>Please fill in the following details.</p>
<hr/>
<p><label for="feedback">feedback:</label><br /><input id="feedback" name="feedback" type="text" /></p>
<p><label for="rating">rating</label><br /><select id="rating" name="rating">
<option value=1>1</option>
<option value="2">2</option>
<option value="3">3</option>
<option value="4">4</option>
<option value="5">5</option>
</select></p>
</div>
<input type="submit" name="button1" class="button" value="Submit  " />
</form>

</html>
