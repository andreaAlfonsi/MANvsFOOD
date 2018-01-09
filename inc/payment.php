<?php

session_start();
//check if user is logged in
if ( $_SESSION['logged_in'] != 1 ) {
  $_SESSION['message'] = "Devi avere eseguito l'accesso per vedere questa pagina!";
  header("location: error.php");    
}

if(empty($_SESSION['cart'])){
	header("location: categories.php");   
}

$_SESSION['location']=$_POST['place'];

require_once $_SERVER["DOCUMENT_ROOT"] . '/Progetto/inc/head.php';
require_once $_SERVER["DOCUMENT_ROOT"] . '/Progetto/inc/header.php';
?>
<h1>Inserisci i dati di pagamento</h1>
<div id="paymentField">
      <input type="text"></input>
	<div><button type="button" onclick="window.location.href='add-order.php'">Conferma</button></div>
</div>

<?php require_once $_SERVER["DOCUMENT_ROOT"] . '/Progetto/inc/footer.php'; ?>