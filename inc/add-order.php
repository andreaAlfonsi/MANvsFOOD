<?php
require 'db.php';
session_start();

if ( $_SESSION['logged_in'] != 1 ) {
  $_SESSION['message'] = "Devi avere eseguito l'accesso per vedere questa pagina!";
  header("location: error.php");    
}

if(empty($_SESSION['cart'])){
	header("location: categories.php");   
}

//insert order
$sql="INSERT INTO ord (ord.place,ord.user_id) VALUES ('$_SESSION[location]',(SELECT user.user_id FROM user WHERE user.email='$_SESSION[email]'));" ;
$mysqli->query($sql);

//get last id
$last_id = $mysqli->insert_id;

//insert prod in ord
$whereIN=implode(',',$_SESSION['cart']);
$result = $mysqli->query("SELECT product.prod_id FROM product WHERE prod_id IN($whereIN)");
$products=array();
while($row = $result->fetch_assoc()) {
	$products[]= $row;
}
foreach ($products as $elem) {
	$tmp = array_count_values($_SESSION['cart']);
	$qnt = $tmp[$elem['prod_id']];
	$sql="INSERT INTO prod_in_ord (order_id,product_id,qnt)VALUES ($last_id,$elem[prod_id],$qnt)";
	$mysqli->query($sql);
}
//creo notifica verso l'amministratore con l'id del cliente
$result=$mysqli->query("SELECT user.user_id FROM user WHERE user.email='$_SESSION[email]';");
while($row = $result->fetch_assoc()) {
	$user = $row;
}
$sql="INSERT INTO notification (testo, user_id)VALUES('Il cliente con id $user[user_id] ha fatto un ordine con id: $last_id',13)";
$mysqli->query($sql);
//creo anche email verso amministratore
$to = 'amministratoremanvsfood@gmail.com';
$subject = 'Nuovo ordine';
$message_body = '
Nuovo ordine, controlla la pagina delle notifiche:

http://localhost/Progetto/inc/notifications.php';  

 mail($to, $subject, $message_body);

header("location: order-success.php"); 
