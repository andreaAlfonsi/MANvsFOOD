<?php
require 'db.php';
session_start();

// Check if user is logged in 
if ( $_SESSION['logged_in'] != 1 ) {
  $_SESSION['message'] = "Devi avere eseguito l'accesso per vedere questa pagina!";
  header("location: error.php");    
}

if(isset($_GET['category']) && !empty($_GET['category']))
{
    $category = $_GET['category']; 
    
    $result = $mysqli->query("SELECT product.prod_id, product.descr , product.price FROM product inner join category on product.cat_id = category.cat_id WHERE category.descr=$category");

    if ( $result->num_rows == 0 )
    { 
        $_SESSION['message'] = "Nessun prodotto per questa categoria";

        header("location: error.php");
    }
    else {
		$products=array();
		while($row = $result->fetch_assoc()) {
			$products[]= $row;
		}
		$out = json_encode($products);

    }
}
else {
    $_SESSION['message'] = "Parametri errati";
    header("location: error.php");
}     


require_once $_SERVER["DOCUMENT_ROOT"] . '/Progetto/inc/head.php';
require_once $_SERVER["DOCUMENT_ROOT"] . '/Progetto/inc/header.php'; ?>
<h1 id="cath1">Ordina il tuo pranzo</h1>
<p id="catp">Seleziona i prodotti</p>
<div class="products">

</div>
<script>
	var products = <?php echo $out; ?>;
	console.log(products);
	$(document).ready(function(){
		$(products).each(function(i, e) {
			$(".products").append(
			  '<div class="product"><div class="prod_descr">' + e.descr + '</div><div class="prod_price">'+ e.price +' &euro; </div><div class="addProd"><button type="button" onclick="window.location.href=\'add-to-cart.php?id='+ e.prod_id + '\'">&#10010</button></div></div>'
			)
		})
	});
</script>
<?php require_once $_SERVER["DOCUMENT_ROOT"] . '/Progetto/inc/footer.php'; ?>