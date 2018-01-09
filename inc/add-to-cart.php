<?php

session_start();

//check if user is logged in
if ( $_SESSION['logged_in'] != 1 ) {
  $_SESSION['message'] = "Devi avere eseguito l'accesso per vedere questa pagina!";
  header("location: error.php");    
}

//check if cart is empty
if(empty($_SESSION['cart'])){
	$_SESSION['cart']=array();
}

//check if parameter is correct
if(isset($_GET['id']) && !empty($_GET['id'])){
	$_SESSION['cart'][] = $_GET['id'];
}
else {
    $_SESSION['message'] = "Parametri errati";
    header("location: error.php");
}     

require_once $_SERVER["DOCUMENT_ROOT"] . '/Progetto/inc/head.php';
require_once $_SERVER["DOCUMENT_ROOT"] . '/Progetto/inc/header.php';
?>

<h1>Prodotto inserito correttamente!</h1>
<div class="mod-cart-buttons">
	<div><button type="button" onclick="window.location.href='categories.php'">Compra altri prodotti</button></div>
	<div><button type="button" onclick="window.location.href='cart.php'">Visualizza il carrello</button></div>
</div>

<?php require_once $_SERVER["DOCUMENT_ROOT"] . '/Progetto/inc/footer.php'; ?>