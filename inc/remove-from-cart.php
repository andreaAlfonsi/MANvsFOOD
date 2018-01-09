<?php

session_start();

//check if user is logged in
if ( $_SESSION['logged_in'] != 1 ) {
  $_SESSION['message'] = "Devi avere eseguito l'accesso per vedere questa pagina!";
  header("location: error.php");    
}

//check if parameter is correct
if(isset($_GET['id']) && !empty($_GET['id']))
{
	$key = array_search($_GET['id'],$_SESSION['cart']);
	if($key!==false){
		unset($_SESSION['cart'][$key]);
	}
	$_SESSION['cart'] = array_values($_SESSION['cart']);
}
else {
    $_SESSION['message'] = "Parametri errati";
    header("location: error.php");
}

require_once $_SERVER["DOCUMENT_ROOT"] . '/Progetto/inc/head.php';
require_once $_SERVER["DOCUMENT_ROOT"] . '/Progetto/inc/header.php';
?>

<h1>Prodotto rimosso correttamente!</h1>
<div class="mod-cart-buttons">
	<div><button type="button" onclick="window.location.href='categories.php'">Compra altri prodotti</button></div>
	<div><button type="button" onclick="window.location.href='cart.php'">Visualizza il carrello</button></div>
</div>

<?php require_once $_SERVER["DOCUMENT_ROOT"] . '/Progetto/inc/footer.php'; ?>