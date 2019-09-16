<?php
include 'cart.php';
$koszyk = new Cart;

include 'connect.php';
if(isset($_REQUEST['action']) && !empty($_REQUEST['action'])) {
    if($_REQUEST['action'] == 'dodaj' && !empty($_REQUEST['id'])) {
        $productID = $_REQUEST['id'];
       
        $row_sql="SELECT * FROM products WHERE id = '".$productID."'";
        $row_query=mysqli_query($connection, $row_sql);
        $row=mysqli_fetch_assoc($row_query);
        $itemData = array(
            'id' => $row['id'],
            'name' => $row['name'],
            'price' => $row['price'],
            'qty' => 1
        );
        
        $insertItem = $koszyk->insert($itemData);
        $redirectLoc = $insertItem?'preview.php':'index.php';
        header("Location: ".$redirectLoc);
    } elseif ($_REQUEST['action'] == 'uaktualnij' && !empty($_REQUEST['id'])) {
        $itemData = array(
            'rowid' => $_REQUEST['id'],
            'qty' => $_REQUEST['qty']
        );
        $updateItem = $koszyk->update($itemData);
        echo $updateItem?'ok':'err';die;
    } elseif ($_REQUEST['action'] == 'usun' && !empty($_REQUEST['id'])){
        $deleteItem = $koszyk->remove($_REQUEST['id']);
        header("Location: preview.php");
    }
} else {
    header("Location: index.php");
}
