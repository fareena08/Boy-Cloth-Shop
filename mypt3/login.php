<?php
include_once 'validate_login.php';

if (!isset($_SESSION)) {
	session_start();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<title>Boy Apparel Co</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--===============================================================================================-->
		
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<!--===============================================================================================-->
	
</head>

<body>

	<div class="limiter">
		<div class="container-login100" style="background-image: url(https://images.pexels.com/photos/6347888/pexels-photo-6347888.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1);" >
			<div class="wrap-login100 p-t-90 p-b-90">
				<form class="login100-form validate-form" action="#" method="POST">
					<div class="login100-form-avatar">
						<img src="pictures/logo.png" alt="logo">
					</div>
		

					<div class="wrap-input100 validate-input m-b-10" data-validate="User ID is required">
						<input class="input100" type="text" name="sid" placeholder="User ID">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-user"></i>
						</span>
					</div>


					<div class="wrap-input100 validate-input m-b-10" data-validate="Password is required">
						<input class="input100" type="password" name="pass" placeholder="Password">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock"></i>
						</span>
					</div>
					
					<div class="wrap-input100 validate-input m-b-10">
						<span class="symbol-input100">
							<i class="fa fa-bars"></i>
						</span>
						
						
							<select name="level" class="input100" id="level" required>
								<option value="">Please select a role</option>
								<option value="Normal Staff">Normal Staff</option>
								<option value="Admin">Admin</option>
							</select>
								
					
					</div>


					<div class="container-login100-form-btn p-t-10">
						<button type="submit" class="login100-form-btn loginbtn">
							Login
						</button>
					</div>

					<div class="text-center w-full p-t-25 p-b-230">
						<a href="#" class="txt1">
						</a>
					</div>

					<div class="text-center w-full">
						<a class="txt1" href="#">
						</a>
					</div>

					</a>
			</div>
			</form>
		</div>
	</div>
	</div>


	<!--===============================================================================================-->

	<script src="js/main.js"></script>

</body>

</html>