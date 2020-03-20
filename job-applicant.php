<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>CreativeSpace - Applicant</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css"href="vendor/font-awesome/css/all.css">
	<link rel="stylesheet" type="text/css"href="vendor/font-awesome/css/brands.min.css">
	<link rel="stylesheet" type="text/css" href="css/timeline.css">
	<link rel="stylesheet" type="text/css" href="css/navigation-bar.css">
	<link rel="stylesheet" type="text/css" href="css/timeline-responsive.css">
	<link rel="stylesheet" type="text/css" href="css/job-applicant.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<?php
		$uname_now = $_SESSION['recruiter'];
		include 'function/connection.php';
		$sql = "SELECT 
					recruiter_name,
                    recruiter_uname,
                    recruiter_city,
                    recruiter_img
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
						<a href=""><?php echo $_SESSION['recruiter'];?></a>
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
				<li><a class="active" href="timeline-jobapp-employer.php"><i class="fa fa-1x fa-newspaper"></i> Job Applications</a></li>
				<li><a href=""><i class="fa fa-1x fa-user-edit"></i> Job Applicants</a></li>
				<li style="float:right"> 
					<form action="function/logout.php" method="POST">
						<button class="logout">Logout</button></li></form>
			</ul>
		</div>
	</nav>
	<!-- END OF NAVBAR -->

	<div class="main">
		<div class="main-profile">
		<div class="main-profile-img">
				<?php
						$propic = $row['recruiter_img'];
						if(!$propic == null) {
							echo "<center><img src=profile-picture/$propic></center>";
						} else {
							echo "<img src=img/enterprise.png>";
						}
				?>
				<!--<img src="img/girl.png">-->
			</div>
			<div class="profile-name">
				<center><?php echo $row['recruiter_name'];?></center>
			</div>
			<div class="uname-name">
				<center>@<?php echo $_SESSION['recruiter'];?></center>
			</div>
			<div class="pro-loc" style="margin-bottom:30px;">
                    <div class="icon-pro">
						<i class="fa fa-1x fa-map-marker-alt"></i>
					</div>
					<?php echo $row['recruiter_city'];?>
				
			</div>
		</div>
					<?php }} ?>
		<div class="timelines">
            <div class="timelines-title">Job Applicants</div>
            <?php
                    $applicant = "SELECT job_title,
                                        job_skill,
                                        student_uname,
                                        student_img,
                                        university,
                                        major,
                                        phone,
                                        email_stu,
                                        explanation
                                FROM student_profile,
                                    apply_job
                                WHERE student_profile.student_uname = apply_job.uname_stu_apply
                                AND apply_job.uname_rec_apply = '$uname_now'
                                AND apply_job.status_apply = 'pending';";
                    $result_app = mysqli_query($conn, $applicant);
                    $resultCheck_app = mysqli_num_rows($result_app);
            
                    if($resultCheck_app > 0) {
                        while ($row_app = mysqli_fetch_assoc($result_app)) {
                ?>
            <div class="applicants">
                <form action="function/status-apply.php" method="POST">
                <input name="job_t" readonly class="input-title" type="text" value="<?php echo $row_app['job_title'];?>"><span><?php echo $row_app['job_skill'];?></span>
                <table class="table-applicant">
                    <tr>
                        <td>Username</td>
                        <td>University</td>
                        <td>Major</td>
                        <td>Contact</td>
                    </tr>
                    <tr>
                        <td class="applicant-profile">
                            <div class="applicant-img">
                                    <?php
										$propic_tl = $row_app['student_img'];
										if(!$propic_tl == null) {
											echo "<center><img src=profile-picture/$propic_tl></center>";
										} else {
											echo "<img src=img/girl.png>";
										}
									?>
                            </div>
                            <div class="applicant-uname">
                                <a href="profile-visit-rec.php?uname_visit=<?php echo $row_app['student_uname'];?>">
                                    <?php echo $row_app['student_uname'];?>
                                </a>
                            </div>
                        </td>
                        <td><?php echo $row_app['university'];?></td>
                        <td><?php echo $row_app['major'];?></td>
                        <td>
                            <i class="fa fa-phone fa-1x"></i><?php echo $row_app['phone'];?><br>
                            <i class="fa fa-mail-bulk fa-1x"></i><?php echo $row_app['email_stu'];?><br>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4">"<?php echo $row_app['explanation'];?>"</td>
                        
                    </tr>
                    <tr>
                        <td colspan="3"><textarea name="reply"></textarea></td>
                        <td>
                            
                            <select name="accept">
                                <option name="accept" value="Accepted">Accept</option>
                                <option name="accept" value="Declined">Decline</option>
                            </select>
                            <input style="display:none;" type="text" name="uname_stu" value="<?php echo $row_app['student_uname'];?>">
                            <input type="submit" name="submit" class="submit-apply">
                            </form>
                        </td>
                    </tr>
                </table>
               
            </div>
            <?php }} ?>
        </div>
	</div>
	
</body>
</html>