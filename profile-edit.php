<?php
	session_start();
	if(!isset($_SESSION['submit'])) {
		echo "Illegal Akses";
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>CreativeSpace - Edit Profile</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css"href="vendor/font-awesome/css/all.css">
	<link rel="stylesheet" type="text/css"href="vendor/font-awesome/css/brands.min.css">
	<link rel="stylesheet" type="text/css" href="css/navigation-bar.css">
	<link rel="stylesheet" type="text/css" href="css/profile.css">
	<link rel="stylesheet" type="text/css" href="css/profile-edit.css">
	<link rel="stylesheet" type="text/css" href="css/timeline-responsive.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
</head>
<body>
		<?php
				include 'function/connection.php';
				$uname_now = $_SESSION['student'];
		
					$sql = "SELECT 
								name,
								student_img,
								university, 
								major,
								status_desc,
								birthdate, 
								loc_city,
								phone,
								email_stu,
								student_img,
								student_header
							FROM 
								student_profile WHERE student_uname = '$uname_now';";
					$result = mysqli_query($conn, $sql);
					$resultCheck = mysqli_num_rows($result);

					if($resultCheck > 0) {
						while ($row = mysqli_fetch_assoc($result)) {
			?>
	<nav>
		<div class="upper-navbar">
			<ul class="menu-padding">
				<li class="profil">
					<div class="profile">
						<div class="profile-img">
						<?php
							$propic = $row['student_img'];
							if(!$propic == null) {
								echo "<center><img src=profile-picture/$propic></center>";
							} else {
								echo "<img src=img/girl.png>";
							}
						?>
						</div>
						<a href="profile.php"><?php echo $_SESSION['student'];?></a>
					</div>
				</li>
				<li><a href="faq.php">FAQs</a></li>
				<li><a href="timeline.php">Timeline</a></li>
				<li><a href="index.php">Home</a></li>
				<li class="left-menu">
					<a href="index.php">
						<img src="img/creativespace.png">
					</a>
				</li>
				<!--<li class="left-menu-search">
					<input type="" name="" placeholder="Search..">
				</li>-->
			</ul>
		</div>
		<div class="lower-navbar">
			<ul class="menu-padding">
				<li>
					<a href="timeline.php"><i class="fa fa-1x fa-images"></i> Content</a>
				</li>
				<li><a href="timeline-jobapp.php"><i class="fa fa-1x fa-newspaper"></i> Job Applications</a></li>
				<li style="float:right"> 
					<form action="function/logout.php" method="POST">
						<button class="logout" name="logout">Logout</button>
					</form>
				</li>
			</ul>
		</div>
	</nav>
	<!-- END OF NAVBAR -->
	<?php
		$header_stu = $row['student_header'];
		if(!$header_stu == null) {
			$headerbg = 'header-student/'.$row['student_header'];
		} else {
			$headerbg = 'img/bgbg.jpg';
		}
	?>
    <div class="main-header" style="background-image:url('<?php echo $headerbg;?>');">
    <div class="main-profile">
			<div class="profile-descript">
				<div class="edit-profile">
				</div>
				<div class="profile-picture">
						<?php
							$propic = $row['student_img'];
							if(!$propic == null) {
								echo "<center><img src=profile-picture/$propic></center>";
							} else {
								echo "<img src=img/girl.png>";
							}
						?>
					
				</div>
				<div class="more-profile">
					<div class="profile-name"><?php echo $row['name'];?></div>
					<div class="uname-name"><center>@<?php echo $_SESSION['student'];?></center></div>
					<div class="profile-status">
						"<?php echo $row['status_desc'];?>"
					</div>
					<div class="profile-info">
						<div class="info-profile">
							<div class="icon-info">
								<i class="fa fa-university fa-1x"></i>
							</div>
							<div class="icon-ket">
									<?php echo $row['university'];?>
							</div>
						</div>
						<div class="info-profile">
							<div class="icon-info">
								<i class="fa fa-circle-notch fa-1x"></i>
							</div>
							<div class="icon-ket">
									<?php echo $row['major'];?>
							</div>
						</div>
						<div class="info-profile">
							<div class="icon-info">
								<i class="fa fa-map-marker-alt fa-1x"></i>
							</div>
							<div class="icon-ket">
								<?php
									$loc = $row['loc_city'];
									if($loc == null) {
										echo "-";
									} else {
										echo $row['loc_city'];
									}
								?>
							</div>
						</div>
						<div class="info-profile">
							<div class="icon-info">
								<i class="fa fa-phone fa-1x"></i>
							</div>
							<div class="icon-ket">
								<?php
									$phonenum = $row['phone'];
									if($phonenum == 0) {
										echo "-";
									} else {
										echo $row['phone'];
									}
								?>
							</div>
						</div>
						<div class="info-profile">
							<div class="icon-info">
								<i class="fa fa-mail-bulk fa-1x"></i>
							</div>
							<div class="icon-ket">
								<?php
									$emails = $row['email_stu'];
									if($emails == null) {
										echo "-";
									} else {
										echo $row['email_stu'];
									}
								?>
							</div>
						</div>
						
					</div>
				</div>
			</div>
			<div class="profile-timeline">
                <div class="edit-title">
					Edit Profile
					<a href="profile.php">Back To Profile</a>
				</div>
				<div class="main-edit-profile">
					
                    <div class="edit-left">
					<form action="function/update-profile.php" method="POST" enctype="multipart/form-data">
                        <div class="edit-profile-picture">
                            <i class="fa fa-image fa-1x"></i>Edit Header Picture<br><br>
                            <input type="file" name="header_pic">
						</div>
						<div class="edit-text">
							<i class="fa fa-image fa-1x"></i>Edit Profile Picture<br><br>
                            <input type="file" name="propic">
                        </div>
                        <div class="edit-text">
                            <i class="fa fa-university fa-1x"></i>Edit University Name<br><br>
                            <input type="text" value="<?php echo $row['university'];?>" name="university">
                        </div>
                        <div class="edit-text">
                            <i class="fa fa-circle-notch fa-1x"></i>Edit Major<br><br>
                            <input type="text" value="<?php echo $row['major'];?>" name="major">
                        </div>
                        <div class="edit-text">
                            <i class="fa fa-edit fa-1x"></i> Edit Profile Description<br><br>
                            <input class="status-profile" type="text" value="<?php echo $row['status_desc'];?>" name="status_desc">
                        </div>

                    </div>
                    <div class="edit-right">
                         <div class="edit-text">
							<i class="fa fa-map-marker-alt fa-1x"></i>
							Edit City<br><br>
                            <input type="text" value="<?php echo $row['loc_city'];?>" name="loc_city">
                        </div>
                        <div class="edit-text">
                            <i class="fa fa-phone fa-1x"></i>Edit Phone Number<br><br>
                            <input type="text" value="<?php echo $row['phone'];?>" name="phone">
                        </div>
                        <div class="edit-text">
                            <i class="fa fa-mail-bulk fa-1x"></i>Edit Email<br><br>
                            <input type="text" value="<?php echo $row['email_stu'];?>" name="email_stu">
						</div>
						<div class="edit-text">
                            <input type="submit" name="update_profile">
						</div>
					</form>
					</div>
							
                </div>
			</div>
		</div>
	</div>
<?php
					}
				}
				?>
</body>
</html>