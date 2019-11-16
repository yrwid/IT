<?php

	session_start();
	if ((!isset($_POST['town'])))
	{
		header('Location: ../indexPage/index.php');
		exit();
	}
	require_once "../phpRegister/connect.php";

	$polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);
	$town = $_POST['town'];
	$id = $_SESSION['id'];
	echo" $town oraz id $id";
	if ((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']==true))
	{
		if($polaczenie->query("UPDATE users SET town = '$town' WHERE id = '$id'"))
		{
			$_SESSION['town'] = $town;
			header('Location: profile.php');
		}
	}
	$polaczenie->close();
?>