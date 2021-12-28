<?php 
	include_once '../config/db_conn.php';

	session_destroy();

	header('location:login.php');
?>