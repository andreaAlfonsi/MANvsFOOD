<?php $ptitle = "MANvsFOOD" ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title><?php print $ptitle ?></title>
		<link href="https://fonts.googleapis.com/css?family=Amatic+SC" rel="stylesheet">
		<script src="/Progetto/js/jquery-3.2.1.min.js"></script>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="shortcut icon" type="image/x-icon" href="/Progetto/imgs/icona.ico">
		<link rel="stylesheet" type="text/css" href="/Progetto/css/style.css" />
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

	</head>
		<?php 
		if ($_SERVER['REQUEST_METHOD'] == 'POST') 
		{
			if (isset($_POST['login'])) { //user logging in

				require_once $_SERVER["DOCUMENT_ROOT"] . '/Progetto/inc/login.php';
				
			}
			
			elseif (isset($_POST['register'])) { //user registering
				
				require_once $_SERVER["DOCUMENT_ROOT"] . '/Progetto/inc/register.php';
				
			}
		}
		?>
	<body>
		<div class="page-wrap">