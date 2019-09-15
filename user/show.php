<?php
	session_start();
	if (!isset($_SESSION['logged_in'])) {
		header('Location: index.php');
		exit();
	}
?>

<!DOCTYPE HTML>
<html lang="pl">
	<head>
		<link href="/style.css" rel="stylesheet" type="text/css" media="all">
		<meta charset="utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<title> Informacje o uzytkowniku </title>
	</head>

	<body>
		<div class="card">
			<div class="container">
				<?php
					echo "<p><h1>Witaj ".$_SESSION['login'].'!</h1> [<a href="/logout.php">Wyloguj się!</a>]</p>';
					echo "<p><b>Imię</b>: ".$_SESSION['first_name']."</p>";
					echo "<p><b>Nazwisko</b>: ".$_SESSION['last_name']."</p>";
					echo "<p><b>E-mail</b>: ".$_SESSION['email']."</p>";
					echo "<p><b>Ulica</b>: ".$_SESSION['street']."</p>";
					echo "<p><b>Nr domu</b>: ".$_SESSION['number1']."</p>";
					echo "<p><b>Nr mieszkania</b>: ".$_SESSION['number2']."</p>";
					echo "<p><b>Kod pocztowy</b>: ".$_SESSION['zip_code']."</p>";
					echo "<p><b>Miasto</b>: ".$_SESSION['city']."</p>";
					echo "<p><b>Wykształcenie</b>: ".$_SESSION['education']."</p>";
					echo "<p><b>Zainteresowania</b>: ".$_SESSION['hobby']."</p>";
				?>
			</div>
		</div>
	</body>
</html>
