<?php
 
 session_start();
	require_once "../phpRegister/connect.php";
	
	//$data_teraz = $_GET[data_cos];
	//echo "data:".$_GET['data'];
	$data_get = $_GET['data'];
	$polaczenie2 = @new mysqli($host, $db_user, $db_password, $db_name);
	//$first = mysqli_query($polaczenie2,"SELECT temperature_bmp AS temp, DATE_FORMAT(bmp180.date,'%T') AS date, DATE(bmp180.date) AS date_day FROM bmp180 WHERE DATE(bmp180.date) = DATE_SUB(CURDATE(), INTERVAL 11 DAY)");
	$first = mysqli_query($polaczenie2,"SELECT ppm AS ppm, DATE_FORMAT(mq7.date,'%T') AS date, DATE(mq7.date) AS date_day FROM mq7 WHERE DATE(mq7.date) = '$data_get'");
	$first1 = $first->fetch_assoc();
	$second = mysqli_query($polaczenie2,"SELECT CURDATE() AS today");
	$second1 = $second->fetch_assoc();
 
$dataPoints = array();
//$i = 1;
while($row = mysqli_fetch_array($first))
{
	//echo $row['temp'] . " " . $row['date']; echo "<br>"; 
$y = $row['ppm'];
//for($i = 0; $i < 100; $i++){
	//$y += rand(0, 10) - 5; 
	//$i = $i +1;
$i = $row['date'];
	array_push($dataPoints, array("label" => $i, "y" => $y));
}
 //<?php echo "Temperature from ".$row['date_day'];
?>
<!DOCTYPE HTML>
<html>
<head> 
<script>
window.onload = function () {
 
var chart = new CanvasJS.Chart("chartContainer", {
	theme: "light2", // "light1", "light2", "dark1", "dark2"
	animationEnabled: true,
	zoomEnabled: true,
	title: {
		text: "DAILY CO CONCENTRATION"
	},
	axisY: {
		title: "CO [PPM]"
	},
	data: [{
		type: "area",     
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
<form action="../plotPage/ppm_line.php" method="get">
<h1 style="float: left;">Change date:</h1>
<?php echo "<input type=\"date\" name=\"data\" style=\"font-size: 3rem\" max=".$second1['today']." value = ".$data_get.'>' ?>
<button id="p_button" type="submit" class="signupbtn">Check!</button>
</form>
<button id="back_button" onclick="window.location.href = '../plotPage/plot.php';"class="cancelbtn">Back to plot page!</button>
<!--
<a href="temp_line.php?data=2019-11-25">Kliknij tu.</a>-->
</body>
</html>