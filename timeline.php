<?php
	session_start();
	
	?>
<!DOCTYPE html>
<html>
<head>
	<title>CreativeSpace - Timeline</title>
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
					<a class="active" href=""><i class="fa fa-1x fa-images"></i> Content</a>
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
				<!--<img src="img/girl.png">-->
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
			<div class="timelines-title">Content Timelines</div>
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
				$timeline_query = "SELECT student_img,
											university,
											uname, description,
											category,
											file,
											upload_date 
									FROM student_profile,
											 content
									WHERE student_profile.student_uname = content.uname ORDER BY content.upload_date DESC;";
				$result_tl = mysqli_query($conn, $timeline_query);
				$resultCheck_tl = mysqli_num_rows($result);
		
				if($resultCheck_tl > 0) {
					while ($row_tl = mysqli_fetch_assoc($result_tl)) {
			?>
			<div class="timelines-content">
				<div class="content-profile">
					<div class="content-profile-img">
									<?php
										$propic_tl = $row_tl['student_img'];
										if(!$propic_tl == null) {
											echo "<center><img src=profile-picture/$propic_tl></center>";
										} else {
											echo "<img src=img/girl.png>";
										}
									?>
						<!--<img src="profile-picture/<?php echo $row_tl['student_img'];?>">-->
					</div>
					<div class="content-profile-desc">
						<div class="content-profile-name">
							<a href="profile-visit.php?uname_visit=<?php echo $row_tl['uname']; ?>">
								<?php echo $row_tl['uname'];?>
							</a>
						</div>
						<div class="content-profile-univ">
							<i class="fa fa-1x fa-university"></i>
							<?php echo $row_tl['university'];?>
						</div>
					</div>
				</div>
				<div class="content">
					<div class="content-file">
						<img src="content-file/<?php echo $row_tl['file'];?>">
					</div>
				</div>
				<div class="content-category">
					<?php echo $row_tl['category'];?>
				</div>
				<div class="content-desc">
					<p>
						<?php echo $row_tl['description'];?>
					</p>	
				</div>
				<div class="content-time">
					<i class="fa fa-1x fa-clock"></i><?php echo $row_tl['upload_date'];?>
				</div>
			</div>
					<?php } } ?>
		</div>
	</div>
</body>
</html>