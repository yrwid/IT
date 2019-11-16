<?php

	session_start();
	if ((!isset($_POST['fName'])))
	{
		header('Location: ../indexPage/index.php');
		exit();
	}
	require_once "../phpRegister/connect.php";

	$polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);
	$fName = $_POST['fName'];
	$id = $_SESSION['id'];
	echo" $fName oraz id $id";
	if ((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']==true))
	{
		if($polaczenie->query("UPDATE users SET fName = '$fName' WHERE id = '$id'"))
		{
			$_SESSION['fName'] = $fName;
			header('Location: profile.php');
		}
	}
	$polaczenie->close();
?>