<?php 
	include_once '../config/db_conn.php';
	$title = "CRUD Project";

	if (!isset($_SESSION['user-login'])) {
		header('location:login.php');
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php echo $title; ?></title>
	<!-- Bootstrap css file -->
	<link rel="stylesheet" href="../assets/css/bootstrap.min.css">
	<!-- Fontawesome css file -->
	<link rel="stylesheet" href="../assets/css/fontawesome-all.min.css">
	<!-- Google font -->
	<link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@700&display=swap" rel="stylesheet">
	<!-- Custom Css -->

</head>
<body>
	<div class="d-flex justify-content-between m-3">
		<h3>CRUD</h3>
		<a href="log_out.php" class="btn btn-danger">Log Out</a>
	</div>
	<div class="container mt-5">
		<div class="row">
			<div class="col-md-6 card">
				<div class="card-body">
					<form class="form-group" method="POST">
						<h3 class="card-header text-center">Make a post</h3>
						<label>Title</label>
						<input type="text" name="title" class="form-control" required>

						<label>Description</label>
						<input type="text" name="description" class="form-control" required>
						<div class="form-inline mt-3 mb-3">
							<label>Active &nbsp;</label>
							<input type="radio" name="type" id="active" value="1">
							<label class="ml-5">Inactive &nbsp;</label>
							<input type="radio" name="type" id="inactive" value="0">
						</div>

						<input class="btn btn-primary" type="submit" name="submit" value="Post">

					</form>
					<?php 
						if (isset($_POST['submit'])) {
							$title = addslashes($_POST['title']);
							$description = addslashes($_POST['description']);
							$type = $_POST['type'];

							$ins_sql = "INSERT INTO crud (title, description, type) VALUES ('$title', '$description', '$type')";
							$ins_res = mysqli_query($connection, $ins_sql);
							if ($ins_res) {
								echo "Thank You";
							}else{
								echo "Sorry";
							}

						}
					?>
				</div>
			</div>

			<div class="col-md-6 card">
				<h3 class="text-center card-header">All Post</h3>
				<div class="card-body">
					<?php 
						$sel_sql = "SELECT * FROM crud";
						$sel_res = mysqli_query($connection, $sel_sql);
						if (mysqli_num_rows($sel_res)>0) {
							while ($row = mysqli_fetch_assoc($sel_res)) {
					?>			
						<h5 class="card-title"><?php echo $row['title'] ?></h5>
						<p class="card-description d-flex justify-content-between"><?php echo $row['description'] ?> - <?php if ($row['type'] == 0) {
							echo "Inactive Post";
						}else{
							echo "Active Post";
						} ?> </p>
						<a href="edit.php?id=<?php echo $row['id'] ?>" class="btn btn-success"><i class="fas fa-edit"></i>Edit Post</a>
						<a href="delete.php?id=<?php echo $row['id'] ?>" class="btn btn-danger"><i class="fas fa-trash"></i>Delete Post</a>
						<hr>
								
					<?php } } ?>
				</div>
			</div>
		</div>
	</div>

	<!-- Neccessary js file -->
	<script src="../assets/js/jquery.min.js"></script>
	<script src="../assets/js/bootstrap.min.js"></script>
	<script src="../assets/js/popper.min.js"></script>
	<script src="../assets/js/fontawesome-all.min.js"></script>
	<script src="../assets/js/sweetalert.min.js"></script>
	
</body>
</html>