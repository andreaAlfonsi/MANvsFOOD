<?php
/* The password reset form, the link to this page is included
   from the forgot.php email message
*/
require 'db.php';
session_start();

// Make sure email and hash variables aren't empty
if( isset($_GET['email']) && !empty($_GET['email']) AND isset($_GET['hash']) && !empty($_GET['hash']) )
{
    $email = $mysqli->escape_string($_GET['email']); 
    $hash = $mysqli->escape_string($_GET['hash']); 

    // Make sure user email with matching hash exist
    $result = $mysqli->query("SELECT * FROM user WHERE email='$email' AND hash='$hash'");

    if ( $result->num_rows == 0 )
    { 
        $_SESSION['message'] = "URL non valido!";
        header("location: error.php");
    }
}
else {
    $_SESSION['message'] = "La verifica è fallita!";
    header("location: error.php");  
}

?>
	<?php require_once $_SERVER["DOCUMENT_ROOT"] . '/Progetto/inc/head.php'; ?>
	<?php require_once $_SERVER["DOCUMENT_ROOT"] . '/Progetto/inc/header.php'; ?>
    <div class="form">

          <h1>Scegli la tua nuova password</h1>
          
          <form action="reset_password.php" method="post">
              
          <div class="field-wrap">
            <label>
              Nuova Password<span class="req">*</span>
            </label>
            <input type="password"required name="newpassword" autocomplete="off"/>
          </div>
              
          <div class="field-wrap">
            <label>
              Conferma la nuova Password<span class="req">*</span>
            </label>
            <input type="password"required name="confirmpassword" autocomplete="off"/>
          </div>
          
          <!-- This input field is needed, to get the email of the user -->
          <input type="hidden" name="email" value="<?= $email ?>">    
          <input type="hidden" name="hash" value="<?= $hash ?>">    
              
          <button class="button button-block" />Applica</button>
          
          </form>

    </div>
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src="/Progetto/js/index.js"></script>
<script>
	$(document).ready(function(){
		$('#myTopnav a:not(:first)').hide();
	});
</script>
<?php require_once $_SERVER["DOCUMENT_ROOT"] . '/Progetto/inc/footer.php'; ?>