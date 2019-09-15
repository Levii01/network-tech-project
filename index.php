<?php
	session_start();
	
	if ((isset($_SESSION['logged_in'])) && ($_SESSION['logged_in']==true)) {
		// header('Location: user/show.php'); 
		// exit();
    }
?>

<!DOCTYPE HTML>
<html lang="pl">

<head>
    <link href="/style.css" rel="stylesheet" type="text/css" media="all">
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title> Strona startowa </title>
</head>

<body>
    <header> Witaj na stronie sklepu! :) </header>
    
    <?php
        if ((isset($_SESSION['logged_in'])) && ($_SESSION['logged_in']==true)) {
            echo 'Link do twojego profilu: <b><a href="/user/show.php">['.$_SESSION['login'].']</a></b>. ';
            echo 'Jezeli chcesz zakończyć sesję [<a href="/logout.php">Wyloguj się!</a>]';
        } else {
            include 'login_form.php';
        }

        if(isset($_SESSION['blad'])) { echo $_SESSION['blad']; }
    ?>

    <div>
        <h1>Produkty</h1>
        <?php
        $row_sql="SELECT * FROM products";
        if($row_query=mysqli_query($db, $row_sql)){
             $row=mysqli_fetch_assoc($row_query);
        }
        if(mysqli_num_rows($row_query) > 0){ 
            do {
        ?>
        <h4><?php echo $row['name']; ?></h4>
        <p><?php echo $row['description']; ?></p>
        <p><?php echo $row['price'].' zł'; ?></p>
        <a href="inkoszyk.php?action=dodaj&id=<?php echo $row['id']; ?>">Dodaj do koszyka</a>
        <?php } while($row=mysqli_fetch_assoc($row_query));
        
        }else{ ?>
        <p>Brak produktów w sklepie.</p>
        <?php } ?>

        <p><a href="podglad.php">Idź do koszyka</a></p>
    </div>
</body>

</html>
