<?php 
	include_once '../config/db_conn.php';
	$title = "Edit Post";
	
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
	<div class="container">
		<div class="col-md-6 card justify-content-center">
			<div class="card-body">
				<?php 
					if (isset($_GET['id'])) {
						$post_id = $_GET['id'];

						$sel_sql = "SELECT * FROM crud WHERE id='$post_id' ";
						$sel_res = mysqli_query($connection, $sel_sql);

						if (mysqli_num_rows($sel_res)>0) {
							while ($my_data = mysqli_fetch_assoc($sel_res)) {
								
				?>
				<form class="form-group" method="POST">
					<h3 class="card-header text-center">Update Post</h3>
					<label>Title</label>
					<input type="text" name="title" class="form-control" value="<?php echo $my_data['title'] ?>">
					<label>Description</label>
					<input type="text" name="description" class="form-control" value="<?php echo $my_data['description'] ?>">
					<div class="form-inline mt-3 mb-3">
						<label>Active &nbsp;</label>
						<input <?php if ($my_data['type'] == 1) { echo "checked"; } ?> type="radio" name="type" id="active" value="1" >
						<label class="ml-5">Inactive &nbsp;</label>
						<input  <?php if ($my_data['type'] == 0) { echo "checked"; } ?> type="radio" name="type" id="inactive" value="0" >
					</div>

					<input class="btn btn-primary" type="submit" name="submit" value="Update">

				</form>
				<?php 
						}
					}

				}else{
					echo "No Data!";
				}


					if (isset($_POST['submit'])) {
						//Update Data
						$title = $_POST['title'];
						$description = $_POST['description'];
						$type = $_POST['type'];

						$upd_sql = "UPDATE `crud` SET `title`='$title',`description`='$description',`type`='$type' WHERE id='$post_id'";
						$exe_query = mysqli_query($connection, $upd_sql);
						if ($upd_sql) {
							header('location:index.php');
						}
				}
				?>
				
			</div>
		</div>
	</div>
</body>
</html>