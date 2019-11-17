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
	 
	 <link href="style.css" rel="stylesheet" type="text/css" />
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
				<?php 
	if ((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']==true))
	{
		//echo "<p>Witaj ".$_SESSION['login'].'!</p>';
		//echo "<p><b>E-mail</b>: ".$_SESSION['email'];
		echo "<p>Hello, <a href=\"../profilePage/profile.php\">".$_SESSION['login'].'</a></p>';
	
	}
   
?>
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
				  <li><a href="index.php">Main page</a></li>
				  <li><a href="../aboutPage/about.php">About us</a></li>
				  <li><a href="../productPage/prod.php">Our product</a></li>
				  <li><a href="../softwarePage/soft.php">Software</a></li>
				  <li><a href="../contactPage/contact.php">Contact us</a></li>
				</ol>
			</div>
			<div class="square">
			  
		    
		      <div class="tile1"> <h3> Our partnerships and sponsors </h3></div>	  
			  <div style="clear: both;"></div>
			
			  <div class="tile2"></div>
			  <div class="tile3"></div>
			  <div style="clear: both;"> </div>
			  
			  <div class="tile4"></div>
			  <div class="tile5"></div>
			  <div style="clear: both;"> </div>
		    </div>
			
			
			<div class="content">
			    <p>Have you ever wondered about the current
				parameters of your work room?
				Or do you want to be sure that you are safe in a place
				where you spend a good part of your day?
				With us you are able to achieve each of these things and even more! </p>
			</div>
			
			<div class="clock" id="MyClockDisplay" onload="showTime()">
			
			<script>
			function showTime(){
			var date = new Date();
			var h = date.getHours(); // 0 - 23
			var m = date.getMinutes(); // 0 - 59
			var s = date.getSeconds(); // 0 - 59
			var session = "AM";
    
			if(h == 0){
				h = 12;
			}
    
			if(h > 12){
				h = h - 12;
				session = "PM";
			}
    
			h = (h < 10) ? "0" + h : h;
			m = (m < 10) ? "0" + m : m;
			s = (s < 10) ? "0" + s : s;
    
			var time = h + ":" + m + ":" + s + " " + session;
			document.getElementById("MyClockDisplay").innerText = time;
			document.getElementById("MyClockDisplay").textContent = time;
    
			setTimeout(showTime, 1000);
    
		}

		showTime();
		</script>
		</div>
			
			
			<div class="socials"><a style="text-decoration:none; color:#096506;"  href='https://329elearning.aei.polsl.pl/tiwordpress2019/s121/'  >IT Blog</a></div> 

              			
			</div>
			
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
