<?php
	session_start();

	$_SESSION['err'] = 1;
	foreach($_POST as $key => $value){
		if(trim($value) == ''){
			$_SESSION['err'] = 0;
		}
		break;
	}

	if($_SESSION['err'] == 0){
		header("Location: purchase.php");
	} else {
		unset($_SESSION['err']);
	}

	require_once "./functions/database_functions.php";
	// print out header here
	$title = "Purchase Process";
	require "header.php";
	// connect database
	$conn = db_connect();
	extract($_SESSION['ship']);
    $id=$_SESSION['id'];
	$card_number = $_POST['card_number'];
	$card_PID = $_POST['card_PID'];
	$card_expire = strtotime($_POST['card_expire']);
	$card_owner = $_POST['card_owner'];

	// find customer
	$customerid = getCustomerId($id,$name, $address, $city, $zip_code, $country);
	if($customerid == null) {
		// insert customer into database and return customerid
		$customerid = setCustomerId($id,$name, $address, $city, $zip_code, $country);
	}
	$date = date("Y-m-d H:i:s");
	insertIntoOrder($conn, $id, $_SESSION['total_price'], $date,$name, $address, $city, $zip_code, $country);

	// take orderid from order to insert order items
	$orderid = getOrderId($conn, $customerid);

	foreach($_SESSION['cart'] as $isbn => $qty){
		$bookprice = getbookprice($isbn);
		$query = "INSERT INTO order_items VALUES 
		('$orderid', '$isbn', '$bookprice', '$qty')";
		$result = mysqli_query($conn, $query);
		if(!$result){
			echo "Insert value false!" . mysqli_error($conn2);
			exit;
		}else{
		echo '<script>swal({
            title: "oooohooooo you purchase a book ...see you soon!",
            type: "success",
            timer: 2000,
			showConfirmButton: false
		}, function(){
			  window.location.href = "index.php";
		});
            </script>';  
	}
}

	session_unset();
?>
	<!-- <div class="alert alert-success rounded-0 my-4">Your order has been processed sucessfully. We'll be reaching you out to confirm your order. Thanks!</div> -->

<?php
	if(isset($conn)){
		mysqli_close($conn);
	}
	require_once "footer.php";
?>