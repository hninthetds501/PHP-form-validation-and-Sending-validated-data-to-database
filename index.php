<?php 
require "config.php";

$emailerr="";
$passworderr="";
$repassworderr="";
$nameerr="";
$passmatch="";

if(isset($_POST['btnsubmit'])){
	$name=$_POST['name'];
	$email=$_POST['email'];
	$password=$_POST['password'];
	$repassword=$_POST['repassword'];
	$check=true; 

// Name
	if(empty($name)){
		$nameerr="* Name is empty";
		$check=false;
	}
	else{
		// ^=>start with, +=>one and more [^]=>not included $=>end with
		if(!preg_match("/^[a-zA-Z]+[^0-9]$/",$name)){
			$nameerr="* Name is invalid";
			$check=false;
		}
	}

// Email
	if(empty($email)){
		$emailerr="* Email is empty";
		$check=false;
	}
	else{
		if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
			$emailerr="* Email is invalid";
			$check=false;
		}
	}

// Password
	if(empty($password)){
		$passworderr="* Password is empty";
		$check=false;
	}
	else{
		//you can use parathesis to define how many word should be included by using {from,to}
		if(!preg_match("/^(([a-zA-Z0-9]+)([!@#$%^&*]*)){3,8}/",$password)){
			$passworderr="* Password is invalid";
			$check=false;
		}
	}

// RePassword
	if(empty($repassword)){
		$repassworderr="* RePassword is empty";
		$check=false;
	}
	else{
		if(!preg_match("/^(([a-zA-Z0-9]+)([!@#$%^&*]*)){3,8}/",$password)){
			$repassworderr="* Password is invalid";
			$check=false;
		}
	}

// Matching Password
	if($password!==$repassword){
		$passmatch="* Password does not match";
		$check=false;
	}

// Sending datat to database
		if($check==true){
		//echo $check;
		$sql="INSERT INTO users(name,email,password) VALUES('$name','$email','$password')";
		mysqli_query($conn, $sql);

		}
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Registeration form</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="style.css">
	<!-- <script src="jquery.js"></script> -->
</head>
<body>
	<h1>User Register Form</h1>
	<form action="" method="post" id="myform">
		<input type="text" name="name" id="name" placeholder="Enter name">
		<div><?php echo $nameerr; ?></div>

		<input type="text" name="email" id="email" placeholder="Enter email">
		<div><?php echo $emailerr; ?></div>

		<input type="password" name="password" id="password" placeholder="Enter password">
		<div><?php echo $passworderr; ?></div>
		<div><?php echo $passmatch=""; ?> </div>
		<input type="checkbox" onclick="showpass('password')"><label for="">Show Password</label>

		<input type="password" name="repassword" id="repassword" placeholder="Re enter password">
		<div><?php echo $repassworderr; ?></div>

		<input type="checkbox" onclick="showpass('repassword')"><label for="">Show Password</label>

		<input type="submit" value="Register" name="btnsubmit">
	</form>

	
</body>
<!-- <script src="jquery.js"></script>
	<script src="app.js"></script> -->


	<script>

		// to toggle password checkbox
		function showpass(id){
			console.log(id);
			var obj=document.getElementById(id);
			// console.log(obj);

			if(obj.type=="password"){
				obj.type="text";
			}
			else{
				obj.type="password";
			}
		}

	</script>
	</html>