<?php

	session_start();
	if ((!isset($_POST['lName'])))
	{
		header('Location: ../indexPage/index.php');
		exit();
	}
	require_once "../phpRegister/connect.php";

	$polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);
	$lName = $_POST['lName'];
	$id = $_SESSION['id'];
	echo" $lName oraz id $id";
	if ((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']==true))
	{
		if($polaczenie->query("UPDATE users SET lName = '$lName' WHERE id = '$id'"))
		{
			$_SESSION['lName'] = $lName;
			header('Location: profile.php');
		}
	}
	$polaczenie->close();
?>