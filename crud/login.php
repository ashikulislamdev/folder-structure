<?php 
	include_once '../config/db_conn.php';
	$title = "CRUD Project Login";

	if (isset($_SESSION['user-login'])) {
		header('location:index.php');
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
	<div class="container d-flex justify-content-center mt-5">
		<div class="col-md-6 card">
			<form class="form-group" method="POST">
				<div class="card-body">
					<label>Email</label>
					<input type="email" name="email" class="form-control">
					<label>Password</label>
					<input type="password" name="password" class="form-control">
					<input type="submit" name="submit" value="Login" class="btn btn-success mt-4">
				</div>
			</form>

			<?php 
				if (isset($_POST['submit'])=='submit') {
					$email = $_POST['email'];
					$password = md5($_POST['password']);

					$ck_sql = "SELECT * FROM admin WHERE email='$email' AND password='$password' ";
					$exe_query = mysqli_query($connection, $ck_sql);

					if (mysqli_num_rows($exe_query)>0) {
						if ($exe_query) {
							$_SESSION['user-login'] = $email;
							header('location:index.php');
						}else{
							echo "Email or Password invalid!";
						}
					}else{
						echo "Email or Password invalid!";
					}
				}
			?>
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