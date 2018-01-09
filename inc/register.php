<?php
/* Registration process, inserts user info into the database 
   and sends account confirmation email message
 */

// Set session variables to be used on profile.php page
$_SESSION['email'] = $_POST['email'];
$_SESSION['first_name'] = $_POST['firstname'];
$_SESSION['last_name'] = $_POST['lastname'];

// Escape all $_POST variables to protect against SQL injections
$first_name = $mysqli->escape_string($_POST['firstname']);
$last_name = $mysqli->escape_string($_POST['lastname']);
$email = $mysqli->escape_string($_POST['email']);
$password = $mysqli->escape_string(password_hash($_POST['password'], PASSWORD_BCRYPT));
$hash = $mysqli->escape_string( md5( rand(0,1000) ) );
      
// Check if user with that email already exists
$result = $mysqli->query("SELECT * FROM user WHERE email='$email'") or die($mysqli->error());

// We know user email exists if the rows returned are more than 0
if ( $result->num_rows > 0 ) {
    
    $_SESSION['message'] = 'Un utente con questa mail esiste già!';
    header("location: inc/error.php");
    
}
else { // Email doesn't already exist in a database, proceed...

    $sql = "INSERT INTO user (first_name, last_name, email, password, hash, active) " 
            . "VALUES ('$first_name','$last_name','$email','$password', '$hash', '0')";

    // Add user to the database
    if ( $mysqli->query($sql) ){

        $_SESSION['active'] = 0; //0 until user activates their account with verify.php
        $_SESSION['logged_in'] = false; 
        $_SESSION['message'] =
                
                 "Il link di conferma è stato inviato a $email!";

        // Send registration confirmation link (verify.php)
        $to      = $email;
        $subject = 'Verifica account ( MANvsFOOD )';
        $message_body = '
        Ciao '.$first_name.',

        Grazie per esserti registrato!

        Clicca il seguente link per attivare il tuo account:

        http://localhost/Progetto/inc/verify.php?email='.$email.'&hash='.$hash;  

        mail( $to, $subject, $message_body );

        $_SESSION['message'] = 'Ti abbiamo inviato una email per confermare il tuo account!';
		header("location: inc/success.php");

    }

    else {
        $_SESSION['message'] = 'Registration failed!';
        header("location: inc/error.php");
    }

}