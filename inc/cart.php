<?php
require 'db.php';
session_start();

if ( $_SESSION['logged_in'] != 1 || !$_SESSION['active']) {
  $_SESSION['message'] = "Devi avere eseguito l'accesso per vedere questa pagina!";
  header("location: error.php");    
}

if(empty($_SESSION['cart'])){
	header("location: categories.php");   
}
else{
	$whereIN=implode(',',$_SESSION['cart']);

	$result = $mysqli->query("SELECT product.prod_id, product.descr , product.price FROM product WHERE prod_id IN($whereIN)");

	$products=array();
	while($row = $result->fetch_assoc()) {
		$products[]= $row;
	}
	$out = json_encode($products);
	$session_cart=json_encode($_SESSION['cart']);
}

require_once $_SERVER["DOCUMENT_ROOT"] . '/Progetto/inc/head.php';
require_once $_SERVER["DOCUMENT_ROOT"] . '/Progetto/inc/header.php';
?>
<h1>Carrello:</h1>
<div class="cart-prod">
</div>
<div class="cart-end">
	<div class="back-div"><button type="button" onclick="window.location.href='categories.php'">Torna indietro</button></div>
	<div id="total"><p>Totale:  </p><div class="tot"></div></div>
	<div class="proceed-div"><button type="button" onclick="window.location.href='place-of-delivery.php'">Procedi all'acquisto</button></div>
</div>
<script>
	function countInArray(array, what) {
		var count = 0;
		for (var i = 0; i < array.length; i++) {
			if (array[i] === what) {
				count++;
			}
		}
		return count;
	}
	var tot=0;
	var products = <?php echo $out?>;
	var cart= <?php echo $session_cart?>;
	$(document).ready(function(){
		$(products).each(function(i, e) {
			var cnt=countInArray(cart, e.prod_id);
			tot=tot+(parseFloat(e.price)*cnt);
			$(".cart-prod").append(
				'<div class="product"><div class="prod_descr">' + e.descr +' x ' + cnt +'</div><div class="prod_price">'+ (e.price*cnt).toFixed(2) +' &euro; </div><div class="delProd"><button type="button" onclick="window.location.href=\'remove-from-cart.php?id='+ e.prod_id + '\'">&#9747;</button></div></div>'
			)
		})
		$(".tot").append(tot.toFixed(2)+'&euro;');
	});
</script>

<?php require_once $_SERVER["DOCUMENT_ROOT"] . '/Progetto/inc/footer.php'; ?>