<?php
//log out e distruzione della sessione con l'utente
session_start();
session_unset();
session_destroy(); 
?>
<?php require_once $_SERVER["DOCUMENT_ROOT"] . '/Progetto/inc/head.php'; ?>
<?php require_once $_SERVER["DOCUMENT_ROOT"] . '/Progetto/inc/header.php'; ?>

    <div class="form">
          <h1>Grazie per essere passato</h1>
              
          <p><?= 'Ti sei disconnesso!'; ?></p>
          
          <a href="../"><button class="button button-block"/>Home</button></a>

    </div>
	<script>
		$(document).ready(function(){
			$('#myTopnav a:not(:first)').hide();
		});
	</script>
<?php require_once $_SERVER["DOCUMENT_ROOT"] . '/Progetto/inc/footer.php'; ?>

