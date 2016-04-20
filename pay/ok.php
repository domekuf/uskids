<?php

//Store transaction information from PayPal
$item_number = $_GET['item_number']; 
$txn_id = $_GET['tx'];
$payment_gross = $_GET['amt'];
$currency_code = $_GET['cc'];
$payment_status = $_GET['st'];
$productPrice=10;


if(!empty($txn_id) && $payment_gross == $productPrice){
    //Insert tansaction data into the database
    $insert = $db->query("INSERT INTO payments(item_number,txn_id,payment_gross,currency_code,payment_status) VALUES('".$item_number."','".$txn_id."','".$payment_gross."','".$currency_code."','".$payment_status."')");
    $last_insert_id = $db->insert_id;

?>

<h1>Pagamento Avvenuto.</h1>

<h1> ID - <?php echo $last_insert_id; ?>.</h1>


<?php

}else{

?>

<h1>Your payment has failed.</h1>


<?php

}

?>

