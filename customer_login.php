<?php
session_start();
if(isset($_SESSION['user']) && $_SESSION['user'] == true){
	header('location:index.php');
}
	// $title = "Admin Panel";
	// require_once "header.php";
?>
<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<link href="./bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="./bootstrap/css/styles.css" rel="stylesheet">

<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/all.min.js" integrity="sha512-6PM0qYu5KExuNcKt5bURAoT6KCThUmHRewN3zUFNaoI6Di7XJPTMoT6K0nsagZKk2OB4L7E3q1uQKHNHd4stIQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script type="text/javascript" src="./bootstrap/js/jquery-3.6.0.min.js"></script>
<script type="text/javascript" src="./bootstrap/js/bootstrap.bundle.min.js"></script>
</head>
<div class="row justify-content-center my-5">
	<div class="col-lg-4 col-md-6 col-sm-10 col-xs-12">
		<div class="card rounded-0 shadow">
			<div class="card-header">
				<div class="card-title text-center h4 fw-bolder">Login</div>
			</div>
			<div class="card-body">
				<div class="container-fluid">
					<?php if(isset($_SESSION['err_login'])): ?>
						<div class="alert alert-danger rounded-0">
							<?= $_SESSION['err_login'] ?>
						</div>
					<?php 
						unset($_SESSION['err_login']);
						endif;
					?>

                    <h2 class="text-center"> Welcome to BooksMart</h2>
					<form class="form-horizontal" method="post" action="customer_verify.php">
						<div class="mb-3">
							<label for="name" class="control-label ">Username OR Email</label>
							<input type="text" name="name" class="form-control rounded-0">
						</div>
						<div class="mb-3">
							<label for="pass" class="control-label ">Password</label>
							<input type="password" name="pass" class="form-control rounded-0">
						</div>
						<div class="mb-3 d-grid">
							<input type="submit" name="submit" class="btn btn-primary rounded-0">
						</div>
					</form>

				</div>
                <ul style="display: flex;">
              <li style="list-style:none"> <a class="nav-link  text-dark" href="admin.php"><span class="fa fa-user"></span> Admin</a></li>
               <li style="list-style:none"><a class="nav-link  text-dark" href="signup.php"><span class="fa fa-user-plus"></span> New user</a></li>
<ul>

			</div>
		</div>
	</div>
</div>
	

