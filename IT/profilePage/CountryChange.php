<?php

	session_start();
	if ((!isset($_POST['country'])))
	{
		header('Location: ../indexPage/index.php');
		exit();
	}
	require_once "../phpRegister/connect.php";

	$polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);
	$country = $_POST['country'];
	$id = $_SESSION['id'];
	echo" $country oraz id $id";
	if ((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']==true))
	{
		if($polaczenie->query("UPDATE users SET country = '$country' WHERE id = '$id'"))
		{
			$_SESSION['country'] = $country;
			header('Location: profile.php');
		}
	}
	$polaczenie->close();
?>