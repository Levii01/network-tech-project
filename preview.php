<?php
    include 'cart.php';
    $koszyk = new Cart;
?>
<!DOCTYPE html>
<html lang=pl>

<head>
    <link href="/style.css" rel="stylesheet" type="text/css" media="all">
    <title>Podgląd koszyka</title>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>
        function uaktualnij(obj, id) {
            $.get("in_cart.php", {
                action: "uaktualnij",
                id: id,
                qty: obj.value
            }, function (data) {
                if (data == 'ok') {
                    location.reload();
                } else {
                    alert('Cart update failed, please try again.');
                }
            });
        }
    </script>
</head>

<body>
    <div class="card">
        <div class="container">
            <h1>Koszyk</h1>
            <table>
                <thead>
                    <tr>
                        <th>Nazwa Produktu</th>
                        <th>Cena</th>
                        <th>Ilość</th>
                        <th>Posumowanie</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
        if($koszyk->total_items() > 0){
            $cartItems = $koszyk->contents();
            foreach($cartItems as $item){
        ?>
                    <tr>
                        <td><?php echo $item["name"]; ?></td>
                        <td><?php echo $item["price"].' zł'; ?></td>
                        <td><input type="number" value="<?php echo $item["qty"]; ?>"
                                onchange="uaktualnij(this, '<?php echo $item["rowid"]; ?>')"></td>
                        <td><?php echo $item["subtotal"].' zł'; ?></td>
                        <td>
                            <a href="in_cart.php?action=usun&id=<?php echo $item["rowid"]; ?>">Usuń</a>
                        </td>
                    </tr>
                    <?php } }else{ ?>
                    <tr>
                        <td colspan="4">
                            <p>Twój koszyk jest pusty</p>
                        </td>
                        <?php } ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td></td>
                        <td colspan="2"></td>
                        <?php if($koszyk->total_items() > 0){ ?>
                        <td class="text-center"><strong>Total <?php echo $koszyk->total().' zł'; ?></strong></td>
                        <td><a href="checkout.php">Zamawiam</a></td>
                        <?php } ?>
                    </tr>
                </tfoot>
            </table>
            <a href="index.php">Kontynuuj zakpupy</a>
        </div>
    </div>
</body>

</html>
