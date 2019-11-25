<?php

	session_start();
	

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
			
			 <div id="chart"></div> 
			
        <script>
            function getData() {
                return Math.random();
            }  
			
			var layout = {
						  autosize: false,
						  width: 1000,
						  height: 500,
						  margin: {
							l: 70,
							r: 70,
							b: 70,
							t: 70,
							pad: 40
						  },
						  paper_bgcolor: '#7f7f7f',
						  plot_bgcolor: '#c7c7c7'
						};
						
			var data = [
					  {
						y: [getData()],
						type: 'lines'
					  }
					  ];
			
            Plotly.plot('chart',data,layout);//[{
               // y:[getData()],
               // type:'line'
           // }]);
            
            var cnt = 0;
            setInterval(function(){
                Plotly.extendTraces('chart',{ y:[[getData()]]}, [0]);
                cnt++;
                if(cnt > 100) {
                    Plotly.relayout('chart',{
                        xaxis: {
                            range: [cnt-100,cnt]
                        }
                    });
                }
            },1000);
        </script>
		
		 <div id="bar"></div> 
         <div class="opis1"><h1>Dynamic plot !<h1/> </div>	
		 
		 <div class="opis2"><h1>Static plot !<h1/> </div>		 
		<script>
				var trace1 = {
					x: ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'],
				    y: [8.0, 8.0, 12.0, 12.0, 13.0, 20.0, 21.0],
				    type: 'bar',
				    text: ['4.17 below the mean', '4.17 below the mean', '0.17 below the mean', '0.17 below the mean', '0.83 above the mean', '7.83 above the mean'],
				    marker: {
					color: 'rgb(142,124,195)'
				  }
				};

				var data = [trace1];

				var layout = {
				  title: 'Avarage temperature',
				  font:{
					family: 'Raleway, sans-serif'
				  },
				  showlegend: false,
				  xaxis: {
					tickangle: -45
				  },
				  yaxis: {
					zeroline: false,
					gridwidth: 2
				  },
				  bargap :0.05,
				   autosize: false,
						  width: 1000,
						  height: 500,
						  margin: {
							l: 70,
							r: 70,
							b: 70,
							t: 70,
							pad: 40
						  },
				};
				Plotly.newPlot('bar', data, layout);
		</script>
			
			
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
