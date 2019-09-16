<?php
    $connection = mysqli_connect("localhost", "root", "root", "techniki_dev");
    if(mysqli_connect_errno()) {
        echo "Błąd połączenia z bazą:".mysqli_connect_error();
        exit();
    }
?>
