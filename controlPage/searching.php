<?php

	session_start();
	require_once "../phpRegister/connect.php";
	
	if (!(isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']!=true))
	{
		header('Location: Location: ../indexPage/index.php');
		exit();
	}
	if($_GET['data']!=NULL || ($_GET['data']!=NULL && $_GET['town']!=NULL))
	{
			$dane_czy_sa = true;
			$data_get = $_GET['data'];
			$polaczenie2 = @new mysqli($host, $db_user, $db_password, $db_name);
			//$first = mysqli_query($polaczenie2,"SELECT temperature_bmp AS temp, DATE_FORMAT(bmp180.date,'%T') AS date, DATE(bmp180.date) AS date_day FROM bmp180 WHERE DATE(bmp180.date) = DATE_SUB(CURDATE(), INTERVAL 11 DAY)");
			$sprawdzenie = mysqli_query($polaczenie2,"SELECT * FROM users WHERE login = '$data_get'");
			$sprawdzenie2 = $sprawdzenie->fetch_assoc();
			
			if($sprawdzenie2['access'] == 1)
			{
			$access = true;
			$first = mysqli_query($polaczenie2,"SELECT * FROM bmp180 WHERE user_id = (SELECT id from users where login = '$data_get') AND date=(Select max(date) from bmp180 where user_id = (SELECT id from users where login = '$data_get'))"); // WHERE user_id = (SELECT id from users where login = '$data_get')";
			$bmp = $first->fetch_assoc();
			$second = mysqli_query($polaczenie2,"SELECT * FROM dht11 WHERE user_id = (SELECT id from users where login = '$data_get') AND date=(Select max(date) from dht11 where user_id = (SELECT id from users where login = '$data_get'))");
			$dht = $second->fetch_assoc();
			$third = mysqli_query($polaczenie2,"SELECT * FROM mq7 WHERE user_id = (SELECT id from users where login = '$data_get') AND date=(Select max(date) from mq7 where user_id = (SELECT id from users where login = '$data_get'))");
			$mq = $third->fetch_assoc();
			$dane_nick = true;
			$dane_town = false;
			}
			else 
			{
				$access = false;
			}
	}
	if($_GET['town']!=NULL && $_GET['data']==NULL)
	{
			$dane_czy_sa = true;
			$data_get = $_GET['town'];
			$polaczenie2 = @new mysqli($host, $db_user, $db_password, $db_name);
			//$first = mysqli_query($polaczenie2,"SELECT temperature_bmp AS temp, DATE_FORMAT(bmp180.date,'%T') AS date, DATE(bmp180.date) AS date_day FROM bmp180 WHERE DATE(bmp180.date) = DATE_SUB(CURDATE(), INTERVAL 11 DAY)");
			$sprawdzenie = mysqli_query($polaczenie2,"SELECT * FROM users WHERE town = '$data_get' AND access=1 LIMIT 1");
			$sprawdzenie2 = $sprawdzenie->fetch_assoc();
			
			if($sprawdzenie2['access'] == 1)
			{
			$access = true;
			$first = mysqli_query($polaczenie2,"SELECT * FROM bmp180 WHERE user_id = (SELECT id from users WHERE town = '$data_get' AND access=1 LIMIT 1) AND date=(Select max(date) from bmp180 where user_id = (SELECT id from users WHERE town = '$data_get' AND access=1 LIMIT 1))"); // WHERE user_id = (SELECT id from users where login = '$data_get')";
			$bmp = $first->fetch_assoc();
			$second = mysqli_query($polaczenie2,"SELECT * FROM dht11 WHERE user_id = (SELECT id from users WHERE town = '$data_get' AND access=1 LIMIT 1) AND date=(Select max(date) from dht11 where user_id = (SELECT id from users WHERE town = '$data_get' AND access=1 LIMIT 1))");
			$dht = $second->fetch_assoc();
			$third = mysqli_query($polaczenie2,"SELECT * FROM mq7 WHERE user_id = (SELECT id from users WHERE town = '$data_get' AND access=1 LIMIT 1) AND date=(Select max(date) from mq7 where user_id = (SELECT id from users WHERE town = '$data_get' AND access=1 LIMIT 1))");
			$mq = $third->fetch_assoc();
			$dane_nick = false;
			$dane_town = true;
			}
			else 
			{
				$access = false;
			}
	}
	if($_GET['town']==NULL && $_GET['data']==NULL) $dane_czy_sa = false;
?>

<!DOCTYPE HTML>
<html lang="pl">
	<head>
		<meta charset="utf-8" />
		 <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		 
		 <title>M&M searching</title>
		 
		 <meta name ="description" contenr="Serwis o ciekawych rzeczach itp." />
		 <meta name="keywords" content="Elektronika , Mikroprocesory,Programowanie ,Gliwice ,Politechnika ,AEI" />
		 <link rel="shortcut icon" href="../images/Logo_ikona.ico">
		 
		 <link href="style_control.css" rel="stylesheet" type="text/css" />
	</head>
	
	<body>

		
	<?php 

if($dane_czy_sa == true) 
{
				if($sprawdzenie2['access'] == 1) 
				{
					echo "<div class=\"form\">"; 
							//	  <!-- Modal Content -->
								 
								echo"	<div class=\"container\" style=\"background-color:#292929\">";
								if($dane_nick == true)echo"	<h3 style = \"font-size:60px\"><b>Here is <span style=\"color:#c3ff00\">".$_GET['data']."</span> data:</b></h3>";
								if($dane_town == true)echo"	<h3 style = \"font-size:60px\"><b>Here is data from <span style=\"color:#c3ff00\">".$_GET['town']."</span>:</b></h3>";
								echo"	<div class=\"SMdata\">";
								echo"	<ul>";
								echo"	  <li>Temperature:&emsp;&emsp;&emsp;&emsp;&emsp;";
										echo $bmp['temperature_bmp']." [°C]<br>";
								echo"	   </li>";
								echo"	  <li>Humidity:&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;";
										echo $dht['humidity']." [%]<br>";
								echo"	  </li>";
								echo"	  <li>Atmospheric pressure:&emsp;" ;
										echo $bmp['humidity_bmp']." [hPa]<br>";
								echo"	   </li>";
								echo"	  <li>PPM:&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;"; 
										echo $mq['ppm']." [ppm]<br>";
								echo"	    </li>";
									
								echo"	</ul>";
								echo"	<p style=\"font-size:25px\";>Time:&emsp;";
										echo $mq['date']."<br>";
								echo"	   </p></div></div></div>";
				}
						if($sprawdzenie2['access'] == 0)
				{
								echo "<div class=\"form\">";
								echo"	<div class=\"SMdata\">";	
								echo"	<div class=\"container\" style=\"background-color:#292929\">";								
								echo"	<b><font color=\"#bf0000\" size=\"60\">User has blocked access to data!</font></b>";
								echo "</div></div></div>"; 
				}
}
?>
<div class="form">
<form action="../controlPage/searching.php" method="get">
		<input type="text" name="data" style="font-size: 3rem" placeholder ="Nickname">
		<span style="text-align:center;font-size:3rem;padding-bottom:0px"><b>Or</b></span>
		<input type="text" name="town" style="font-size: 3rem;" placeholder ="Town">
		<button id="p_button" type="submit" style="width: 1200px; height:7rem" class="signupbtn">Check!</button>
</form>	
<button id="back_button2" style="width: 1200px;" onclick="window.location.href = '../indexPage/index.php';">Back to main page!</button>

</div>
	</body>
</html>