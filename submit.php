<?php
function file_list($d,$x){ 
       foreach(array_diff(scandir($d),array('.','..')) as $f)if(is_file($d.'/'.$f)&&(($x)?ereg($x.'$',$f):1))$l[]=$f; 
       return $l; 
} 

$lista_utenti = file_list('iscritti/', ".usk");

$i=0;

foreach($lista_utenti as $u){
	$i++;

}

$id_utente='uskids'.$i.'.usk';

$utente = json_encode($_POST);

$newfile = fopen('iscritti/'.$id_utente, "a");//r+ era a
fwrite($newfile, $utente, 1024);
fclose($newfile);
//Set useful variables for paypal form
$paypal_url = 'https://www.sandbox.paypal.com/cgi-bin/webscr'; //Test PayPal API URL
$paypal_id = 'domenicodiiorio6-facilitator@hotmail.it'; //Business Email
echo('<h1>Registrazione Effettuata </h1><h2>ID: '.$id_utente);

?>

<form action="<?php echo $paypal_url; ?>" method="post">
	<input type="hidden" name="business" value="<?php echo $paypal_id; ?>">
        
        <!-- Specify a Buy Now button. -->
        <input type="hidden" name="cmd" value="_xclick">
        
        <!-- Specify details about the item that buyers will purchase. -->
        <input type="hidden" name="item_name" value="<?php echo $id_utente; ?>">
        <input type="hidden" name="item_number" value="1">
        <input type="hidden" name="amount" value="10">
        <input type="hidden" name="currency_code" value="EUR">
        
        <!-- Specify URLs -->
        <input type='hidden' name='cancel_return' value='http://www.ilsitodeikuf.it/'>
        <input type='hidden' name='return' value='http://www.fb.com/kufff'>
        
        <!-- Display the payment button. -->
        <input type="image" name="submit" border="0"
        src="https://www.paypalobjects.com/en_US/i/btn/btn_buynow_LG.gif" alt="PayPal - The safer, easier way to pay online">
        <img alt="" border="0" width="1" height="1" src="https://www.paypalobjects.com/it_IT/i/scr/pixel.gif" >
    
</form>