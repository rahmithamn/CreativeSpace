<?php
	include_once 'function/connection.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title>CreativeSpace - Register</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css"href="vendor/font-awesome/css/all.css">
	<link rel="stylesheet" type="text/css"href="vendor/font-awesome/css/brands.min.css">
	<link rel="stylesheet" type="text/css" href="css/navigation-bar.css">
	<link rel="stylesheet" type="text/css" href="css/login-form.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script>
	$(document).ready(function(){
	    $("#register").click(function(){
	        $(".login-block").hide();
	        $(".login2-block").show();
	        $("#register").addClass("active-menu");
	        $("#login").removeClass("active-menu");
	    });
	    $("#login").click(function(){
	        $(".login-block").show();
	        $(".login2-block").hide();
	        $("#login").addClass("active-menu");
	        $("#register").removeClass("active-menu");
	    });
	});
	</script>
</head>
<body>
	<nav>
		<div class="upper-navbar">
			<ul class="menu-padding">
				<li><a href="">FAQs</a></li>
				<li><a href="">Timeline</a></li>
				<li><a href="">Home</a></li>
				<li class="left-menu">
					<a href="">
						<img src="img/creativespace.png">
					</a>
				</li>
				<!--<li class="left-menu-search">
					<input type="" name="" placeholder="Search..">
				</li>-->
			</ul>
		</div>
	</nav>
	<!-- END OF NAVBAR -->
	
	<div class="main-login-form">
		<div class="login-bg">
			<img src="img/bg1.png">
		</div>
		<div class="login-form">
			<div class="menu-login">
				<button class="active-menu" id="login">Register as Student</button>
				<button id="register">Register as Recruiter</button>
			</div>
			<div class="login-block">
				<div class="login-title">REGISTER AS STUDENT</div>
				<form action="function/signup.php" method="POST"><div class="input-form">
					<div class="input-login">
						Email : <br>
						<input type="text" name="email">
					</div>
					<div class="input-login">
						Name : <br>
						<input type="text" name="name">
					</div>
					<div class="input-login">
						Username : <br>
						<input type="text" name="username">
					</div>
					<div class="input-login">
						University : <br>
						<input type="text" name="uni_name">
					</div>
					<div class="input-login">
						City : <br>
						<input type="text" name="city">
					</div>
					<div class="input-login">
						Birthdate : <br>
						<input type="date" name="birthdate">
					</div>
					<div class="input-login">
						Password : <br>
						<input type="password" name="password">
					</div>
					<div class="input-login">
						Confirm Password : <br>
						<input type="password" name="cpassword">
					</div>
					<div class="input-login">
						<input class="submit-input" type="submit" name="submit" value="Register">
					</div>
				</form>
				</div>
				<div class="signup-form">Already have an account?<a href="login.php"> Login Here</a></div>
			</div></form>
			<div class="login2-block">
				<div class="login-title">REGISTER AS RECRUITER</div>
				<form action="function/signup-rec.php" method="POST">
				<div class="input-form">
					<div class="input-login">
						Email : <br>
						<input type="text" name="email_rec">
					</div>
					<div class="input-login">
						Username : <br>
						<input type="text" name="username_rec">
					</div>
					<div class="input-login">
						Company/Institution Name : <br>
						<input type="text" name="rec_name">
					</div>
					<div class="input-login">
						City : <br>
						<input type="text" name="city_rec">
					</div>
					<div class="input-login">
						Password : <br>
						<input type="password" name="password_rec">
					</div>
					<div class="input-login">
						Confirm Password : <br>
						<input type="password" name="cpassword">
					</div>
					<div class="input-login">
						<input class="submit-input" type="submit" name="submit" value="Register">
					</div>
					</form>
				<div class="signup-form">Already have an account?<a href="login.php"> Login Here</a></div>
			</div>
		</div>
	</div>