<?php
require 'db.php';
session_start();

if ( $_SESSION['logged_in'] != 1 ) {
  $_SESSION['message'] = "Devi avere eseguito l'accesso per vedere questa pagina!";
  header("location: error.php");    
}

//controlo se devo cancellare notifiche
if(isset($_GET['id']) && !empty($_GET['id']))
{
	$result = $mysqli->query("UPDATE notification SET status=1 WHERE id=$_GET[id]");
}

//conrollo se devo visualizzare un ordine
$view_order=0;
$orders=1;
$place=0;
if(isset($_GET['order_id']) && !empty($_GET['order_id']))
{
	$view_order=true;
	$result = $mysqli->query("SELECT product.descr, prod_in_ord.qnt FROM prod_in_ord INNER JOIN product on product.prod_id= prod_in_ord.product_id WHERE order_id=$_GET[order_id]");
	$order=array();
	while($row = $result->fetch_assoc()) {
		$order[]= $row;
	}
	$orders = json_encode($order);
	$result = $mysqli->query("SELECT place FROM ord WHERE order_id=$_GET[order_id]");
	$places=array();
	while($row = $result->fetch_assoc()) {
		$places[]= $row;
	}
	$place = json_encode($places);
}

//controllo se l'utente è admin
$admin=0;
if(isset($_SESSION['admin'])){
	$admin=true;
}

//controllo se devo inviare notifica all'utente
if(isset($_GET['user_id']) && !empty($_GET['user_id']))
{
	//creo notifica per il cliente
	$sql="INSERT INTO notification (testo, user_id)VALUES('Ordine pronto, il fattorino sta partendo',$_GET[user_id])";
	$mysqli->query($sql);
	//mando mail al cliente
	$sql="SELECT email FROM user WHERE user_id=$_GET[user_id]";
	$result = $mysqli->query($sql);
	$to=array();
	while($row = $result->fetch_assoc()) {
		$to[]= $row;
	}
	$to = $to[0]['email'];
	$subject = 'Nuovo ordine';
	$message_body = '
	Ordine pronto, il fattorino sta arrivando.';
	
	 mail($to, $subject, $message_body);
}

//prendo tutte le notifiche dell'utente connesso non ancora lette
$result = $mysqli->query("SELECT * FROM notification WHERE notification.user_id=$_SESSION[user_id] AND notification.status=0");
$notifics=array();
while($row = $result->fetch_assoc()) {
	$notifics[]= $row;
}
$out = json_encode($notifics);

require_once $_SERVER["DOCUMENT_ROOT"] . '/Progetto/inc/head.php';
require_once $_SERVER["DOCUMENT_ROOT"] . '/Progetto/inc/header.php';
?>
<h1>Notifiche</h1>
<p class="under_title">Aggiorna la pagina per vedere se ci sono nuove notifiche</p>
<div class="notific-conteiner"></div>
<div class="view-order" id="see_ord"></div>
<div class="send-fattorino"></div>
<script>
	var view_order=<?php echo $view_order ?>;
	var admin=<?php echo $admin ?>;
	var notifications = <?php echo $out?>;
	$(document).ready(function(){
		$(notifications).each(function(i, e) {
			$(".notific-conteiner").append(
				'<div class="notific"><div class="notific-text">' + e.testo +'</div><button type="button" onclick="window.location.href=\'notifications.php?id='+ e.id + '\'">&#9747;</button></div>'
			)
		})
		if(admin==true){
			$(".view-order").css("display","block");
			$(".view-order").append(
			'<h1>Visualizza un ordine inserendo il suo ID</h1><form id="not_form" action="notifications.php" method="get"><input type="text" name="order_id" placeholder="ID dell\'ordine da cercare" required autocomplete="off"/><input type="submit" value="Visualizza ordine"></form>'
			)
			$(".send-fattorino").css("display","block");
			$(".send-fattorino").append(
			'<h1>Manda un fattorino</h1><form id="not_form" action="notifications.php" method="get"><input type="text" name="user_id" placeholder="ID del cliente" required autocomplete="off"/><input type="submit" value="Manda fattorino"></form>'
			)
		}
		if(view_order==true){
			var orders=<?php echo $orders ?>;
			var place=<?php echo $place ?>;
			$(".view-order").append('<div class="place"> Indirizzo:</br>'+place[0].place+'</br></br>Prodotti:</br></div>');
			$(orders).each(function(i, e) {
				$(".view-order").append(
					'<div class="order-prod"><div class="order-descr">' + e.descr +' x</div><div class="order-qnt">'+e.qnt+'</div></div>'
				)
			})
		}
	});
</script>
<?php require_once $_SERVER["DOCUMENT_ROOT"] . '/Progetto/inc/footer.php'; ?>