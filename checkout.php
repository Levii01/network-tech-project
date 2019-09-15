<?php
include 'connect.php';
require("php/class.phpmailer.php");
include 'cart.php';
$koszyk = new Cart;

if($koszyk->total_items() <= 0) {
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang=pl>

<head>
    <link href="/style.css" rel="stylesheet" type="text/css" media="all">
    <title>Podsumowanie zamówienia</title>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
</head>

<body>
    <div class="card">
        <div class="container">
            <h1>Podsumowanie zamówienia</h1>
            <table>
                <thead>
                    <tr>
                        <th>Nazwa produktu</th>
                        <th>Cena</th>
                        <th>Ilość</th>
                        <th>Koszt całkowity</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
        if($koszyk->total_items() > 0){
          
            $cartItems = $koszyk->contents();
            foreach($cartItems as $item){
        ?>
                    <tr>
                        <td><?php echo $item['name']; ?></td>
                        <td><?php echo $item['price'].' zł'; ?></td>
                        <td><?php echo $item['qty']; ?></td>
                        <td><?php echo $item['subtotal'].' zł'; ?></td>
                    </tr>
                    <?php } }else{ ?>
                    <tr>
                        <td colspan="4">
                            <p>Brak produktów w koszyku</p>
                        </td>
                        <?php } ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="3"></td>
                        <?php if($koszyk->total_items() > 0){ ?>
                        <td><b>Koszt całkowity <?php echo $koszyk->total().'zł'; ?></b></td>
                        <?php } ?>
                    </tr>
                </tfoot>
            </table>

            <?php
if(isset($_POST['submit'])) 
{   
$mail = new PHPMailer();
$mail->IsSMTP(); 
$mail->SMTPDebug  = 2; 
$mail->From = "technikiinternetu.pw.2019@gmail.com";
$mail->FromName = "TechInernetu";
$mail->Host = "smtp.gmail.com"; 
$mail->SMTPSecure= "ssl"; 
$mail->Port = 465; 
$mail->SMTPAuth = true;
$mail->Username = "technikiinternetu.pw.2019@gmail.com"; 
$mail->Password = "Test#12345"; 
$mail->AddAddress("technikiinternetu.pw.2019@gmail.com", "TechInernetu"); 
$mail->WordWrap = 50; 
$mail->IsHTML(true); 
$mail->Subject = 'Test';
$mail->Body = 'Full Name:'.$_POST['name'].'<br>
Phone:	'.$_POST['phone'].'<br>
Email:	'.$_POST['email'].'<br>
Comments:'.$_POST['comment'].'<br>
Zamówienie:<br>
Nazwa przedmiotu: '.$item['name'].' ---- Cena:'.$item['price'].' zł <br>
Ilość:'.$item['qty'].'<br><br>
Łączny koszt:'.$item['subtotal'].' zł<br> Całość zamówienia:'.$cartItems['name'];
    
if($mail->Send()) {echo "Wysłano mail";}
else {echo "Wystąpił błąd";} 

}
?>
            <div>
                <h3>Uzupełnij dane:</h3>
                <form name="form1" id="form1" action="" method="post">
                    <fieldset>
                        <input type="text" name="name" placeholder="Imię i nazwisko" required />
                        <br />
                        <input type="text" name="phone" placeholder="Numer kontaktowy" required />
                        <br />
                        <input type="email" name="email" placeholder="Email" required />
                        <br />
                        <textarea rows="5" cols="40" name="comment" placeholder="Komentarz"></textarea>
                        <br />
                        <input type="submit" name="submit" value="Prześlij zamówienie" />
                    </fieldset>
                </form>
                <p><?php if(!empty($message)) echo $message; ?></p>
            </div>
            <p><a href="index.php">Kontynuuj zakupy </a></p>
        </div>
    </div>
</body>

</html>
