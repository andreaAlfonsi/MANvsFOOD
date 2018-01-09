<?php 
/* Verifies registered user email, the link to this page
   is included in the register.php email message 
*/
require_once $_SERVER["DOCUMENT_ROOT"] . '/Progetto/inc/db.php';
session_start();

// Make sure email and hash variables aren't empty
if(isset($_GET['email']) && !empty($_GET['email']) AND isset($_GET['hash']) && !empty($_GET['hash']))
{
    $email = $mysqli->escape_string($_GET['email']); 
    $hash = $mysqli->escape_string($_GET['hash']); 
    
    // Select user with matching email and hash, who hasn't verified their account yet (active = 0)
    $result = $mysqli->query("SELECT * FROM user WHERE email='$email' AND hash='$hash' AND active='0'");

    if ( $result->num_rows == 0 )
    { 
        $_SESSION['message'] = "L'account è già stato attivato oppure l'URL è sbagliato.";

        header("location: error.php");
    }
    else {
        $_SESSION['message'] = "Il tuo account è stato attivato!";
        
        // Set the user status to active (active = 1)
        $mysqli->query("UPDATE user SET active='1' WHERE email='$email'") or die($mysqli->error);
        $_SESSION['active'] = 1;
        
        header("location: success.php");
    }
}
else {
    $_SESSION['message'] = "Parametri errati per la verifica dell'account";
    header("location: error.php");
}     
?>