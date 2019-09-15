<?php
	session_start();

	if( (!isset($_POST['login'])) || (!isset($_POST['password'])) ) {
		header('Location: index.php');
		exit();
	}
	
	require_once "connect.php";
	$connection = @new mysqli($host, $db_user, $db_password, $db_name);
	
	if($connection->connect_errno!=0) {
		echo "Error:".$connection->connect_errno."Opis: ".$connection->connect_error;
	}	else {
		$login=$_POST['login'];
		$password=$_POST['password'];
		$login = htmlentities($login, ENT_QUOTES, "UTF-8");
	
		$result = @$connection->query(sprintf("SELECT * FROM users WHERE login='$login'", mysqli_real_escape_string($connection, $login)));
		if($result) {
			if($result->num_rows > 0) {
				$row = $result->fetch_assoc();

				if (password_verify($password, $row['password'])) {
					$_SESSION['logged_in'] = true;
					
					$_SESSION['id'] = $row['id'];
					$_SESSION['login'] = $row['login'];
					$_SESSION['first_name']=$row['first_name'];
					$_SESSION['last_name']=$row['last_name'];
					$_SESSION['email']=$row['email'];
					$_SESSION['street']=$row['street'];
					$_SESSION['number1']=$row['number1'];
					$_SESSION['number2']=$row['number2'];
					$_SESSION['zip_code']=$row['zip_code'];
					$_SESSION['city']=$row['city'];
					$_SESSION['education']=$row['education'];
					$_SESSION['hobby']=$row['hobby'];

					unset($_SESSION['blad']);
					$result->close();
					header('Location: user/show.php');
				} 
				else {
					$_SESSION['blad'] = '<span style = "color:red">Nieprawidłowe hasło</span>';
					header('Location: index.php');
				}
			} else {
			  $_SESSION['blad'] = '<span style = "color:red">Nieprawidłowy login, nie znaleziono uytkownika.</span>';
			  header('Location: index.php');
			}
		}
		$connection->close();
	}
?>
