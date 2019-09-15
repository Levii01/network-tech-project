<?php
	session_start();
	
	if (!isset($_SESSION['register_finish'])) {
		header('Location: /index.php'); 
		exit();
	}	else {
		unset($_SESSION['register_finish']);
	}
?>

<!DOCTYPE HTML>
<html lang="pl">
	<head>
		<link href="/style.css" rel="stylesheet" type="text/css" media="all">
		<meta charset="utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<title> Logowanie i rejestracja </title>
	</head>

	<body>
		<header> Dziękujemy za rejestrację, możesz się zalogować </header>
		<h1><center><a href="/index.php"> Zaloguj się na konto! </a><center></h1>
	</body>
</html>
