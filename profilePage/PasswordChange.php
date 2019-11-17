<?php

	session_start();
	if ((!isset($_POST['password']))||(!isset($_POST['password_new']))||(!isset($_POST['password_new2'])))
	{
		header('Location: ../indexPage/index.php');
		exit();
	}
	require_once "../phpRegister/connect.php";

	$polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);
	$wszystko_OK = true;
	$password = $_POST['password'];
	$haslo1 = $_POST['password_new'];
	$haslo2 = $_POST['password_new2'];
	$login = $_SESSION['login'];
	$id = $_SESSION['id'];
		if ((strlen($haslo1)<8) || (strlen($haslo1)>20))
		{
			$wszystko_OK=false;
			$_SESSION['e_haslo']="Hasło musi posiadać od 8 do 20 znaków!";
		}
		
		if ($haslo1!=$haslo2)
		{
			$wszystko_OK=false;
			$_SESSION['e_haslo']="Podane hasła nie są identyczne!";
		}	
		
		$haslo_hash = password_hash($haslo1, PASSWORD_DEFAULT);
	if($wszystko_OK==true)
	{
		//$rezultat = @$polaczenie->query(sprintf("SELECT * FROM users WHERE id='$id'"))
		//$wiersz = $rezultat->fetch_assoc();
		if ((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']==true))
		{
			if ($rezultat = @$polaczenie->query(
		sprintf("SELECT * FROM users WHERE login='%s'",
		mysqli_real_escape_string($polaczenie,$login))))
		{
			$wiersz = $rezultat->fetch_assoc();
				if (password_verify($password, $wiersz['password']))
				{
					$polaczenie->query("UPDATE users SET password = '$haslo_hash' WHERE id = '$id'");
					header('Location: profile.php');
				}
				else 
				{
							$_SESSION['blad'] = '<span style="color:red">Incorrect password!</span>';
							header('Location: ../profilePage/profile.php');
				}
		}
		}
	}
	else 
		{
							$_SESSION['blad'] = '<span style="color:red">new passwords have to be the same!</span>';
							header('Location: ../profilePage/profile.php');
		}
	$polaczenie->close();
?>