<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>CreativeSpace - Profile</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css"href="vendor/font-awesome/css/all.css">
	<link rel="stylesheet" type="text/css"href="vendor/font-awesome/css/brands.min.css">
	<link rel="stylesheet" type="text/css" href="css/navigation-bar.css">
	<link rel="stylesheet" type="text/css" href="css/profile.css">
	<link rel="stylesheet" type="text/css" href="css/timeline-responsive.css">
	<link rel="stylesheet" type="text/css" href="css/job-form.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script>
	$(document).ready(function(){
	    $("#main-form").click(function(){
            $(".main-form").slideDown("slow");
	    });
		$("#close-button").click(function(){
	        $(".main-form").slideUp("slow");
	    });
	});
	</script>
	
</head>
<body>
<?php
        include 'function/connection.php';
        $uname_visit = addslashes($_GET['uname_visit']);
		$uname_now = $_SESSION['student'];
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
					recruiter_profile WHERE recruiter_uname = '$uname_visit';";
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
						<a href="profile-rec.php"><?php echo $_SESSION['student'];?></a>
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
					<a href="profile-edit-rec.php"><i class="fa fa-edit fa-1x"></i></a>
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
					<div class="uname-name"><center>@<?php echo $row['recruiter_uname'];?></center></div>
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
			<?php
						}
					}
                    $job_query = "SELECT recruiter_img,
                    recruiter_city,
                    uname_rec_job, 
                    job_title,
                    job_desc,
                    job_skill,
                    job_deadline,
                    job_payment,
                    job_upload_date
                FROM recruiter_profile,
                    job_application
                WHERE recruiter_profile.recruiter_uname = job_application.uname_rec_job
                AND recruiter_profile.recruiter_uname = '$uname_visit'
                AND job_application.uname_rec_job = '$uname_visit' ORDER BY job_application.job_upload_date DESC;";
                $result_job = mysqli_query($conn, $job_query);
                $resultCheck_job = mysqli_num_rows($result_job);
			?>
		
			<div class="profile-timeline">
				
				<div class="timelines">
				<div class="timelines-title"><b>Uploaded Applications </b>
					<span class="count-span">
					<?php
                                if ($resultCheck_job > 1) {
                                    echo $resultCheck_job." Uploads";
                                } else {
                                    echo $resultCheck_job." Upload";
                                }
                            ?>
					</span>
				</div>
                
						<?php
				
		
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