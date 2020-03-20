<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>CreativeSpace - JOb Applications</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css"href="vendor/font-awesome/css/all.css">
	<link rel="stylesheet" type="text/css"href="vendor/font-awesome/css/brands.min.css">
	<link rel="stylesheet" type="text/css" href="css/timeline.css">
	<link rel="stylesheet" type="text/css" href="css/navigation-bar.css">
	<link rel="stylesheet" type="text/css" href="css/timeline-responsive.css">
	<link rel="stylesheet" type="text/css" href="css/job-form.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<?php
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
					student_img
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
		<div class="lower-navbar">
			<ul class="menu-padding">
				<li>
					<a href="timeline.php"><i class="fa fa-1x fa-images"></i> Content</a>
				</li>
				<li><a class="active" href=""><i class="fa fa-1x fa-newspaper"></i> Job Applications</a></li>
				<li style="float:right"><form action="function/logout.php" method="POST">
						<button class="logout" name="logout">Logout</button>
					</form></li>
			</ul>
		</div>
	</nav>
	<!-- END OF NAVBAR -->
	
	<div class="main">
		<div class="main-profile">
			<div class="main-profile-img">
			<?php
						$propic_query = "SELECT student_img FROM student_profile WHERE student_uname = '$uname_now';";
						
							$result_propic = mysqli_query($conn, $propic_query);
							$resultCheck_propic = mysqli_num_rows($result_propic);
								
							if($resultCheck_propic > 0) {
								while ($row_propic = mysqli_fetch_assoc($result_propic)) {
									$s_propic = $row_propic['student_img'];
									if(!$s_propic == null) {
										echo "<center><img src=profile-picture/$s_propic></center>";
									} else {
										echo "<img src=img/girl.png>";
									}
								}
							}
				?>
			</div>
			<div class="profile-name">
				<center><?php echo $row['name'];?></center>
			</div>
			<div class="uname-name">
				<center>@<?php echo $_SESSION['student'];?></center>
			</div>
			<div class="uni-name">
					<div class="icon-pro">
						<i class="fa fa-university fa-1x"></i>
					</div>
					<?php echo $row['university'];?><br>
				
			</div>
			<div class="uni-major">
					<div class="icon-pro">
						<i class="fa fa-circle-notch fa-1x"></i>
					</div>
					<?php echo $row['major'];?>
			</div>
			<div class="profile-location">
					<div class="icon-pro">
						<i class="fa fa-1x fa-map-marker-alt"></i>
					</div>
					<?php echo $row['loc_city'];?>
			</div>
		</div>
		<?php
			}
		}
	?>
		<div class="timelines">
			<div class="timelines-title">
				Job Applications

				<a href="timeline-jobapp-status.php">Check Applications Status Here</a>
			</div>
				<?php
				$job_query = "SELECT recruiter_img,
									recruiter_city,
									recruiter_uname,
									uname_rec_job,
									id_jobapp, 
									job_title,
									job_desc,
									job_skill,
									job_deadline,
									job_payment,
									job_upload_date
								FROM recruiter_profile,
									job_application
								WHERE recruiter_profile.recruiter_uname = job_application.uname_rec_job
								ORDER BY job_upload_date DESC;";
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
					<a href="profile-rec-visit-stu.php?uname_visit=<?php echo $row_job['recruiter_uname']; ?>" style="text-decoration:none;color:black;"><b><?php echo $row_job['uname_rec_job'];?></b></a> <br>
						<p><i class="fa fa-map-marker-alt fa-1x"></i><?php echo $row_job['recruiter_city'];?></p>
					</div>
				</div>
				<div class="content-job-category">
					<?php echo $row_job['job_skill'];?>
				</div>
				<div class="job-title">
					<?php echo $row_job['job_title'];?>
				</div>
				<div class="job-desc">
					<?php echo $row_job['job_desc'];?>
				</div>
				<div class="job-pay">
					Job Payment : Rp. <?php echo $row_job['job_payment'];?>
				</div>
				<div class="job-time">
					Need to be done in <?php echo $row_job['job_deadline'];?>
				</div>
				<div class="apply">
					<a href="job-apply.php?apply_job=<?php echo $row_job['id_jobapp']; ?>">Apply for Job</a>
				</div>
				<?php
                    $count_job = $row_job['job_title'];
                    $count_apply = "SELECT job_title FROM apply_job WHERE job_title = '$count_job';";

                    $result_count_applier = mysqli_query($conn, $count_apply);
                    $resultCheck_applier = mysqli_num_rows($result_count_applier);
                ?>
				<div class="count-applier"><?php echo $resultCheck_applier;?> apllied for the job</div>
				
			</div>
					<?php } }?>
			

		</div>
	</div>
	

</body>
</html>