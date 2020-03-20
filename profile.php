<?php
	session_start();
	if(!isset($_SESSION['submit'])) {
		echo "Illegal Akses";
	}
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
			<?php
						}
					}
						$query_profile_tl = "SELECT student_img, 
																				university, 
																				uname, 
																				description, 
																				category, 
																				file,
																				upload_date 
																FROM student_profile, 
																			content 
																WHERE student_profile.student_uname = '$uname_now' 
																AND content.uname='$uname_now' ORDER BY upload_date DESC;";
						$result_profile_tl = mysqli_query($conn, $query_profile_tl);
						$resultCheck_profile_tl = mysqli_num_rows($result_profile_tl);
			?>
		
			<div class="profile-timeline">
				<div class="page-divider">
					<a href="profile.php" class="active-profile">Content</a>
					<a href="profile-job.php" class="not-active-profile">Job Experience</a>
				</div>
				<div class="timelines">
				<div class="timelines-title"><b>Content Timelines </b>
					<span class="count-span">
					<?php
                                if ($resultCheck_profile_tl > 1) {
                                    echo $resultCheck_profile_tl." Uploads";
                                } else {
                                    echo $resultCheck_profile_tl." Upload";
                                }
                            ?>
					</span>
				</div>
			<div class="timelines-post">
				
				<div class="timelines-post-input">
				<form action="function/post-content.php" method="POST" enctype="multipart/form-data">
					<textarea name="description" placeholder="Describe your upload here..."></textarea>
					<div class="category-upload">
						<select name="category">
							<option name="category" value="Category">Category</option>
							<option name="category" value="Web Design">Web Design</option>
							<option name="category" value="Web Development">Web Development</option>
							<option name="category" value="Graphic Design">Graphic Design</option>
							<option name="category" value="Interior Design">Interior Design</option>
							<option name="category" value="Photography">Photography</option>
							<option name="category" value="Fashion Design">Fashion Design</option>
							<option name="category" value="Sketch">Sketch</option>
							<option name="category" value="Painting">Painting</option>


						</select>
						<input name="file" type="file" class="custom-file-input">
						<input class="input-upload" type="submit" name="upload_content" value="Upload">
						</form>
					</div>
					
				</div>
				
			</div>
						<?php
				
						if($resultCheck_profile_tl > 0) {
							while ($row_profile_tl = mysqli_fetch_assoc($result_profile_tl)) {
							
						?>
					<div class="timelines-content">
						<div class="content-profile">
							<div class="content-profile-img">
								<?php
										$propic_tl = $row_profile_tl['student_img'];
										if(!$propic_tl == null) {
											echo "<center><img src=profile-picture/$propic_tl></center>";
										} else {
											echo "<img src=img/girl.png>";
										}
									?>
							</div>
							<div class="content-profile-desc">
								<div class="content-profile-name"><?php echo $row_profile_tl['uname'];?></div>
								<div class="content-profile-univ">
									<i class="fa fa-1x fa-university"></i>
									<?php echo $row_profile_tl['university'];?>
								</div>
							</div>
						</div>
						<div class="content">
							<div class="content-file">
								<img src="content-file/<?php echo $row_profile_tl['file'];?>">
							</div>
						</div>
						<div class="content-category">
							<?php echo $row_profile_tl['category'];?>
						</div>
						<div class="content-desc">
							<p>
								<?php echo $row_profile_tl['description'];?>
							</p>	
						</div>
						<div class="content-time">
							<i class="fa fa-1x fa-clock"></i><?php echo $row_profile_tl['upload_date'];?>
							
						</div>
					</div>
					<?php }} ?>
				</div>
			</div>
		</div>
	</div>
						
</body>
</html>