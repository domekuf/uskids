<?php
$mail_cliente='lola@gmail.com';
function file_list($d,$x){ 
       foreach(array_diff(scandir($d),array('.','..')) as $f)if(is_file($d.'/'.$f)&&(($x)?ereg($x.'$',$f):1))$l[]=$f; 
       return $l; 
} 

$lista_utenti = file_list('iscritti/', ".usk");

$i=0;

foreach($lista_utenti as $u){
	$i++;

}

if($i<130){//massimo numero di iscritti

$id_utente='uskids'.$i.'.usk';

$utente = json_encode($_POST);

$newfile = fopen('iscritti/'.$id_utente, "a");//r+ era a
fwrite($newfile, $utente, 1024);
fclose($newfile);
//Set useful variables for paypal form
$paypal_url = 'https://www.sandbox.paypal.com/cgi-bin/webscr'; //Test PayPal API URL
$paypal_id = 'domenicodiiorio6-facilitator@hotmail.it'; //Business Email
echo('<h1>Registrazione Effettuata </h1><h2>ID: '.$id_utente.'</h2>');

?>

<?php
include('mail.php');

$ret=sendMail('dome.diiorio@icloud.com','Registrazione ID: '.$id_utente,'dome.diiorio@icloud.com','Conferma iscrizione clicca qui per pagare.');

echo('<h3> Controlla la tua mail</h3>');

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
        <hr>
        <h2>Paga Subito con PayPal</h2>
        <button class="btn btn-danger" type="submit"><i class="fa fa-4x fa-paypal"></i></button>
    
</form>

<?php
}else{
	echo('<h1>Le Iscrizioni Online sono chiuse: </h1><h2>contattare: '.$mail_cliente.'</h2>');
}
?>
