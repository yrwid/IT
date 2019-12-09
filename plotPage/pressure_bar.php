<?php
 
 session_start();
	require_once "../phpRegister/connect.php";

	$polaczenie2 = @new mysqli($host, $db_user, $db_password, $db_name);
	$first = mysqli_query($polaczenie2,"SELECT avg(humidity_bmp) AS press, DATE(bmp180.date) AS date FROM bmp180 WHERE DATE(bmp180.date) = DATE_SUB(CURDATE(), INTERVAL 14 DAY)");
	$first1 = $first->fetch_assoc();
	$second = mysqli_query($polaczenie2,"SELECT avg(humidity_bmp) AS press, DATE(bmp180.date) AS date FROM bmp180 WHERE DATE(bmp180.date) = DATE_SUB(CURDATE(), INTERVAL 15 DAY)");
	$second1 = $second->fetch_assoc();
	$third = mysqli_query($polaczenie2,"SELECT avg(humidity_bmp) AS press, DATE(bmp180.date) AS date FROM bmp180 WHERE DATE(bmp180.date) = DATE_SUB(CURDATE(), INTERVAL 16 DAY)");
	$third1 = $third->fetch_assoc();
	$four = mysqli_query($polaczenie2,"SELECT avg(humidity_bmp) AS press, DATE(bmp180.date) AS date FROM bmp180 WHERE DATE(bmp180.date) = DATE_SUB(CURDATE(), INTERVAL 17 DAY)");
	$four1 = $four->fetch_assoc();
	$five = mysqli_query($polaczenie2,"SELECT avg(humidity_bmp) AS press, DATE(bmp180.date) AS date FROM bmp180 WHERE DATE(bmp180.date) = DATE_SUB(CURDATE(), INTERVAL 18 DAY)");
	$five1 = $five->fetch_assoc();
	$six = mysqli_query($polaczenie2,"SELECT avg(humidity_bmp) AS press, DATE(bmp180.date) AS date FROM bmp180 WHERE DATE(bmp180.date) = DATE_SUB(CURDATE(), INTERVAL 19 DAY)");
	$six1 = $six->fetch_assoc();
	$seven = mysqli_query($polaczenie2,"SELECT avg(humidity_bmp) AS press, DATE(bmp180.date) AS date FROM bmp180 WHERE DATE(bmp180.date) = DATE_SUB(CURDATE(), INTERVAL 20 DAY)");
	$seven1 = $seven->fetch_assoc();
 
$dataPoints = array( 
	/*array("y" => $seven1['press'], "label" => $seven1['date'] ),
	array("y" => $six1['press'], "label" => $six1['date'] ),
	array("y" => $five1['press'], "label" => $five1['date'] ),
	array("y" => $four1['press'], "label" => $four1['date'] ),
	array("y" => $third1['press'], "label" => $third1['date'] ),
	array("y" => $second1['press'], "label" => $second1['date'] ),
	array("y" => $first1['press'], "label" => $first1['date'] )*/
	array("y" => $third1['press'], "label" => $third1['date'] ),
	array("y" => $third1['press'], "label" => $third1['date'] ),
	array("y" => $first1['press'], "label" => $first1['date'] ),
	array("y" => $third1['press'], "label" => $third1['date'] ),
	array("y" => $first1['press'], "label" => $first1['date'] ),
	array("y" => $third1['press'], "label" => $third1['date'] ),
	array("y" => $first1['press'], "label" => $first1['date'] )
);
 
?>
<!DOCTYPE HTML>
<html>
<head>
<script>
window.onload = function() {
 
var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	theme: "light2",
	title:{
		text: "AVG LAST WEEK ATMOSPHERIC PRESSURE"
	},
	axisY: {
		title: "ATMOSPHERIC PRESSURE [hPa]"
	},
	data: [{
		type: "column",
		yValueFormatString: "#,##0.## [hPa]",
		dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();
 
}
</script>
<meta charset="utf-8" />
	 <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	 
	 <title>M&M</title>
	 
	 <meta name ="description" contenr="Serwis o ciekawych rzeczach itp." />
	 <meta name="keywords" content="Elektronika , Mikroprocesory,Programowanie ,Gliwice ,Politechnika ,AEI" />
	 <link rel="shortcut icon" href="../images/Logo_ikona.ico">
	 
	 <link href="style_plot.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="chartContainer" style="height: 880px; width: 100%;"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
<button id="back_button" style="width: 95%; height:5rem; margin-left:50px" onclick="window.location.href = '../plotPage/plot.php';"class="cancelbtn">Back to plot page!</button>
</body>
</html>