<?php

	session_start();
	
	if (!(isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']!=true))
	{
		header('Location: Location: ../indexPage/index.php');
		exit();
	}
	

?>

<!DOCTYPE HTML>
<html lang="pl">
	<head>
		<meta charset="utf-8" />
		 <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		 
		 <title>M&M control</title>
		 
		 <meta name ="description" contenr="Serwis o ciekawych rzeczach itp." />
		 <meta name="keywords" content="Elektronika , Mikroprocesory,Programowanie ,Gliwice ,Politechnika ,AEI" />
		 <link rel="shortcut icon" href="../images/Logo_ikona.ico">
		 
		 <link href="style_control.css" rel="stylesheet" type="text/css" />
	</head>
	
	<body>
	<div class="check" style="text-align: center;font-size:7rem;">
		<b>CHECK:</b>
	</div>
	
	
	<button id="11" onClick="window.location.reload();" class="led" style="margin-top:2%;">Temperature</button> <!-- przycisk dla pinu 11 -->
	<button id="12" onClick="window.location.reload();" class="led">Humidity</button> <!-- przycisk dla pinu 12 -->
	<button id="13" onClick="window.location.reload();" class="led">Concentration</button> <!-- przycisk dla pinu 13 -->
	<button id="10" onClick="window.location.reload();" class="led">Atmospheric pressure</button> <!-- przycisk dla pinu 14 -->
	<button id="back_button2" onclick="window.location.href = '../indexPage/index.php';">Back to main page!</button>
		
	<script src="jquery.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$(".led").click(function(){
				var p = $(this).attr('id'); // pobranie wartoœci (dla jednego z pinów)
				
				// wys³anie HTTP GET request do adresu IP z parametrem "pin" i wartoœci¹ "p"
				//$.get("http://192.168.4.1:80/", {pin:p}); // wykonanie polecenia
				//$.get("http://192.168.1.33:81/", {pin:p}); // wykonanie polecenia STARE ESP
				//$.get("http://192.168.43.248:81/", {pin:p}); // wykonanie polecenia STARE ESP - TEL
				$.get("http://192.168.43.241:81/", {pin:p});//NOWE ESP
				//$.get("http://192.168.1.42:81/", {pin:p}); //FUN_EXT
				
				
			});
		});
	</script>
	</body>
</html>