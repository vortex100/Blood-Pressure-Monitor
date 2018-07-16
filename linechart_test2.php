<!DOCTYPE HTML>
<html>
<head>
<script>
window.onload = function () {
	var options = {
		animationEnabled: true,
		theme: "light2",
		title:{
			text: "Systolic and Diastolic Blood Pressure"
		},
		axisX:{
			valueFormatString: "DD MMM"
		},
		axisY: {
			title: "Pressure Reading",
			suffix: "",
			minimum: 50
		},
		toolTip:{
			shared:true
		},
		legend:{
			cursor:"pointer",
			verticalAlign: "bottom",
			horizontalAlign: "left",
			dockInsidePlotArea: true,
			itemclick: toogleDataSeries
		},
		data: [{
			type: "line",
			showInLegend: true,
			name: "Systolic Pressure",
			markerType: "square",
			xValueFormatString: "DD MMM, YYYY",
			color: "#F08080",
			yValueFormatString: "#,##0K",
			dataPoints: [
			   <?php
					require ("dbinfo.php");
					// Create connection
					$conn = new mysqli($Host, $User, $Password, $DBName);
					// Check connection
					if ($conn->connect_error) {
						die("Connection failed: " . $conn->connect_error);
					}

					$sql = "(SELECT date, systolic FROM bpdata ORDER BY date DESC LIMIT 20) ORDER BY date ASC";
					$result = $conn->query($sql);

					if ($result->num_rows > 0) {
						// output data of each row
						while($row = $result->fetch_assoc()) {
							$mydate = $row["date"];
							$thisdate = strtotime("-1 month", strtotime($mydate));
							$newdate = date("Y, n, j", $thisdate);
							$systolic = $row["systolic"];
							echo "{ x: new Date($newdate), y: $systolic },";
						}
					}
					$conn->close();
            ?>
			]
		},
		{
			type: "line",
			showInLegend: true,
			name: "Diastolic Pressure",
			yValueFormatString: "#,##0K",
			dataPoints: [
				<?php
					require ("dbinfo.php");
					// Create connection
					$conn = new mysqli($Host, $User, $Password, $DBName);
					// Check connection
					if ($conn->connect_error) {
						die("Connection failed: " . $conn->connect_error);
					}

					$sql = "(SELECT date, diastolic FROM bpdata ORDER BY date DESC LIMIT 20) ORDER BY date ASC";
					$result = $conn->query($sql);

					if ($result->num_rows > 0) {
						// output data of each row
						while($row = $result->fetch_assoc()) {
							$mydate = $row["date"];
							$thisdate = strtotime("-1 month", strtotime($mydate));
							$newdate = date("Y, n, j", $thisdate);
							$diastolic = $row["diastolic"];
							echo "{ x: new Date($newdate), y: $diastolic },";
						}
					}
					$conn->close();
            ?>
			]
		}]
	};
	$("#chartContainer").CanvasJSChart(options);

	function toogleDataSeries(e){
		if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
			e.dataSeries.visible = false;
		} else{
			e.dataSeries.visible = true;
		}
		e.chart.render();
	}
}
</script>
</head>
<body>
<div id="chartContainer" style="height: 370px; width: 100%;"></div>
<script src="https://canvasjs.com/assets/script/jquery-1.11.1.min.js"></script>
<script src="https://canvasjs.com/assets/script/jquery.canvasjs.min.js"></script>
</body>
</html>