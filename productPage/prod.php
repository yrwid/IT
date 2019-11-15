<?php

	session_start();
	

?>

<!DOCTYPE HTML>
<html lang="pl">
  <head>
     <meta charset="utf-8" />
	 <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	 
	 <title>M&M</title>
	 
	 <meta name ="description" contenr="Serwis o ciekawych rzeczach itp." />
	 <meta name="keywords" content="Elektronika , Mikroprocesory,Programowanie ,Gliwice ,Politechnika ,AEI" />
	  <link rel="shortcut icon" href="../images/Logo_ikona.ico">
	 
	 <link href="main_style.css" rel="stylesheet" type="text/css" />
	 <link href="prod_add.css" rel="stylesheet" type="text/css" />
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
			</div>
			
			<!-- TU DODAŁEM-->
			<?php
							if ((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']==true))
							{
							echo <<< EOT
<button id="p3" style="float: right;width: 10%;margin-right:10px;background-color: #e68a00;" onclick="window.location.href = '../phpRegister/logout.php'">Log Out</button>
EOT;
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
				  <li><a href="prod.php">Our product</a></li>
				  <li><a href="../softwarePage/soft.php">Software</a></li>
				  <li><a href="../contactPage/contact.php">Contact us</a></li>
				</ol>
			</div>
		
		   <div class="content">
							<h1>           HDTT04R1 </h1>
			    <p> 
					our product consists of dedicated devices and a web application that interacts with the device via a wifi interface. The solution provided by our company provides a lot of information regarding home use, e.g. temperature, humidity, atmospheric pressure or carbon monoxide sensor is also equipped with a 0.5 watt speaker designed to inform the user about the current state of a given parameter. All information is currently sent to the website
					where the user can manage to check statistics and charts from the last days. 
				</p>
			</div>
			
			
			<div class="prod"></div>
			
				
			
			
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

				<!-- tutaj javascript jak klikniesz poza obszar logowania to Cię przenosi -->
				<script> 
				// Get the modal
				var modal = document.getElementById('id01');

				// When the user clicks anywhere outside of the modal, close it
				window.onclick = function(event) {
				  if (event.target == modal) {
					modal.style.display = "none";
				  }
				}
				</script>
			<!--KONIEC DODAWANIA-->
			
		</div>
  </body>
</html>