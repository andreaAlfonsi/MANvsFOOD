<?php 
 require 'db.php';
 session_start();

 if ( $_SESSION['logged_in'] != 1 || $_SESSION['admin']!=1) {
  $_SESSION['message'] = "Non sei autorizzato a visualizzare questa pagina";
  header("location: error.php");    
}

if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) 
{ 
	if (isset($_POST['submit'])) { 
	
	$descr = $mysqli->escape_string($_POST['descr']);		
	$price = $mysqli->escape_string($_POST['price']);
	$cat   = $mysqli->escape_string($_POST['cat']);	

	$found = $mysqli->query("SELECT descr FROM product WHERE descr='$descr';");

	if($found->num_rows > 0 )
	{
		$_SESSION['message'] = "Prodotto già esistente";
        header("location: error.php");
	}
	else
		$insert = $mysqli->query("INSERT INTO product (descr,price,cat_id) VALUES ('$descr',$price,$cat);");
		
	}
	elseif(isset($_POST['del'])){
	
	  $prod = $mysqli->escape_string($_POST['prod']);
	  $found = $mysqli->query("SELECT descr FROM product WHERE descr='$prod';");
	  if($found->num_rows == 0 )
	  {
		  $_SESSION['message'] = "Prodotto non esistente!";
			header("location: error.php");
		}
	  else
		$delete = $mysqli->query("DELETE FROM product WHERE descr='$prod';");
					
	}
}
$category=$mysqli->query("SELECT * FROM category;");
if($category->num_rows == 0){
	$_SESSION['message'] = "Database vuoto";
	header("location: error.php");
}
else{
	$list = $mysqli->query("SELECT * FROM product;");
	$products=array();
	while($row = $list->fetch_assoc()) {
		$products[]= $row;
	}
	$prod = json_encode($products);			
}

require_once $_SERVER["DOCUMENT_ROOT"] . '/Progetto/inc/head.php';
require_once $_SERVER["DOCUMENT_ROOT"] . '/Progetto/inc/header.php';
?>
<h1>Listino</h1>
<div class="admin-container">
	<div class="cat-1">
		<p>Pasta [1]</p>
	</div>
	<div class="cat-2">
		<p>Carne [2]</p>
	</div>
	<div class="cat-3">
		<p>Pizza [3]</p>
	</div>
	<div class="cat-4">
		<p>Contorni [4]</p>
	</div>
	<div class="cat-5">
		<p>Bevande [5]</p>
	</div>	
	<div class="cat-6">
		<p>Altro [6]</p>
	</div>
</div>
<div class="form">
	<ul class="tab-group">
		<li class="tab active"><a href=".add">Aggiungi</a></li>
        <li class="tab"><a href=".remove-from-list">Rimuovi</a></li>
    </ul>
      
    <div class="tab-content">

	<div class="add">
		<h1>Aggiungi prodotto</h1>
		<form action="admin_list.php" method="post" autocomplete="off">
            <div class="field-wrap">
				<label>Nome prodotto</label>
				<input type="text" required autocomplete="off" name="descr" />
			</div>
			<div class="field-wrap">
				<label>Prezzo</label>
				<input type="text" required autocomplete="off" name="price" />
			</div>
			<div class="field-wrap">
				<label>ID Categoria</label>
				<input type="text" required autocomplete="off" name="cat" />
			</div>
			<button class="button button-block" name="submit" />Inserisci</button>
		</form>
	</div>
	<div class="remove-from-list">
		<h1>Rimuovi prodotto</h1>
		<form action="admin_list.php" method="post" autocomplete="off">
            <div class="field-wrap">
				<label>Nome prodotto</label>
				<input type="text" required autocomplete="off" name="prod" />
			</div>
			<button class="button button-block" name="del" />Rimuovi</button>
		</form>
	</div>
</div>
<script>
var prod = <?php echo $prod?>;
$(document).ready(function(){
	$(prod).each(function(i, e) {
		var $categor = e.cat_id;
		$(".cat-"+ e.cat_id).append(
			'<div class="prod"><div class="prod-name">'+e.descr+'</div><div class="price">'+e.price+' &euro; </div></div>'
		)
	})
});
</script>
<script src="/Progetto/js/index.js"></script>
<?php require_once $_SERVER["DOCUMENT_ROOT"] . '/Progetto/inc/footer.php'; ?>