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
        session_start();
        if ((isset($_SESSION['logged_in'])) && ($_SESSION['logged_in']==true)) {
            echo 'Link do twojego profilu: <b><a href="/user/show.php">['.$_SESSION['login'].']</a></b>. ';
            echo 'Jezeli chcesz zakończyć sesję [<a href="/logout.php">Wyloguj się!</a>]';
        } else {
            include 'login_form.php';
        }

        if(isset($_SESSION['blad'])) { echo $_SESSION['blad']; }
    ?>

    <div class="card">
        <div class="container">
            <h1>Produkty</h1>
            <?php
            include 'connect.php';
            $row_sql="SELECT * FROM products";
            if($row_query=mysqli_query($connection, $row_sql)) {
                $row=mysqli_fetch_assoc($row_query);
            } 
            $i = 0;
            if (mysqli_num_rows($row_query) > 0) { 
        ?>
            <table>
                <tr>
                    <th>#</th>
                    <th>Nazwa</th>
                    <th>Opis</th>
                    <th>Cena</th>
                    <th>Do koszyka </th>
                </tr>
                <?php
                do {
                $i++;
            ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['description']; ?></td>
                    <td><?php echo $row['price'].' zł'; ?></td>
                    <td><a href="in_cart.php?action=dodaj&id=<?php echo $row['id']; ?>">Dodaj do koszyka</a>
                    <td>
                </tr>
                <?php } while($row=mysqli_fetch_assoc($row_query)); ?>
            </table>
            <?php } else { ?>
            <p>Brak produktów w sklepie.</p>
            <?php } ?>

            <p><a href="preview.php">Idź do koszyka</a></p>
        </div>
    </div>
</body>

</html>
