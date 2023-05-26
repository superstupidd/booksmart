<?php
	session_start();
	if(!isset($_POST['submit'])){
		echo "Something wrong! Check again!";
		exit;
	}
	require_once "./functions/database_functions.php";
	$conn = db_connect();

	$name = trim($_POST['name']);
	$pass = md5(trim($_POST['pass']));
	// echo $pass;
	// die;


	if($name == "" || $pass == ""){
		echo "Name or Pass is empty!";
		exit;
	}

	$name = mysqli_real_escape_string($conn, $name);
	$pass = mysqli_real_escape_string($conn, $pass);
	// $pass = sha1($pass);

	// get from db
	$query = "SELECT `id`,`name`, `pass` from `users` where (`name` = '{$name}' OR `email` = '{$name}') and `pass` ='{$pass}'";
	$result = mysqli_query($conn, $query);
	$fire = mysqli_fetch_array($result);
	// echo $fire['name'];
	// die;
	if($result->num_rows <= 0){
		$_SESSION['err_login'] = "Incorrect Username or Password";
		header("Location: customer_login.php");

		exit;
	}
	if(isset($conn)) {mysqli_close($conn);}
	$_SESSION['user'] = true;
	$_SESSION['name']=$fire['name'];;
	$_SESSION['id']=$fire['id'];
	
	

	header("Location: index.php");
?>