<?php 
/* Main page with two forms: sign up and log in */
require_once $_SERVER["DOCUMENT_ROOT"] . '/Progetto/inc/db.php';
session_start();

if (isset($_SESSION['admin']) && $_SESSION['admin']){
	header("location: inc/admin_list.php");
}

if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == 1 && $_SESSION['active']) {
	header("location: inc/categories.php");    
}

require_once $_SERVER["DOCUMENT_ROOT"] . '/Progetto/inc/head.php'; 
require_once $_SERVER["DOCUMENT_ROOT"] . '/Progetto/inc/header.php'; 
require_once $_SERVER["DOCUMENT_ROOT"] . '/Progetto/inc/main.php'; 
require_once $_SERVER["DOCUMENT_ROOT"] . '/Progetto/inc/footer.php'; ?>
