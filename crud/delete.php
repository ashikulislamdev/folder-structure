<?php 
	include_once '../config/db_conn.php';
	if (isset($_GET['id'])) {
		$post_id = $_GET['id'];

		$del_sql = "DELETE FROM crud WHERE id='$post_id' "; 
		$del_res = mysqli_query($connection, $del_sql);


		header('location:index.php');
	}
?>