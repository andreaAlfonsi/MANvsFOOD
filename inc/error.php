<?php
/* Displays all error messages */
session_start();
?>
<?php require_once $_SERVER["DOCUMENT_ROOT"] . '/Progetto/inc/head.php'; ?>
<?php require_once $_SERVER["DOCUMENT_ROOT"] . '/Progetto/inc/header.php'; ?>

<div class="form">
    <h1>Errore</h1>
    <p>
    <?php 
    if( isset($_SESSION['message']) AND !empty($_SESSION['message']) ): 
        echo $_SESSION['message'];    
    else:
        header( "location: ../" );
    endif;
    ?>
    </p>     
    <a href="../"><button class="button button-block"/>Home</button></a>
</div>
<script>
		$(document).ready(function(){
			$('#myTopnav a:not(:first)').hide();
		});
	</script>
<?php require_once $_SERVER["DOCUMENT_ROOT"] . '/Progetto/inc/footer.php'; ?>

