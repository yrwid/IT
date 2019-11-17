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
	  
	 <link href="about.css" rel="stylesheet" type="text/css" />
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
							echo "<button id=\"p4\" onclick=\"window.location.href = '../profilePage/profile.php'\">".$_SESSION['login'].'</button>';
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
				  <li><a href="about.php">About us</a></li>
				  <li><a href="../productPage/prod.php">Our product</a></li>
				  <li><a href="../softwarePage/soft.php">Software</a></li>
				  <li><a href="../contactPage/contact.php">Contact us</a></li>
				</ol>
			</div>
		
			
			<div class="proud">
			<p>      <h2> Our  managers</h2> </p>
			       <div class="picture"></div>   
				   <div class="picture1"></div> 
				   <div style="clear: both;"></div>
		     <h3>Dawid Mudry <span style="display:inline-block; width: 180px;"></span> Karol Marciniak</h3>
			</div>
			
				
			<div class="content">
							<h1>            Who we are ?</h1>
			
			
			    <p> We are a company that was founded in 2019 by two students of the Silesian University of Technology. Our company is a pioneer in solutions combining microprocessor systems with dedicated peripherals and our own software our solutions have made Gliwice famous throughout Europe, Asia, North America and the Faroe Islands </p>
					
				 <p> Our team consists of experienced programmers, masters in creating hardware and great management staff. Our foreign clients are proud to name our company. our products are used in many home appliances, thanks to which thousands of people start the day with a smile every day
					</p>
			</div>
			
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