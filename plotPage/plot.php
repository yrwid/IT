<?php

	session_start();
	require_once "../phpRegister/connect.php";

	$polaczenie2 = @new mysqli($host, $db_user, $db_password, $db_name);
	if ((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']==true))
	{
	$id = $_SESSION['id'];
	$first = mysqli_query($polaczenie2,"SELECT * FROM bmp180 WHERE user_id = '$id' AND date=(Select max(date) from bmp180 where user_id = '$id')");
	$bmp = $first->fetch_assoc();
	$second = mysqli_query($polaczenie2,"SELECT * FROM dht11 WHERE user_id = '$id' AND date=(Select max(date) from dht11 where user_id = '$id')");
	$dht = $second->fetch_assoc();
	$third = mysqli_query($polaczenie2,"SELECT * FROM mq7 WHERE user_id = '$id' AND date=(Select max(date) from mq7 where user_id = '$id')");
	$mq = $third->fetch_assoc();
	}
	$today = mysqli_query($polaczenie2,"SELECT CURDATE() AS today");
	$today1 = $today->fetch_assoc();
	

?>

<!DOCTYPE HTML>
<html lang="pl">
  <head>
     <meta charset="utf-8" />
	 <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	 <script src="plotly.min.js"></script>
	 <title>M&M</title>
	 
	 <meta name ="description" contenr="Serwis o ciekawych rzeczach itp." />
	 <meta name="keywords" content="Elektronika , Mikroprocesory,Programowanie ,Gliwice ,Politechnika ,AEI" />
	 <link rel="shortcut icon" href="../images/Logo_ikona.ico">
	 
	 <link href="abc.css" rel="stylesheet" type="text/css" />
  </head>
 
  <body>
		<div class="wrapper"> 
			<div class="header">
				<div class="logo">
						<img src="../images/logo.jpg" style="float: left;"/>
						 <span style="color: #7E6398">M&M</span>  
 						 <span style="color: #025D45">Company</span> 
						<div style="clear:both;"></div>
				</div>
				<?php /*
	if ((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']==true))
	{
		//echo "<p>Witaj ".$_SESSION['login'].'!</p>';
		//echo "<p><b>E-mail</b>: ".$_SESSION['email'];
		//echo "<p>Hello, <a href=\"../profilePage/profile.php\">".$_SESSION['login'].'</a></p>';
		//echo "<button id=\"p4\" onclick=\"window.location.href = '../profilePage/profile.php'\">".$_SESSION['login'].'</button>';
	
	}*/
   
?>
			</div>
			
			
			<!-- TU DODAŁEM-->
			<?php
							if ((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']==true))
							{
							echo <<< EOT
<button id="p3" style="float: right;width: 10%;margin-right:10px;background-color: #e68a00;" onclick="window.location.href = '../phpRegister/logout.php'">Log Out</button>
EOT;
							echo "<button id=\"p4\" onclick=\"window.location.href = '../profilePage/profile.php'\">".$_SESSION['login'].'</button>';
							echo "<button id=\"p5\" onclick=\"document.getElementById('id02').style.display='block'\">Live Data</button>";
							echo "<button id=\"p7\" onclick=\"window.location.href = '../controlPage/control.php'\">Control</button>";
							echo "<button id=\"p8\" onclick=\"window.location.href = '../controlPage/searching.php?data=&town='\">Search</button>";
							unset($_SESSION['blad']);
							unset($_SESSION['blad2']);
							}
							else
							{
								echo"<button id=\"p1\" onclick=\"document.getElementById('id01').style.display='block'\">Log In</button>";
								echo"<button id=\"p2\" onclick=\"window.location.href = '../phpRegister/register.php'\">Sign Up</button>";
							}
						?>
						
			<!-- KONIEC DODAWANIA-->
			<div class="nav">
				<ol>
				  <li><a href="../indexPage/index.php">Main page</a></li>
				  <li><a href="../aboutPage/about.php">About us</a></li>
				  <li><a href="../productPage/prod.php">Our product</a></li>
				  <li><a href="../softwarePage/soft.php">Software</a></li>
				  <li><a href="../contactPage/contact.php">Contact us</a></li>
				</ol>
			</div>
					 
		<?php 
			if ((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']==true))
				{
					
					echo "<h1 style = \"text-align: center;\">Hey, <span style =\"color: #f5c001\">".$_SESSION['login'].'</span> here are your charts!</h1>';
					//DODAĆ ŻE PRZENOSI DO DZISIEJSZEJ DATY !!!!!!!
					echo "<div class=\"box-2\"><div onclick=\"window.location.href = 'temp_bar.php'\" class=\"btn btn-two\"><span>TEMPERATURE <br>(COLUMN)</span></div></a></div>";
					echo "<div class=\"box-2\"><div onclick=\"window.location.href = 'temp_line.php?data=".$today1['today']."'\" class=\"btn btn-two\"><span>TEMPERATURE <br>(LINE)</span></div></div>";
					echo "<div class=\"box-2\"><div onclick=\"window.location.href = 'hum_bar.php'\" class=\"btn btn-two\"><span>HUMIDITY <br>(COLUMN)</span></div></div>";
					echo "<div class=\"box-2\"><div onclick=\"window.location.href = 'hum_line.php?data=".$today1['today']."'\" class=\"btn btn-two\"><span>HUMIDITY <br>(LINE)</span></div></div>";
					echo "<div class=\"box-2\"><div onclick=\"window.location.href = 'pressure_bar.php'\" class=\"btn btn-two\"><span>ATMOSPHERIC PRESSURE <br>(COLUMN)</span></div></div>";
					echo "<div class=\"box-2\"><div onclick=\"window.location.href = 'pressure_line.php?data=".$today1['today']."'\" class=\"btn btn-two\"><span>ATMOSPHERIC PRESSURE <br>(LINE)</span></div></div>";
					echo "<div class=\"box-2\"><div onclick=\"window.location.href = 'ppm_bar.php'\" class=\"btn btn-two\"><span>CO CONCENTRATION <br>(COLUMN)</span></div></div>";
					echo "<div class=\"box-2\"><div onclick=\"window.location.href = 'ppm_line.php?data=".$today1['today']."'\" class=\"btn btn-two\"><span>CO CONCENTRATION <br>(LINE)</span></div></div>";
					/*echo "<p style = \"font-size:40px\"><b>Here is your data:</b></p>";
					echo "<p><b>Nickname: &emsp;<span style=\"color:#949494\">".$_SESSION['login'].'</span></p>';
					echo "<p><b>E-mail:</b> &emsp;<span style=\"color:#949494\">".$_SESSION['email'].'</span></p>';
					//echo "<p>First name: &emsp;".$_SESSION['fName'].'<button style=\"float: right;width: 10%;margin-right:10px;background-color: #e68a00;\">Change</button></p>';
					echo "<p><b>First name</b>: &emsp;".$_SESSION['fName'].'';
					//echo "<button style=\"float: right;width: 10%;margin-right:10px;background-color: #e68a00;\">Change</button></p>";
					echo "<button id=\"p4\" onclick=\"document.getElementById('id02').style.display='block'\">Change First name</button></p>";
					echo "<p><b>Last name:</b> &emsp;".$_SESSION['lName'].'';
					echo "<button id=\"p4\" onclick=\"document.getElementById('id03').style.display='block'\">Change Last name</button></p>";
					echo "<p><b>Country:</b> &emsp;".$_SESSION['country'].'';
					echo "<button id=\"p4\" onclick=\"document.getElementById('id04').style.display='block'\">Change Country</button></p>";
					echo "<p><b>Town:</b> &emsp;".$_SESSION['town'].'';
					echo "<button id=\"p4\" onclick=\"document.getElementById('id05').style.display='block'\">Change Town</button></p>";
					echo "<p><b><span style=\"color:#949494;font-size:30px;\">If you want to change password:</span></b> &emsp;";
					echo "<button id=\"p4\" style=\"background-color:#ff0000;\" onclick=\"document.getElementById('id06').style.display='block' \">Change password</button>";if(isset($_SESSION['blad2'])) echo $_SESSION['blad2'];echo"</p>";
					echo "<hr></hr>";*/
					
				
				
				
				}
	   
	?>
			
			
			<div class="socials"><a style="text-decoration:none; color:#096506;"  href='https://329elearning.aei.polsl.pl/tiwordpress2019/s121/'  >IT Blog</a></div> 

              			
			
			
			<!--TU DODAŁEM-->
				<!-- The Modal -->
				<div id="id01" class="modal">
				  <!-- Modal Content -->
				  <form class="modal-content animate" action="../phpRegister/login.php" method="post">
					<div class="container" style="background-color:#292929">
					  <label for="uname"><b>Username</b></label>
					  <input type="text" placeholder="Enter Username" name="login" required>

					  <label for="psw"><b>Password</b></label>
					  <input type="password" placeholder="Enter Password" name="haslo" required>

					  <button type="submit">Login</button>
					  <label>
						<input type="checkbox" checked="checked" name="remember"> Remember me
					  </label>
					</div>

					<div class="container" style="background-color:#171717">
					  <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
					  <?php
						if(isset($_SESSION['blad']))	echo $_SESSION['blad'];
						?>
					</div>
				  </form>
				</div>
				<div id="id02" class="modal">
				  <!-- Modal Content -->
				  <form class="modal-content animate">
					<div class="container" style="background-color:#292929">
					<h3 style = "font-size:60px"><b>Here is your data:</b></h3>
					<div class="SMdata">
					<ul>
					  <li>Temperature: <?php
						echo $bmp['temperature_bmp']."<br>";
					  ?> </li>
					  <li>Humidity: <?php
						echo $dht['humidity']."<br>";
					  ?></li>
					  <li>Atmospheric pressure: <?php
						echo $bmp['humidity_bmp']."<br>";
					  ?> </li>
					  <li>PPM: <?php
						echo $mq['ppm']."<br>";
					  ?>  </li>
					
					</ul>
					<p style="font-size:25px";>Time: <?php
						echo $mq['date']."<br>";
					  ?>  </p>
					</div>
					 
					</div>

					<div class="container" style="background-color:#171717">
					  <button type="button" onclick="document.getElementById('id02').style.display='none'" class="cancelbtn">Close</button>
					  <?php
						if(isset($_SESSION['blad']))	echo $_SESSION['blad'];
						?>
					</div>
				  </form>
				</div>


				<!-- tutaj javascript jak klikniesz poza obszar logowania to Cię przenosi -->
				<script> 
				// Get the modal
				var modal = document.getElementById('id01');
				var modal2 = document.getElementById('id02');
				// When the user clicks anywhere outside of the modal, close it
				window.onclick = function(event) {
				  if (event.target == modal || event.target == modal2) {
					modal.style.display = "none";
					modal2.style.display = "none";
				  }
				}
				</script>
			<!--KONIEC DODAWANIA-->
			
			
		</div>
  </body>
</html>
