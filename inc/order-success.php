<?php
require 'db.php';
session_start();

if ( $_SESSION['logged_in'] != 1 ) {
  $_SESSION['message'] = "Devi avere eseguito l'accesso per vedere questa pagina!";
  header("location: error.php");    
}

/*if(empty($_SESSION['cart'])){
	header("location: categories.php");   
}*/

require_once $_SERVER["DOCUMENT_ROOT"] . '/Progetto/inc/head.php';
require_once $_SERVER["DOCUMENT_ROOT"] . '/Progetto/inc/header.php';
$_SESSION['cart']=array();
?>

<div class="confirmed-order">
<h1>Ordine confermato con successo</h1>
<p>Riceverei una notifica alla partenza del fattorino</p>
<div><button type="button" onclick="window.location.href='notifications.php'">Vai a notifiche</button></div>
</div>

<?php require_once $_SERVER["DOCUMENT_ROOT"] . '/Progetto/inc/footer.php'; ?>