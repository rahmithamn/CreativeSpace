<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>CreativeSpace - Application Status</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css"href="vendor/font-awesome/css/all.css">
	<link rel="stylesheet" type="text/css"href="vendor/font-awesome/css/brands.min.css">
	<link rel="stylesheet" type="text/css" href="css/timeline.css">
	<link rel="stylesheet" type="text/css" href="css/navigation-bar.css">
	<link rel="stylesheet" type="text/css" href="css/timeline-responsive.css">
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
                <li style="float:right"> <form action="function/logout.php" method="POST">
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
						<?php }}?>
		<div class="timelines">
			<div class="timelines-title">
				Job Applications Status

				<a href="timeline-jobapp.php">Return to Job Applications Page</a>
			</div>
			<?php
						$sql_app = "SELECT
									uname_stu_apply,
									uname_rec_apply,
									job_title,
									job_skill,
									job_payment,
									status_apply,
									uname_stu,
									reply
								FROM apply_job,
									reply_apply
								WHERE apply_job.uname_stu_apply = reply_apply.uname_stu
								AND apply_job.uname_stu_apply = '$uname_now'
								AND reply_apply.uname_stu = '$uname_now'
								AND apply_job.job_title = reply_apply.job_t;";
						$result_app = mysqli_query($conn, $sql_app);
						$resultCheck_app = mysqli_num_rows($result_app);
				
						if($resultCheck_app > 0) {
							while ($row_app = mysqli_fetch_assoc($result_app)) {
					?>
			<table>
                <tr>
                    <td>Recruiter</td>
                    <td>Job Title</td>
                    <td>Skill Needed</td>
                    <td>Payment</td>
                    <td>Status</td>
				</tr>
				
                <tr>
					
                    <td><a style="text-decoration:none;" href=""><?php echo $row_app['uname_rec_apply'];?></a></td>
                    <td><?php echo $row_app['job_title'];?></td>
                    <td><?php echo $row_app['job_skill'];?></td>
                    <td><?php echo $row_app['job_payment'];?></td>
					<?php
						$status = $row_app['status_apply'];
						if($status == 'pending') {
							echo "<td><span style='background-color:orange;color:white;padding:3px;'>$status</span></td>";
						}
						if($status == 'Accepted') {
							echo "<td><span style='background-color:green;color:white;padding:3px;'>$status</span></td>";
						}
						if($status == 'Declined') {
							echo "<td><span style='background-color:red;color:white;padding:3px;'>$status</span></td>";
						}
					?>
							
				</tr>
				<tr>
					<td colspan="5">
						Reply : <br><br>
						<?php
							$rep = $row_app['reply'];
							if($status == 'pending') {
								echo "There is no reply yet.";
							} else {
								echo $rep;
							}
						?>
						
					</td>
				</tr>
				
            </table><br><br>
			<?php }}?>

		</div>
	</div>
</body>
</html>