<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>CreativeSpace - Job Experience</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css"href="vendor/font-awesome/css/all.css">
	<link rel="stylesheet" type="text/css"href="vendor/font-awesome/css/brands.min.css">
	<link rel="stylesheet" type="text/css" href="css/navigation-bar.css">
	<link rel="stylesheet" type="text/css" href="css/profile.css">
	<link rel="stylesheet" type="text/css" href="css/job-form.css">
	<link rel="stylesheet" type="text/css" href="css/timeline-responsive.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
</head>
<body>
<?php
		include 'function/connection.php';
		$uname_now = $_SESSION['student'];
		include 'function/connection.php';
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
					<a href="profile-edit.php"><i class="fa fa-edit fa-1x"></i></a>
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
									<?php }}?>
			<div class="profile-timeline">
				<div class="page-divider">
					<a href="profile.php" class="not-active-profile">Content</a>
					<a href="profile-job.php" class="active-profile">Job Experience</a>
				</div>
				<div class="timelines">
			<div class="timelines-title">Job Experience </div>
			<?php
				$job_query = "SELECT a.recruiter_img,
									a.recruiter_city,
									b.uname_rec_job, 
									b.job_title,
									b.job_desc,
									b.job_skill,
									b.job_deadline,
									b.job_payment,
									b.job_upload_date,
									c.status_apply
								FROM recruiter_profile a
								LEFT JOIN job_application b ON a.recruiter_uname = b.uname_rec_job
								LEFT JOIN apply_job c ON b.job_title = c.job_title 
								WHERE c.uname_stu_apply = '$uname_now'
								AND c.status_apply = 'Accepted';";
				$result_job = mysqli_query($conn, $job_query);
				$resultCheck_job = mysqli_num_rows($result_job);
		
				if($resultCheck_job > 0) {
					while ($row_job = mysqli_fetch_assoc($result_job)) {
			?>
			<div class="timelines-job">
				<div class="profile-job">
					<div class="profile-job-img">
					<?php
							$propic = $row_job['recruiter_img'];
							if(!$propic == null) {
								echo "<center><img src=profile-picture/$propic></center>";
							} else {
								echo "<img src=img/enterprise.png>";
							}
						?>
					</div>
					<div class="profile-job-uname">
						<b><?php echo $row_job['uname_rec_job'];?></b> <br>
						<p><i class="fa fa-map-marker-alt fa-1x"></i><?php echo $row_job['recruiter_city'];?></p>
					</div>
				</div>
				<div class="job-title">
				<?php echo $row_job['job_title'];?>
				</div>
				<div class="job-desc">
					<?php echo $row_job['job_desc'];?>
				</div>
				<div class="content-job-category">
					<?php echo $row_job['job_skill'];?>
				</div>
				<div class="job-pay">
					Job Payment : Rp. <?php echo $row_job['job_payment'];?>
				</div>
				<div class="job-time">
					Need to be done in <?php echo $row_job['job_deadline'];?>
				</div>
				<div class="content-time">
					<i class="fa fa-1x fa-clock"></i><?php echo $row_job['job_upload_date'];?>
				</div>
			</div>
					<?php }} ?>
	</div>
			</div>
		</div>
	</div>
	
</body>
</html>