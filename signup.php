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
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">


   

    </script>
</head>
<div class="row justify-content-center my-5">
	<div class="col-lg-4 col-md-6 col-sm-10 col-xs-12">
		<div class="card rounded-0 shadow">
			<div class="card-header">
				<div class="card-title text-center h4 fw-bolder">Sign Up</div>
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
					<form class="form-horizontal" method="post" action="">
						<div class="mb-3">
							<label for="name" class="control-label ">Username</label>
							<input type="text" name="name" class="form-control rounded-0">
						</div>
                        <div class="mb-3">
							<label for="email" class="control-label ">Email</label>
							<input type="email" name="email" class="form-control rounded-0">
						</div>
						<div class="mb-3">
							<label for="pass" class="control-label ">Password</label>
							<input type="password" name="password" class="form-control rounded-0">
						</div>
						<div class="mb-3 d-grid">
							<input type="submit" name="signup" class="btn btn-primary rounded-0">
						</div>
					</form>

				</div>


</div>


<?php
require_once "./functions/database_functions.php";

	$conn = db_connect();

if (isset($_POST['signup'])){
$username=($_POST['name']);
$email=($_POST['email']);
$password = md5(trim($_POST['password'])); // hash the password
$user_check = "SELECT * FROM users WHERE name = '$username' ";
    $res = mysqli_query($conn, $user_check);
    if(mysqli_num_rows($res) > 0){
        echo '<script>
        swal({
            title: "Username that you have entered is already exist!!",
            type: "warning",
            timer: 2000,
            showConfirmButton: false
          })    
            </script>';
         }else{
        $user_check1 = "SELECT * FROM users WHERE email='$email'";
        $res1 = mysqli_query($conn, $user_check1);
    if(mysqli_num_rows($res1) > 0){
        echo '<script>
        swal({
            title: "Email that you have entered is already exist!!",
            type: "warning",
            timer: 2000,
            showConfirmButton: false
          })    
            </script>'; 
          }else{
    
    $sql= "INSERT INTO users(name,email,pass) VALUES ('$username','$email','$password')";
    $result=mysqli_query($conn,$sql);
    if($result){
        // $_SESSION['username'] = $username;
      echo '<script>swal({
        title: "Success!",
        text: "Redirecting in 2 seconds.",
        type: "success",
        timer: 2000,
        showConfirmButton: false
      }, function(){
            window.location.href = "customer_login.php";
      });
              
        </script>';
    }else{
        echo"something went wrong";
}
    }
}
}

?>
<style>
    .lmain{
width:500px;
height:500px;

box-shadow: black 12px 12px 7px ;
margin-left:35% ;
margin-top: 10%;
margin-bottom:10px;
/*background-color:#cfd2cf;*/
background: linear-gradient(90deg, rgba(2,0,36,1) 0%, rgba(255,255,255,1) 0%, rgba(0,150,255,0.5184574073770133) 100%);
padding:1px;
    
}
.btn-outline-success {
    color: #fff;
    border-color: white;
}
</style>

