<!DOCTYPE html>

<html lang="en">
<head>
   <title>Blood Pressure History</title>
	<meta charset="utf-8">
   <META name="description" content="">
   <meta http-equiv="content-type" content="text/html; charset=UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="maincss.css">
	<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
   <link rel="icon" href="/favicon.ico" type="image/x-icon">
	<style>
		th {
		   background-color: #FFFFFF;
			color: #000000;
		}
	</style>
</head>

<body>
&nbsp;<br>

<div class="container">
	<div class="row">
	   <div class="col-sm-12">
			<h1 class="text-center">Blood Pressure Monitor</h1><p style="text-align: center;">for Robert Lattery</p>
	   </div>
	</div>
   <div class="row" style="margin-top: 20px;">
		<div class="col-sm-2">
		   &nbsp;
	   </div>
	   <div class="col-sm-8" style="margin-bottom: 20px;">
			<h2>Blood Pressure History:</h2>
			<div class="table-responsive">
			   <table class="table table-bordered">
					<thead>
						<tr>
							<th>Date</th>
							<th>Time</th>
							<th>Systolic</th>
							<th>Diastolic</th>
							<th>Pulse</th>
							<th>Notes</th>
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

                  $tablename = "bpdata";
						$sql = "SELECT * FROM $tablename ORDER BY date DESC";
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
								echo "</tr>";
							}
						} else {
							echo "<tr><td colspan='6'>no results</td></tr>";
						}
						$conn->close();
             	?>
					</tbody>
				</table>
			</div>
	   </div>
	   <div class="col-sm-2">
		   &nbsp;
	   </div>
	</div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
</body>

</html>
