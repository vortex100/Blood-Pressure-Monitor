<!DOCTYPE html>

<html lang="en">
<head>
   <title>Edit Blood Pressure Data - Result</title>
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

   $msg = "";

   if (isset($_POST['submit'])) {

	   foreach($_POST as $key =>$value) {
			$$key=$value;
		}

		//convert date into MYSQL date
		$phpdate = strtotime($mydate);
		$mysqldate = date('Y-m-d', $phpdate);

		//convert time into MYSQL time
		$phptime = strtotime($mytime);
		$mysqltime = date('H:i:s', $phptime);

		require ("dbinfo.php");
		// Create connection
		$conn = mysqli_connect($Host, $User, $Password, $DBName);
		// Check connection
		if (!$conn) {
			 die("Connection failed: " . mysqli_connect_error());
		}

		//escape variables for security
		$myid = mysqli_real_escape_string($conn, $myid);
		$mysqldate = mysqli_real_escape_string($conn, $mysqldate);
		$mysqltime = mysqli_real_escape_string($conn, $mysqltime);
		$systolic = mysqli_real_escape_string($conn, $systolic);
		$diastolic = mysqli_real_escape_string($conn, $diastolic);
		$pulse = mysqli_real_escape_string($conn, $pulse);
		$notes = mysqli_real_escape_string($conn, $notes);

		$Tablename = "bpdata";
		$sql = "UPDATE $Tablename SET date='$mysqldate', time='$mysqltime', systolic='$systolic', diastolic='$diastolic', pulse='$pulse', notes='$notes' WHERE id='$myid' ";

		if (mysqli_query($conn, $sql)) {
			$msg = "Your Blood Pressure data was updated in the database";
		} else {
			$msg = "Error: " . $sql . "<br>" . mysqli_error($conn);
		}

		mysqli_close($conn);
	}
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
			<p style="color: red; text-weight: bold;"><?php echo $msg; ?></p>
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
