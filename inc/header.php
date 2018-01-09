<?php
	require 'db.php';
	 if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
	if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == 1 && isset($_SESSION['user_id'])){
		$count=0;
		$result = $mysqli->query("SELECT * FROM notification WHERE status = 0 AND user_id=$_SESSION[user_id]");
		$count=mysqli_num_rows($result);
	}
	$is_admin=0;
	if(isset($_SESSION['admin']) && $_SESSION['logged_in'] == true){
		$is_admin=1;
	}
?>
<header class="mainheader">
	<div class="topnav" id="myTopnav">
		<a id="logo" href="http://localhost/Progetto/index.php">manVSfood</a>
		<a href="cart.php" class="lastElem">Carrello</a>
		<a href="notifications.php" class="notifications-count">Notifiche</a>
		<a href="logout.php">Logout</a>
		<a href="javascript:void(0);" class="icon" onclick="responsiveNav()">&#9776;</a>
	</div>
	<script>
	 $(document).ready(function () {
		 $(".notifications-count").html("Notifiche: <?php echo $count ?>");
		 if(<?php echo $is_admin?>==1){
			 $(".lastElem")
			 .html("Listino")
			 .attr("href", "admin_list.php");
		 }
	 })
	</script>
</header>
<main>