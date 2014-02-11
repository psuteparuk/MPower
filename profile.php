<!DOCTYPE html>
<html lang="en">
	<head>
		<title>MPower</title>
		<!--<meta charset="iso-8859-1">-->
		<meta charset="utf-8">
		<meta name="description" content="">
		<meta name="author" content="">
		
		<!-- stylesheets -->
		<link href="bootstrap/css/bootstrap.css" rel="stylesheet">
        <link href="bootstrap/css/bootstrap-responsive.css" rel="stylesheet">
		<link rel="stylesheet" href="assets/css/layout.css" type="text/css">
		<link rel="stylesheet" href="assets/css/elements.css" type="text/css">
		<link rel="stylesheet" href="assets/css/colorbox.css" type="text/css">
		<link rel="stylesheet" href="assets/css/quiz.css" type="text/css">
		<link rel="shortcut icon" href="assets/ico/favicon.ico">

		<!--[if lt IE 9]>
			<script src="scripts/html5shiv.js"></script>
		<![endif]-->
		<script type="text/javascript" charset="utf-8" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
		<script type="text/javascript" charset="utf-8" src="assets/js/mpower.js"></script>
		<script type="text/javascript" charset="utf-8" src="assets/js/popbox.min.js"></script>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	
		<script type="text/javascript" charset="utf-8" src="assets/js/jquery.colorbox-min.js"></script>
		<script type="text/javascript" charset="utf-8" src="assets/js/jquery.timer.js"></script>
		<script type="text/javascript" charset="utf-8" src="assets/js/quiz_student.js"></script>
	</head>
	
	<body>
		<!-- header -->
		<?php include 'header.php'; ?>
		
		<!-- content -->
		<div id="container">
				<div class="full-canvas" style="height:450px">
					<!-- content body -->
					<aside id="left_column">
						<nav>
							<ul>
							<li class="selected"><a href="index.php"><h2>Home</h2></a></li>
							<li><a href="courses.php"><h2>Courses / Videos</h2></a></li>
							<li><a href="quiz.php"><h2>Quizzes</h2></a></li>
							<li><a href="report.php"><h2>Report</h2></a></li>
							<li><a href="achievement.php"><h2>Achievement</h2></a></li>
							<li class="last"><a href="discussion.php"><h2>Discussion Forum</h2></a></li>
							</ul>
						</nav>
					</aside>
					
					<!-- main content -->
					<div id="content">
						<?php
							include 'db/dbconfig.php';
							if (isset($_SESSION['login_user'])) {
								echo '<div><p>';
								$user_query = mysql_query('SELECT * FROM user WHERE username="'.$_SESSION['login_user'].'"');
								$user = mysql_fetch_array($user_query);
								echo '<h1>Welcome '.$user['firstname'].' '.$user['lastname'].'</h1><br/>';
								echo '<div><i class="icon-user"></i> '.$user['nickname'].'</div><br/>';
								echo '<div><i class="icon-time"></i> '.$user['birthday'].'</div><br/>';
								echo '<div><i class="icon-map-marker"></i> '.$user['address'].'</div><br/>';
								echo '<div><i class="icon-envelope"></i> '.$user['email'].'</div><br/>';
								echo '<div><i class="icon-headphones"></i> '.$user['phone'].'</div><br/>';
								echo '<div><i class="icon-heart"></i> '.$user['aboutyou'].'</div><br/>';
								echo '<div><i class="icon-star"></i> '.$user['goal'].'</div><br/>';
								echo '</p></div>';
							} else {
								echo '<h1>Please log in</h1>';
							}
							mysql_close();
						?>
								
					</div>
				</div>
						
		</div>
		
		<!-- footer -->
		<?php include 'footer.php'; ?>
		
		<script src="bootstrap/js/jquery.js"></script>
		<script src="bootstrap/js/bootstrap-transition.js"></script>
		<script src="bootstrap/js/bootstrap-alert.js"></script>
		<script src="bootstrap/js/bootstrap-modal.js"></script>
		<script src="bootstrap/js/bootstrap-dropdown.js"></script>
		<script src="bootstrap/js/bootstrap-scrollspy.js"></script>
		<script src="bootstrap/js/bootstrap-tab.js"></script>
		<script src="bootstrap/js/bootstrap-tooltip.js"></script>
		<script src="bootstrap/js/bootstrap-popover.js"></script>
		<script src="bootstrap/js/bootstrap-button.js"></script>
		<script src="bootstrap/js/bootstrap-collapse.js"></script>
		<script src="bootstrap/js/bootstrap-carousel.js"></script>
		<script src="bootstrap/js/bootstrap-typeahead.js"></script>
	</body>
	
</html>