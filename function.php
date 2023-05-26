<?php
  ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include "config.php";

       session_start();

if (isset($_POST['login'])){
$username=($_POST['username']);
$password=($_POST['password']);


	$query = "SELECT * FROM users WHERE username='$username' AND password ='$password' LIMIT 1";
		$results = mysqli_query($con, $query);
	if (mysqli_num_rows($results) == 1) { 
			// check if user is admin or user
			$logged_in_user = mysqli_fetch_assoc($results);
			
				$_SESSION['username'] = $username;
				header('location: index.php');
			}
			}else {

			echo ("<script LANGUAGE='JavaScript'>
			window.alert('Wrong Username or password');
			 window.location.href='login.php';
			</script>");
		}

}


	 

?>