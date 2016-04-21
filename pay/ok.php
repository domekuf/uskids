<?php

//Store transaction information from PayPal
$item_number = $_GET['item_number']; 
$txn_id = $_GET['tx'];
$payment_gross = $_GET['amt'];
$currency_code = $_GET['cc'];
$payment_status = $_GET['st'];
$productPrice=50;


if(!empty($txn_id) && $payment_gross == $productPrice){
    //Insert tansaction data into the database
   
?>

<h1>Pagamento Avvenuto.</h1>

<h1> ID - <?php echo $txn_id; ?>.</h1>


<?php

include('../mail.php');

$ret=sendMail('dome.diiorio@icloud.com','Registrazione ID: '.$id_utente,'dome.diiorio@icloud.com','Conferma Pagamento. ID: '.$txn_id);


}else{

?>

<h1>Pagamento Fallito, riprovare.</h1>


<?php

}

?>

