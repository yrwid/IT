<?php

	session_start();
	
	session_unset();
	
	header('Location: ../indexPage/index.php');

?>