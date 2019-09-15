<?php
	session_start();
	
	if ((isset($_SESSION['logged_in'])) && ($_SESSION['logged_in']==true)) {
		header('Location: user/show.php'); 
		exit();
    }
?>

<!DOCTYPE HTML>
<html lang="pl">
    <head>
        <link href="style.css" rel="stylesheet" type="text/css" media="all">
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <title> Strona startowa </title>
    </head>

    <body>
        <header> Witaj na stronie! :) </header>

        <form action="login.php" method="POST">
            <center>Login: <input type="text" name="login" /></center><br />
            <center>Hasło: <input type="password" name="password" /></center><br />
            <center><input type="submit" value="ZALOGUJ" /></center>
            <center><a href="register.php">Jeżeli nie masz konta - kliknij!</a><br /><br /></center>
        </form>
        
        <?php
            if(isset($_SESSION['blad'])) { echo $_SESSION['blad']; }
        ?>
    </body>
</html>
