<!DOCTYPE html>

<html lang="en">
<head>
   <title>Edit Blood Pressure Data</title>
	<meta charset="utf-8">
   <META name="description" content="">
   <meta http-equiv="content-type" content="text/html; charset=UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="maincss.css">
	<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
   <link rel="icon" href="/favicon.ico" type="image/x-icon">
</head>

<body>
&nbsp;<br>
<?php
   $error = "";

	$id=$_GET['id'];

	require ("dbinfo.php");
	// Create connection
	$conn = mysqli_connect($Host, $User, $Password, $DBName);
	// Check connection
	if (!$conn) {
		 die("Connection failed: " . mysqli_connect_error());
	}

	$tablename = "bpdata";
	$sql = "SELECT * FROM $tablename WHERE id = '$id'";
	$result = mysqli_query($conn, $sql);

	if (mysqli_num_rows($result) > 0) {
		while ($row = mysqli_fetch_assoc($result)) {
			$myid = $row["id"];
			$clientid = $row["client"];
			$mydate = $row["date"];
			$mytime = $row["time"];
			$systolic = $row["systolic"];
			$diastolic = $row["diastolic"];
			$pulse = $row["pulse"];
			$notes = $row["notes"];
			if ($pulse == "0") {
				$pulse = "n.a.";
			}
		}
	} else {
		$error = "0 results";
	}
	mysqli_close($conn);
?>
<div class="container">
	<div class="row">
	   <div class="col-sm-6">
	      <a href="index.php"><img src="images/bp_logo1.jpg" class="img-responsive center-block" width="162" height="148" alt="bp_logo1"></a>
	   </div>
		<div class="col-sm-6">
			<h1 class="text-center">Blood Pressure Monitor</h1><p style="text-align: center;">for Robert Lattery</p>
	   </div>
	</div>
   <div class="row" style="margin-top: 20px;">
		<div class="col-sm-3">
		   &nbsp;
	   </div>
	   <div class="col-sm-6" style="border: solid 1px #DDDDDD; margin-bottom: 20px;">
			<h2>Edit Blood Pressure Data:</h2>
			<form action="editbp2.php" method="post">
				<div class="form-group">
					<label for="mydate">Date:</label>
					<input type="date" class="form-control" id="mydate" name="mydate" value="<?php echo $mydate; ?>" required>
				</div>
				<div class="form-group">
					<label for="mytime">Time:</label>
					<input type="time" class="form-control" id="mytime" name="mytime" value="<?php echo $mytime; ?>" required>
				</div>
				<div class="form-group">
					<label for="systolic">Systolic:</label>
					<input type="number" class="form-control" id="systolic" name="systolic" value="<?php echo $systolic; ?>" required>
				</div>
				<div class="form-group">
					<label for="diastolic">Diastolic:</label>
					<input type="number" class="form-control" id="diastolic" name="diastolic" value="<?php echo $diastolic; ?>" required>
				</div>
				<div class="form-group">
					<label for="pulse">Pulse:</label>
					<input type="text" class="form-control" id="pulse" name="pulse" value="<?php echo $pulse; ?>">
				</div>
				<div class="form-group">
					<label for="notes">Notes:</label>
					<textarea class="form-control" rows="2" id="notes" name="notes"><?php echo $notes; ?></textarea>
				</div>
				<input type="hidden" name="myid" value="<?php echo $id; ?>">
				<button type="submit" class="btn btn-primary" id="submit" name="submit">Edit</button>
			</form>
			<br>&nbsp;
	   </div>
	   <div class="col-sm-3">
		   &nbsp;
	   </div>
	</div>
	<div class="row">
		<div class="col-sm-3">
		  &nbsp;
		</div>
	   <div class="col-sm-6">
		  <p><a href="index.php"><span class='glyphicon glyphicon-circle-arrow-left'></span> Home</a></p>
		  &nbsp;
		</div>
		<div class="col-sm-3">
		  &nbsp;
		</div>
	</div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
</body>

</html>
