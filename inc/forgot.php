<?php 
/* Reset your password form, sends reset.php password link */
require 'db.php';
session_start();

// Check if form submitted with method="post"
if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) 
{   
    $email = $mysqli->escape_string($_POST['email']);
    $result = $mysqli->query("SELECT * FROM user WHERE email='$email'");

    if ( $result->num_rows == 0 ) // User doesn't exist
    { 
        $_SESSION['message'] = "Non esiste un utente con questa email!";
        header("location: error.php");
    }
    else { // User exists (num_rows != 0)

        $user = $result->fetch_assoc(); // $user becomes array with user data
        
        $email = $user['email'];
        $hash = $user['hash'];
        $first_name = $user['first_name'];

        // Session message to display on success.php
        $_SESSION['message'] = "<p>Controlla la tua email <span>$email</span>"
        . " per il link di conferma del reset della password!</p>";

        // Send registration confirmation link (reset.php)
        $to      = $email;
        $subject = 'Password Reset Link ( MANvsFOOD )';
        $message_body = '
        Ciao '.$first_name.',

        Hai chiesto di resettare la password

        Clicca il seguente link per farlo:

        http://localhost/Progetto/inc/reset.php?email='.$email.'&hash='.$hash;  

        mail($to, $subject, $message_body);

        header("location: success.php");
  }
}
?>

<?php require_once $_SERVER["DOCUMENT_ROOT"] . '/Progetto/inc/head.php'; ?>
<?php require_once $_SERVER["DOCUMENT_ROOT"] . '/Progetto/inc/header.php'; ?>
    
  <div class="form">

    <h1>Resetta la tua password</h1>

    <form action="forgot.php" method="post">
     <div class="field-wrap">
      <label>
		Indirizzo email<span class="req">*</span>
      </label>
      <input type="email"required autocomplete="off" name="email"/>
    </div>
    <button class="button button-block"/>Reset</button>
    </form>
	          <a href="../"><button class="button button-block"/>Home</button></a>

  </div>

<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src="/Progetto/js/index.js"></script>
<script>
	$(document).ready(function(){
		$('#myTopnav a:not(:first)').hide();
	});
</script>
<?php require_once $_SERVER["DOCUMENT_ROOT"] . '/Progetto/inc/footer.php'; ?>
