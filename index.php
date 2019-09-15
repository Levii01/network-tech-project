<?php
	session_start();
	
	if ((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']==true))
	{
		header('Location: panel.php'); 
		exit();
	}
?>

<!DOCTYPE HTML>
<html lang="pl">
    <head>
        <style type="text/css">
            input[type="submit"]{
            border: 1px solid #006633;
            background-color: #009966;
            color: #ffffff;
            border-radius: 5px;
            padding: 15px;
            }
        
            header {
            font-size: 200%;
            font-family: "Courier New", Courier, monospace;
            margin: 0px auto 15px auto;
            text-align: center;}
        </style>
        
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <title> Strona startowa </title>
    </head>

    <body>
        <header> Witaj na stronie </header>
        
        <?php
            if(isset($_SESSION['blad'])) { echo $_SESSION['blad']; }
        ?>
    </body>
</html>
