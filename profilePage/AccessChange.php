<?php

	session_start();
	if ((!isset($_GET['access'])))
	{
		header('Location: ../indexPage/index.php');
		exit();
	}
	require_once "../phpRegister/connect.php";

	$polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);
	$access = $_GET['access'];
	$id = $_SESSION['id'];
	echo" $access oraz id $id";
	if ((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']==true))
	{
		if($polaczenie->query("UPDATE users SET access = '$access' WHERE id = '$id'"))
		{
			$_SESSION['access'] = $access;
			header('Location: profile.php');
		}
	}
	$polaczenie->close();
?>