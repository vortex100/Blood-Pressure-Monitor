<!DOCTYPE html>

<html lang="en">
<head>
   <title>Blood Pressure Monitor</title>
   <meta charset="utf-8">
   <META name="description" content="Blood Pressure Monitor: record and save your blood pressure readings">
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

		//values
		$rowid = "0";
		$clientid = "1";

		//escape variables for security
		$mysqldate = mysqli_real_escape_string($conn, $mysqldate);
		$mysqltime = mysqli_real_escape_string($conn, $mysqltime);
		$systolic = mysqli_real_escape_string($conn, $systolic);
		$diastolic = mysqli_real_escape_string($conn, $diastolic);
		$pulse = mysqli_real_escape_string($conn, $pulse);
		$notes = mysqli_real_escape_string($conn, $notes);

		$Tablename = "bpdata";
		$sql = "INSERT INTO $Tablename (id, client, date, time, systolic, diastolic, pulse, notes) VALUES ('$rowid', '$clientid', '$mysqldate', '$mysqltime', '$systolic', '$diastolic', '$pulse', '$notes');";

		if (mysqli_query($conn, $sql)) {
			$msg = "Your Blood Pressure data was entered into the database";
		} else {
			$msg = "Error: " . $sql . "<br>" . mysqli_error($conn);
		}

		mysqli_close($conn);
	}
?>
<div class="container">
	<div class="row">
	   <div class="col-sm-6">
	      <img src="images/bp_logo1.jpg" class="img-responsive center-block" width="162" height="148" alt="bp_logo1">
	   </div>
		<div class="col-sm-6">
			<h1 class="text-center">Blood Pressure Monitor</h1><p style="text-align: center;">for Robert Lattery</p>
	   </div>
	</div>
   <div class="row" style="margin-top: 20px;">
	   <div class="col-sm-6" style="border: solid 1px #DDDDDD; margin-bottom: 20px;">
			<h2>Add New Blood Pressure Readings:</h2>
			<form action="index.php" method="post">
				<div class="form-group">
					<label for="mydate">Date:</label>
					<input type="date" class="form-control" id="mydate" name="mydate" required>
				</div>
				<div class="form-group">
					<label for="mytime">Time:</label>
					<input type="time" class="form-control" id="mytime" name="mytime" required>
				</div>
				<div class="form-group">
					<label for="systolic">Systolic:</label>
					<input type="number" class="form-control" id="systolic" name="systolic" required>
				</div>
				<div class="form-group">
					<label for="diastolic">Diastolic:</label>
					<input type="number" class="form-control" id="diastolic" name="diastolic" required>
				</div>
				<div class="form-group">
					<label for="pulse">Pulse:</label>
					<input type="number" class="form-control" id="pulse" name="pulse">
				</div>
				<div class="form-group">
					<label for="notes">Notes:</label>
					<textarea class="form-control" rows="2" id="notes" name="notes"></textarea>
				</div>
				<button type="submit" class="btn btn-primary" id="submit" name="submit">Submit</button>
			</form>
			<br><br>
			<img src="images/bp_table.jpg" class="img-responsive center-block" width="609" height="720" alt="blood pressure table">
			<br>&nbsp;
	   </div>
	   <div class="col-sm-6">
		   <h2 class="text-center" style="margin-top: 0px;">Blood Pressure History</h2><p style="text-align: center;">Last 30 Readings</p>
			<?php
			   echo "<p style='color: red; text-weight: bold;'>$msg</p>";
			?>
			<div class="table-responsive">
			   <table class="table table-bordered">
					<thead>
						<tr>
							<th>Date</th>
							<th style="width: 60px;">Time</th>
							<th>Systolic</th>
							<th>Diastolic</th>
							<th>Pulse</th>
							<th>Notes</th>
							<th>&nbsp;</th>
						</tr>
					</thead>
					<tbody>
               <?php
             	   require ("dbinfo.php");
             		// Create connection
						$conn = new mysqli($Host, $User, $Password, $DBName);
						// Check connection
						if ($conn->connect_error) {
							die("Connection failed: " . $conn->connect_error);
						}

						$sql = "SELECT * FROM bpdata ORDER BY date DESC LIMIT 31";
						$result = $conn->query($sql);

						if ($result->num_rows > 0) {
							// output data of each row
							while($row = $result->fetch_assoc()) {
							   $myid = $row["id"];
								$clientid = $row["client"];
							   $mydate = $row["date"];
								$thisdate = strtotime($mydate);
                        $newdate = date("m/d/Y", $thisdate);
                        $mytime = $row["time"];
								$thistime = strtotime($mytime);
								$newtime = date("g:i A", $thistime);
								$systolic = $row["systolic"];
								$diastolic = $row["diastolic"];
								$pulse = $row["pulse"];
								$notes = $row["notes"];
								if ($pulse == "0") {
								   $pulse = "n.a.";
								}
							   echo "<tr>";
								echo "<td>$newdate</td>";
								echo "<td>$newtime</td>";
								echo "<td>$systolic</td>";
								echo "<td>$diastolic</td>";
								echo "<td>$pulse</td>";
								echo "<td>$notes</td>";
								echo "<td><a href='editbp.php?id=$myid'><span class='glyphicon glyphicon-edit' title='edit'></span></a> &nbsp; <a href='deletebp.php?id=$myid' onclick=\"return confirm('Are you sure you want to delete this Blood Pressure data?\\nIt will be permanently deleted from the database.');\" title='delete'><span class='glyphicon glyphicon-remove' title='delete'></span></a></td>";
								echo "</tr>";
							}
						} else {
							echo "<tr><td colspan='6'>no results</td></tr>";
						}
						$conn->close();
             	?>
					</tbody>
				</table>
				<p>See more <a href="bp_history.php">Blood Pressure History <span class='glyphicon glyphicon-circle-arrow-right'></span></a></p>
				<p>See the <a href="linechart.php" target="_blank">Blood Pressure Line Chart <span class='glyphicon glyphicon-circle-arrow-right'></span></a></p>
			</div>
	   </div>
	</div>
	<div class="row">
	   <div class="col-sm-12">
		  &nbsp;
		</div>
	</div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
</body>

</html>
