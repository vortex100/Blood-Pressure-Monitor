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
   $msg = "";

	$id=$_GET['id'];

	require ("dbinfo.php");
	// Create connection
	$conn = mysqli_connect($Host, $User, $Password, $DBName);
	// Check connection
	if (!$conn) {
		 die("Connection failed: " . mysqli_connect_error());
	}

	$tablename = "bpdata";
	$sql = "DELETE FROM $tablename WHERE id = '$id'";

	if (mysqli_query($conn, $sql)) {
		$msg = "The Blood Pressure data was sucessfully deleted from the database.";
	}
	else {
		$msg = "<b>ERROR:</b> Something went wrong and the Blood Pressure data was not deleted from the database";
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
			<h2>Delete Blood Pressure Data:</h2>
			<p><?php echo "<p style='color: red; font-weight: bold;'>$msg</p>"; ?></p>
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
