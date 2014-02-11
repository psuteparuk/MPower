<!DOCTYPE html>
<html lang="en">
	<head>
		<title>MPower</title>
		<!--<meta charset="iso-8859-1">-->
		<meta charset="utf-8">
		<meta name="description" content="">
		<meta name="author" content="">
		
		<!-- stylesheets -->
		<link href="assets/css/bootstrap.css" rel="stylesheet">
        <link href="assets/css/bootstrap-responsive.css" rel="stylesheet">
		<link rel="stylesheet" href="assets/css/layout.css" type="text/css">
		<link rel="stylesheet" href="assets/css/elements.css" type="text/css">
		<link rel="stylesheet" href="assets/css/colorbox.css" type="text/css">
		<link rel="stylesheet" href="assets/css/report.css" type="text/css">
		
		<!--[if lt IE 9]>
			<script src="scripts/html5shiv.js"></script>
		<![endif]-->
		<script type="text/javascript" charset="utf-8" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
		<script type="text/javascript" charset="utf-8" src="assets/js/mpower.js"></script>
		<script type="text/javascript" charset="utf-8" src="assets/js/popbox.min.js"></script>
		<script type="text/javascript" charset="utf-8" src="assets/js/jquery.colorbox-min.js"></script>
		<script type="text/javascript" charset="utf-8" src="assets/js/jquery.timer.js"></script>
		<script type="text/javascript" charset="utf-8" src="assets/js/quiz_student.js"></script>
		<script>
			$(document).ready(function(){
				$(".report_link_dropdown").click(function(){
					var handle = $(this).next(".report_dropdown");
					if (handle.is(":visible")) $(this).css("background-image","url(assets/images/orange_file.gif)");
					else $(this).css("background-image","url(assets/images/orange_file_down.gif)");
					handle.slideToggle();
				});
				
				$("#report_radar_chart").colorbox({
					innerWidth:'1170px',
					innerHeight:'630px',
					iframe:'true'
				});
				
				$("#report_quiz_result").colorbox({
					innerWidth:'1300px',
					innerHeight:'650px',
					iframe:'true'
				});
			});
		</script>
	</head>
	
	<body>
		<!-- header -->
		<?php include 'header.php'; ?>
		
		<!-- content -->
		<div class="wrapper row2">
			<div id="container">
				<div class="full-canvas">
					<!-- content body -->
					<aside id="left_column">
						<nav>
							<ul>
							<li><a href="index.php"><h2>Home</h2></a></li>
							<li><a href="courses.php"><h2>Courses / Videos</h2></a></li>
							<li><a href="quiz_student.php"><h2>Quizzes</h2></a></li>
							<li class="selected"><a href="report.php"><h2>Report</h2></a></li>
							<li><a href="achievement.php"><h2>Achievement</h2></a></li>
							<li class="last"><a href="discussion.php"><h2>Discussion Forum</h2></a></li>
							</ul>
						</nav>
					</aside>
					
					<!-- main content -->
					<div id="content">
						<div id="section_header_div">
							<header id="section_header">
								<hgroup>
								<h1>Your Report</h1>
								</hgroup>
							</header>
						</div>
						
						<div id="report_links_div">
							<aside id="report_links">
								<nav>
								<?php
									//if (isset($_SESSION['login_user']) && !empty($_SESSION['login_user'])) {
										include 'db/dbconfig.php';
										$user_query = mysql_query('SELECT * FROM user WHERE username="'.$_SESSION['login_user'].'"');
										$user = mysql_fetch_array($user_query);
										echo '<ul>';
										echo '<li>';
										echo '<a class="report_link_dropdown" id="quiz_result_link" href="#"><h2>Quiz Results</h2></a>';
										echo '<div class="report_dropdown" id="quiz_result_dropdown">';
										echo '<div class="subreport_dropdown last" id="quiz_result">';
										echo '<a class="btn seereport" id="report_quiz_result" href="report_quiz_result.php" target="_blank">See Quiz Results</a>';
										echo '<p>How did you do?</p>';
										echo '</div>';
										echo '</div>';
										echo '</li>';
										echo '<li class="last">';
										echo '<a class="report_link_dropdown" id="strengths_dropdown" href="#"><h2>Know Your Strengths</h2></a>';
										echo '<div class="report_dropdown" id="quiz_result_dropdown">';
										echo '<div class="subreport_dropdown last" id="quiz_result">';
										echo '<a class="btn seereport" id="report_radar_chart" href="radarchart.html" target="_blank">Know Them Now!</a>';
										echo '<p>See your prograce over time.</p><p>Focus on where you need improvement.</p>';
										echo '</div>';
										echo '</div>';
										echo '</li>';
										echo '</ul>';
										mysql_close();
									//}
								?>
								</nav>
							</aside>
						</div>
					</div>
					
					<div class="clear"></div>
				</div>
			</div>
		</div>
		
		<!-- footer -->
		<?php include 'footer.php'; ?>
	</body>
	
</html>