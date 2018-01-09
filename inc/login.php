<?php

$email = $mysqli->escape_string($_POST['email']);
$result = $mysqli->query("SELECT * FROM user WHERE email='$email'");

if ( $result->num_rows == 0 ){ // Utente non esiste
    $_SESSION['message'] = "L'utente con questa email non esiste!";
    header("location: inc/error.php");
}
else { //utente esiste
    $user = $result->fetch_assoc();

    if ( password_verify($_POST['password'], $user['password']) ) {
        
        $_SESSION['email'] = $user['email'];
        $_SESSION['first_name'] = $user['first_name'];
        $_SESSION['last_name'] = $user['last_name'];
		$_SESSION['user_id']=$user['user_id'];
        $_SESSION['active'] = $user['active'];
        
        // sappiamo se l'utente è loggato o meno
        $_SESSION['logged_in'] = true;

		//qui metto il controllo per vedere se l'utente è admin
		$found = $mysqli->query("SELECT * FROM admin WHERE admin.user_id=$user[user_id];");
		if ( $found->num_rows == 0 ){ //not an admin
			header("location: inc/categories.php");
		}
		else{
			$_SESSION['admin'] = true;
			header("location: inc/admin_list.php");
		}
    }
    else {
        $_SESSION['message'] = "La password è errata!";
        header("location: inc/error.php");
    }
}

