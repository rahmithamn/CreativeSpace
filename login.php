<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>CreativeSpace - Login</title>
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
				<button class="active-menu" id="login">Login as Student</button>
				<button id="register">Login as Recruiter</button>
			</div>
			<div class="login-block">
				<div class="login-title">LOGIN AS STUDENT</div>
				<div class="input-form">
				<div class="input-login">
				<form action="function/loginsystem.php" method="POST">
					Username : <br>
						<input type="text" name="username">
					</div>
					<div class="input-login">
						Password : <br>
						<input type="password" name="password">
					</div>
					<div class="input-login">
						<input class="submit-input" type="submit" name="submit" value="Login">
					</div>
				</form>
				</div>
				<div class="signup-form">Don't have an account?<a href="register.php"> Sign Up Here</a></div>
			</div>
			<div class="login2-block">
				<div class="login-title">LOGIN AS RECRUITER</div>
				<div class="input-form">
					<form action="function/loginsystem-rec.php" method="POST">
					<div class="input-login">
						Username : <br>
						<input type="text" name="uname_rec">
					</div>
					<div class="input-login">
						Password :<br>
						<input type="password" name="pass_rec">
					</div>
					<div class="input-login">
						<input class="submit-input" type="submit" name="login_rec" value="Login">
					</div>
					</form>
				</div>
				<div class="signup-form">Don't have an account?<a href="register.php"> Sign Up Here</a></div>
			</div>
		</div>
	</div>