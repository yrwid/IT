<?php

	session_start();
	
	if (isset($_POST['email']))
	{
		//If everything is ok
		$wszystko_OK=true;
		
		//Check nickname
		$nick = $_POST['nick'];
		
		//Check nick length
		if ((strlen($nick)<3) || (strlen($nick)>20))
		{
			$wszystko_OK=false;
			$_SESSION['e_nick']="Nickname must be between 3 and 20 characters!";
		}
		
		if (ctype_alnum($nick)==false)
		{
			$wszystko_OK=false;
			$_SESSION['e_nick']="Nick can only consist of letters and numbers (without Polish characters)";
		}
		
		// Check email
		$email = $_POST['email'];
		$emailB = filter_var($email, FILTER_SANITIZE_EMAIL);
		
		if ((filter_var($emailB, FILTER_VALIDATE_EMAIL)==false) || ($emailB!=$email))
		{
			$wszystko_OK=false;
			$_SESSION['e_email']="Please enter a correct email address!";
		}
		
		//Validate the password
		$haslo1 = $_POST['haslo1'];
		$haslo2 = $_POST['haslo2'];
		
		if ((strlen($haslo1)<8) || (strlen($haslo1)>20))
		{
			$wszystko_OK=false;
			$_SESSION['e_haslo']="Password must have between 8 and 20 characters!";
		}
		
		if ($haslo1!=$haslo2)
		{
			$wszystko_OK=false;
			$_SESSION['e_haslo']="Passwords you have entered do not match!";
		}	

		$haslo_hash = password_hash($haslo1, PASSWORD_DEFAULT);
		
		//Have the regulations been accepted?
		if (!isset($_POST['regulamin']))
		{
			$wszystko_OK=false;
			$_SESSION['e_regulamin']="Confirm regulations!";
		}				
		
		//Remember entered data
		$_SESSION['fr_nick'] = $nick;
		$_SESSION['fr_email'] = $email;
		$_SESSION['fr_haslo1'] = $haslo1;
		$_SESSION['fr_haslo2'] = $haslo2;
		if (isset($_POST['regulamin'])) $_SESSION['fr_regulamin'] = true;
		
		require_once "connect.php";
		mysqli_report(MYSQLI_REPORT_STRICT);
		
		try 
		{
			$polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
			if ($polaczenie->connect_errno!=0)
			{
				throw new Exception(mysqli_connect_errno());
			}
			else
			{
				//Czy email już istnieje?
				$rezultat = $polaczenie->query("SELECT id FROM users WHERE email='$email'");
				
				if (!$rezultat) throw new Exception($polaczenie->error);
				
				$ile_takich_maili = $rezultat->num_rows;
				if($ile_takich_maili>0)
				{
					$wszystko_OK=false;
					$_SESSION['e_email']="An account already exists for this email address!";
				}		

				//Czy nick jest już zarezerwowany?
				$rezultat = $polaczenie->query("SELECT id FROM users WHERE login='$nick'");
				
				if (!$rezultat) throw new Exception($polaczenie->error);
				
				$ile_takich_nickow = $rezultat->num_rows;
				if($ile_takich_nickow>0)
				{
					$wszystko_OK=false;
					$_SESSION['e_nick']="A user with this nickname already exists! Choose another one.";
				}
				
				if ($wszystko_OK==true)
				{
					//Everything is OK, create new account
					
					if ($polaczenie->query("INSERT INTO users VALUES (NULL, '$nick', '$haslo_hash', '$email',NULL,NULL,NULL,NULL,0)"))
					{
						$_SESSION['udanarejestracja']=true;
						header('Location: hello.php');
					}
					else
					{
						throw new Exception($polaczenie->error);
					}
					
				}
				
				$polaczenie->close();
			}
			
		}
		catch(Exception $e)
		{
			echo '<span style="color:red;">Server error! We apologize for the inconvenience and please register at a different time!</span>';
			echo '<br />Developer Information: '.$e;
		}
		
	}
	
	
?>

<!DOCTYPE HTML>
<html lang="pl">
  <head>
     <meta charset="utf-8" />
	 <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	 <title>M&M </title>
	 
	 <meta name ="description" contener="Serwis o ciekawych rzeczach itp." />
	 <meta name="keywords" content="Elektronika , Mikroprocesory,Programowanie ,Gliwice ,Politechnika ,AEI" />
	 
	 <link href="../indexPage/style.css" rel="stylesheet" type="text/css" />
	 <link href="style_registerr.css" rel="stylesheet" type="text/css" />
  </head>
 
  <body>
  <div class="form">
		  <form style="border:1px solid #ccc" method="post">
		  <div class="container">
			<h1>Sign Up</h1>
			<p>Please fill in this form to create an account.</p>
			<hr>
			
			<label for="nick"><b>Login</b></label>
			<br>
			<input type="text" placeholder="Enter Login" value="<?php
			if (isset($_SESSION['fr_nick']))
			{
				echo $_SESSION['fr_nick'];
				unset($_SESSION['fr_nick']);
			}
			?>" name="nick" required><br />
			<?php
				if (isset($_SESSION['e_nick']))
				{
					echo '<div class="error">'.$_SESSION['e_nick'].'</div>';
					unset($_SESSION['e_nick']);
				}
			?>
			<br>
			<label for="email"><b>Email</b></label>
			<br>
			<input type="text" placeholder="Enter Email" value="<?php
			if (isset($_SESSION['fr_email']))
			{
				echo $_SESSION['fr_email'];
				unset($_SESSION['fr_email']);
			}
			?>" name="email" required><br />
			<?php
			if (isset($_SESSION['e_email']))
			{
				echo '<div class="error">'.$_SESSION['e_email'].'</div>';
				unset($_SESSION['e_email']);
			}
			?>
			<br>
			<label for="haslo1"><b>Password</b></label>
			<br>
			<input type="password" placeholder="Enter Password" value="<?php
			if (isset($_SESSION['fr_haslo1']))
			{
				echo $_SESSION['fr_haslo1'];
				unset($_SESSION['fr_haslo1']);
			}
			?>" name="haslo1" required id="password"><br />
			<?php
			if (isset($_SESSION['e_haslo']))
			{
				echo '<div class="error">'.$_SESSION['e_haslo'].'</div>';
				unset($_SESSION['e_haslo']);
			}
			?>
			<br>
			<label for="haslo2"><b>Repeat Password</b></label>
			<br>
			<input type="password" placeholder="Repeat Password" value="<?php
			if (isset($_SESSION['fr_haslo2']))
			{
				echo $_SESSION['fr_haslo2'];
				unset($_SESSION['fr_haslo2']);
			}
			?>" name="haslo2" required id="password_confirm" oninput="check(this)">
			<!--ZOSTAWIC CZY USUNAC ::-->
			<label>
			<input type="checkbox" name="regulamin" <?php
			if (isset($_SESSION['fr_regulamin']))
			{
				echo "checked";
				unset($_SESSION['fr_regulamin']);
			}
				?>/><b>I accept the terms and conditions&nbsp;&nbsp;</b>
			</label>
			<?php
			if (isset($_SESSION['e_regulamin']))
			{
				echo '<div class="error">'.$_SESSION['e_regulamin'].'</div>';
				unset($_SESSION['e_regulamin']);
			}
			?>	
			<!--DO TEGO MIEJSCA-->
			<br><br>
			<p> &nbsp;</p><br>
			<!--<p>By creating an account you agree to our <a href="terms.html" style="color:dodgerblue">Terms & Privacy</a>.</p>-->

			<div class="clearfix">
			  <button onclick="window.location.href = '../indexPage/index.php';"class="cancelbtn">Cancel</button>
			  <button type="submit" class="signupbtn">Sign Up</button>
			</div>
			
			
			
			
			
		  </div>
		</form>
	  </div>
  </body>
</html>