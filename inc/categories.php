<?php
/* Displays user information and some useful messages */
session_start();


// Controllo che l'utente sia loggato
if ( $_SESSION['logged_in'] != 1) {
  $_SESSION['message'] = "Devi avere eseguito l'accesso per vedere questa pagina!";
  header("location: error.php");    
}

//controllo se l'account è verificato
if (!$_SESSION['active']) {
  $_SESSION['message'] = "Il tuo account non è ancora verificato!";
  header("location: error.php");    
}
else {

    $first_name = $_SESSION['first_name'];
    $last_name = $_SESSION['last_name'];
    $email = $_SESSION['email'];
    $active = $_SESSION['active'];
}
?>
<?php require_once $_SERVER["DOCUMENT_ROOT"] . '/Progetto/inc/head.php'; ?>
<?php require_once $_SERVER["DOCUMENT_ROOT"] . '/Progetto/inc/header.php'; ?>
<h1 id="cath1">Ordina il tuo pranzo</h1>
<p id="catp">Seleziona una categoria</p>
<div class="categories">
	<a href="http://localhost/Progetto/inc/products.php?category='pasta';">
		<div class="pasta">
			<p>Pasta</p>
		</div>
	</a>
	<a href="http://localhost/Progetto/inc/products.php?category='carne';">
		<div class="carne">
			<p>Carne</p>
		</div>
	</a>
	<a href="http://localhost/Progetto/inc/products.php?category='pizza';">
		<div class="pizza">
			<p>Pizza</p>
		</div>
	</a>
	<a href="http://localhost/Progetto/inc/products.php?category='contorni';">
		<div class="contorni">
			<p>Contorni</p>
		</div>
	</a>
	<a href="http://localhost/Progetto/inc/products.php?category='bevande';">
		<div class="bevande">
			<p>Bevande</p>
		</div>
	</a>
	<a href="http://localhost/Progetto/inc/products.php?category='altro';">
		<div class="altro">
			<p>Altro</p>
		</div>
	</a>
</div>
<?php require_once $_SERVER["DOCUMENT_ROOT"] . '/Progetto/inc/footer.php'; ?>