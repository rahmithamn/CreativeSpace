<?php
	session_start();
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
		$uname_now = $_SESSION['recruiter'];
		include 'function/connection.php';
		$sql = "SELECT 
					recruiter_name,
                    recruiter_uname,
                    recruiter_city,
                    recruiter_img,
                    recruiter_header,
                    recruiter_email,
                    recruiter_phone,
                    recruiter_status
				FROM 
					recruiter_profile WHERE recruiter_uname = '$uname_now';";
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
							$propic = $row['recruiter_img'];
							if(!$propic == null) {
								echo "<center><img src=profile-picture/$propic></center>";
							} else {
								echo "<img src=img/enterprise.png>";
							}
						?>
						</div>
						<a href="profile-rec.php"><?php echo $_SESSION['recruiter'];?></a>
					</div>
				</li>
				<li><a href="faq.php">FAQs</a></li>
				<li><a href="timeline-rec.php">Timeline</a></li>
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
					<a href="timeline-rec.php"><i class="fa fa-1x fa-images"></i> Content</a>
				</li>
				<li><a href="timeline-jobapp-employer.php"><i class="fa fa-1x fa-newspaper"></i> Job Applications</a></li>
				<li><a href="job-applicant.php"><i class="fa fa-1x fa-user-edit"></i> Job Applicants</a></li>
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
		$header_stu = $row['recruiter_header'];
		if(!$header_stu == null) {
			$headerbg = 'header-recruiter/'.$row['recruiter_header'];
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
							$propic = $row['recruiter_img'];
							if(!$propic == null) {
								echo "<center><img src=profile-picture/$propic></center>";
							} else {
								echo "<img src=img/enterprise.png>";
							}
						?>
					
				</div>
				<div class="more-profile">
					<div class="profile-name"><?php echo $row['recruiter_name'];?></div>
					<div class="uname-name"><center>@<?php echo $_SESSION['recruiter'];?></center></div>
					<div class="profile-status">
						"<?php echo $row['recruiter_status'];?>"
					</div>
					<div class="profile-info">
                    <div class="info-profile">
							<div class="icon-info">
								<i class="fa fa-map-marker-alt fa-1x"></i>
							</div>
							<div class="icon-ket">
							<?php
									$loc = $row['recruiter_city'];
									if($loc == null) {
										echo "-";
									} else {
										echo $row['recruiter_city'];
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
									$phonenum = $row['recruiter_phone'];
									if($phonenum == 0) {
										echo "-";
									} else {
										echo $phonenum;
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
										$emails = $row['recruiter_email'];
										if($emails == null) {
											echo "-";
										} else {
											echo $emails;
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
				<div class="main-edit-profile" style="margin-bottom:60px;">
					
                    <div class="edit-left">
					<form action="function/update-profile-rec.php" method="POST" enctype="multipart/form-data">
                        <div class="edit-profile-picture">
                            <i class="fa fa-image fa-1x"></i>Edit Header Picture<br><br>
                            <input type="file" name="header_pic">
						</div>
						<div class="edit-text">
							<i class="fa fa-image fa-1x"></i>Edit Profile Picture<br><br>
                            <input type="file" name="propic">
                        </div>
                        <div class="edit-text">
                            <i class="fa fa-edit fa-1x"></i> Edit Profile Description<br><br>
                            <input class="status-profile" type="text" value="<?php echo $row['recruiter_status'];?>" name="status_desc">
                        </div>

                    </div>
                    <div class="edit-right">
                         <div class="edit-text">
							<i class="fa fa-map-marker-alt fa-1x"></i>
							Edit City<br><br>
                            <input type="text" value="<?php echo $row['recruiter_city'];?>" name="loc_city">
                        </div>
                        <div class="edit-text">
                            <i class="fa fa-phone fa-1x"></i>Edit Phone Number<br><br>
                            <input type="text" value="<?php echo $row['recruiter_phone'];?>" name="phone">
                        </div>
                        <div class="edit-text">
                            <i class="fa fa-mail-bulk fa-1x"></i>Edit Email<br><br>
                            <input type="text" value="<?php echo $row['recruiter_email'];?>" name="email_stu">
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